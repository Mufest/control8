<?php
$servername = "localhost:3306";
$username = "root";
$password = "Mustang.88";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$ubicación = $_POST['ubicación'];
$habitaciones_disponibles = $_POST['habitaciones_disponibles'];
$tarifa_noche = $_POST['tarifa_noche'];

if (empty($nombre) || empty($ubicación) || empty($habitaciones_disponibles) || empty($tarifa_noche)) {
    die("Por favor complete todos los campos.");
}

$sql = "INSERT INTO HOTEL (nombre, ubicación, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $nombre, $ubicación, $habitaciones_disponibles, $tarifa_noche);

if ($stmt->execute()) {
    echo "Hotel agregado exitosamente.";
} else {
    echo "Error al agregar hotel: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
