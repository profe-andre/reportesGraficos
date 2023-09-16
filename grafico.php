<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>
    
<?php
// Datos de ejemplo
$datos = array(
    array('Categoría', 'Valor'),
    array('A', 10),
    array('B', 20),
    array('C', 30)
);

// Convierte los datos a formato JSON
$datos_json = json_encode($datos);
?>

<script type="text/javascript">
    // Carga la biblioteca de visualización y los datos
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(dibujarGrafico);

    function dibujarGrafico() {
        // Convierte los datos JSON en un objeto DataTable
        var data = google.visualization.arrayToDataTable(<?php echo $datos_json; ?>);

        // Configura las opciones del gráfico
        var opciones = {
            title: 'Mi Gráfico',
            width: 400,
            height: 300
        };

        // Crea un gráfico de barras
        var chart = new google.visualization.BarChart(document.getElementById('grafico'));

        // Dibuja el gráfico con los datos y las opciones
        chart.draw(data, opciones);
    }
</script>

<!-- Aquí es donde se mostrará el gráfico -->
<div id="grafico"></div>

</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</html>