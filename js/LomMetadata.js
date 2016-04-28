/**
 * Created by magir on 2/04/2016.
 */


function LOMMetadata(){
    var aggregationlevel;
    var structure;
    var title;
    var keyword;
    var description;
    var language;
    var semanticdensity;
    var context;
    var learningresourcetype;
    var interactivitytype;
    var typicalagerange;
    var interactivitylevel;
    var intendedenduserrole;
    var difficulty;
    var location=[];
    var format;
    var entity;
    var rolelifecycle;
    var status;
    var cost;
    var copyrightandotherrestrictions;
    var role;
    var purpose;
 
}

function processXml(xml) {

            var lom = new LOMMetadata();

            lom.aggregationlevel = $(xml).find("lom\\:aggregationlevel").text();
            lom.structure = $(xml).find("lom\\:structure").text();
            lom.title = $(xml).find("lom\\:title").text();
            lom.keyword = $(xml).find("lom\\:keyword").first().text();
            lom.description = $(xml).find("lom\\:description").first().text();
            lom.language = $(xml).find("lom\\:language").first().text();
            lom.semanticdensity = $(xml).find("lom\\:semanticdensity").text();
            lom.context = $(xml).find("lom\\:context").text();
            lom.learningresourcetype = $(xml).find("lom\\:learningresourcetype").text();
            lom.interactivitytype = $(xml).find("lom\\:interactivitytype").text();
            lom.typicalagerange = $(xml).find("lom\\:typicalagerange").text();
            lom.interactivityLevel = $(xml).find("lom\\:interactivitylevel").text();
            lom.intendedenduserrole = $(xml).find("lom\\:intendedenduserrole").text();
            lom.difficulty = $(xml).find("lom\\:difficulty").text();
            var ind =$(xml).find("lom\\:location").length;
            console.log(ind);

            //lom.location= $(xml).each("lom\\:location").text();
            //
           $.each($(xml).find("lom\\:location"), function( index, value ) {
                    for (var i = 0; i <= 0; i--) {
                        lom.location[i]=value.text();
                    }
            });
            
            for (var i = 0; i < ind; i++) {
                //lom.location.push( $(xml).getElementsByTagName("lom\\:location")[i].childNodes[0].text());
                lom.location[i]= $(xml).find("lom\\:location")[i].text();
                 console.log(lom.location[i]);
            }
            
            lom.format = $(xml).find("lom\\:format").text();
            lom.entity = $(xml).find("lom\\:entity").text();
            lom.rolelifecycle = $(xml).find("lom\\:role").first().text();
            lom.status = $(xml).find("lom\\:status").text();
            lom.cost = $(xml).find("lom\\:cost").text();
            lom.copyrightandotherrestrictions = $(xml).find("lom\\:varcopyrightandotherrestrictions").text();


            lom.role = $(xml).find("lom\\:metametadata").find("lom\\:role").text();
            

            lom.purpose = $(xml).find("lom\\:purpose").text();


            

            return lom;
        }


