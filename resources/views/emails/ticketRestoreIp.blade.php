@php
    use App\Models\ClienteModel;
    use App\Models\EstadoModel;
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Solicitud de acceso al Ticket #{{ $ticket->id }}</title>
</head>

<body>
    <p><strong>Estimado {{ ClienteModel::find($ticket->cliente_id)->email }}</strong></p>
    <h3>Para acceder al ticket ingrese al siguiente enlace:</h3>
    <a href="{{ route('restore.ticket_access', ['id' => $ticket->id]) }}">{{ route('restore.ticket_access', ['id' => $ticket->id]) }}</a>
    <h3>¿Porque sucedio esto?</h3>
    <p>- Por seguridad los ticket solo se pueden acceder desde el dispositivo en el que fueron creados.</p>
    <h3>¿Era este dispositivo?</h3>
    <p>- En el caso que su dispositivo tenga IP Dinamica, es decir cambia cada vez que se inicia, el sistema detectara que es un dispositivo diferente</p>
    <p>- Recomendamos que lo reporte a servicio tecnico para solucionarlo.</p>

    <p>Si usted no solicito el acceso a un ticket desestime este mail</p>
    <p>Saludos cordiales</p>
    <p>Hospital Universitario</p>
</body>

</html>
