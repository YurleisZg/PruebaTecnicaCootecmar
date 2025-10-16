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
        Schema::create('bloques', function (Blueprint $table) {
            $table->string('IDBLOQUE')->primary(); // PK string
            $table->string('nombre');
            
            $table->string('proyecto_id'); // FK string
            $table->foreign('proyecto_id')
                  ->references('IDPROYECTO')
                  ->on('proyectos')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloques');
    }
};
