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
    <p><strong>Estimado {{ ClienteModel::find($ticket->cliente_id)->email }}</strong></p>
    <h3>Nuestro equipo ha respondido su ticket</h3>
    <p>Ticket: #{{ $ticket->id }}</p>
    <p>Estado: {{ EstadoModel::find($ticket->estado_id)->nombre }}</p>
    <p>Para ver la respuesta y agregar comentarios adicionales, haga click en el siguiente botón:</p>
    <a href="{{ route('ticket.gest', ['id' => $ticket->id]) }}" class="btn btn-primary">Ver ticket #{{ $ticket->id }}</a>
    <p>Nota: No responda este mail debido a que no es monitoriado.</p>
    <p>Saludos cordiales</p>
    <p>Hospital Universitario</p>
</body>

</html>
