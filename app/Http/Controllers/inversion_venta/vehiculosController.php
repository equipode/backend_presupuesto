<?php

namespace App\Http\Controllers\inversion_venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inversion_venta\vehiculos;
use App\Models\inversion_venta\repuestos;
use App\Models\inversion_venta\ventas;

class vehiculosController extends Controller
{
    public function index()
    {
        $vehiculos = vehiculos::orderBy('placa', 'asc')
            ->get();

        return response()->json($vehiculos);
    }
    public function vehiculosPorId(Request $request, $id = 0)
    {

        try {
            $request->validate([
                'rol_user' => 'required|integer'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $rol_user = $request->rol_user;
        $rol = $this->validateRolUser($rol_user);
        if ($rol) {

            if ($id <= 0) {
                return response()->json([
                    'error' => 'debe enviar el id del task'
                ], 404);
            }

            $vehiculos = vehiculos::find($id);
            if (is_null($vehiculos)) {
                return response()->json([
                    'error' => 'no se pudo realizar correctamente con este id ' . $id . ''
                ], 404);
            }
            return response()->json($vehiculos);
        } else {
            return response()->json([
                'error' => 'Access prohibited'
            ], 403);
        }
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
            'ok' => 'vehiculo creado',
            'resp' => $vehiculo
        ], 201);
    }

    public function destroy(Request $request, int $id = 0)
    {
            if ($id <= 0) {
                return response()->json([
                    'error' => 'debe enviar el id del vehículo para eliminar'
                ], 404);
            }

            $vehiculo = vehiculos::find($id);
            if (is_null($vehiculo)) {
                return response()->json([
                    'error' => 'No se pudo realizar correctamente con este id ' . $id . ''
                ], 404);
            }

            $repuesto = repuestos::query()->where('fk_vehiculo', '=', $id);
            if (is_null($repuesto)) {
                return response()->json([
                    'error' => 'No se pudo realizar correctamente con este id ' . $id . ''
                ], 404);
            }

            $venta = ventas::query()->where('fk_ve_hiculo', '=', $id)->count();
            if ($venta > 0) {
                return response()->json([
                    'error' => 'No se puede eliminar el vehículo, porque está relacionado con una venta'
                ], 422);
            }

            $repuesto->delete();

            $vehiculo->delete();
            return response()->json([
                'ok' => 'Vehículo eliminado'
            ], 204);
        }


}
