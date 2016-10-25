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
  <script type="text/javascript">
    function  acordeon() {
                  $('table').accordion({header: '.category', collapsible: true,
               heightStyle: "content" });
                }

  </script>

  <script src="js/ObaaMetadata1.js"></script>
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
        <li> <a href="graficar.php">Estadisticas</a> </li>
        <li> <a  href="contacto.html">Contacto</a> </li>
    </ul>
</nav>
<body>
  <center>
    <div class="contenedor2"><h4>Evalua tus RED</h4><br>
      <div>

<?php  

error_reporting(E_ALL ^ E_NOTICE);
            if($_POST['url']){
                $ruta=simplexml_load_file($_POST['url']);
                $nombreoa=$_POST['url'];
            }elseif($_FILES['url']['tmp_name']){
                    if ($_FILES['url']["error"] > 0){
                      echo "Error: " . $_FILES['url']['error'] . "<br>";
                    }else{
                      $hoy = getdate();
                      $ruta="OBAA-".$hoy['year']."-".$hoy['mon']."-".$hoy['mday']."-".$hoy['hours']."-".$hoy['minutes']."-".$hoy['seconds'].rand().".xml";
                      move_uploaded_file($_FILES['url']['tmp_name'], $ruta);}
                      $nombreoa=$_FILES['url']['name'];
                    }




$llego=$ruta;
            //echo "<div>".$llego."</div><br>";
      echo "<table>
              <thead>
                <tr>
                  <td>La ruta es:</td>
                  <td>".$nombreoa."</td>
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
  if (ruta!="") {
  var obaa ;
  var m_reusabilidad;
  var m_disponivilidad;
  var m_completitud;
  var m_consistencia;
  var m_coherencia;
  var titulo;
         //var xmlDoc=loadXMLDoc('as.xml');
        $(document).ready(function(){
          $.get(ruta,function(xml){
            //console.log(xml);
            var xmlString = (new XMLSerializer()).serializeToString(xml);
            
            //console.log(xmlString);
            obaa = processXml(xmlString);
            
            titulo=obaa.title;
            console.log(obaa);
            if (!obaa.identifier) {
              m_reusabilidad=reusabilidadobaa(obaa);
              //alert("desde afuera "+m_reusabilidad);
              // valida que calidad de objeto es
                        if (m_reusabilidad<0.25) {
                            evaluacion="Regular";
                        }else if (m_reusabilidad>=0.25 && m_reusabilidad<0.5) {
                                evaluacion="Buena";
                            }else if (m_reusabilidad>=0.5 && m_reusabilidad<0.75) {
                                    evaluacion="Muy buena";
                                }else if (m_reusabilidad>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                        m_reusabilidad="* Reusabilidad de: "+ m_reusabilidad +"; "+evaluacion;

             // m_disponivilidad=disponibilidadobaa(obaa.location);
             // 
              m_completitud=completitudobaa(obaa);
              //alert("desde afuera "+m_completitud);
              // valida que calidad de la completitud del objeto 
                        if (m_completitud<0.25) {
                            evaluacion="Regular";
                        }else if (m_completitud>=0.25 && m_completitud<0.5) {
                                evaluacion="Buena";
                            }else if (m_completitud>=0.5 && m_completitud<0.75) {
                                    evaluacion="Muy buena";
                                }else if (m_completitud>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                         m_completitud="* Completitud de: "+m_completitud+ "; "+evaluacion;

              m_consistencia=consistenciaobaa(obaa);
              //alert("desde afuera "+m_consistencia);
              // valida que calidad de la completitud del objeto 
                        if (m_consistencia<0.25) {
                            evaluacion="Regular";
                        }else if (m_consistencia>=0.25 && m_consistencia<0.5) {
                                evaluacion="Buena";
                            }else if (m_consistencia>=0.5 && m_consistencia<0.75) {
                                    evaluacion="Muy buena";
                                }else if (m_consistencia>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                         m_consistencia="* Consistencia de: "+m_consistencia+"; "+evaluacion;

              m_coherencia=coherenciaobaa(obaa);
              //alert("desde afuera "+m_coherencia);
              // valida que calidad de objeto es
                        if ( m_coherencia<0.25) {
                             evaluacion="Regular";
                        }else if ( m_coherencia>=0.25 &&  m_coherencia<0.5) {
                                 evaluacion="Buena";
                            }else if ( m_coherencia>=0.5 &&  m_coherencia<0.75) {
                                     evaluacion="Muy buena";
                                }else if ( m_coherencia>=0.75 ) {
                                         evaluacion="Exelente";
                                }

                        // imprime  la evaluacion de la metrica
                       m_coherencia="* Coherencia de: "+ m_coherencia+"; "+ evaluacion;
              
              //realiza el borrado del archivo temporal
            var data = {ruta:ruta};
              $.post("borrar.php", data, function(dato){
                //alert(dato);
              });

            }else{
              alert("el archivo xml no corresponde a un solo OA");
              //realiza el borrado del archivo temporal
            var data = {ruta:ruta};
              $.post("borrar.php", data, function(dato){
                //alert(dato);
              });
              location.href ="index.html";
            }

            $('#oa').append('' +
              "<div><h3>EVALUACIÓN DE UN OBJETO ESTANDAR OBAA:</h3>"+
              "<TABLE table table-bordered\">"+
              "<TBODY class=\"category\">"+
                      "<TR>"+
                        "<TD colspan=\"4\">ID: 1</TD>"+
                      "</TR>"+
                      "<TR>"+
                        "<TD colspan=\"4\">Titulo del objeto analizado: "+titulo+
                      "</TR>"+
                    "</TBODY>"+
                    "<TBODY class=\"subcategory\">"+
                          "<TR>"+
                            "<TD style=\"padding:5px;\">"+
                                m_reusabilidad+"<br>"+
                                //m_disponivilidad+"<br>"+
                                m_completitud+"<br>"+
                                m_consistencia+"<br>"+
                                m_coherencia+"<br>"+
                            "</TD>"+
                          "</TR>"+
                        "</TBODY>"+
              "</TABLE></div>");
              acordeon();
              
  

            
            //document.writeln(lom.title);
          });
        });

}else{
  alert("NO CARGO  NINGUN ARCHIVO O URL");
              location.href ="index.html";
}

</script>



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
