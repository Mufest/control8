<?php
$servername = "localhost:3306";
$username = "root";
$password = "Mustang.88";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$origen = $_POST['origen'];
$destino = $_POST['destino'];
$fecha = $_POST['fecha'];
$plazas_disponibles = $_POST['plazas_disponibles'];
$precio = $_POST['precio'];

if (empty($origen) || empty($destino) || empty($fecha) || empty($plazas_disponibles) || empty($precio)) {
    die("Por favor complete todos los campos.");
}

$sql = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssis", $origen, $destino, $fecha, $plazas_disponibles, $precio);

if ($stmt->execute()) {
    echo "Vuelo agregado exitosamente.";
} else {
    echo "Error al agregar vuelo: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
