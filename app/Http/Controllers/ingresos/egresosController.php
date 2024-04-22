<?php

namespace App\Http\Controllers\ingresos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ingresos\egresos;

class egresosController extends Controller
{
    public function index()
    {
        $egresos = egresos::with('descripcionEgreso')
            ->orderBy('fecha_egreso', 'desc')
            ->get();

        return response()->json($egresos);
    }
}
