<?php

namespace App\Http\Controllers;

use App\Mail\ticketResponsed;
use App\Mail\ticketClosed;
use App\Mail\ticketCreatedAgent;
use App\Mail\ticketCreated;
use App\Mail\ticketReopen;
use App\Mail\ticketRestoreIp;
use App\Models\AreaModel;
use App\Models\ClienteModel;
use App\Models\DashboardTicketModel;
use App\Models\DepartamentoModel;
use App\Models\PrioridadModel;
use App\Models\TipoProblemaModel;
use App\Models\TicketModel;
use App\Models\AdjuntoModel;
use App\Models\AdjuntoTicketModel;
use App\Models\AdjuntoTicketResponseModel;
use App\Models\EstadoModel;
use App\Models\User;
use App\Models\TicketeraTicketModel;
use App\Models\TicketRespuestaModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
        $departamentos = DepartamentoModel::orderBy('nombre')->get();
        $prioridades = PrioridadModel::orderBy('nombre')->get();
        $tiposProblema = TipoProblemaModel::orderBy('nombre')->get();
        return view('create_ticket', ['data' => $data, 'departamentos' => $departamentos, 'prioridades' => $prioridades, 'tiposProblema' => $tiposProblema]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'detalle' => 'required|string',
            'departamento_id' => 'required|exists:departamento,id',
            'email' => 'required|exists:cliente,email'
        ], [
            'detalle.required' => 'Debe proporcionar un detalle del ticket.',
            'departamento_id.required' => 'Debe seleccionar un departamento.',
            'departamento_id.exists' => 'El departamento seleccionado no es válido.',
            'email.required' => 'Debe proporcionar un correo institucional.',
            'email.exists' => 'El correo institucional no existe.'
        ]);

        $email = $request->input('email');
        $cliente = ClienteModel::where('email', $email)->first();

        $ticket = TicketModel::create([
            'asunto' => $request->input('asunto'),
            'cliente_id' => $cliente->id,
            'departamento_id' => $request->input('departamento_id'),
            'tipo_problema_id' => $request->input('tipo_de_problema') ? $request->input('tipo_de_problema') : 7,
            'cuerpo' => $request->input('detalle'),
            'estado_id' => 1,
            'device_ip' => $request->ip()
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


        Mail::to($email)->send(new ticketCreated($ticket));

        $emailsAgents = User::where('ticketera_id', $request->input('ticketera_id'))->where('recibe_emails', 1)->get()->pluck('email')->toArray();
        foreach ($emailsAgents as $emailAgent) {
            Mail::to($emailAgent)->send(new ticketCreatedAgent($ticket));
        }

        return redirect()->route('ticket.gest', ['id' => $ticket->id])->with('success', 'Ticket enviado correctamente.');
    }

    public function show_own_tickets(Request $request)
    {
        $email = "";
        $tickets = collect();
        if ($request->has('email')) {
            $email = $request->input('email');
            $cliente_id = ClienteModel::where('email', $email)->first();
            if ($cliente_id) {
                $tickets = TicketModel::where('cliente_id', $cliente_id->id)->get();
            }
        }
        $ticketeras = DashboardTicketModel::all();
        $estados = EstadoModel::all();
        return view('show_own_tickets', ['tickets' => $tickets, 'ticketeras' => $ticketeras, 'estados' => $estados, 'isMobile' => request()->header('User-Agent') && preg_match('/Mobile|Android|iPhone/', request()->header('User-Agent'))]);
    }

    public function gest_ticket($id, Request $request)
    {
        $ticket = TicketModel::find($id);
        if ($ticket->device_ip) {
            if (Auth::id() == null && $ticket->device_ip == $request->ip() || Auth::id()) {
                $ticket_response = TicketRespuestaModel::where('ticket_id', $id);
                $estados = EstadoModel::all();
                $adjuntos = AdjuntoTicketModel::where('ticket_id', $id)->get();
                $adjuntosResponse = AdjuntoTicketResponseModel::all();
                $ticketeras = DashboardTicketModel::all();
                $areas = AreaModel::all();

                return view('gest_ticket', ['ticket' => $ticket, 'estados' => $estados, 'ticket_response' => $ticket_response, 'adjuntos' => $adjuntos, 'adjuntosResponse' => $adjuntosResponse, 'ticketeras' => $ticketeras, 'areas' => $areas]);
            } else {
                $message = 'No tienes permiso para acceder a este ticket, si quieres ingresar desde este dispositivo o crees que es un error presiona "Restablecer acceso"';
                $buttons = [['url' => route('send.restore_email_ip', ['id' => $ticket->id]), 'text' => 'Restablecer acceso']];
                return view('unauthorized', ['message' => $message, 'buttons' => $buttons]);
            }
        } else {
            $ticket_response = TicketRespuestaModel::where('ticket_id', $id);
            $estados = EstadoModel::all();
            $adjuntos = AdjuntoTicketModel::where('ticket_id', $id)->get();
            $adjuntosResponse = AdjuntoTicketResponseModel::all();
            $ticketeras = DashboardTicketModel::all();
            $areas = AreaModel::all();

            return view('gest_ticket', ['ticket' => $ticket, 'estados' => $estados, 'ticket_response' => $ticket_response, 'adjuntos' => $adjuntos, 'adjuntosResponse' => $adjuntosResponse, 'ticketeras' => $ticketeras, 'areas' => $areas]);
        }
    }
    public function ticket_response_store(Request $request)
    {

        $ticket = TicketModel::where('id', $request->input('ticket_id'))->first();
        if ($ticket->estado_id != 4) {
            $cliente_id = TicketModel::where('id', $request->input('ticket_id'))->first()->cliente_id;
            $email = ClienteModel::find($cliente_id)->email;
            if (Auth::id() == null) {
                $personal_id = ClienteModel::find($cliente_id)->email;
                $ticket->estado_id = 2; //Respondido
                $ticket->save();
            } else {
                $personal_id = Auth::id();
                $ticket->estado_id = 3; //Pendiente
                $ticket->save();
                Mail::to($email)->send(new ticketResponsed($ticket));
            }
            $ticket_response = TicketRespuestaModel::create([
                'ticket_id' => $request->input('ticket_id'),
                'cuerpo' => $request->input('detalle'),
                'personal_id' => $personal_id
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
                    AdjuntoTicketResponseModel::create([
                        'adjunto_id' => $adjunto->id,
                        'ticket_id' => $ticket_response->id
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Respuesta enviada correctamente.');
        } else {
            return redirect()->back();
        }
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
                $newMessages = false;
            } else {
                $newMessages = true;
            }

            // Devuelve la respuesta indicando si hay nuevos mensajes o no
            return response()->json(['newMessages' => $newMessages]);
        } catch (\Exception $e) {
            Log::error('Error al procesar la solicitud: ' . $e->getMessage());
            return response()->json(['newMessages' => false]);
        }
    }

    public function tickets_dashboard($typeSort = null, $id = null)
    {
        $ticketera_id = Auth::user()->ticketera_id;

        // Obtén y normaliza los IDs
        $tickets_id = TicketeraTicketModel::where('ticketera_id', $ticketera_id)
            ->pluck('ticket_id')
            ->unique()
            ->map(function ($id) {
                return (int) $id; // Asegúrate de que sean enteros
            });

        // Verifica si hay IDs antes de consultar
        if ($tickets_id->isEmpty()) {
            $tickets = collect(); // Colección vacía si no hay IDs
        } else {
            // Inicia la consulta para obtener los tickets
            $query = TicketModel::whereIn('id', $tickets_id);

            // Si sortArea no es 0, filtra por area_id
            if ($typeSort === 'area') {
                $query->where('area_id', $id)->where('estado_id', '!=', 4);
            }

            // Si sortEstado no es 0, filtra por estado_id
            if ($typeSort === 'estado') {
                if ($id == 1) {
                    $query->where('estado_id', $id)->where('area_id', null);
                } else {
                    $query->where('estado_id', $id);
                }
            }

            // Ejecuta la consulta y obtiene los tickets
            $tickets = $query->get();
        }

        $estados = EstadoModel::all();
        return view('tickets_dashboard', [
            'tickets' => $tickets,
            'estados' => $estados,
            'id' => $id,
            'isMobile' => request()->header('User-Agent') && preg_match('/Mobile|Android|iPhone/', request()->header('User-Agent'))
        ]);
    }



    public function area_estados_dashboard()
    {
        $areas = AreaModel::where('ticketera_id', Auth::user()->ticketera_id)->get();
        $estados = EstadoModel::all();
        $tickets = TicketModel::all();

        return view('area_estado_ticket_dashboard', [
            'areas' => $areas,
            'estados' => $estados,
            'tickets' => $tickets
        ]);
    }

    public function close_ticket(Request $request, $id = null)
    {
        if (!$id) {
            $id = $request->input('ticket_id');
        }

        $ticket = TicketModel::find($id);

        if ($request->input('detalle') != '<p><br></p>' && $request->input('detalle') != null) {
            $this->ticket_response_store($request);
        }

        $ticket->estado_id = 4; //Cerrado
        $ticket->cerrado_por = Auth::user()->id;
        $ticket->reopenMotivo = null;
        $ticket->save();
        $email = ClienteModel::find($ticket->cliente_id)->email;

        Mail::to($email)->send(new ticketClosed($ticket));

        if ($ticket->area_id) {
            $typeSort = "area";
            $area_id = $ticket->area_id;

            return redirect()->route('ticket.dashboard', ["typeSort" => $typeSort, "id" => $area_id])->with('success', 'Ticket #' . $id . ' cerrado con exito.');
        } else {
            return redirect()->route('ticket.dashboard')->with('success', 'Ticket #' . $id . ' cerrado con exito.');
        }
    }

    public function reassign(Request $request)
    {
        $ticketeraTicket = TicketeraTicketModel::where('ticket_id', $request->input('id'))->first();

        if ($request->input('ticketera_id')) {
            $ticketeraTicket->ticketera_id = $request->input('ticketera_id'); //Cerrado
            $ticket = TicketModel::find($ticketeraTicket->ticket_id);
            $ticket->area_id = null;
            $ticket->save();
        } else if ($request->input('area_id')) {
            $ticket = TicketModel::find($request->input('id'));
            $ticket->area_id = $request->input('area_id'); //Cerrado
            $ticket->save();
        }
        $ticketeraTicket->save();
        return redirect()->route('ticket.dashboard')->with('success', 'Ticket #' . $request->input('id') . ' reasignado con exito.');
    }

    public function reopen_ticket(Request $request, $id = null)
    {
        if (!$id) {
            $id = $request->input('ticket_id');
        }

        $ticket = TicketModel::find($id);

        $ticket->estado_id = 1; //Cerrado
        $ticket->reopenMotivo = $request->input('reopenMotivo');
        $ticket->save();
        $email = ClienteModel::find($ticket->cliente_id)->email;

        $emailsAgents = User::where('ticketera_id', $request->input('ticketera_id'))->where('recibe_emails', 1)->get()->pluck('email')->toArray();
        foreach ($emailsAgents as $emailAgent) {
            Mail::to($emailAgent)->send(new ticketReopen($ticket));
        }

        return redirect()->route('ticket.gest', ['id' => $ticket->id]);
    }

    public function send_restore_email(Request $request)
    {
        $ticket = TicketModel::find($request->input('id'));
        $email = ClienteModel::find($ticket->cliente_id)->email;

        Mail::to($email)->send(new ticketRestoreIp($ticket));


        return redirect()->route('ticketera.dashboard')->with('success', 'Correo de acceso enviado a ' . $email . ', revise su bandeja de entrada.');
    }

    public function restore_ticket_access(Request $request, $id = null)
    {
        $ticket = TicketModel::find($id);

        $ticket->device_ip = $request->ip();
        $ticket->save();

        return redirect()->route('ticket.gest', ['id' => $ticket->id])->with('success', 'Acceso validado correctamente, solo se podra acceder a este ticket desde este dispositivo.');
    }

}
