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

    public function create(Request $request)
    {
        try{
            $request->validate([
                'nombre' => 'required|min:3|max:11',
                'cantidad' => 'required|integer',
                'precio' => 'required|integer',
                'fk_vehiculo' => 'required|integer'
            ]);
        } catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['errors' => $e->errors()], 422);
        }

        $repuestos = new repuestos();
        $repuestos->nombre = $request->nombre; 
        $repuestos->cantidad = $request->cantidad; 
        $repuestos->precio = $request->precio; 
        $repuestos->fk_vehiculo = $request->fk_vehiculo; 
        $repuestos->save();

        return response()->json([
            'ok' => 'repuesto creado'
        ], 201);
    }
}
