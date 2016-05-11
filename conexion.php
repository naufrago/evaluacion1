<!DOCTYPE html>
<html>
	<body>
		<?php
		$conexion = pg_connect ('host=localhost dbname=eva_oa user=postgres password=root');
		if($conexion)
		{

			echo"<p>Se conecto satisfactoriamente con la base de datos EVAOA.</p>";
			exit;
		}
		?>
	</body>
</html>