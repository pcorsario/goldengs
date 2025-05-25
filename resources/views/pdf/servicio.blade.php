<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Servicio</title>
</head>
<body>
    <h1>Servicio #{{ $servicio->id }}</h1>
    <p><strong>Nombre:</strong> {{ $servicio->nombre_servicio }}</p>
    <p><strong>Fecha de Pago:</strong> {{ $servicio->fecha_pago }}</p>
    <p><strong>Forma de Pago:</strong> {{ $servicio->forma_pago }}</p>
    <p><strong>Estudiante:</strong> {{ $servicio->estudiante->apellidos ?? 'N/A' }}</p>
    <p><strong>Valor:</strong> ${{ number_format($servicio->valor, 2) }}</p>
</body>
</html>
