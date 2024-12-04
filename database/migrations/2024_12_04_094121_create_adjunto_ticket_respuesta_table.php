<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntoTicketRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjunto_ticket_respuesta', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->unsignedBigInteger('adjunto_id')->nullable(); // Llave foránea hacia 'adjunto'.
            $table->unsignedBigInteger('ticket_id')->nullable(); // Llave foránea hacia 'ticket_respuesta'.

            // Llaves foráneas
            $table->foreign('adjunto_id')
                  ->references('id')
                  ->on('adjunto')
                  ->onDelete('cascade'); // Elimina en cascada.

            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('ticket_respuesta')
                  ->onDelete('cascade'); // Elimina en cascada.

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
        Schema::dropIfExists('adjunto_ticket_respuesta');
    }
}
