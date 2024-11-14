<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TipoProblemaModel extends Model
{
    protected $table = 'tipo_problemas';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre'
    ];
}
