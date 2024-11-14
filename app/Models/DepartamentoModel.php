<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class DepartamentoModel extends Model
{
    protected $table = 'departamento';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'nombre'
    ];
}
