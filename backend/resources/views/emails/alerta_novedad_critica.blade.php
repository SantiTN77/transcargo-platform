@php
    /** @var \App\Models\NovedadDespacho $novedad */
    /** @var \App\Models\Despacho $despacho */
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alerta crítica de despacho</title>
</head>
<body>
    <h1>Alerta crítica de despacho</h1>
    <p>Se registró una novedad crítica en el despacho #{{ $despacho->id }}.</p>
    <ul>
        <li><strong>Tipo:</strong> {{ $novedad->tipo->value }}</li>
        <li><strong>Descripción:</strong> {{ $novedad->descripcion }}</li>
        <li><strong>Fecha de la novedad:</strong> {{ $novedad->fecha->format('d/m/Y H:i') }}</li>
        <li><strong>Estado actual del despacho:</strong> {{ $despacho->estado }}</li>
    </ul>
    <p>Por favor, el área de operaciones debe revisar esta alerta de inmediato.</p>
</body>
</html>
