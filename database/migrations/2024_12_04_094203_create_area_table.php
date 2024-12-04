<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->string('nombre', 255)->nullable(); // Columna 'nombre', puede ser NULL.
            $table->unsignedBigInteger('ticketera_id'); // Relaciona con 'ticketera_id'.

            // Llave primaria (se crea automáticamente con $table->id()).
            
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
        Schema::dropIfExists('area');
    }
}
