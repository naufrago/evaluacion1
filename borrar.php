<?php
if($_POST){
	$ruta = array_key_exists('ruta', $_POST) ? $_POST['ruta'] : null;

	if($ruta!=null){
		unlink($ruta);
		echo "listo";
	}
}



?>