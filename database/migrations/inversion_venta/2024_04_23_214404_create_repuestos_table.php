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
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id('pk_repuesto');
            $table->char('nombre', 20);
            $table->unsignedBigInteger('cantidad');
            $table->double('precio', 22,0);
            $table->unsignedBigInteger('fk_vehiculo');
            $table->foreign('fk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repuestos');
    }
};
