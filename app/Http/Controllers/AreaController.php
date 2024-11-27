<?php

namespace App\Http\Controllers;

use App\Models\DashboardTicketModel;
use App\Models\AreaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    public function index()
    {
        $areas = AreaModel::where('ticketera_id',Auth::user()->ticketera_id)->get();
        $ticketeras = DashboardTicketModel::all();
        return view('areas', ['areas' => $areas, 'ticketeras' => $ticketeras]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:area,nombre'
        ], [
            'nombre.unique' => 'El area '. $request->input('nombre') .' ya existe'
        ]);

        AreaModel::create([
            'nombre' => $validatedData['nombre'],
            'ticketera_id' => Auth::user()->ticketera_id
        ]);

        return redirect()->back()->with('success', 'Area agregada correctamente');
    }
}
