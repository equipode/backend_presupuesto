<?php

namespace App\Http\Controllers\ingresos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ingresos\ingresos;

class ingresosController extends Controller
{
    public function index()
    {
        $ingresos = ingresos::with('descripcionIngresos')
            ->orderBy('fecha_ingreso', 'desc')
            ->get();

        return response()->json($ingresos);
    }
}
