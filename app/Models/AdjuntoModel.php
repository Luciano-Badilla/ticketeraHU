<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AdjuntoModel extends Model
{
    protected $table = 'adjunto';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'path'
    ];
}
