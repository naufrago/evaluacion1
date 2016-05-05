<!DOCTYPE html>
<html>
<head>
	<script src="plugins/jQuery/jQuery-2.2.1.min.js"></script>
	<title></title>
	<script src="js/LomMetadata.js"></script>
  <script type="text/javascript">
  
  
    /*var lom ;
         //var xmlDoc=loadXMLDoc('as.xml');
        $(document).ready(function(){
          $.get("as.xml",function(xml){

            var xmlString = (new XMLSerializer()).serializeToString(xml);

            //console.log(xmlString);
          
            lom = processXml(xmlString);

            document.writeln(lom.title);
          });
        });*/

function ping(ip)
{
    var input = "";
    var WshShell = new ActiveXObject("WScript.Shell");
    var oExec = WshShell.Exec("c:/windows/system32/ping.exe " + ip);

    while (!oExec.StdOut.AtEndOfStream)
    {
            input += oExec.StdOut.ReadLine() + "<br />";
    }
    alert(input)
}

   
      
</script>
  
</head>
<body>
<div>
<script type="text/javascript">
  
//ping( "http://google.com", z, 4000 );
// El resultado sería true.
 
ping( );
// El resultado sería false.
</script>

</div>



</body>
</html>