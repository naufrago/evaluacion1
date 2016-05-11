<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
if ($_FILES['url']["error"] > 0)
  {
  echo "Error: " . $_FILES['url']['error'] . "<br>";
  }
else
  {
  echo "Nombre: " . $_FILES['url']['name'] . "<br>";
  echo "Tipo: " . $_FILES['url']['type'] . "<br>";
  echo "Tamaño: " . ($_FILES["url"]["size"] / 1024) . " kB<br>";
  echo "Carpeta temporal: " . $_FILES['url']['tmp_name'];

  $hoy = getdate();
  $ruta=$hoy['year']."-".$hoy['mon']."-".$hoy['mday']."-".$hoy['hours']."-".$hoy['minutes']."-".$hoy['seconds'].".xml";
  move_uploaded_file($_FILES['url']['tmp_name'], $ruta);}


?>


</body>
</html>