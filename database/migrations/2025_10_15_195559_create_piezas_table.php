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
        Schema::create('piezas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->decimal('peso_teorico', 8, 3);
            $table->decimal('peso_real', 8, 3)->nullable();
            $table->enum('estado', ['Pendiente','Fabricada'])->default('Pendiente');
            $table->foreignId('bloque_id')->constrained('bloques')->cascadeOnDelete();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->foreignId('registrado_por')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piezas');
    }
};
