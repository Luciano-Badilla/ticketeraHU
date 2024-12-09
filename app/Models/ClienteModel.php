<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class ClienteModel extends Model
{
    protected $table = 'cliente';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'name',
        'surname'
    ];
}
