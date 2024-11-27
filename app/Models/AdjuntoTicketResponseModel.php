<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AdjuntoTicketResponseModel extends Model
{
    protected $table = 'adjunto_ticket_respuesta';

    public $timestamps = false;

    protected $fillable = [
        'adjunto_id',
        'ticket_id'
    ];
}
