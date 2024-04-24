<?php

namespace App\Http\Controllers\inversion_venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inversion_venta\vehiculos;

class vehiculosController extends Controller
{
    public function index()
    {
        $vehiculos = vehiculos::orderBy('placa', 'asc')
            ->get();

        return response()->json($vehiculos);
    }
}
