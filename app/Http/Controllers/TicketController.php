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
use App\Models\EstadoModel;
use App\Models\TicketeraTicketModel;
use App\Models\TicketRespuestaModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                    'path' => "storage/" . $path
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
        Log::info($request);
        $email = "";
        $tickets = collect();
        if ($request->has('email')) {
            $email = $request->input('email');
            $cliente_id = ClienteModel::where('email', $email)->first()->id;
            $tickets = TicketModel::where('cliente_id', $cliente_id)->get();
        }
        $ticketeras = DashboardTicketModel::all();
        $estados = EstadoModel::all();
        return view('show_own_tickets', ['tickets' => $tickets, 'ticketeras' => $ticketeras, 'estados' => $estados]);
    }

    public function gest_ticket($id, Request $request)
    {
        $ticket = TicketModel::find($id);
        $ticket_response = TicketRespuestaModel::where('ticket_id', $id);
        $estados = EstadoModel::all();
        $adjuntos = AdjuntoTicketModel::where('ticket_id', $id)->get();

        return view('gest_ticket', ['ticket' => $ticket, 'estados' => $estados, 'ticket_response' => $ticket_response, 'adjuntos' => $adjuntos]);
    }
    public function ticket_response_store(Request $request)
    {
        if (Auth::id() == null) {
            $ticket = TicketModel::where('id', $request->input('ticket_id'))->first()->cliente_id;
            $personal_id = ClienteModel::find($ticket)->email;
        } else {
            $personal_id = Auth::id();
        }
        TicketRespuestaModel::create([
            'ticket_id' => $request->input('ticket_id'),
            'cuerpo' => $request->input('detalle'),
            'personal_id' => $personal_id
        ]);

        return redirect()->back()->with('success', 'Respuesta enviada correctamente.');
    }

    public function checkNewMessages($ticketId)
    {
        $lastChecked = request()->query('lastChecked');

        try {
            // Obtener el último mensaje registrado para el ticket
            $lastMessage = TicketRespuestaModel::where('ticket_id', $ticketId)
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$lastMessage) {
                // Si no hay mensajes en la base de datos, no hay nuevos mensajes
                return response()->json(['newMessages' => false]);
            }

            // Si no se recibe lastChecked, asumimos que siempre hay nuevos mensajes
            if (!$lastChecked) {
                return response()->json(['newMessages' => true]);
            }

            // Parsear la fecha recibida y restar 3 horas
            $lastChecked = Carbon::parse($lastChecked)->subHours(3);

            // Obtener la fecha del último mensaje en la base de datos
            $lastMessageTime = $lastMessage->created_at;

            // Comparar si la fecha del último mensaje es posterior a la fecha recibida
            if ($lastMessageTime->format('Y-m-d H:i:s') === $lastChecked->format('Y-m-d H:i:s')) {
                Log::info("No hay nuevos mensajes");
                $newMessages = false;
            } else {
                Log::info("Si hay nuevos mensajes");
                $newMessages = true;
            }

            // Devuelve la respuesta indicando si hay nuevos mensajes o no
            return response()->json(['newMessages' => $newMessages]);
        } catch (\Exception $e) {
            Log::error('Error al procesar la solicitud: ' . $e->getMessage());
            return response()->json(['newMessages' => false]);
        }
    }

    public function edit_index($id) {}

    public function edit(Request $request) {}
}
