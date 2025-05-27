<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resolución de Sanción - {{ $datos['numero_resolucion'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        .content { margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        .firma { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>RESOLUCIÓN DE SANCIÓN DOCENTE</h2>
        <p><strong>Número:</strong> {{ $datos['numero_resolucion'] }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($datos['fecha_emision'])->format('d/m/Y') }}</p>
    </div>

    <div class="content">
        <h3>INFORMACIÓN DEL DOCENTE</h3>
        <table>
            <tr>
                <th>Nombre Completo:</th>
                <td>{{ $datos['docente']['nombre'] }} {{ $datos['docente']['apellido'] }}</td>
            </tr>
            <tr>
                <th>Identificación:</th>
                <td>{{ $datos['docente']['identificacion'] }}</td>
            </tr>
            <tr>
                <th>Asignatura:</th>
                <td>{{ $datos['docente']['asignatura'] }}</td>
            </tr>
            <tr>
                <th>Calificación:</th>
                <td>{{ $datos['docente']['calificacion'] }}</td>
            </tr>
        </table>

        <h3>ANTECEDENTES Y JUSTIFICACIÓN</h3>
        <p>{!! nl2br(e($datos['antecedentes'])) !!}</p>

        <h3>FUNDAMENTOS NORMATIVOS</h3>
        <p>{!! nl2br(e($datos['fundamentos'])) !!}</p>

        <h3>RESOLUCIÓN</h3>
        <p>{!! nl2br(e($datos['resolucion'])) !!}</p>
    </div>

    <div class="firma">
        <p>__________________________</p>
        <p><strong>Firma del Decano/Coordinador</strong></p>
        @if(isset($datos['firma']) && $datos['firma'])
            <img src="{{ $datos['firma'] }}" style="max-height: 80px;">
        @endif
        <p>Fecha: {{ $fecha_actual }}</p>
    </div>
</body>
</html>