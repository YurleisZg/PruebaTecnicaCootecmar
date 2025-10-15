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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained();
            $table->foreignId('bloque_id')->constrained();
            $table->foreignId('pieza_id')->constrained();
            $table->decimal('peso_real', 8,3)->nullable();
            $table->decimal('diferencia', 8,3)->nullable();
            $table->timestamp('registrado_en');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
