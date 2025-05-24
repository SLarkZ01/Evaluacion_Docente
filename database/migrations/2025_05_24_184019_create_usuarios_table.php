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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id_usuario', true);
            $table->integer('id_rol')->nullable()->index('id_rol');
            $table->boolean('activo')->nullable();
            $table->string('nombre');
            $table->string('correo')->unique('correo');
            $table->string('contrasena');
            $table->enum('tipo_usuario', ['docente', 'coordinador', 'administrador']);
            $table->string('apellido', 260);
            $table->integer('identificacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
