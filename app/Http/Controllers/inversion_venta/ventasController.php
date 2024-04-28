<?php

namespace App\Http\Controllers\inversion_venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inversion_venta\ventas;
use App\Models\inversion_venta\vehiculos;

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
                'cliente' => 'required|min:3|max:50',
                'fk_ve_hiculo' => 'required|integer',
                'precio_egreso' => 'required|integer'
            ]);
        } catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['errors' => $e->errors()], 422);
        }

        $ventas = new ventas();
        $ventas->cliente = $request->cliente;
        $ventas->fk_ve_hiculo = $request->fk_ve_hiculo;
        $ventas->save();

        $vehiculo = vehiculos::find($request->fk_ve_hiculo);
        $vehiculo->precio_egreso = $request->precio_egreso;
        $vehiculo->save();

        return response()->json([
            'ok' => 'venta creada'
        ], 201);
    }

    public function destroy(Request $request, int $id = 0)
    {
            if ($id <= 0) {
                return response()->json([
                    'error' => 'debe enviar el id de la venta para eliminar'
                ], 404);
            }

            $ventas = ventas::find($id);
            if (is_null($ventas)) {
                return response()->json([
                    'error' => 'No se pudo realizar correctamente con este id ' . $id . ''
                ], 404);
            }

            $ventas->delete();
            return response()->json([
                'ok' => 'Venta eliminada'
            ], 204);
        }
}
