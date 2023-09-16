<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Ventas por Mes</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
    <?php   include("obtenerdatos.php");
    ?>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(dibujarGrafico);

        function dibujarGrafico() {
            var data = google.visualization.arrayToDataTable(<?php echo $datos_json; ?>);

            var opciones = {
                title: 'Ventas por Mes',
                legend: 'none', // Puedes cambiar esto a 'right' o 'bottom' si deseas una leyenda
                hAxis: {
                    title: 'Mes'
                },
                vAxis: {
                    title: 'Ventas'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('grafico'));

            chart.draw(data, opciones);
        }

        
    </script>
</head>
<body>
   
    <div id="grafico" style="width: 800px; height: 400px;"></div>
    <button id="descargarPDF">Descargar PDF</button>
    <a href="apdf.php">Imprimir</a>  
    <script>
        document.getElementById('descargarPDF').addEventListener('click', function() {
    // Captura el contenido del gráfico usando html2canvas
    console.log('Botón clicado'); // Verifica si el e
    html2canvas(document.getElementById('grafico')).then(function(canvas) {
        // Crea un objeto jsPDF
        console.log('Gráfico capturado');
        var pdf = new jsPDF('p', 'mm', 'a4');


        // Calcula las dimensiones del PDF según el tamaño del gráfico
        var imgData = canvas.toDataURL('imags/png');
        var imgWidth = 190; // Ancho del gráfico en el PDF
        var imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Agrega la imagen del gráfico al PDF
        pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);

        // Descarga el PDF con un nombre específico (puedes cambiarlo)
        pdf.save('mi_grafico.pdf');
    });
});
    </script>
</body>
</html>
