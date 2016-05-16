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

       function graficar2 () {

                $(function () {
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
                                $sql = "SELECT COUNT(disponible) AS d FROM objeto_a WHERE disponible = True;";
                                $query = $db->execute($sql);
                                while($row = $db->fetch_row($query)){?>
                                {
                                    name: 'Disponibles',
                                    y: <?php echo $row['d']?>
                                },                        <?php } ?>
                                <?php
                                $db = new Conect_Postgres();
                                $sql = "SELECT COUNT(disponible) AS nd FROM objeto_a WHERE disponible = False;";
                                $query = $db->execute($sql);
                                while($row = $db->fetch_row($query)){?>
                                {
                                    name: 'No disponibles',
                                    y: <?php echo $row['nd']?>
                                },                        <?php } ?>

                            ]
                        }]
                    });
                });
            }

        function graficar3() {
            $(function () {
                $('#container3').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Historial de evaluación OA'
                    },
                    subtitle: {
                        text: 'Objeto de prueba'
                    },
                    xAxis: {
                        categories: [
                            <?php $db = new Conect_Postgres();
                            $sql = "SELECT (evaluacion),(fecha) AS f FROM evaluacion WHERE id_obj = '11';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                                '<?php echo $row['f']?>'
                            ,  <?php } ?>

                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Evaluacion (gral)'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Obj 1',
                        data: [
                            <?php $db = new Conect_Postgres();
                            $sql = "SELECT (evaluacion),(fecha) AS f FROM evaluacion WHERE id_obj = '11';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            <?php echo $row['evaluacion']?>
                            ,  <?php } ?>
                        ]

                    }, {
                        name: 'Obj 2',
                        data: [<?php $db = new Conect_Postgres();
                            $sql = "SELECT (evaluacion),(fecha) AS f FROM evaluacion WHERE id_eval = '3203';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            <?php echo $row['evaluacion']?>
                            ,  <?php } ?>]

                    }, {
                        name: 'Obj 3',
                        data: [<?php $db = new Conect_Postgres();
                            $sql = "SELECT (evaluacion),(fecha) AS f FROM evaluacion WHERE id_eval = '3216';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            <?php echo $row['evaluacion']?>
                            ,  <?php } ?>]

                    }, {
                        name: 'Obj 4',
                        data: [<?php $db = new Conect_Postgres();
                            $sql = "SELECT (evaluacion),(fecha) AS f FROM evaluacion WHERE id_eval = '3245';";
                            $query = $db->execute($sql);
                            while($row = $db->fetch_row($query)){?>
                            <?php echo $row['evaluacion']?>
                            ,  <?php } ?>]

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

<div>
    <button id="eva2" onclick="graficar2()">Disponibilidad</button>
    <button id="eva3" onclick="graficar3()">Barras</button>
</div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<div id="container3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

</body>
</html>