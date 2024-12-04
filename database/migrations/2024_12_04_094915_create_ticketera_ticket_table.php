<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketeraTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketera_ticket', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->bigInteger('ticketera_id'); // Columna 'ticketera_id', no puede ser NULL.
            $table->bigInteger('ticket_id'); // Columna 'ticket_id', no puede ser NULL.
            $table->string('type', 50); // Columna 'type', no puede ser NULL.

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
        Schema::dropIfExists('ticketera_ticket');
    }
}
