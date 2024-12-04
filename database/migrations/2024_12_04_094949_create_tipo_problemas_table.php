<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProblemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_problemas', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->string('nombre', 100); // Columna 'nombre', no puede ser NULL.

            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at'.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_problemas');
    }
}
