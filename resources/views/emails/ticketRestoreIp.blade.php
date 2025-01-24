@php
    use App\Models\ClienteModel;
    use App\Models\EstadoModel;
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Solicitud de acceso al Ticket #{{ $ticket->id }}</title>
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
    <h3>Para acceder al ticket ingrese al siguiente botón:</h3>
    <a href="{{ route('restore.ticket_access', ['id' => $ticket->id]) }}" class="btn btn-primary">Obtener acceso al ticket
        #{{ $ticket->id }}</a>
    <h3>¿Porque sucedio esto?</h3>
    <p>- Por seguridad los ticket solo se pueden acceder desde el dispositivo en el que fueron creados.</p>
    <h3>¿Era este dispositivo?</h3>
    <p>- En el caso que su dispositivo tenga IP Dinamica, es decir cambia cada vez que se inicia, el sistema detectara
        que es un dispositivo diferente.</p>
    <p>- Recomendamos que lo reporte a servicio tecnico para solucionarlo.</p>

    <h3>Si usted no solicito el acceso a un ticket desestime este mail</h3>
    <p>Saludos cordiales</p>
    <p>Hospital Universitario</p>
</body>

</html>
