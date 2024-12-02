<?php

namespace App\Http\Controllers;

use App\Models\DashboardTicketModel;
use App\Models\DepartamentoModel;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = DepartamentoModel::all();
        $ticketeras = DashboardTicketModel::all();
        return view('departamentos', ['departamentos' => $departamentos, 'ticketeras' => $ticketeras]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:departamento,nombre'
        ], [
            'nombre.unique' => 'El departamento '. $request->input('nombre') .' ya existe'
        ]);

        DepartamentoModel::create([
            'nombre' => $validatedData['nombre']
        ]);

        return redirect()->back()->with('success', 'Departamento agregado correctamente');
    }

    public function edit(Request $request){
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $departamento = DepartamentoModel::find($id);
        $departamento->nombre = $nombre;
        $departamento->update();
        return redirect()->back()->with('success', 'Departamento editado correctamente');
    }
}
