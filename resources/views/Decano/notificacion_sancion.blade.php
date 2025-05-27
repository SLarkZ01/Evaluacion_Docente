<<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Sanción Docente</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #d9534f;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            text-align: center;
            color: #777;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Notificación de Resolución de Sanción</h2>
    </div>

    <div class="content">
        <p>Estimado(a) Docente {{ $sancion->nombre }} {{ $sancion->apellido }},</p>

        <p>Por medio del presente correo se le notifica oficialmente sobre la resolución de sanción docente emitida por nuestra institución.</p>

        <div class="details">
            <p><strong>Número de Resolución:</strong> {{ $sancion->numero_resolucion }}</p>
            <p><strong>Fecha de Emisión:</strong> {{ \Carbon\Carbon::parse($sancion->fecha_emision)->format('d/m/Y') }}</p>
            <p><strong>Tipo de Sanción:</strong> {{ ucfirst($sancion->tipo_sancion) }}</p>
            <p><strong>Fecha de Notificación:</strong> {{ $fecha }}</p>
        </div>

        <p>Se adjunta documento PDF con los detalles completos de la resolución. Por favor revise cuidadosamente el documento adjunto.</p>

        <p>Para cualquier aclaración o recurso, puede contactar al departamento correspondiente:</p>
        <ul>
            <li><strong>Correo:</strong> rrhh@institucion.edu</li>
            <li><strong>Teléfono:</strong> +123 456 7890</li>
            <li><strong>Horario:</strong> Lunes a Viernes de 8:00 a 16:00</li>
        </ul>

        <p>Atentamente,</p>
        <p><strong>Departamento de Recursos Humanos</strong><br>
        {{ config('app.name') }}</p>
    </div>

    <div class="footer">
        <p>Este es un mensaje automático, por favor no responda a este correo.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
    </div>
</body>
</html>