<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subarea', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->string('nombre', 100); // Columna 'nombre', no puede ser NULL.
            $table->bigInteger('ticketera_id'); // Columna 'ticketera_id', no puede ser NULL.

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
        Schema::dropIfExists('subarea');
    }
}
