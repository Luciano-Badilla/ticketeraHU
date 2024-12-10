<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AreaModel extends Model
{
    protected $table = 'area';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'icon',
        'nombre',
        'ticketera_id'
    ];
}
