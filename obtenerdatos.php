<?php
// Conexión a la base de datos (reemplaza con tus propios datos)
include("config.php");
if ($con->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Consulta para obtener las ventas por meses
$sql = "SELECT MONTH(fecha) AS mes, SUM(monto) AS total
        FROM ventas
        GROUP BY mes";

$result = $con->query($sql);

// Crear un array para almacenar los datos de ventas por meses
$datos = array();
$datos[] = array('Mes', 'Ventas');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mes = obtenerNombreMes($row['mes']); // Función para obtener el nombre del mes
        $ventas = (float) $row['total'];
        $datos[] = array($mes, $ventas);
    }
}

// Convierte los datos a formato JSON
$datos_json = json_encode($datos);

// Función para obtener el nombre del mes a partir de su número (1 = enero, 2 = febrero, etc.)
function obtenerNombreMes($numeroMes) {
    $meses = array(
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    );
    return $meses[$numeroMes];
}


?>
