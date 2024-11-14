<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class DashboardTicketModel extends Model
{
    protected $table = 'dashboard_tickets';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'icon'
    ];
}
