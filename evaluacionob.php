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
	
	<script type="text/javascript">
		  
	</script>
</head>
<header>
		<div class="logo">
			<img src="imagenes/logo.png" alt="logo"/>
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

					

					//$rut="http://froac.manizales.unal.edu.co/roap/oai.php?verb=ListRecords&metadataPrefix=lom";
					//$objetos=simplexml_load_file($rut)	;
					// recorre  el xml y entrega la cantidad de objetos que contiene el xml
					//$total_objetos=count($objetos->ListRecords->record);
					// imprime la cantidad de objetos analizados
					echo "<table>
							<thead>
								<tr>
									<td>La ruta es:</td> 
									<td>".$_POST['url']."</td> 
								</tr>
							</thead><br>";
					
					$objeto;
					
								$ca=1;
									$objeto[0][0]= $densidadsemantica;
									$objeto[0][1]= $nivelagregacion;
									$objeto[0][2]= $estructura;
									$objeto[0][3]= $contexto;
									$objeto[0][4]= $ubicacion;
									$objeto[0][5]= $titulo;
									$objeto[0][6]= $palabrasclave;
									$objeto[0][7]= $descripcion;
									$objeto[0][8]= $autor;
									$objeto[0][9]= $tiporecursoeducativo;
									$objeto[0][10]= $formato;
									$objeto[0][11]= $idioma;
									$objeto[0][12]= $tipointeractividad;
									$objeto[0][13]= $tiporangoedad;
									$objeto[0][14]= $costo;
									$objeto[0][15]= $estado;
									$objeto[0][16]= $copyrightotasrestricciones;
									$objeto[0][17]= $rol;
									$objeto[0][18]= $metarol;
									$objeto[0][19]= $nivelinteractivo;
									$objeto[0][20]= $rolusuariofinal;
									$objeto[0][21]= $dificultad;
									$objeto[0][22]= $proposito;
							}
						

									echo "<div>este es el ensayo ".$titulo."</div>";
			// ciclo que realiza la evaluacion a todos los OAS
					echo "<div><h3>EVALUACIÓN DE LOS OBJETOS:</h3>";
											echo"<TABLE table table-bordered\">";
										   
					echo "<TBODY class=\"category\">
											<TR>
												<TD colspan=\"4\">ID: 1</TD>
											</TR>
											<TR>
												<TD colspan=\"4\">Titulo del objeto analizado: ".$objeto[0][5]."
											</TR>
										</TBODY>
										<TBODY class=\"subcategory\">
										      <TR>
										      	<TD style=\"padding:5px;\">";
										      	reusabilidad($objeto,0);
										        disponibilidad($objeto[0][4]);
										        completitud($objeto,0);
										        consistencia($objeto,0);
										        coherencia($objeto,0);
										        echo"</TD>
										      </TR>
										    </TBODY>";
					echo "</TABLE></div>";
				
			}else
				{
					echo '<script >alert("DEBE SELECCIONAR  ALGUNA FORMA E INGRESAR LA URL O EL ARCHIVO XML");
					location.href ="javascript:window.close();"</script>';
					//header('Location: index.html');
				}


			function reusabilidad($objeto1, $pos){
					// extrae las variables nesesarias para la evaluacion
					$densidadsemantica1=$objeto1[$pos][0];
					$general1=$objeto1[$pos][1];
					$estructura1=$objeto1[$pos][2];
					$contexto1=$objeto1[$pos][3];
					$titulo1=$objeto1[$pos][5];
					//inicializa las reglas y las variables de los pesos
					$r=0;
					$pesor1=0;
					$pesor2=0;
					$pesor3=0;
					$pesor4=0;
					//verifica cuantas reglas se van a evaluar
					if ($densidadsemantica1!="") {
							$r++;
							switch ($densidadsemantica1) {
			       			 case 'very low':
			       			 	$pesor1=1;
			       			 	break;

			       			 case 'low':
			       			 	$pesor1=0.8;
			       			 	break;

			       			 case 'medium':
			       			 	$pesor1=0.6;
			       			 	break;

			       			 case 'high':
			       			 	$pesor1=0.4;
			       			 	break;

			       			 case 'very high':
			       			 	$pesor1=0.2;
			       			 	break;
			       		}
					}
					if ($general1!="") {
							$r++;
							switch ($general1) {
			       			 case '1':
			       			 	$pesor2=1;
			       			 	break;

			       			 case '2':
			       			 	$pesor2=0.75;
			       			 	break;

			       			 case '3':
			       			 	$pesor2=0.5;
			       			 	break;

			       			 case '4':
			       			 	$pesor2=0.25;
			       			 	break;

			       			
			       		}
					}
					if ($estructura1!="") {
							$r++;
							switch ($estructura1) {
			       			 case 'atomic':
			       			 	$pesor3=1;
			       			 	break;

			       			 case 'collection':
			       			 	$pesor3=0.25;
			       			 	break;

			       			 case 'networked':
			       			 	$pesor3=0.25;
			       			 	break;

			       			 case 'hierarchical':
			       			 	$pesor3=0.25;
			       			 	break;

			       			 case 'linear':
			       			 	$pesor3=0.25;
			       			 	break;

			       			
			       		}
					}

					$can_contex=0;
					for ($i=0; $i <$can_contex ; $i++) { 
						if ($contexto1[$i]!="") {
							$can_contex++;
						}
					}
					$r++;
					if ($can_contex==1) {
						$pesor4=0.2;
						}elseif($can_contex==2){
							 $pesor4=0.6;
							 }elseif($can_contex>=3){
									$pesor4=1;
								}
						
					
					$evaluacion="OA no reutilizable";
					$m_reusabilidad=0;
					//condiciona la evaluacion del objeto
					if ($r>0) {
						// hace la sumatoria de los pesos 
			       		$m_reusabilidad=($pesor1/$r)+($pesor2/$r)+($pesor3/$r)+($pesor4/$r);

			       		// valida que calidad de objeto es
			       		if ($m_reusabilidad<0.25) {
			       			$evaluacion="Regular";
			       		}elseif ($m_reusabilidad>=0.25 && $m_reusabilidad<0.5) {
			       				$evaluacion="Buena";
			       			}elseif ($m_reusabilidad>=0.5 && $m_reusabilidad<0.75) {
			       					$evaluacion="Muy buena";
			       				}elseif ($m_reusabilidad>=0.75 ) {
			       						$evaluacion="Exelente";
			       				}

			       				// imprime  la evaluacion de la metrica
			       		echo "* Reusabilidad de: ".$m_reusabilidad."; ".$evaluacion."<br>";
			       		



					}else{
						// en caso tal  que las reglas sean cero imprime esto
						echo "* La métrica de reusabilidad no se puede aplicar no se cumple ninguna regla";
					}

				};
		 
			  // funcion encargada de verificar si la ruta  si conduce a un objeto
			function disponibilidad($ruta){
					$cantidad=count($ruta);
					echo "* Cantidad rutas ".$cantidad."<br>";
					$campos=0;
					for ($y=0; $y <$cantidad ; $y++) { 
						// invoca la funcion si url_exist para verificar existencia con un llamado al servidor
						$existe= isURL( $ruta[$y] );
						// si  es verdadero entrega  la existencia del objeto
						if ($existe) {
							# code...
							$campos++;
							echo "      -El objeto almacenado en la ruta ".$ruta[$y].", si existe.<br> ";
						}	else{// 
								// si no existe el objeto
								echo "      -El objeto almacenado en la ruta ".$ruta[$y].", no fue encontrado.<br>";
								}

						
					}
					$m_disponibilidad=$campos/$cantidad;
						// valida que calidad de la completitud del objeto 
			       		if ($m_disponibilidad<0.25) {
			       			$evaluacion="Regular";
			       		}elseif ($m_disponibilidad>=0.25 && $m_disponibilidad<0.5) {
			       				$evaluacion="Buena";
			       			}elseif ($m_disponibilidad>=0.5 && $m_disponibilidad<0.75) {
			       					$evaluacion="Muy buena";
			       				}elseif ($m_disponibilidad>=0.75 ) {
			       						$evaluacion="Exelente";
			       				}
						echo "      -Disponibilidad: ".$evaluacion."<br>";
					

					}

			//verfica la existenca del objeto
			function isURL($url){
			    $pattern='|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';
			    if(preg_match($pattern, $url) > 0) return true;
			    else return false;
			}

			 // verifica que tan completo es el oa en sus metadatos
			 function completitud($oa,$pos){
			 		$titulo=0; $keyword=0; $descripcion=0; $autor=0;
			 		$tipoRE=0; $formato=0; $contexto=0; $idioma=0;
			 		$tipointer=0; $rangoedad=0; $nivelagregacion=0;
			 		$ubicacion=0; $costo=0; $estado=0; $copyright=0;

			 		// verifica que la variable tenga  un valor y asigna el peso a las variables
			 		if (trim($oa[$pos][5])!="") {
			 			$titulo=0.15;
			 		}
			 		if (trim($oa[$pos][6])!="") {
			 			$keyword=0.14;
			 		}
			 		if (trim($oa[$pos][7])!="") {
			 			$descripcion=0.12;
			 		}
			 		if (trim($oa[$pos][8])!="") {
			 			$autor=0.11;
			 		}
			 		if (trim($oa[$pos][9])!="") {
			 			$tipoRE=0.09;
			 		}
			 		if (trim($oa[$pos][10])!="") {
			 			$formato=0.08;
			 		}

			 		
			 		// hace la  comprobacion cuantos contextos existe  en el objeto
			 		$context=$oa[$pos][3];
			 		// cuenta cuantas ubicaciones tiene el objeto
			 		$can=count($context);
			 		// asigna el nuevo peso que tendra cada contexto
			 		$pesocontexto=0.06/$can;
			 		// comprueba  que los contextos sean diferentes a  vacio o a espacio 
			 		for ($w=0; $w <$can ; $w++) { 
			 			if (trim($context[$w])!="") {
			 				// calcula el nuevo peso para entregar para el calculo de la metrica
			 				$contexto=$contexto+$pesocontexto;
			 			}
			 		}





			 		if (trim($oa[$pos][11])!="") {
			 			$idioma=0.05;
			 		}
			 		if (trim($oa[$pos][12])!="") {
			 			$tipointer=0.04;
			 		}
			 		if (trim($oa[$pos][13])!="") {
			 			$rangoedad=0.03;
			 		}
			 		if (trim($oa[$pos][1])!="") {
			 			$nivelagregacion=0.03;
			 		}
			 		// hace la  comprobacion cuantas ubicaciones existe  en el objeto
			 		$location=$oa[$pos][4];
			 		// cuenta cuantas ubicaciones tiene el objeto
			 		$can=count($location);
			 		// asigna el nuevo peso que tendra cada ubicacion
			 		$peso=0.03/$can;
			 		// comprueba  que las ubicaciones sean diferentes a  vacio o a espacio 
			 		for ($i=0; $i <$can ; $i++) { 
			 			if (trim($location[$i])!="") {
			 				// calcula el nuevo peso para entregar para el calculo de la metrica
			 				$ubicacion=$ubicacion+$peso;
			 			}
			 		}
			 		

			 		if (trim($oa[$pos][14])!="") {
			 			$costo=0.03;
			 		}
			 		if (trim($oa[$pos][15])!="") {
			 			$estado=0.02;
			 		}
			 		if (trim($oa[$pos][16])!="") {
			 			$copyright=0.02;
			 		}

			 		
					
						// hace la sumatoria de los pesos 
			       		$m_completitud=$titulo + $keyword + $descripcion + $autor + $tipoRE + $formato + $contexto + $idioma +
			 						   $tipointer + $rangoedad + $nivelagregacion + $ubicacion + $costo + $estado + $copyright;

			       		// valida que calidad de la completitud del objeto 
			       		if ($m_completitud<0.25) {
			       			$evaluacion="Regular";
			       		}elseif ($m_completitud>=0.25 && $m_completitud<0.5) {
			       				$evaluacion="Buena";
			       			}elseif ($m_completitud>=0.5 && $m_completitud<0.75) {
			       					$evaluacion="Muy buena";
			       				}elseif ($m_completitud>=0.75 ) {
			       						$evaluacion="Exelente";
			       				}

			       				// imprime  la evaluacion de la metrica
			       		echo "* Completitud de: ".$m_completitud."; ".$evaluacion."<br>";
			       	}


			function consistencia($oa,$pos){
				$nivelagregacion=0; $estructura=0; $rol=0; $estado=0; $metarol=0; $tipointer=0;
				$tiporecursoeducativo=0; $nivelinter=0; $densidadsemantica=0; $rolusuariofinal=0;
				$contexto=0; $dificultad=0; $copyright=0; $costo=0; $proposito=0; $r=14;

				if (trim($oa[$pos][1])==1 || trim($oa[$pos][1])==2 || trim($oa[$pos][1])==3 ||trim($oa[$pos][1])==4  ) {
						$nivelagregacion=1;
				}
				if (trim($oa[$pos][2])=="atomic" || trim($oa[$pos][2])=="collection" || trim($oa[$pos][2])=="networked" ||trim($oa[$pos][2])=="hierarchical" || trim($oa[$pos][2])=="linear" ) {
						$estructura=1;
				}
				if (trim($oa[$pos][17])=="author" ||
				    trim($oa[$pos][17])=="publisher" || 
				    trim($oa[$pos][17])=="unknown" ||
				    trim($oa[$pos][17])=="initiator" || 
				    trim($oa[$pos][17])=="terminator" || 
				    trim($oa[$pos][17])=="validator" || 
				    trim($oa[$pos][17])=="editor" || 
				    trim($oa[$pos][17])=="graphical designer" || 
				    trim($oa[$pos][17])=="technical implementer" || 
				    trim($oa[$pos][17])=="content provider" || 
				    trim($oa[$pos][17])=="technical validator" || 
				    trim($oa[$pos][17])=="educational validator" || 
				    trim($oa[$pos][17])=="script writer" || 
				    trim($oa[$pos][17])=="instructional designer" || 
				    trim($oa[$pos][17])=="subject matter expert" ) {
						$rol=1;
				}
				if (trim($oa[$pos][15])=="draft" || trim($oa[$pos][15])=="final" || trim($oa[$pos][15])=="revised" ||trim($oa[$pos][15])=="unavailable" ) {
						$estado=1;
				}
				if (trim($oa[$pos][18])=="creator" || trim($oa[$pos][18])=="validator"  ) {
						$metarol=1;
				}
				if (trim($oa[$pos][12])=="active" || trim($oa[$pos][12])=="expositive" || trim($oa[$pos][12])=="mixed" ) {
						$tipointer=1;
				}
				if (trim($oa[$pos][9])=="exercise" ||
				    trim($oa[$pos][9])=="simulation" || 
				    trim($oa[$pos][9])=="questionnaire" ||
				    trim($oa[$pos][9])=="diagram" || 
				    trim($oa[$pos][9])=="figure" || 
				    trim($oa[$pos][9])=="graph" || 
				    trim($oa[$pos][9])=="index" || 
				    trim($oa[$pos][9])=="slide" || 
				    trim($oa[$pos][9])=="table" || 
				    trim($oa[$pos][9])=="narrative text" || 
				    trim($oa[$pos][9])=="exam" || 
				    trim($oa[$pos][9])=="experiment" || 
				    trim($oa[$pos][9])=="problem" || 
				    trim($oa[$pos][9])=="statement" || 
				    trim($oa[$pos][9])=="self assessment" || 
				    trim($oa[$pos][9])=="lecture" ) {
						$tiporecursoeducativo=1;
				}
				if (trim($oa[$pos][19])=="very low" || trim($oa[$pos][19])=="low" || trim($oa[$pos][19])=="medium" || trim($oa[$pos][19])=="high" || trim($oa[$pos][19])=="very high" ) {
						$nivelinter=1;
				}
				if (trim($oa[$pos][0])=="very low" || trim($oa[$pos][0])=="low" || trim($oa[$pos][0])=="medium" || trim($oa[$pos][0])=="high" || trim($oa[$pos][0])=="very high" ) {
						$densidadsemantica=1;
				}
				if (trim($oa[$pos][20])=="teacher" || trim($oa[$pos][20])=="author" || trim($oa[$pos][20])=="learner" || trim($oa[$pos][20])=="manager" ) {
						$rolusuariofinal=1;
				}

				// analisa cada uno de los contextos existentes en el objeto 
				// verifica que sea consistente  de lo contrario entrega 0
				$context=$oa[$pos][3];
				$cantidad=count($context);
				$cumple=true;
				$s=0;
				while ( $cumple && $s<$cantidad) {
				 	if (trim($context[$s])=="school" || trim($context[$s])=="higher education" || trim($context[$s])=="training" || trim($context[$s])=="other" ) {
						$cumple=false;
						$contexto=1;
					}else{
						$s++;
					}
				}
				
				if (trim($oa[$pos][21])=="very easy" || trim($oa[$pos][21])=="easy" || trim($oa[$pos][21])=="medium" || trim($oa[$pos][21])=="difficult" || trim($oa[$pos][21])=="very difficult" ) {
						$dificultad=1;
				}
				if (trim($oa[$pos][16])=="yes" || trim($oa[$pos][16])=="no"  ) {
						$copyright=1;
				}
				if (trim($oa[$pos][14])=="yes" || trim($oa[$pos][14])=="no"  ) {
						$costo=1;
				}
				if (trim($oa[$pos][22])=="discipline" ||
				    trim($oa[$pos][22])=="idea" || 
				    trim($oa[$pos][22])=="prerequisite" ||
				    trim($oa[$pos][22])=="educational objective" || 
				    trim($oa[$pos][9])=="accessibility" || 
				    trim($oa[$pos][9])=="restrictions" || 
				    trim($oa[$pos][9])=="educational level" || 
				    trim($oa[$pos][9])=="skill level" || 
				    trim($oa[$pos][9])=="security level" || 
				    trim($oa[$pos][9])=="competency"  ) {
						$proposito=1;
				}
				$m_consistencia=($nivelagregacion + $estructura + $rol + $estado + $metarol + $tipointer +
								$tiporecursoeducativo + $nivelinter + $densidadsemantica + $rolusuariofinal + 
								$contexto + $dificultad + $copyright + $costo + $proposito) /  $r;

				// valida que calidad de la completitud del objeto 
			       		if ($m_consistencia<0.25) {
			       			$evaluacion="Regular";
			       		}elseif ($m_consistencia>=0.25 && $m_consistencia<0.5) {
			       				$evaluacion="Buena";
			       			}elseif ($m_consistencia>=0.5 && $m_consistencia<0.75) {
			       					$evaluacion="Muy buena";
			       				}elseif ($m_consistencia>=0.75 ) {
			       						$evaluacion="Exelente";
			       				}

			       				// imprime  la evaluacion de la metrica
			       		echo "* Consistencia de: ".$m_consistencia."; ".$evaluacion."<br>";
			}

			// verifica que tan coherente son los metadatos del oa
			 function coherencia($objeto,$pos){
			 	// extrae las variables nesesarias para la evaluacion
			 	$estructura=$objeto[$pos][2];
			 	$nivelagregacion=$objeto[$pos][1];
			 	$tipointeractividad=$objeto[$pos][12]; 
			 	$nivelinteractivo=$objeto[$pos][19];
			 	$tiporecursoeducativo=$objeto[$pos][9];
			 	
			 	//inicializa las reglas y las variables de los pesos
				$r=0;
				$pesor1=0;
				$pesor2=0;
				$pesor3=0;

				//verifica las reglas que se van a evaluar
				if (trim($estructura)=="atomic" && trim($nivelagregacion)==1){
                    $r++;
					$pesor1=1;
				}elseif (trim($estructura)=="atomic" && trim($nivelagregacion)==2){
                    	$r++;
						$pesor1=0.5;
					}elseif (trim($estructura)=="atomic" && trim($nivelagregacion)==3){
                    		$r++;
							$pesor1=0.25;
						}elseif (trim($estructura)=="atomic" && trim($nivelagregacion)==4){
                    			$r++;
								$pesor1=0.125;
							}elseif (trim($estructura)=="collection" && trim($nivelagregacion)==1){
                    				$r++;
									$pesor1=0.5;
								}elseif (trim($estructura)=="networked" && trim($nivelagregacion)==1){
                    					$r++;
										$pesor1=0.5;	
									}elseif (trim($estructura)=="hierarchical" && trim($nivelagregacion)==1){
                    						$r++;
											$pesor1=0.5;	
										}elseif (trim($estructura)=="linear" && trim($nivelagregacion)==1){
                    							$r++;
												$pesor1=0.5;	
											}elseif (trim($estructura)=="collection" && (trim($nivelagregacion)==2 || 
													 									 trim($nivelagregacion)==3 || 
													 									 trim($nivelagregacion)==4) ){
                    								$r++;
													$pesor1=1;	
												}elseif (trim($estructura)=="networked" && (trim($nivelagregacion)==2 || 
														 									trim($nivelagregacion)==3 || 
														 									trim($nivelagregacion)==4) ){
                    								 	$r++;
														$pesor1=1;	
													}elseif (trim($estructura)=="hierarchical" && (trim($nivelagregacion)==2 || 
															 									   trim($nivelagregacion)==3 || 
															 									   trim($nivelagregacion)==4) ){
                    										$r++;
															$pesor1=1;	
														}elseif (trim($estructura)=="linear" && (trim($nivelagregacion)==2 || 
																 								 trim($nivelagregacion)==3 || 
																 								 trim($nivelagregacion) ==4) ){
                    											$r++;
																$pesor1=1;	
														}

				if (trim($tipointeractividad)=="active" && (trim($nivelinteractivo)=="very high" || 
														    trim($nivelinteractivo)=="high" || 
														    trim($nivelinteractivo)=="medium" || 
														    trim($nivelinteractivo)=="low" ||
														    trim($nivelinteractivo)=="very low") ){
                    	$r++;
						$pesor2=1;	
				}elseif (trim($tipointeractividad)=="mixed" && (trim($nivelinteractivo)=="very high" || 
														    trim($nivelinteractivo)=="high" || 
														    trim($nivelinteractivo)=="medium" || 
														    trim($nivelinteractivo)=="low" ||
														    trim($nivelinteractivo)=="very low") ){
						$r++;
						$pesor2=1;
					}elseif (trim($tipointeractividad)=="expositive" && (trim($nivelinteractivo)=="very high" || 
														    			 trim($nivelinteractivo)=="high") ){
							$r++;
							$pesor2=0;
						}elseif (trim($tipointeractividad)=="expositive" && trim($nivelinteractivo)=="medium" ){
								$r++;
								$pesor2=0.5;
							}elseif (trim($tipointeractividad)=="expositive" && (trim($nivelinteractivo)=="low" ||
														    					 trim($nivelinteractivo)=="very low") ){
									$r++;
									$pesor2=1;
							}	
				if (trim($tipointeractividad)=="active" && (trim($tiporecursoeducativo)=="exercise" || 
														    trim($tiporecursoeducativo)=="simulation" || 
														    trim($tiporecursoeducativo)=="questionnaire" || 
														    trim($tiporecursoeducativo)=="exam" ||
														    trim($tiporecursoeducativo)=="experiment" ||
														    trim($tiporecursoeducativo)=="problem statement" ||
														    trim($tiporecursoeducativo)=="self assessment") ){
                    	$r++;
						$pesor3=1;	
				}elseif (trim($tipointeractividad)=="active" && (trim($tiporecursoeducativo)=="diagram" || 
														    	 trim($tiporecursoeducativo)=="figure" || 
														    	 trim($tiporecursoeducativo)=="graph" || 
														    	 trim($tiporecursoeducativo)=="index" ||
														    	 trim($tiporecursoeducativo)=="slide" ||
														    	 trim($tiporecursoeducativo)=="table" ||
														    	 trim($tiporecursoeducativo)=="narrative text" ||
														    	 trim($tiporecursoeducativo)=="lecture") ){
                    	$r++;
						$pesor3=0;
					
					}elseif (trim($tipointeractividad)=="expositive" && (trim($tiporecursoeducativo)=="exercise" || 
														    			 trim($tiporecursoeducativo)=="simulation" || 
														    			 trim($tiporecursoeducativo)=="questionnaire" || 
														    			 trim($tiporecursoeducativo)=="exam" ||
														    			 trim($tiporecursoeducativo)=="experiment" ||
														    			 trim($tiporecursoeducativo)=="problem statement" ||
														    			 trim($tiporecursoeducativo)=="self assessment") ){
                    		$r++;
							$pesor3=0;	
						}elseif (trim($tipointeractividad)=="expositive" && (trim($tiporecursoeducativo)=="diagram" || 
														    	 			 trim($tiporecursoeducativo)=="figure" || 
														    	 			 trim($tiporecursoeducativo)=="graph" || 
														    	 			 trim($tiporecursoeducativo)=="index" ||
														    	 			 trim($tiporecursoeducativo)=="slide" ||
														    	 			 trim($tiporecursoeducativo)=="table" ||
														    	 			 trim($tiporecursoeducativo)=="narrative text" ||
														    	 			 trim($tiporecursoeducativo)=="lecture") ){
                    			$r++;
								$pesor3=1;
							}elseif (trim($tipointeractividad)=="mixed" && (trim($tiporecursoeducativo)=="exercise" || 
														    			 trim($tiporecursoeducativo)=="simulation" || 
														    			 trim($tiporecursoeducativo)=="questionnaire" || 
														    			 trim($tiporecursoeducativo)=="exam" ||
														    			 trim($tiporecursoeducativo)=="experiment" ||
														    			 trim($tiporecursoeducativo)=="problem statement" ||
														    			 trim($tiporecursoeducativo)=="self assessment" ||
														    			 trim($tiporecursoeducativo)=="diagram" ||
														    			 trim($tiporecursoeducativo)=="figure" ||
														    			 trim($tiporecursoeducativo)=="graph" ||
														    			 trim($tiporecursoeducativo)=="index" ||
														    			 trim($tiporecursoeducativo)=="slide" ||
														    			 trim($tiporecursoeducativo)=="table" ||
														    			 trim($tiporecursoeducativo)=="narrative text" ||
														    			 trim($tiporecursoeducativo)=="lecture") ){
                    				$r++;
									$pesor3=1;	
							}	


				// hace la sumatoria de los pesos 
			       		$m_coherencia= ($pesor1 + $pesor2 + $pesor3) / $r;

			     	// valida que calidad de objeto es
			       		if ($m_coherencia<0.25) {
			       			$evaluacion="Regular";
			       		}elseif ($m_coherencia>=0.25 && $m_coherencia<0.5) {
			       				$evaluacion="Buena";
			       			}elseif ($m_coherencia>=0.5 && $m_coherencia<0.75) {
			       					$evaluacion="Muy buena";
			       				}elseif ($m_coherencia>=0.75 ) {
			       						$evaluacion="Exelente";
			       				}

			       		// imprime  la evaluacion de la metrica
			       			echo "* Coherencia de: ".$m_coherencia."; ".$evaluacion."<br><br>";

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