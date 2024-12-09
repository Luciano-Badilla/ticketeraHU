<?php

namespace App\Http\Controllers;

use App\Models\DashboardTicketModel;
use App\Models\AreaModel;
use App\Models\ClienteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = ClienteModel::all();
        return view('clientes', ['clientes' => $clientes]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|max:255|unique:cliente,email'
        ], [
            'email.unique' => 'El email '. $request->input('email') .' ya existe'
        ]);

        ClienteModel::create([
            'email' => $validatedData['email'],
            'name' => $request->input('nombre'),
            'surname' => $request->input('apellido')
        ]);

        return redirect()->back()->with('success', 'Cliente agregado correctamente');
    }
}
