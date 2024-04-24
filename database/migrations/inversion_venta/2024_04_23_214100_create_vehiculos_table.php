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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id('pk_vehiculo');
            $table->char('placa', 20);
            $table->char('marca', 20);
            $table->double('precio_ingreso', 22,0);
            $table->double('precio_repuesto', 22,0);
            $table->double('precio_egreso', 22,0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
