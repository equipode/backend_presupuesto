<?php

namespace App\Models\inversion_venta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repuestos extends Model
{
    use HasFactory;
    protected $primaryKey = 'pk_repuesto';
    public function repuestoVehiculo(){
        return $this->belongsTo(vehiculos::class, 'fk_vehiculo', 'pk_vehiculo');
    }
}
