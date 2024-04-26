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

    public function create(Request $request)
    {
        try{
            $request->validate([
                'placa' => 'required|min:3|max:11',
                'marca' => 'required|min:3|max:11',
                'precio_ingreso' => 'required|integer',
                'precio_repuesto' => 'required|integer',
                'precio_egreso' => 'required|integer'
            ]);
        } catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['errors' => $e->errors()], 422);
        }

        $vehiculo = new vehiculos();
        $vehiculo->placa = $request->placa; 
        $vehiculo->marca = $request->marca; 
        $vehiculo->precio_ingreso = $request->precio_ingreso; 
        $vehiculo->precio_repuesto = $request->precio_repuesto; 
        $vehiculo->precio_egreso = $request->precio_egreso; 
        $vehiculo->save();

        return response()->json([
            'ok' => 'vehiculo creado'
        ], 201);
    }


}
