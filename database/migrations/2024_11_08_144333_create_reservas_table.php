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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim')->nullable();
            $table->unsignedBigInteger('unidade_id')->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('sala_id');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sala_id')->references('id')->on('salas')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
