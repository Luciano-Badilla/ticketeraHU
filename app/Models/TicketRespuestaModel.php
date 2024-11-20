<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TicketRespuestaModel extends Model
{
    protected $table = 'ticket_respuesta';

    public $timestamps = true;

    protected $fillable = [
        'ticket_id',
        'cuerpo',
        'personal_id'
    ];
}
