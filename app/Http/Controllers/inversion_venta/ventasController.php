<?php

namespace App\Http\Controllers\inversion_venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inversion_venta\ventas;

class ventasController extends Controller
{
    public function index()
    {
        $ventas = ventas::with('ventaVehiculo')
            ->orderBy('cliente', 'asc')
            ->get();

        return response()->json($ventas);
    }
}
