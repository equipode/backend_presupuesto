<?php

namespace App\Http\Controllers\inversion_venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inversion_venta\repuestos;

class repuestosController extends Controller
{
    public function index()
    {
        $repuestos = repuestos::with('repuestoVehiculo')
            ->orderBy('nombre', 'asc')
            ->get();

        return response()->json($repuestos);
    }
}
