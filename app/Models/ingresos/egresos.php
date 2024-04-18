<?php

namespace App\Models\ingresos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class egresos extends Model
{
    use HasFactory;
    protected $primaryKey = 'pk_egreso';
    public function descripcionEgreso(){
        return $this->belongsTo(descripcion_egresos::class, 'fk_descripcion_egreso', 'pk_descrip_egreso');
    }    
}
