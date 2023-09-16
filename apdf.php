<h1> descargando </h1>

<?php


require_once('tcpdf/tcpdf.php');
include("config.php");
if ($con->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Consulta para obtener las ventas por meses
$sql = "SELECT * FROM `ventas` ";
echo "hizo nuevo";
$result = $con->query($sql);
print_r($result);
$pdf = new TCPDF();

// Establece el título del documento
$pdf->SetTitle('Consulta SQL a PDF');

// Agrega una página
$pdf->AddPage();

// Define el contenido del PDF
$html = '<h1>Ventas de meses</h1>';
$html .= '<table border="1">';
$html .= '<tr><th>ID</th><th>fecha</th><th>Monto</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        print_r($row['monto']);
        $html .= '<tr>';
        $html .= '<td>' . $row['id'] . '</td>';
        $html .= '<td>' . $row['fecha'] . '</td>';
        $html .= '<td>' . $row['monto'] . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

// Agrega el contenido al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo PDF de salida
$nombre_archivo = 'consulta_sql.pdf';
ob_end_clean();
// Envia el PDF como una descarga al navegador
$pdf->Output($nombre_archivo, 'I');
$con->close();
?>




