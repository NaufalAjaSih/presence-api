<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function getByDate(Request $request)
    {
        $date = $request->get('date');

        $agendas = Agenda::where('date', $date)->get();

        if (!$agendas) {
            return response()->json([
                'message' => 'Agenda not found',
            ], 404);
        }
        
        return response()->json([
            'data' => $agendas,
        ]);
    }
}
