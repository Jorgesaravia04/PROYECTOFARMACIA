<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Ejecuta los cambios de compatibilidad sin eliminar datos.
     */
    public function up(): void
    {
        // El esquema actual ya está instalado; no se realizan cambios destructivos.
    }

    /**
     * Revierte los cambios de compatibilidad.
     */
    public function down(): void
    {
        // Sin cambios que revertir.
    }
};
