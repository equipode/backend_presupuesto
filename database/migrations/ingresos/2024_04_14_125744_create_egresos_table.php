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
        Schema::create('egresos', function (Blueprint $table) {
            $table->id('pk_egreso');
            $table->date('fecha_egreso');
            $table->double('valor',22,0);

            $table->unsignedBigInteger('fk_descripcion_egreso');
            $table->foreign('fk_descripcion_egreso')->references('pk_descrip_egreso')->on('descripcion_egresos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
