<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Hoteles</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Agregar Hotel</h1>
    <form action="procesar_hotel.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="ubicación">Ubicación:</label>
        <input type="text" id="ubicación" name="ubicación" required><br><br>
        
        <label for="habitaciones_disponibles">Habitaciones Disponibles:</label>
        <input type="number" id="habitaciones_disponibles" name="habitaciones_disponibles" required><br><br>
        
        <label for="tarifa_noche">Tarifa por Noche:</label>
        <input type="number" id="tarifa_noche" name="tarifa_noche" step="0.01" required><br><br>
        
        <input type="submit" value="Agregar Hotel">
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
