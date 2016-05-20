<!DOCTYPE HTML>
<?php require_once 'config.inc.php'?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Estadisticas de OA</title>
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
        function graficar (eva) {
            $(function () {
                document.cookie ='variable='+eva+'; expires=Thu, 2 Aug 2021 20:47:11 UTC; path=/';
                <?php $myEva =  $_COOKIE["variable"];?>
                $('#container').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Calidad de los objetos evaluados'
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
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Objetos',
                        colorByPoint: true,
                        data: [
                            <?php $db = new Conect_Postgres();
                            $sql = "SELECT COUNT(evaluacion) AS b FROM evaluacion WHERE evaluacion>=0.25 and evaluacion<0.5 and evaluacion.num_eva = '$myEva';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            {
                                name: 'Buena',
                                y: <?php echo $row['b']?>
                            },                        <?php } ?>
                            <?php
                            $db = new Conect_Postgres();
                            $sql = "SELECT COUNT(evaluacion) AS r FROM evaluacion WHERE evaluacion<0.25 and evaluacion.num_eva = '$myEva';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            {
                                name: 'Regular',
                                y: <?php echo $row['r']?>
                            },                        <?php } ?>

                            <?php
                            $db = new Conect_Postgres();
                            $sql = "SELECT COUNT(evaluacion) AS e FROM evaluacion WHERE evaluacion>=0.75 and evaluacion.num_eva = '$myEva';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            {
                                name: 'Excelente',
                                y: <?php echo $row['e']?>
                            },                        <?php } ?>

                            <?php
                            $db = new Conect_Postgres();
                            $sql = "SELECT COUNT(evaluacion) AS mb FROM evaluacion WHERE evaluacion>=0.5 and evaluacion<0.75 and evaluacion.num_eva = '$myEva';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            {
                                name: 'Muy buena',
                                y: <?php echo $row['mb']?>
                            },                        <?php } ?>

                        ]
                    }]
                });
            });
        }
    </script>
</head>
<header>
    <div class="logo">
        <img src="imagenes/logo.png" alt="pushek"/>
    </div>
    <div class="titular">
        <h1 class="titulo">
            <span>Evaluación de recursos educativos digitales</span>
        </h1>
        <div>
            <a class="filtro" href="http://www.froac.manizales.unal.edu.co/GAIA">
                Universidad Nacional
            </a>

        </div>
    </div>

</header>
<nav>
    <ul id="menu"class="nav nav-pills">
            <li> <a href="index.html">Evaluar</a> </li>
            <li> <a href="estadistica.php">Estadisticas</a> </li>
            <li> <a  href="busquedas.html">Busqueda OA´S</a> </li>
            <li> <a  href="contacto.html">Contacto</a> </li>

        </ul>
</nav>
<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div id="s_Eva" style="min-width: 200px; height: 100px; max-width: 600px; margin: 0 auto">
    <select class="form-control" name="evaluaciones"  id="num_eva"  onchange="graficar(this.value)" style="width:70px; margin: 10px auto;;">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

</body>
</html>