<?php

namespace App\Http\Controllers;

use App\Models\AlertModel;
use App\Models\EspecialidadModel;
use App\Models\EstadoModel;
use Illuminate\Http\Request;

class GestAlertsController extends Controller
{
    //

    public function index()
    {

        return view('alerts', []);
    }
}
