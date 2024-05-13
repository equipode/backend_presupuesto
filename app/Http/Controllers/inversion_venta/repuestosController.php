<?php

namespace App\Http\Controllers\inversion_venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inversion_venta\repuestos;
use App\Models\inversion_venta\vehiculos;

class repuestosController extends Controller
{
    public function index()
    {
        $repuestos = repuestos::with('repuestoVehiculo')
            ->orderBy('nombre', 'asc')
            ->get();

        return response()->json($repuestos);
    }

    public function repuestosPorIdVehiculo(int $id = 0)
    {
        if ($id <= 0) {
            return response()->json([
                'error' => 'debe enviar el id del repuesto para eliminar'
            ], 404);
        }

        $repuestos = repuestos::query()
        ->with('repuestoVehiculo')
        ->where('fk_vehiculo', '=', $id)
        ->get();

        return response()->json($repuestos);
    }

    public function create(Request $request)
    {
        try{
            $request->validate([
                'nombre' => 'required|min:3|max:19',
                'cantidad' => 'required|integer',
                'precio' => 'required|integer',
                'fk_vehiculo' => 'required|integer',
                'precio_repuestos' => 'required|integer'
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

        $vehiculo = vehiculos::find($request->fk_vehiculo);
        $vehiculo->precio_repuesto = $request->precio_repuestos;
        $vehiculo->save();

        return response()->json([
            'ok' => 'repuesto creado'
        ], 201);
    }

    public function destroy(Request $request, int $id = 0)
    {
            if ($id <= 0) {
                return response()->json([
                    'error' => 'debe enviar el id del repuesto para eliminar'
                ], 404);
            }

            $repuestos = repuestos::find($id);
            if (is_null($repuestos)) {
                return response()->json([
                    'error' => 'No se pudo realizar correctamente con este id ' . $id . ''
                ], 404);
            }

            $repuestos->delete();
            return response()->json([
                'ok' => 'Repuesto eliminado'
            ], 204);
        }
}
