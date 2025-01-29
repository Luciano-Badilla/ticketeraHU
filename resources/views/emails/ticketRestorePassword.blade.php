
<!DOCTYPE html>
<html>

<head>
    <title>Restablecer contraseña</title>
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
    <p><strong>Estimado {{ $email }}</strong></p>
    <h3>Para restablecer su contraseña haga click en el siguiente botón:</h3>
    <a href="{{ route('view.changepassword',['email' => $email]) }}" class="btn btn-primary">Restablecer contraseña</a>

    <h3>Si usted no solicito el acceso a un ticket desestime este mail</h3>
    <p>Saludos cordiales</p>
    <p>Hospital Universitario</p>
</body>

</html>
