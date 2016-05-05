<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Evaluacion de OA</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="plugins/jQuery/jQuery-2.2.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="css/estilo.css">
	<script>
	  $(document).ready(function () {
	      $('table').accordion({header: '.category', collapsible: true,
	   heightStyle: "content" });
	  });
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
			<li> <a href="#">Estadisticas</a> </li>
			<li> <a  href="#">Contacto</a> </li>

		</ul>
</nav>
<body>
	<center>
		<div class="contenedor2"><h4>Evalua tus RED</h4><br>
			<?php
            $llego=$_POST['url'];
            if ($llego!="") {
                //carga el xml  en la variable
                $objetos=simplexml_load_file($_POST['url']);
                if ($objetos->ListRecords){
                    // recorre  el xml y entrega la cantidad de objetos que contiene el xml
                    $total_objetos=count($objetos->ListRecords->record);
                    // imprime la cantidad de objetos analizados
                    echo "<table>
                            <thead>
                                <tr>
                                    <td>La ruta es:</td>
                                    <td>".$_POST['url']."</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cantidad de OAS:</td>
                                    <td>".$total_objetos."</td>
                                </tr>
                            <tbody>
                                </table><br>";

                    $objeto;
                    try{
                        for ($i=0; $i <$total_objetos ; $i++) {
                            $atributo=$objetos->ListRecords->record[$i]->header->attributes();
                            $estatus=$atributo['status'];
                            $id=$objetos->ListRecords->record[$i]->header->identifier;
                            echo "<div>".$estatus." y  el identificador ".$id."</div>";
                        }



                    }catch (Exception $e) {
                        echo '<script >alert("ALGO SALIO MAL EN LA CARGA DE LA INFORMACION DEL ARCHIVO XML");
                            location.href ="index.html"</script>';

                    }






                }else {
                    echo '<script >alert("EL XML CARGADO NO CUMPLE CON  EL ESTANDAR PARA REALIZAR LA EVALUACION O  NO ES UN XML");
                        location.href ="javascript:window.close();"</script>';
                }

            }else {
                    echo '<script >alert("DEBE SELECCIONAR  ALGUNA FORMA E INGRESAR LA URL O EL ARCHIVO XML");
                    location.href ="index.html"</script>';
                    //header('Location: index.html');
                }


            ?>


      
		</div>
	</center>
</body>
  <!-- jQuery 2.2.1 -->
    <script src="plugins/jQuery/jQuery-2.2.1.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="plugins/filestyle.js"></script>
</html>
