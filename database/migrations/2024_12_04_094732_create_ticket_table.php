<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'.
            $table->string('asunto', 255)->nullable(); // Columna 'asunto', puede ser NULL.
            $table->longText('cuerpo'); // Columna 'cuerpo', no puede ser NULL.
            $table->foreignId('estado_id')->default(2)->constrained('estado')->onDelete('set null'); // Relación con 'estado', valor por defecto '2'.
            $table->foreignId('departamento_id')->nullable()->constrained('departamento')->onDelete('set null'); // Relación con 'departamento'.
            $table->foreignId('cliente_id')->nullable()->constrained('cliente')->onDelete('set null'); // Relación con 'cliente'.
            $table->foreignId('prioridad_id')->default(3)->constrained('prioridad')->onDelete('set null'); // Relación con 'prioridad', valor por defecto '3'.
            $table->timestamp('created_at')->nullable(); // Columna 'created_at', puede ser NULL.
            $table->timestamp('updated_at')->nullable(); // Columna 'updated_at', puede ser NULL.
            $table->foreignId('tipo_problema_id')->nullable(); // Relación con 'tipo_problema'.
            $table->foreignId('area_id')->nullable(); // Relación con 'area'.
            $table->bigInteger('cerrado_por')->nullable(); // Columna 'cerrado_por', puede ser NULL.

            // Índices y claves foráneas
            $table->primary('id');
            $table->foreign('estado_id')->references('id')->on('estado')->onDelete('set null');
            $table->foreign('departamento_id')->references('id')->on('departamento')->onDelete('set null');
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('set null');
            $table->foreign('prioridad_id')->references('id')->on('prioridad')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
