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
        Schema::create('transfer_reservas', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->string('localizador', 100);
            $table->unsignedBigInteger('id_hotel')->nullable()->comment('Es el hotel que realiza la reserva');
            $table->unsignedBigInteger('id_tipo_reserva');
            $table->string('email_cliente', 100);
            $table->dateTime('fecha_reserva');
            $table->dateTime('fecha_modificacion');
            $table->unsignedBigInteger('id_destino')->comment('Es el hotel de destino del viajero');
            $table->date('fecha_entrada')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->string('numero_vuelo_entrada', 50)->nullable();
            $table->string('origen_vuelo_entrada', 50)->nullable();
            $table->time('hora_vuelo_salida')->nullable();
            $table->date('fecha_vuelo_salida')->nullable();
            $table->integer('num_viajeros');
            $table->unsignedBigInteger('id_vehiculo');
            
            $table->foreign('id_destino')->references('id_hotel')->on('tranfer_hotel');
            $table->foreign('id_hotel')->references('id_hotel')->on('tranfer_hotel');
            $table->foreign('id_tipo_reserva')->references('id_tipo_reserva')->on('transfer_tipo_reserva');
            $table->foreign('id_vehiculo')->references('id_vehiculo')->on('transfer_vehiculo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_reservas');
    }
};
