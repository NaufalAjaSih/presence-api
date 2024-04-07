<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function getByDate(Request $request)
    {
        $agendas = Agenda::all();

        if ($agendas->isEmpty()) {
            return response()->json([
                'message' => 'Agenda not found',
            ], 404);
        }

        // Membuat array untuk menyimpan agendanya berdasarkan tanggal
        $response = [];

        foreach ($agendas as $agenda) {
            $response[$agenda->date][] = $agenda;
        }

        return response()->json([
            'data' => $response
        ]);
    }
}
