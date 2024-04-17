<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id('pk_ingreso');
            $table->date('fecha_ingreso');
            $table->double('valor',22,0);

            $table->unsignedBigInteger('fk_descripcion');
            $table->foreign('fk_descripcion')->references('pk_descrip')->on('descripcion_ingresos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
