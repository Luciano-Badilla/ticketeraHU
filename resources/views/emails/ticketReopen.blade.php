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
    <h3>Un ticket ha sido reabierto - {{ $ticket->reopenMotivo }}</h3>
    <p><strong>Ticket:</strong> #{{ $ticket->id }}</p>
    <p><strong>Asunto:</strong> {{ $ticket->asunto }}</p>
    <p><strong>Estado:</strong> {{ EstadoModel::find($ticket->estado_id)->nombre }}</p>
    <p><strong>Cliente:</strong> {{ ClienteModel::find($ticket->cliente_id)->email }}</p>
    <p><strong>Fecha de creación:</strong> {{ Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }}</p>
    <p><strong>{!! $ticket->cuerpo !!}</strong></p>
    <p>Para ver el detalle del ticket y responder, haga click en el siguiente enlace:</p>
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}">{{ route('ticket.gest', ['id' => $ticket->id]) }}</a>
    <p>Saludos cordiales,</p>
    <p><strong>Hospital Universitario</strong></p>
</body>

</html>
