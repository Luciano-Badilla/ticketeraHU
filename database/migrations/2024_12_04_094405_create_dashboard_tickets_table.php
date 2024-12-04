<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_tickets', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->string('titulo', 255); // Columna 'titulo', no puede ser NULL.
            $table->text('descripcion'); // Columna 'descripcion', no puede ser NULL.
            $table->string('icono', 255); // Columna 'icono', no puede ser NULL.
            $table->text('detalle'); // Columna 'detalle', no puede ser NULL.
            $table->text('pretext')->nullable(); // Columna 'pretext', puede ser NULL.

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
        Schema::dropIfExists('dashboard_tickets');
    }
}
