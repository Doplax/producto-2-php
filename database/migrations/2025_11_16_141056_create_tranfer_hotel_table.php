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
        Schema::create('tranfer_hotel', function (Blueprint $table) {
            $table->id('id_hotel');
            $table->unsignedBigInteger('id_zona')->nullable();
            $table->integer('Comision')->nullable();
            $table->string('usuario', 100)->nullable();
            $table->string('password', 100);
            
            $table->foreign('id_zona')->references('id_zona')->on('transfer_zona');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranfer_hotel');
    }
};
