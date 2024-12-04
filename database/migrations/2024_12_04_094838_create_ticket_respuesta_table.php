<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_respuesta', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->foreignId('ticket_id')->nullable()->constrained('ticket')->onDelete('cascade'); // Relación con 'ticket'.
            $table->mediumText('cuerpo'); // Columna 'cuerpo', no puede ser NULL.
            $table->string('personal_id', 100)->nullable(); // Columna 'personal_id', puede ser NULL.
            $table->timestamp('created_at')->nullable(); // Columna 'created_at', puede ser NULL.
            $table->timestamp('updated_at')->nullable(); // Columna 'updated_at', puede ser NULL.

            // Índices y claves foráneas
            $table->primary('id');
            $table->foreign('ticket_id')->references('id')->on('ticket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_respuesta');
    }
}
