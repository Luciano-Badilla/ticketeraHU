@php
    use App\Models\ClienteModel;
    use App\Models\EstadoModel;
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Ticket #{{ $ticket->id }} - {{ $ticket->asunto }}</title>
    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        .btn-primary {
            /* Azul de Bootstrap */
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
            color: white !important;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: #004085;
            border-color: #003366;
            outline: none;
        }
    </style>
</head>

<body>
    <h3>Un nuevo ticket ha sido creado</h3>
    <p><strong>Ticket:</strong> #{{ $ticket->id }}</p>
    <p><strong>Asunto:</strong> {{ $ticket->asunto }}</p>
    <p><strong>Estado:</strong> {{ EstadoModel::find($ticket->estado_id)->nombre }}</p>
    <p><strong>Cliente:</strong> {{ ClienteModel::find($ticket->cliente_id)->email }}</p>
    <p><strong>Fecha de creación:</strong> {{ Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }}</p>
    <p><strong>{!! $ticket->cuerpo !!}</strong></p>
    <p>Para ver el detalle del ticket y responder, haga click en el siguiente botón:</p>
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}" class="btn btn-primary">Ver ticket #{{ $ticket->id }}</a>
    <p>Saludos cordiales,</p>
    <p><strong>Hospital Universitario</strong></p>
</body>

</html>
