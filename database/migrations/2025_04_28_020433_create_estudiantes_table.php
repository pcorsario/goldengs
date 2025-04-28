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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
	    $table->string('cedula')->unique();
            $table->string('apellidos');
            $table->string('nombres');
            $table->date('fecha_nacimiento'); // Mejor tipo date que string
            $table->integer('edad'); // Mejor tipo integer
            $table->string('ciudad');
            $table->string('colegio');
            $table->string('correo')->unique();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('periodo');
            $table->string('grupo');
            $table->string('horario');
            $table->string('usuario');
            $table->string('contrasena');
            $table->foreignId('representante_id')->constrained()->cascadeOnDelete(); // Relación
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
