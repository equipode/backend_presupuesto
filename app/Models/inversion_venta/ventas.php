<?php

namespace App\Models\inversion_venta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    use HasFactory;
    protected $primaryKey = 'pk_venta';
    public function ventaVehiculo(){
        return $this->belongsTo(vehiculos::class, 'fk_ve_hiculo', 'pk_vehiculo');
    }
}
