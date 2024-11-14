<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TicketModel extends Model
{
    protected $table = 'ticket';

    public $timestamps = true;

    protected $fillable = [
        'asunto',
        'cuerpo',
        'estado_id',
        'departamento_id',
        'cliente_id',
        'prioridad_id',
        'tipo_problema_id'
    ];
}
