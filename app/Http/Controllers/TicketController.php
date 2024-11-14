<?php

namespace App\Http\Controllers;

use App\Models\ClienteModel;
use App\Models\DashboardTicketModel;
use App\Models\DepartamentoModel;
use App\Models\PrioridadModel;
use App\Models\TipoProblemaModel;
use App\Models\TicketModel;
use App\Models\AdjuntoModel;
use App\Models\AdjuntoTicketModel;
use App\Models\TicketeraTicketModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    //

    public function index()
    {
        $dashboard_tickets = DashboardTicketModel::all();
        return view('dashboard_ticket', ['dashboard_tickets' => $dashboard_tickets]);
    }

    public function load_create_view(Request $request)
    {
        $data = $request->all();
        $departamentos = DepartamentoModel::all();
        $prioridades = PrioridadModel::all();
        $tiposProblema = TipoProblemaModel::all();
        return view('create_ticket', ['data' => $data, 'departamentos' => $departamentos, 'prioridades' => $prioridades, 'tiposProblema' => $tiposProblema]);
    }
    public function store(Request $request)
    {
        Log::info($request);
        $request->validate([
            'detalle' => 'required|string',
            'departamento_id' => 'required|exists:departamento,id',
            'prioridad' => 'required|exists:prioridad,id',
            'tipo_de_problema' => 'required|exists:tipo_problemas,id',
        ], [
            'detalle.required' => 'Debe proporcionar un detalle del ticket.',
            'departamento_id.required' => 'Debe seleccionar un departamento.',
            'departamento_id.exists' => 'El departamento seleccionado no es válido.',
            'prioridad.required' => 'Debe seleccionar una prioridad.',
            'prioridad.exists' => 'La prioridad seleccionada no es válida.',
            'tipo_de_problema.required' => 'Debe seleccionar un tipo de problema.',
            'tipo_de_problema.exists' => 'El tipo de problema seleccionado no es válido.',
        ]);
        Log::info('Paso la validacion');
        $email = $request->input('email');
        $cliente = ClienteModel::where('email', $email)->first();

        if (!$cliente) {
            $cliente = ClienteModel::create([
                'email' => $email
            ]);
        }

        $ticket = TicketModel::create([
            'asunto' => $request->input('asunto'),
            'cliente_id' => $cliente->id,
            'departamento_id' => $request->input('departamento_id'),
            'tipo_problema_id' => $request->input('tipo_de_problema'),
            'prioridad_id' => $request->input('prioridad'),
            'cuerpo' => $request->input('detalle'),
            'estado_id' => 5 // en_progreso
        ]);

        // Manejo de archivos subidos desde el campo "files"
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('tickets_files', $filename, 'public'); // Guarda el archivo

                // Guarda el archivo en la tabla 'adjunto'
                $adjunto = AdjuntoModel::create([
                    'nombre' => $filename,
                    'path' => $path
                ]);

                // Vincula el adjunto al ticket
                AdjuntoTicketModel::create([
                    'adjunto_id' => $adjunto->id,
                    'ticket_id' => $ticket->id
                ]);
            }
        }

        TicketeraTicketModel::create([
            'ticketera_id' => $request->input('ticketera_id'),
            'ticket_id' => $ticket->id,
            'type' => "ticket"
        ]);

        return redirect()->route('ticket.dashboard')->with('success', 'Ticket enviado correctamente.');
    }


    public function show_own_tickets(Request $request)
    {
        return view('');
    }
    public function edit_index($id) {}

    public function edit(Request $request) {}
}