/*function reusabilidad(objeto1){
                    // extrae las variables nesesarias para la evaluacion
                   var densidadsemantica1=objeto1.semanticdensity;
                   var general1=objeto1.aggregationlevel;
                   var estructura1=objeto1.structure;
                   var contexto1=objeto1.context;
                   var titulo1=$objeto1.title;
                    //inicializa las reglas y las variables de los pesos
                    var r=0;
                    var pesor1=0;
                    var pesor2=0;
                    var pesor3=0;
                    var pesor4=0;
                    //verifica cuantas reglas se van a evaluar
                    
                    if (densidadsemantica1!="") {
                            r++;
                            switch (densidadsemantica1) {
                             case 'very low':
                                pesor1=1;
                                break;

                             case 'low':
                                pesor1=0.8;
                                break;

                             case 'medium':
                                pesor1=0.6;
                                break;

                             case 'high':
                                pesor1=0.4;
                                break;

                             case 'very high':
                                pesor1=0.2;
                                break;
                        }
                    }
                    if (general1!="") {
                            $r++;
                            switch (general1) {
                             case '1':
                                pesor2=1;
                                break;

                             case '2':
                                pesor2=0.75;
                                break;

                             case '3':
                                pesor2=0.5;
                                break;

                             case '4':
                                pesor2=0.25;
                                break;

                            
                        }
                    }
                    if (estructura1!="") {
                            r++;
                            switch (estructura1) {
                             case 'atomic':
                                pesor3=1;
                                break;

                             case 'collection':
                                pesor3=0.25;
                                break;

                             case 'networked':
                                pesor3=0.25;
                                break;

                             case 'hierarchical':
                                pesor3=0.25;
                                break;

                             case 'linear':
                                pesor3=0.25;
                                break;

                            
                        }
                    }

                    var can_contex=0;
                    for (i=0; i <can_contex ; i++) { 
                        if (contexto1[i]!="") {
                            can_contex++;
                        }
                    }
                    r++;
                    if (can_contex==1) {
                        pesor4=0.2;
                        }elseif(can_contex==2){
                             pesor4=0.6;
                             }elseif(can_contex>=3){
                                    pesor4=1;
                                }
                        
                    
                    var evaluacion="OA no reutilizable";
                    var m_reusabilidad=0;
                    //condiciona la evaluacion del objeto
                    if (r>0) {
                        // hace la sumatoria de los pesos 
                        m_reusabilidad=(pesor1/r)+(pesor2/r)+(pesor3/r)+(pesor4/r);

                        // valida que calidad de objeto es
                        if (m_reusabilidad<0.25) {
                            evaluacion="Regular";
                        }elseif (m_reusabilidad>=0.25 && m_reusabilidad<0.5) {
                                evaluacion="Buena";
                            }elseif (m_reusabilidad>=0.5 && m_reusabilidad<0.75) {
                                    evaluacion="Muy buena";
                                }elseif (m_reusabilidad>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                        echo "* Reusabilidad de: ".$m_reusabilidad."; ".$evaluacion."<br>";
                        



                    }else{
                        // en caso tal  que las reglas sean cero imprime esto
                        echo "* La métrica de reusabilidad no se puede aplicar no se cumple ninguna regla";
                    }

   }*/

  // funcion encargada de verificar si la ruta  si conduce a un objeto
            function disponibilidad(ruta){
                    var cantidad=ruta.length;
                    echo "* Cantidad rutas ".cantidad."<br>";
                    var campos=0;
                    for (var y=0; y <cantidad ; y++) { 
                        // invoca la funcion si url_exist para verificar existencia con un llamado al servidor
                        var existe= isURL( ruta[y] );
                        // si  es verdadero entrega  la existencia del objeto
                        if (existe) {
                            
                            campos++;
                            echo "      -El objeto almacenado en la ruta ".ruta[y].", si existe.<br> ";
                        }   else{// 
                                // si no existe el objeto
                                echo "      -El objeto almacenado en la ruta ".ruta[y].", no fue encontrado.<br>";
                                }

                        
                    }
                    var m_disponibilidad=campos/cantidad;
                        // valida que calidad de la completitud del objeto 
                        if (m_disponibilidad<0.25) {
                            evaluacion="Regular";
                        }elseif (m_disponibilidad>=0.25 && m_disponibilidad<0.5) {
                                evaluacion="Buena";
                            }elseif (m_disponibilidad>=0.5 && m_disponibilidad<0.75) {
                                    $evaluacion="Muy buena";
                                }elseif (m_disponibilidad>=0.75 ) {
                                        evaluacion="Exelente";
                                }
                        echo "      -Disponibilidad: ".evaluacion."<br>";
                    

                    }

            //verfica la existenca del objeto
            function isURL(url){
                var pattern='|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';
                if(preg_match(pattern, url) > 0) return true;
                else return false;
            }


            // verifica que tan completo es el oa en sus metadatos
             function completitud(oa){
                    var titulo=0; var keyword=0; var descripcion=0; var autor=0;
                    var tipoRE=0; var formato=0; var contexto=0; var idioma=0;
                    var tipointer=0; var rangoedad=0; var nivelagregacion=0;
                    var ubicacion=0; var costo=0; var estado=0; var copyright=0;

                    // verifica que la variable tenga  un valor y asigna el peso a las variables
                    if (trim(oa.title)!="") {
                        titulo=0.15;
                    }
                    if (trim(oa.keyword)!="") {
                        keyword=0.14;
                    }
                    if (trim(oa.description)!="") {
                        descripcion=0.12;
                    }
                    if (trim(oa.entity)!="") {
                        autor=0.11;
                    }
                    if (trim(oa.learningresourcetype)!="") {
                        tipoRE=0.09;
                    }
                    if (trim(oa.format)!="") {
                        formato=0.08;
                    }

                    
                    // hace la  comprobacion cuantos contextos existe  en el objeto
                    var context=oa.context;
                    // cuenta cuantas ubicaciones tiene el objeto
                    var can=context.length;
                    // asigna el nuevo peso que tendra cada contexto
                    var pesocontexto=0.06/can;
                    // comprueba  que los contextos sean diferentes a  vacio o a espacio 
                    for (var w=0; w <can ; w++) { 
                        if (trim(context[w])!="") {
                            // calcula el nuevo peso para entregar para el calculo de la metrica
                            contexto=contexto+pesocontexto;
                        }
                    }





                    if (trim(oa.language)!="") {
                        idioma=0.05;
                    }
                    if (trim(oa.interactivitytype)!="") {
                        tipointer=0.04;
                    }
                    if (trim(oa.typicalagerange)!="") {
                        rangoedad=0.03;
                    }
                    if (trim(oa.aggregationlevel)!="") {
                        nivelagregacion=0.03;
                    }
                    // hace la  comprobacion cuantas ubicaciones existe  en el objeto
                    var location=oa.location;
                    // cuenta cuantas ubicaciones tiene el objeto
                    var can=location.length;
                    // asigna el nuevo peso que tendra cada ubicacion
                    var peso=0.03/can;
                    // comprueba  que las ubicaciones sean diferentes a  vacio o a espacio 
                    for (var i=0; i <can ; i++) { 
                        if (trim(location[i])!="") {
                            // calcula el nuevo peso para entregar para el calculo de la metrica
                            ubicacion=ubicacion+peso;
                        }
                    }
                    

                    if (trim(oa.cost)!="") {
                        costo=0.03;
                    }
                    if (trim(oa.status)!="") {
                        estado=0.02;
                    }
                    if (trim(oa.copyrightandotherrestrictions)!="") {
                        copyright=0.02;
                    }

                    
                    
                        // hace la sumatoria de los pesos 
                        var m_completitud=titulo + keyword + descripcion + autor + tipoRE + formato + contexto + idioma +
                                       tipointer + rangoedad + nivelagregacion + ubicacion + costo + estado + copyright;

                        var evaluacion;
                        // valida que calidad de la completitud del objeto 
                        if (m_completitud<0.25) {
                            evaluacion="Regular";
                        }elseif (m_completitud>=0.25 && m_completitud<0.5) {
                                evaluacion="Buena";
                            }elseif (m_completitud>=0.5 && m_completitud<0.75) {
                                    evaluacion="Muy buena";
                                }elseif (m_completitud>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                        echo "* Completitud de: ".m_completitud."; ".evaluacion."<br>";
                    }


function consistencia(oa){
                var nivelagregacion=0; var estructura=0; var rol=0; var estado=0; var metarol=0; var tipointer=0;
                var tiporecursoeducativo=0; var nivelinter=0; var densidadsemantica=0; var rolusuariofinal=0;
                var contexto=0; var dificultad=0; var copyright=0; var costo=0; var proposito=0; var r=14;

                if (trim(oa.aggregationlevel)==1 || trim(oa.aggregationlevel)==2 || trim(oa.aggregationlevel)==3 ||trim(oa.aggregationlevel)==4  ) {
                        nivelagregacion=1;
                }
                if (trim(oa.structure)=="atomic" || trim(oa.structure)=="collection" || trim(oa.structure)=="networked" ||trim(oa.structure)=="hierarchical" || trim(oa.structure)=="linear" ) {
                        $estructura=1;
                }
                if (trim(oa.role)=="author" ||
                    trim(oa.role)=="publisher" || 
                    trim(oa.role)=="unknown" ||
                    trim(oa.role)=="initiator" || 
                    trim(oa.role)=="terminator" || 
                    trim(oa.role)=="validator" || 
                    trim(oa.role)=="editor" || 
                    trim(oa.role)=="graphical designer" || 
                    trim(oa.role)=="technical implementer" || 
                    trim(oa.role)=="content provider" || 
                    trim(oa.role)=="technical validator" || 
                    trim(oa.role)=="educational validator" || 
                    trim(oa.role)=="script writer" || 
                    trim(oa.role)=="instructional designer" || 
                    trim(oa.role)=="subject matter expert" ) {
                        rol=1;
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