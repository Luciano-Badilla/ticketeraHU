<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TicketeraTicketModel extends Model
{
    protected $table = 'ticketera_ticket';

    public $timestamps = false;

    protected $fillable = [
        'ticketera_id',
        'ticket_id',
        'type'
    ];
}
