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
  <script src="js/ObaaMetadata.js"></script>
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
      <div>

<?php  $llego=$_POST['url'];
            //echo "<div>".$llego."</div><br>";
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
                  <td> 1 </td>
                </tr>
              <tbody>
                </table><br>";
     ?>       
<script >
  var ruta= "<?php echo $llego; ?>" ;
  console.log(ruta);
  //alert(ruta);
  
  //var datos=oa(ruta);

  
  var m_completitud;
  var m_disponivilidad;
  var m_completitud;
  var m_consistencia;
  var m_coherencia;
         var obaa ;
         //var xmlDoc=loadXMLDoc('as.xml');
        $(document).ready(function(){
          $.get(ruta,function(xml){

            var xmlString = (new XMLSerializer()).serializeToString(xml);

            //console.log(xmlString);
          
            obaa = processXml(xmlString);
            console.log(obaa);
            if (!obaa.identifier) {
              reusabilidadobaa(obaa);
              disponibilidadobaa(obaa.location);
              completitudobaa(obaa);
              consistenciaobaa(obaa);
              coherenciaobaa(obaa);
            }else{
              alert("el archivo xml no corresponde a un solo OA");
              location.href ="index.html";
            }
            
            //document.writeln(lom.title);
          });
        });



</script>

<?php
  $titulo = "<script> document.write(lom.title) </script>";
  echo "<div><h3>EVALUACIÓN DE UN OBJETO ESTANDAR OBAA:</h3>";
  echo"<TABLE table table-bordered\">";
  echo "<TBODY class=\"category\">
                      <TR>
                        <TD colspan=\"4\">ID: 1</TD>
                      </TR>
                      <TR>
                        <TD colspan=\"4\">Titulo del objeto analizado: ".$titulo."
                      </TR>
                    </TBODY>
                    <TBODY class=\"subcategory\">
                          <TR>
                            <TD style=\"padding:5px;\">";
                                                  /*reusabilidad($objeto,$a);
                                                disponibilidad($objeto[$a][4]);
                                                completitud($objeto,$a);
                                                consistencia($objeto,$a);
                                                coherencia($objeto,$a);*/
                                                echo"</TD>
                          </TR>
                        </TBODY>";
  echo "</TABLE></div>";
?>

</div>
<div id="oa" name="oa"> </div>



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
