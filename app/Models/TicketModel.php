<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class TicketModel extends Model
{
    protected $table = 'ticket';

    public $timestamps = true;

    protected $fillable = [
        'asunto',
        'cuerpo',
        'estado_id',
        'departamento_id',
        'cliente_id',
        'prioridad_id',
        'tipo_problema_id',
        'area_id',
        'cerrado_por',
        'reopenMotivo',
        'device_ip'
    ];

    public function ticketera()
    {
        return $this->hasOneThrough(
            DashboardTicketModel::class,
            TicketeraTicketModel::class,
            'ticket_id',       // FK en ticketera_ticket hacia ticket
            'id',              // PK en ticketera (tabla final)
            'id',              // PK en ticket (modelo actual)
            'ticketera_id'     // FK en ticketera_ticket hacia ticketera
        );
    }
}
