<?php

namespace App\Models\ingresos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos extends Model
{
    use HasFactory;
    protected $primaryKey = 'pk_ingreso';
    public function descripcionIngreso(){
        return $this->belongsTo(descripcion_ingresos::class, 'fk_descripcion', 'pk_descrip');
    }
}
