<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Disponibilidad</title>
</head>
<body>
    <h1>Consulta de Disponibilidad</h1>
    <form action="consultar_disponibilidad.php" method="post">
        <label for="fecha_reserva">Fecha de Reserva:</label>
        <input type="date" id="fecha_reserva" name="fecha_reserva" required><br><br>
        <label for="plazas_requeridas">Plazas Requeridas:</label>
        <input type="number" id="plazas_requeridas" name="plazas_requeridas" required><br><br>
        <label for="habitaciones_requeridas">Habitaciones Requeridas:</label>
        <input type="number" id="habitaciones_requeridas" name="habitaciones_requeridas" required><br><br>
        <input type="submit" value="Consultar Disponibilidad">
    </form>
</body>
</html>
