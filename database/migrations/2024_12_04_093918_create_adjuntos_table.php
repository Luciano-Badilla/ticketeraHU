<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjunto', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental primaria llamada 'id'.
            $table->string('nombre', 255)->nullable(); // Columna 'nombre', puede ser NULL.
            $table->string('path', 255)->nullable();   // Columna 'path', puede ser NULL.
            $table->unique('id');                      // Llave única en 'id'.
            $table->timestamps();                      // Crea columnas 'created_at' y 'updated_at'.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjunto');
    }
}
