<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "agencia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$fecha_reserva = isset($_POST['fecha_reserva']) ? $_POST['fecha_reserva'] : '';
$plazas_requeridas = isset($_POST['plazas_requeridas']) ? (int)$_POST['plazas_requeridas'] : 0;
$habitaciones_requeridas = isset($_POST['habitaciones_requeridas']) ? (int)$_POST['habitaciones_requeridas'] : 0;

$sql = "
    SELECT
        v.id_vuelo,
        v.origen,
        v.destino,
        v.fecha,
        v.plazas_disponibles - COALESCE(rv.reservas_hechas, 0) AS plazas_disponibles_actuales,
        h.id_hotel,
        h.nombre AS hotel_nombre,
        h.ubicación AS hotel_ubicación,
        h.habitaciones_disponibles - COALESCE(rh.reservas_hechas, 0) AS habitaciones_disponibles_actuales
    FROM
        VUELO v
    LEFT JOIN (
        SELECT
            id_vuelo,
            COUNT(*) AS reservas_hechas
        FROM
            RESERVA
        GROUP BY
            id_vuelo
    ) rv ON v.id_vuelo = rv.id_vuelo
    LEFT JOIN HOTEL h ON h.id_hotel IN (
        SELECT id_hotel
        FROM RESERVA
        WHERE id_vuelo = v.id_vuelo
    )
    LEFT JOIN (
        SELECT
            id_hotel,
            COUNT(*) AS reservas_hechas
        FROM
            RESERVA
        GROUP BY
            id_hotel
    ) rh ON h.id_hotel = rh.id_hotel
    WHERE
        v.fecha >= ? AND
        (v.plazas_disponibles - COALESCE(rv.reservas_hechas, 0)) >= ? AND
        (h.habitaciones_disponibles - COALESCE(rh.reservas_hechas, 0)) >= ?
    ORDER BY
        v.fecha ASC, h.nombre ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $fecha_reserva, $plazas_requeridas, $habitaciones_requeridas);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
    
        while ($row = $result->fetch_assoc()) {
            echo "Vuelo ID: " . $row['id_vuelo'] . "<br>";
            echo "Origen: " . $row['origen'] . "<br>";
            echo "Destino: " . $row['destino'] . "<br>";
            echo "Fecha: " . $row['fecha'] . "<br>";
            echo "Plazas Disponibles: " . $row['plazas_disponibles_actuales'] . "<br>";
            echo "Hotel ID: " . $row['id_hotel'] . "<br>";
            echo "Nombre del Hotel: " . $row['hotel_nombre'] . "<br>";
            echo "Ubicación del Hotel: " . $row['hotel_ubicación'] . "<br>";
            echo "Habitaciones Disponibles: " . $row['habitaciones_disponibles_actuales'] . "<br><br>";
        }
    } else {
        echo "No hay disponibilidad para los criterios seleccionados.";
    }
} else {
    echo "Error en la consulta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
