<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$objetos=simplexml_load_file("a.xml");

$namespaces = $objetos->getNameSpaces(true);
//define que namespace se busca
$lom = $objetos->children($namespaces['lom']);

echo "<div>".$lom."</div>";
?>
</body>
</html>
