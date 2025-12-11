<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cristian
     * Esta función se ejecuta cuando se crea la migración.
     * Su objetivo es construir la tabla 'citas' con todas sus columnas.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            // ID autoincremental
            $table->id();

            // Datos principales de la cita
            $table->string('nombre_paciente');
            $table->string('nombre_doctor');
            $table->string('motivo_consulta');

            // Estado de la cita con valores específicos permitidos
            $table->enum('estados_cita',['Pendiente','Realizada','Cancelada']);
            $table->enum('consultorio',['C101', 'C102', 'C103', 'C104','C105']);
            // Fecha y hora de la cita
            $table->date('fecha');
            $table->time('tiempo');

            // Timestamps para created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Cristian
     * Esta función revierte los cambios, eliminando la tabla 'citas'
     * si es necesario hacer un rollback de la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
