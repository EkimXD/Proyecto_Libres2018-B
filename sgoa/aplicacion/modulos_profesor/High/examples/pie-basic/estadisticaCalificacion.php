<?php
    require_once 'conexion.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Porcentaje de Calificaciones del Objeto de Aprendizaje'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Porcentaje',
            data: [
            <?php
            $sql = "select concat(nombre,' ', puntuacion) as nombre, COUNT(puntuacion) as puntuacion from objeto_aprendizaje, valoracion where objeto_aprendizaje.idobjeto_aprendizaje =  valoracion.idobjeto_aprendizaje GROUP by puntuacion";
            $result = mysqli_query($conexion, $sql);
            while($res = mysqli_fetch_array($result)){
            ?>           
            ['<?php echo $res['nombre']; ?>', parseInt('<?php echo $res["puntuacion"]; ?>') ],
        <?php } ?>
            ]
        }]
    });
});
        </script>
    </head>
    <body>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

    </body>
</html>
