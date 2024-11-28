@php
    use App\Models\ClienteModel;
    use App\Models\EstadoModel;
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Ticket #{{ $ticket->id }} - {{ $ticket->asunto }}</title>
</head>

<body>
    <p><strong>Estimado {{ ClienteModel::find($ticket->cliente_id)->email }}</strong></p>
    <h3>Nuestro equipo ha respondido su ticket</h3>
    <p>Ticket: #{{ $ticket->id }}</p>
    <p>Estado: {{ EstadoModel::find($ticket->estado_id)->nombre }}</p>
    <p>Para ver la respuesta y agregar comentarios adicionales, haga click en el siguiente enlace:</p>
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}">{{ route('ticket.gest', ['id' => $ticket->id]) }}</a>
    <p>Nota: No responda este mail debido a que no es monitoriado.</p>
    <p>Saludos cordiales</p>
    <p>Hospital Universitario</p>
</body>

</html>
