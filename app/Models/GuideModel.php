<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class GuideModel extends Model
{
    protected $table = 'guides';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'description',
        'icon',
        'body',
        'type'
    ];
}
