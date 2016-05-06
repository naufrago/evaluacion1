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
			<?php
            $llego=$_POST['url'];
            if ($llego!="") {
                //carga el xml  en la variable
                $objetos=simplexml_load_file($_POST['url']);
                if ($objetos->ListRecords){
                    // recorre  el xml y entrega la cantidad de objetos que contiene el xml
                    $total_objetos=count($objetos->ListRecords->record);
                    // imprime la cantidad de objetos analizados
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
                                    <td>".$total_objetos."</td>
                                </tr>
                            <tbody>
                                </table><br>";

                    $objeto;
                    $eliminados=0;
                    try{
                        for ($i=0; $i <$total_objetos ; $i++) {
                            $atributo=$objetos->ListRecords->record[$i]->header->attributes();
                            $estatus=$atributo['status'];
                            $id=$objetos->ListRecords->record[$i]->header->identifier;
                            
                            if ($estatus=="") {
                                //hace el primer analisis del  namespace mas externo PARA HIJOS DE  METADATA
                                foreach ($objetos->ListRecords->record[$i]->metadata as $key) {
                                    //verificar que exista el namespace
                                    $namespaces = $key->getNameSpaces(true);
                                    //define que namespace se busca
                                    $obaa = $key->children($namespaces['obaa']);

                                    ////hace el segundo analisis del  namespace mas externo PARA HIJOS DE  OBAA
                                    foreach ($obaa->obaa as  $obaaobaa) {
                                        //verificar que exista el namespace
                                        $namespacesl = $obaaobaa->getNameSpaces(true);
                                        //define que namespace se busca
                                        $obaal = $obaaobaa->children($namespacesl['obaa']);


                                        try{
                                            // etiqueta GENERAL
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE GENERAL
                                            foreach ($obaal->general as  $obaageneral) {
                                                //verificar que exista el namespace
                                                $namespacesg = $obaageneral->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaag = $obaageneral->children($namespacesg['obaa']);

                                                try {
                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta aggregationlevel pocion
                                                    $nivelagregacion = $obaag->aggregationLevel;
                                                } catch (Exception $e) {
                                                    $nivelagregacion ="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta structure posicion 2
                                                    $estructura= $obaag->structure;
                                                } catch (Exception $e) {
                                                    $estructura= "";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta title posicion 5
                                                    $titulo=$obaag->title;
                                                } catch (Exception $e) {
                                                     $titulo="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta keyword posicion 6
                                                    $palabrasclave=$obaag->keyword;
                                                } catch (Exception $e) {
                                                    $palabrasclave="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta description posicion 7
                                                    $descripcion=$obaag->description;
                                                } catch (Exception $e) {
                                                    $descripcion="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta language posicion 11
                                                    $idioma=$obaag->language;
                                                } catch (Exception $e) {
                                                    $idioma="";
                                                }
                                            }

                                        }catch (Exception $e) {
                                            $nivelagregacion ="";
                                            $estructura= "";
                                            $titulo="";
                                            $palabrasclave="";
                                            $descripcion="";
                                            $idioma="";
                                        }

                                        try{
                                            // etiqueta EDUCATIONAL
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE EDUCATIONAL
                                            foreach ($obaal->educational as  $obaaeducational) {
                                                //verificar que exista el namespace
                                                $namespacesedu = $obaaeducational->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaaed = $obaaeducational->children($namespacesedu['obaa']);

                                                try {
                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta semanticdensity posicion 0
                                                    $densidadsemantica=$obaaed->semanticDensity;
                                                } catch (Exception $e) {
                                                    $densidadsemantica="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta context posicion 3
                                                    $total_contexto=count($obaaed->context);
                                                    $contexto=null;
                                                    for ($x=0; $x <$total_contexto ; $x++) {
                                                        $contexto[$x]=$obaaed->context[$x];
                                                    }
                                                } catch (Exception $e) {
                                                        $contexto="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta learningresourcetype posicion 9
                                                    $tiporecursoeducativo=$obaaed->learningResourceType;
                                                } catch (Exception $e) {
                                                        $tiporecursoeducativo="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta interactivitytype posicion 12
                                                    $tipointeractividad=$obaaed->interactivityType;
                                                } catch (Exception $e) {
                                                        $tipointeractividad="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta typicalagerange posicion 13
                                                    $tiporangoedad=$obaaed->typicalAgeRange;
                                                } catch (Exception $e) {
                                                        $tiporangoedad="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta interactivitylevel posicion 19
                                                    $nivelinteractivo=$obaaed->interactivityLevel;
                                                } catch (Exception $e) {
                                                        $nivelinteractivo="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta intendedenduserrole posicion 20
                                                    $rolusuariofinal=$obaaed->IntendedEndUserRole;
                                                } catch (Exception $e) {
                                                        $rolusuariofinal="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta difficulty posicion 20
                                                    $dificultad=$obaaed->difficulty;
                                                } catch (Exception $e) {
                                                        $dificultad="";
                                                }

                                            }

                                        }catch (Exception $e) {
                                            $densidadsemantica ="";
                                            $contexto= "";
                                            $tiporecursoeducativo="";
                                            $tipointeractividad="";
                                            $tiporangoedad="";
                                            $nivelinteractivo="";
                                            $nivelinteractivo="";
                                            $rolusuariofinal="";
                                            $dificultad="";
                                        }

                                        try {
                                            // etiqueta TECHNICAL
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE TECHNICAL
                                            foreach ($obaal->technical as  $obaatechnical) {
                                                //verificar que exista el namespace
                                                $namespacestec = $obaatechnical->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaatec = $obaatechnical->children($namespacestec['obaa']);

                                                try {
                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta location posicion 4
                                                    $ubicacion=null;
                                                    $total_locat=count($obaatec->location);
                                                    for ($x=0; $x <$total_locat ; $x++) {
                                                        $ubicacion [$x]= $obaatec->location[$x];
                                                    }
                                                } catch (Exception $e) {
                                                    $ubicacion ="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta format posicion 10
                                                    $formato = $obaatec->format;
                                                } catch (Exception $e) {
                                                    $formato ="";
                                                }

                                            }

                                        } catch (Exception $e) {
                                            $ubicacion ="";
                                            $formato= "";
                                        }

                                        try {
                                            // etiqueta LIFECYCLE
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE LIFECYCLE
                                            foreach ($obaal->lifeCycle as  $obaalifecycle) {
                                                //verificar que exista el namespace
                                                $namespacelife = $obaalifecycle->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaalife = $obaalifecycle->children($namespacelife['obaa']);

                                                try {
                                                    //hace el tercero analisis del  namespace mas externo PARA HIJOS DE CONTRIBUTE
                                                    foreach ($obaalife->contribute as $obaacontribute) {
                                                        //verificar que exista el namespace
                                                        $namespacescontri = $obaacontribute->getNameSpaces(true);
                                                        //define que namespace se busca
                                                        $obaacon = $obaacontribute->children($namespacescontri['obaa']);
                                                        try {
                                                            //*****variables capturadas*****
                                                            // guarda en variable el contenido de la etiqueta entity posicion 8
                                                            $autor = $obaacon->entity;
                                                        } catch (Exception $e) {
                                                            $autor ="";
                                                        }

                                                        try {
                                                            // guarda en variable el contenido de la etiqueta role posicion 17
                                                            $rol = $obaacon->role;
                                                        } catch (Exception $e) {
                                                            $rol ="";
                                                        }

                                                    }
                                                }catch (Exception $e) {
                                                    $autor ="";
                                                    $rol= "";
                                                }
                                                try {
                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta status posicion 15
                                                    $estado= $obaalife->status;
                                                } catch (Exception $e) {
                                                        $estado ="";
                                                }

                                            }
                                        }catch (Exception $e) {
                                            $autor ="";
                                            $rol= "";
                                            $estado="";
                                        }

                                        try {
                                            // etiqueta RIGHTS
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE RIGHTS
                                            foreach ($obaal->rights as  $obaarights) {
                                                //verificar que exista el namespace
                                                $namespacesrig = $obaarights->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaaright = $obaarights->children($namespacesrig['obaa']);
                                                try {
                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta cost posicion 14
                                                    $costo = $obaaright->cost;
                                                } catch (Exception $e) {
                                                        $costo ="";
                                                }

                                                try {
                                                    // guarda en variable el contenido de la etiqueta copyrightandotherrestrictions posicion 16
                                                    $copyrightotasrestricciones = $obaaright->CopyrightAndOtherRestrictions;
                                                } catch (Exception $e) {
                                                            $copyrightotasrestricciones ="";
                                                }


                                            }
                                        }catch (Exception $e) {
                                            $costo ="";
                                            $copyrightotasrestricciones= "";
                                        }

                                        try {
                                            // etiqueta METAMETADATA
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE METAMETADATA
                                            foreach ($obaal->metametadata as  $obaametameta) {
                                                //verificar que exista el namespace
                                                $namespacemeta = $obaametameta->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaameta = $obaametameta->children($namespacemeta['obaa']);

                                                //hace el tercero analisis del  namespace mas externo PARA HIJOS DE CONTRIBUTE
                                                foreach ($obaameta->contribute as $obaametacontribute) {
                                                    //verificar que exista el namespace
                                                    $namespacesmetacontri = $obaametacontribute->getNameSpaces(true);
                                                    //define que namespace se busca
                                                    $obaametacon = $obaametacontribute->children($namespacesmetacontri['obaa']);

                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta role posicion 18
                                                    $metarol = $obaametacon->role;
                                                }

                                            }
                                        }catch (Exception $e) {
                                            $metarol ="";

                                        }

                                        try {
                                            // etiqueta CLASSIFICATION
                                            //hace el tercero analisis del  namespace mas externo PARA HIJOS DE CLASSIFICATION
                                            foreach ($obaal->classification as  $obaaclassification) {
                                                //verificar que exista el namespace
                                                $namespacesclass = $obaaclassification->getNameSpaces(true);
                                                //define que namespace se busca
                                                $obaaclassifications = $obaaclassification->children($namespacesclass['obaa']);

                                                    //*****variables capturadas*****
                                                    // guarda en variable el contenido de la etiqueta purpose posicion 22
                                                    $proposito = $obaaclassifications->purpose;

                                            }
                                        }catch (Exception $e) {
                                            $proposito ="";

                                        }

                                        $objeto[$i][0]= $densidadsemantica;
                                        $objeto[$i][1]= $nivelagregacion;
                                        $objeto[$i][2]= $estructura;
                                        $objeto[$i][3]= $contexto;
                                        $objeto[$i][4]= $ubicacion;
                                        $objeto[$i][5]= $titulo;
                                        $objeto[$i][6]= $palabrasclave;
                                        $objeto[$i][7]= $descripcion;
                                        $objeto[$i][8]= $autor;
                                        $objeto[$i][9]= $tiporecursoeducativo;
                                        $objeto[$i][10]= $formato;
                                        $objeto[$i][11]= $idioma;
                                        $objeto[$i][12]= $tipointeractividad;
                                        $objeto[$i][13]= $tiporangoedad;
                                        $objeto[$i][14]= $costo;
                                        $objeto[$i][15]= $estado;
                                        $objeto[$i][16]= $copyrightotasrestricciones;
                                        $objeto[$i][17]= $rol;
                                        $objeto[$i][18]= $metarol;
                                        $objeto[$i][19]= $nivelinteractivo;
                                        $objeto[$i][20]= $rolusuariofinal;
                                        $objeto[$i][21]= $dificultad;
                                        //$objeto[$i][22]= $proposito;
                                        $objeto[$i][23]= $estatus;


                                    }

                                }

                            }else{
                                $objeto[$i][23]= $estatus;
                                $eliminados++;
                            }
                                
                        }

                    }catch (Exception $e) {
                        echo '<script >alert("ALGO SALIO MAL EN LA CARGA DE LA INFORMACION DEL ARCHIVO XML");
                            location.href ="index.html"</script>';

                    }

                    // ciclo que realiza la evaluacion a todos los OAS
                    echo "<div><h3>EVALUACIÓN DE LOS OBJETOS ESTARNDAR OBAA:</h3>";
                    echo"<TABLE table table-bordered\">";

                    for ($a=0; $a <($total_objetos) ; $a++) {
                        # code...
                        $r=$a+1;
                        echo "<TBODY class=\"category\">
                                <TR>
                                    <TD colspan=\"4\">ID: ".$r."</TD>
                                </TR>
                                <TR>";
                                    if ($objeto[$a][23]!="deleted") {
                                        echo "<TD colspan=\"4\">Titulo del objeto analizado: ".$objeto[$a][5]."";
                                    }else{
                                        echo "<TD colspan=\"4\"> Objeto eliminado";

                                    }

                                    
                                echo "</TR>
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

                    }

                    echo "</TABLE></div>";
                }else {
                    echo '<script >alert("EL XML CARGADO NO CUMPLE CON  EL ESTANDAR PARA REALIZAR LA EVALUACION O  NO ES UN XML");
                        location.href ="javascript:window.close();"</script>';
                }

            }else {
                    echo '<script >alert("DEBE SELECCIONAR  ALGUNA FORMA E INGRESAR LA URL O EL ARCHIVO XML");
                    location.href ="index.html"</script>';
                    //header('Location: index.html');
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
