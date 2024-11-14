<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class PrioridadModel extends Model
{
    protected $table = 'prioridad';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nombre'
    ];
}
