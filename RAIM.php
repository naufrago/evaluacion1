<?php

if($_GET){
	$cadena = array_key_exists('val', $_GET) ? $_GET['val'] : null;

	$xml = objetos($cadena);

	echo $_GET['callback'] . '('.json_encode($xml).')';
}

?>