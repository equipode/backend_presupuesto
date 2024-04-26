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

    public function create(Request $request)
    {
        try{
            $request->validate([
                'cliente' => 'required|min:3|max:11',
                'fk_ve_hiculo' => 'required|integer'
            ]);
        } catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['errors' => $e->errors()], 422);
        }

        $ventas = new ventas();
        $ventas->cliente = $request->cliente; 
        $ventas->fk_ve_hiculo = $request->fk_ve_hiculo; 
        $ventas->save();

        return response()->json([
            'ok' => 'venta creada'
        ], 201);
    }
}
