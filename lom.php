<!DOCTYPE html>
<html>
<head>
	<script src="plugins/jQuery/jQuery-2.2.1.min.js"></script>
	<title></title>
	<script src="js/LomMetadata.js"></script>
  <script type="text/javascript">
  
 function oa(ruta){ 
    var lom ;
         //var xmlDoc=loadXMLDoc('as.xml');
        $(document).ready(function(){
          $.get(ruta,function(xml){

            var xmlString = (new XMLSerializer()).serializeToString(xml);

            //console.log(xmlString);
          
            lom = processXml(xmlString);
            console.log(lom);
            if (!lom.identifier) {
              reusabilidad(lom);
              //disponibilidad(lom.location);
              completitud(lom);
              consistencia(lom);
              coherencia(lom);
            }else{
              alert("el archivo xml no corresponde a un solo OA");
              location.href ="index.html";
            }
            
            //document.writeln(lom.title);
          });
        });
  return lom;
}
   
      
</script>
  
</head>
<body>
<div>

<?php  $llego=$_POST['url'];
            //echo "<div>".$llego."</div><br>";

     ?>       
<script >
  var ruta= "<?php echo $llego; ?>" ;
  console.log(ruta);
  //alert(ruta);
  document.write("ruta que llego = " + ruta);
  var datos=oa(ruta);
</script>

</div>



</body>
</html>