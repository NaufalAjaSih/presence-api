<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresenceController extends Controller
{
    private $officeLatitude = -7.874703;
    private $officeLongitude = 112.524122;

    public function recordCheckIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        $now = now()->addHours(7);
        $allowedRadius = 5;

        $distance = $this->calculateDistance($request->latitude, $request->longitude, $this->officeLatitude, $this->officeLongitude);

        if ($distance > $allowedRadius) {
            return response()->json([
                'message' => 'Anda berada di luar radius absensi. Silahkan mendekat ke kantor.'
            ], 400);
        }

        $presence = Presence::where('user_id', $user->id)->where('date', $now->format('Y-m-d'))->first();

        if (!$presence) {
            $presence = Presence::create([
                'user_id' => $user->id,
                'date' => now()->addHours(7)->format('Y-m-d'),
                'check_in' => now()->addHours(7)->format('H:i:s'),
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            $work_start_time = '08:00:00';
            $work_end_time = '17:00:00';
            $tolerance_minutes = 15;

            $check_in_time = strtotime($presence->check_in);
            $work_start_time = strtotime($work_start_time);
            $work_end_time = strtotime($work_end_time);

            if ($check_in_time <= $work_start_time) {
                $presence->attendance_status = 'Tepat Waktu';
            } else {
                $minutes_late = round(($check_in_time - $work_start_time) / 60, 0);
                if ($minutes_late <= $tolerance_minutes) {
                    $presence->attendance_status = 'Terlambat ' . $minutes_late . ' menit';
                } else {
                    $presence->attendance_status = 'Telat';
                }
            }

            $presence->save();

            return response()->json([
                'message' => 'Attendance recorded successfully.',
                'data' => $presence,
            ]);
        } else {
            if (!$presence->check_out) {
                $presence->check_out = $now->format('H:i:s');
                $presence->save();

                return response()->json([
                    'message' => 'Check-out recorded successfully.',
                    'data' => $presence,
                ]);
            } else {
                return response()->json([
                    'message' => 'Anda sudah melakukan check-out.',
                ], 400);
            }
        }
    }

    public function userDistance(Request $request)
    {
        $distance = $this->calculateDistance($request->latitude, $request->longitude, $this->officeLatitude, $this->officeLongitude);

        if ($distance >= 1000) {
            $formattedDistance = number_format($distance / 1000, 1) . " km";
        } else {
            $formattedDistance = number_format($distance, 2) . " m";
        }

        return response()->json([
            'data' => $formattedDistance,
        ]);
    }

    private function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371000;
        $lat1 = deg2rad($latitude1);
        $lon1 = deg2rad($longitude1);
        $lat2 = deg2rad($latitude2);
        $lon2 = deg2rad($longitude2);

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($deltaLon / 2) * sin($deltaLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }
}
