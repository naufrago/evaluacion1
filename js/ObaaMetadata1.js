/**
 * Created by magir on 2/04/2016.
 */


function OBAAMetadata(){
    var aggregationlevel;
    var structure;
    var title;
    var keyword;
    var description;
    var language;
    var semanticdensity;
    var context=[];
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
    var identifier;
 
}

function processXml(xml) {
             //alert("REALIZANDO EVALUACION");
            var obaa = new OBAAMetadata();
            obaa.identifier= $(xml).find("identifier").text();
            obaa.aggregationlevel = $(xml).find("obaa\\:aggregationlevel").text();
            obaa.structure = $(xml).find("obaa\\:structure").text();
            obaa.title = $(xml).find("obaa\\:title").text();
            //alert("Objeto evaluado "+obaa.title);
            obaa.keyword = $(xml).find("obaa\\:keyword").first().text();
            obaa.description = $(xml).find("obaa\\:description").first().text();
            obaa.language = $(xml).find("obaa\\:language").first().text();
            obaa.semanticdensity = $(xml).find("obaa\\:semanticdensity").text();

            var arrayContext = [];

            $(xml).find("obaa\\:context").each(function(){
                console.log($(this).text());
                arrayContext.push($(this).text());
            });

            obaa.context = arrayContext.slice(0);


            obaa.learningresourcetype = $(xml).find("obaa\\:learningresourcetype").text();
            obaa.interactivitytype = $(xml).find("obaa\\:interactivitytype").text();
            obaa.typicalagerange = $(xml).find("obaa\\:typicalagerange").text();
            obaa.interactivityLevel = $(xml).find("obaa\\:interactivitylevel").text();
            obaa.intendedenduserrole = $(xml).find("obaa\\:intendedenduserrole").text();
            obaa.difficulty = $(xml).find("obaa\\:difficulty").text();

            
           var arrayLocation = [];

            $(xml).find("obaa\\:location").each(function(){
                console.log($(this).text());
                arrayLocation.push($(this).text());
            });
            obaa.location = arrayLocation.slice(0);

            obaa.format = $(xml).find("obaa\\:format").text();
            obaa.entity = $(xml).find("obaa\\:entity").text();
            obaa.rolelifecycle = $(xml).find("obaa\\:role").first().text();
            obaa.status = $(xml).find("obaa\\:status").text();
            obaa.cost = $(xml).find("obaa\\:cost").text();
            obaa.copyrightandotherrestrictions = $(xml).find("obaa\\:varcopyrightandotherrestrictions").text();
            obaa.role = $(xml).find("obaa\\:metametadata").find("obaa\\:role").text();
            obaa.purpose = $(xml).find("obaa\\:purpose").text();




            return obaa;
        }


function reusabilidadobaa(objeto1){
                   

                    // extrae las variables nesesarias para la evaluacion
                   var densidadsemantica1=objeto1.semanticdensity;
                   var general1=objeto1.aggregationlevel;
                   var estructura1=objeto1.structure;
                   var contexto1=objeto1.context;
                   var titulo1=objeto1.title;
                    //inicializa las reglas y las variables de los pesos
                    var r=0;
                    var pesor1=0;
                    var pesor2=0;
                    var pesor3=0;
                    var pesor4=0;

                    var mensaje="* La métrica de reusabilidad no se puede aplicar no se cumple ninguna regla";
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
                            r++;
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
                    for (i=0; i <contexto1.length; i++) { 
                        if (contexto1[i]!="") {
                            can_contex++;
                        }
                    }
                    
                    r++;
                    if (can_contex===1) {
                        pesor4=0.2;
                        }else if(can_contex===2){
                             pesor4=0.6;
                             }else if(can_contex>=3){
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
                        }else if (m_reusabilidad>=0.25 && m_reusabilidad<0.5) {
                                evaluacion="Buena";
                            }else if (m_reusabilidad>=0.5 && m_reusabilidad<0.75) {
                                    evaluacion="Muy buena";
                                }else if (m_reusabilidad>=0.75 ) {
                                        evaluacion="Exelente";
                                        

                                }

                                // imprime  la evaluacion de la metrica
                        mensaje="* Reusabilidad de: "+ m_reusabilidad +"; "+evaluacion;
                        //alert(mensaje);
                        return mensaje;
                  
                    }else{
                        // en caso tal  que las reglas sean cero imprime esto
                        return mensaje;
                    }

}

  // funcion encargada de verificar si la ruta  si conduce a un objeto
function disponibilidadobaa(ruta){
                    var cantidad=ruta.length;

                    
                    var campos=0;
                    for (var y=0; y <cantidad ; y++) { 
                        // invoca la funcion si url_exist para verificar existencia con un llamado al servidor
                        var existe= isURL( ruta[y] );
                        
                        // si  es verdadero entrega  la existencia del objeto
                        if (existe) {
                            
                            campos++;
                            //echo "      -El objeto almacenado en la ruta ".ruta[y].", si existe.<br> ";
                        }   else{// 
                                // si no existe el objeto
                                //echo "      -El objeto almacenado en la ruta ".ruta[y].", no fue encontrado.<br>";
                                }

                        
                    }
                    var m_disponibilidad=campos/cantidad;
                        // valida que calidad de la completitud del objeto 
                        if (m_disponibilidad<0.25) {
                            evaluacion="Regular";
                        }else if (m_disponibilidad>=0.25 && m_disponibilidad<0.5) {
                                evaluacion="Buena";
                            }else if (m_disponibilidad>=0.5 && m_disponibilidad<0.75) {
                                    $evaluacion="Muy buena";
                                }else if (m_disponibilidad>=0.75 ) {
                                        evaluacion="Exelente";
                                }
                        //echo "      -Disponibilidad: ".evaluacion."<br>";
                        alert("-Disponibilidad: "+evaluacion);

                    }

            //verfica la existenca del objeto
    function isURL(url){

        var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
        return regexp.test(url);
                /*var pattern='|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';
                if(preg_match(pattern, url) > 0) return true;
                else return false;*/
            }


            // verifica que tan completo es el oa en sus metadatos
            // 
            
function completitudobaa(oa){
                    var titulo=0; var keyword=0; var descripcion=0; var autor=0;
                    var tipoRE=0; var formato=0; var contexto=0; var idioma=0;
                    var tipointer=0; var rangoedad=0; var nivelagregacion=0;
                    var ubicacion=0; var costo=0; var estado=0; var copyright=0;

                    // verifica que la variable tenga  un valor y asigna el peso a las variables
                    if (oa.title.trim()!="") {
                        titulo=0.15;
                    }
                    if (oa.keyword.trim()!="") {
                        keyword=0.14;
                    }
                    if (oa.description.trim()!="") {
                        descripcion=0.12;
                    }
                    if (oa.entity.trim()!="") {
                        autor=0.11;
                    }
                    if (oa.learningresourcetype.trim()!="") {
                        tipoRE=0.09;
                    }
                    if (oa.format.trim()!="") {
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
                        if (context[w].trim()!="") {
                            // calcula el nuevo peso para entregar para el calculo de la metrica
                            contexto=contexto+pesocontexto;
                        }
                    }





                    if (oa.language.trim()!="") {
                        idioma=0.05;
                    }
                    if (oa.interactivitytype.trim()!="") {
                        tipointer=0.04;
                    }
                    if (oa.typicalagerange.trim()!="") {
                        rangoedad=0.03;
                    }
                    if (oa.aggregationlevel.trim()!="") {
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
                        if (location[i].trim()!="") {
                            // calcula el nuevo peso para entregar para el calculo de la metrica
                            ubicacion=ubicacion+peso;
                        }
                    }
                    

                    if (oa.cost.trim()!="") {
                        costo=0.03;
                    }
                    if (oa.status.trim()!="") {
                        estado=0.02;
                    }
                    if (oa.copyrightandotherrestrictions.trim()!="") {
                        copyright=0.02;
                    }

                    
                    
                        // hace la sumatoria de los pesos 
                        var m_completitud=titulo + keyword + descripcion + autor + tipoRE + formato + contexto + idioma +
                                       tipointer + rangoedad + nivelagregacion + ubicacion + costo + estado + copyright;

                        var evaluacion;
                        // valida que calidad de la completitud del objeto 
                        if (m_completitud<0.25) {
                            evaluacion="Regular";
                        }else if (m_completitud>=0.25 && m_completitud<0.5) {
                                evaluacion="Buena";
                            }else if (m_completitud>=0.5 && m_completitud<0.75) {
                                    evaluacion="Muy buena";
                                }else if (m_completitud>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                         mensaje="* Completitud de: "+m_completitud+ "; "+evaluacion;
                        //alert(mensaje);
                        return mensaje;
                        //echo "* Completitud de: ".m_completitud."; ".evaluacion."<br>";
                    }


function consistenciaobaa(oa){
                var nivelagregacion=0; var estructura=0; var rol=0; var estado=0; var metarol=0; var tipointer=0;
                var tiporecursoeducativo=0; var nivelinter=0; var densidadsemantica=0; var rolusuariofinal=0;
                var contexto=0; var dificultad=0; var copyright=0; var costo=0; var proposito=0; var r=14;

                if (oa.aggregationlevel.trim()==="1" || 
                    oa.aggregationlevel.trim()==="2" || 
                    oa.aggregationlevel.trim()==="3" ||
                    oa.aggregationlevel.trim()==="4"  ) {
                        nivelagregacion=1;
                    
                }

                if (oa.structure.trim()==="atomic" || 
                    oa.structure.trim()==="collection" || 
                    oa.structure.trim()==="networked" ||
                    oa.structure.trim()==="hierarchical" || 
                    oa.structure.trim()==="linear" ) {
                        estructura=1;
                }
                if (oa.rolelifecycle.trim()==="author" ||
                    oa.rolelifecycle.trim()==="publisher" || 
                    oa.rolelifecycle.trim()==="unknown" ||
                    oa.rolelifecycle.trim()==="initiator" || 
                    oa.rolelifecycle.trim()==="terminator" || 
                    oa.rolelifecycle.trim()==="validator" || 
                    oa.rolelifecycle.trim()==="editor" || 
                    oa.rolelifecycle.trim()==="graphical designer" || 
                    oa.rolelifecycle.trim()==="technical implementer" || 
                    oa.rolelifecycle.trim()==="content provider" || 
                    oa.rolelifecycle.trim()==="technical validator" || 
                    oa.rolelifecycle.trim()==="educational validator" || 
                    oa.rolelifecycle.trim()==="script writer" || 
                    oa.rolelifecycle.trim()==="instructional designer" || 
                    oa.rolelifecycle.trim()==="subject matter expert" ) {
                        rol=1;
                }
                if (oa.status.trim()==="draft" || 
                    oa.status.trim()==="final" || 
                    oa.status.trim()==="revised" ||
                    oa.status.trim()==="unavailable" ) {
                        estado=1;
                }
                if (oa.role.trim()==="creator" || 
                    oa.role.trim()==="validator"  ) {
                        metarol=1;
                }
                if (oa.interactivitytype.trim()==="active" || 
                    oa.interactivitytype.trim()==="expositive" || 
                    oa.interactivitytype.trim()==="mixed" ) {
                        tipointer=1;
                }
                if (oa.learningresourcetype.trim()==="exercise" ||
                    oa.learningresourcetype.trim()==="simulation" || 
                    oa.learningresourcetype.trim()==="questionnaire" ||
                    oa.learningresourcetype.trim()==="diagram" || 
                    oa.learningresourcetype.trim()==="figure" || 
                    oa.learningresourcetype.trim()==="graph" || 
                    oa.learningresourcetype.trim()==="index" || 
                    oa.learningresourcetype.trim()==="slide" || 
                    oa.learningresourcetype.trim()==="table" || 
                    oa.learningresourcetype.trim()==="narrative text" || 
                    oa.learningresourcetype.trim()==="exam" || 
                    oa.learningresourcetype.trim()==="experiment" || 
                    oa.learningresourcetype.trim()==="problem" || 
                    oa.learningresourcetype.trim()==="statement" || 
                    oa.learningresourcetype.trim()==="self assessment" || 
                    oa.learningresourcetype.trim()==="lecture" ) {
                        tiporecursoeducativo=1;

                }
                
                
                if (oa.interactivityLevel.trim()==="very low" ||
                    oa.interactivityLevel.trim()==="low" || 
                    oa.interactivityLevel.trim()==="medium" || 
                    oa.interactivityLevel.trim()==="high" || 
                    oa.interactivityLevel.trim()==="very high" ) {
                        nivelinter=1;
                }
                
                if (oa.semanticdensity.trim()==="very low" || 
                    oa.semanticdensity.trim()==="low" || 
                    oa.semanticdensity.trim()==="medium" || 
                    oa.semanticdensity.trim()==="high" || 
                    oa.semanticdensity.trim()==="very high" ) {
                        densidadsemantica=1;
                }
                if (oa.intendedenduserrole.trim()==="teacher" || 
                    oa.intendedenduserrole.trim()==="author" || 
                    oa.intendedenduserrole.trim()==="learner" || 
                    oa.intendedenduserrole.trim()==="manager" ) {
                        rolusuariofinal=1;
                }

                // analisa cada uno de los contextos existentes en el objeto 
                // verifica que sea consistente  de lo contrario entrega 0
                var context=oa.context;
                var cantidad=context.length;
                var cumple=true;
                var s=0;
                while ( cumple && s<cantidad) {
                    if (context[s].trim()==="school" || 
                        context[s].trim()==="higher education" || 
                        context[s].trim()==="training" || 
                        context[s].trim()==="other" ) {
                        cumple=false;
                        contexto=1;
                    }else{
                        s++;
                    }
                }
                
                if (oa.difficulty.trim()==="very easy" || 
                    oa.difficulty.trim()==="easy" || 
                    oa.difficulty.trim()==="medium" || 
                    oa.difficulty.trim()==="difficult" || 
                    oa.difficulty.trim()==="very difficult" ) {
                        dificultad=1;
                }
                if (oa.copyrightandotherrestrictions.trim()==="yes" || 
                    oa.copyrightandotherrestrictions.trim()==="no"  ) {
                        copyright=1;
                }
                if (oa.cost.trim()==="yes" || 
                    oa.cost.trim()==="no"  ) {
                        costo=1;
                }
               /* if (oa.purpose.trim()==="discipline" ||
                    oa.purpose.trim()==="idea" || 
                    oa.purpose.trim()==="prerequisite" ||
                    oa.purpose.trim()==="educational objective" || 
                    oa.purpose.trim()==="accessibility" || 
                    oa.purpose.trim()==="restrictions" || 
                    oa.purpose.trim()==="educational level" || 
                    oa.purpose.trim()==="skill level" || 
                    oa.purpose.trim()==="security level" || 
                    oa.purpose.trim()==="competency"  ) {
                        proposito=1;
                }*/
                var m_consistencia=(nivelagregacion + estructura + rol + estado + metarol + tipointer +
                                tiporecursoeducativo + nivelinter + densidadsemantica + rolusuariofinal + 
                                contexto + dificultad + copyright + costo + proposito) /  r;
                var evaluacion="";
                // valida que calidad de la completitud del objeto 
                        if (m_consistencia<0.25) {
                            evaluacion="Regular";
                        }else if (m_consistencia>=0.25 && m_consistencia<0.5) {
                                evaluacion="Buena";
                            }else if (m_consistencia>=0.5 && m_consistencia<0.75) {
                                    evaluacion="Muy buena";
                                }else if (m_consistencia>=0.75 ) {
                                        evaluacion="Exelente";
                                }

                                // imprime  la evaluacion de la metrica
                         mensaje="* Consistencia de: "+m_consistencia+"; "+evaluacion;
                        //alert(mensaje);
                        return mensaje;
                       // echo "* Consistencia de: ".m_consistencia."; ".evaluacion."<br>";
            }

            // verifica que tan coherente son los metadatos del oa
function coherenciaobaa(objeto){
                // extrae las variables nesesarias para la evaluacion
                var estructura= objeto.structure;
                var nivelagregacion=objeto.aggregationlevel;
                var tipointeractividad=objeto.interactivitytype; 
                var nivelinteractivo=objeto.interactivitylevel;
                var tiporecursoeducativo=objeto.learningresourcetype;
                
                //inicializa las reglas y las variables de los pesos
                var r=0;
                var pesor1=0;
                var pesor2=0;
                var pesor3=0;

                //verifica las reglas que se van a evaluar
                if (estructura.trim()==="atomic" && nivelagregacion.trim()==="1"){
                    r++;
                    pesor1=1;
                }else if (estructura.trim()==="atomic" && nivelagregacion.trim()==="2"){
                        r++;
                        pesor1=0.5;
                    }else if (estructura.trim()==="atomic" && nivelagregacion.trim()==="3"){
                            r++;
                            pesor1=0.25;
                        }else if (estructura.trim()==="atomic" && nivelagregacion.trim()==="4"){
                                r++;
                                pesor1=0.125;
                            }else if (estructura.trim()==="collection" && nivelagregacion.trim()==="1"){
                                    r++;
                                    pesor1=0.5;
                                }else if (estructura.trim()==="networked" && nivelagregacion.trim()==="1"){
                                        r++;
                                        pesor1=0.5;    
                                    }else if (estructura.trim()==="hierarchical" && nivelagregacion.trim()==="1"){
                                            r++;
                                            pesor1=0.5;    
                                        }else if (estructura.trim()==="linear" && nivelagregacion.trim()==="1"){
                                                r++;
                                                pesor1=0.5;    
                                            }else if (estructura.trim()==="collection" && (nivelagregacion.trim()==="2" || 
                                                                                        nivelagregacion.trim()==="3" || 
                                                                                        nivelagregacion.trim()==="4") ){
                                                    r++;
                                                    pesor1=1;  
                                                }else if (estructura.trim()==="networked" && (nivelagregacion.trim()==="2" || 
                                                                                           nivelagregacion.trim()==="3" || 
                                                                                           nivelagregacion.trim()==="4") ){
                                                        r++;
                                                        pesor1=1;  
                                                    }else if (estructura.trim()==="hierarchical" && (nivelagregacion.trim()==="2" || 
                                                                                                  nivelagregacion.trim()==="3" || 
                                                                                                  nivelagregacion.trim()==="4") ){
                                                            r++;
                                                            pesor1=1;  
                                                        }else if (estructura.trim()==="linear" && (nivelagregacion.trim()==="2" || 
                                                                                                nivelagregacion.trim()==="3" || 
                                                                                                nivelagregacion.trim() ==="4") ){
                                                                r++;
                                                                pesor1=1;  
                                                        }

                if (tipointeractividad.trim()==="active" && (nivelinteractivo.trim()==="very high" || 
                                                            nivelinteractivo.trim()==="high" || 
                                                            nivelinteractivo.trim()==="medium" || 
                                                            nivelinteractivo.trim()==="low" ||
                                                            nivelinteractivo.trim()==="very low") ){
                        $r++;
                        $pesor2=1;  
                }else if (tipointeractividad.trim()==="mixed" && (nivelinteractivo.trim()==="very high" || 
                                                            nivelinteractivo.trim()==="high" || 
                                                            nivelinteractivo.trim()==="medium" || 
                                                            nivelinteractivo.trim()==="low" ||
                                                            nivelinteractivo.trim()==="very low") ){
                        r++;
                        pesor2=1;
                    }else if (tipointeractividad.trim()==="expositive" && (nivelinteractivo==="very high" || 
                                                            nivelinteractivo==="high") ){
                             r++;
                             pesor2=0;
                        }else if (tipointeractividad.trim()==="expositive" &&  nivelinteractivo==="medium"  ){
                                 r++;
                                 pesor2=0.5;
                            }else if (tipointeractividad.trim()==="expositive" && (nivelinteractivo==="low" ||
                                                            nivelinteractivo==="very low") ){
                                     r++;
                                     pesor2=1;
                            } 

                if ( tipointeractividad.trim()==="active" && (tiporecursoeducativo.trim()==="exercise" || 
                                                            tiporecursoeducativo.trim()==="simulation" || 
                                                            tiporecursoeducativo.trim()==="questionnaire" || 
                                                            tiporecursoeducativo.trim()==="exam" ||
                                                            tiporecursoeducativo.trim()==="experiment" ||
                                                            tiporecursoeducativo.trim()==="problem statement" ||
                                                            tiporecursoeducativo.trim()==="self assessment") ){
                         r++;
                         pesor3=1;  
                }else if (tiporecursoeducativo.trim()==="active" && (tiporecursoeducativo.trim()==="diagram" || 
                                                                 tiporecursoeducativo.trim()==="figure" || 
                                                                 tiporecursoeducativo.trim()==="graph" || 
                                                                 tiporecursoeducativo.trim()==="index" ||
                                                                 tiporecursoeducativo.trim()==="slide" ||
                                                                 tiporecursoeducativo.trim()==="table" ||
                                                                 tiporecursoeducativo.trim()==="narrative text" ||
                                                                 tiporecursoeducativo.trim()==="lecture") ){
                         r++;
                         pesor3=0;
                    
                    }else if (tipointeractividad.trim()==="expositive" && (tiporecursoeducativo.trim()==="exercise" || 
                                                                         tiporecursoeducativo.trim()==="simulation" || 
                                                                         tiporecursoeducativo.trim()==="questionnaire" || 
                                                                         tiporecursoeducativo.trim()==="exam" ||
                                                                         tiporecursoeducativo.trim()==="experiment" ||
                                                                         tiporecursoeducativo.trim()==="problem statement" ||
                                                                         tiporecursoeducativo.trim()==="self assessment") ){
                             r++;
                             pesor3=0;  
                        }else if (tipointeractividad.trim()==="expositive" && (tiporecursoeducativo.trim()==="diagram" || 
                                                                             tiporecursoeducativo.trim()==="figure" || 
                                                                             tiporecursoeducativo.trim()==="graph" || 
                                                                             tiporecursoeducativo.trim()==="index" ||
                                                                             tiporecursoeducativo.trim()==="slide" ||
                                                                             tiporecursoeducativo.trim()==="table" ||
                                                                             tiporecursoeducativo.trim()==="narrative text" ||
                                                                             tiporecursoeducativo.trim()==="lecture") ){
                                 r++;
                                 pesor3=1;
                            }else if (tipointeractividad.trim()==="mixed" && (tiporecursoeducativo.trim()==="exercise" || 
                                                                         tiporecursoeducativo.trim()==="simulation" || 
                                                                         tiporecursoeducativo.trim()==="questionnaire" || 
                                                                         tiporecursoeducativo.trim()==="exam" ||
                                                                         tiporecursoeducativo.trim()==="experiment" ||
                                                                         tiporecursoeducativo.trim()==="problem statement" ||
                                                                         tiporecursoeducativo.trim()==="self assessment" ||
                                                                         tiporecursoeducativo.trim()==="diagram" ||
                                                                         tiporecursoeducativo.trim()==="figure" ||
                                                                         tiporecursoeducativo.trim()==="graph" ||
                                                                         tiporecursoeducativo.trim()==="index" ||
                                                                         tiporecursoeducativo.trim()==="slide" ||
                                                                         tiporecursoeducativo.trim()==="table" ||
                                                                         tiporecursoeducativo.trim()==="narrative text" ||
                                                                         tiporecursoeducativo.trim()==="lecture" )){
                                     r++;
                                     pesor3=1;  
                            }   

                if (r>0) {
                // hace la sumatoria de los pesos 
                         m_coherencia= ( pesor1 +  pesor2 +  pesor3) /  r;
                         
                         var evaluacion="";
                    // valida que calidad de objeto es
                        if ( m_coherencia<0.25) {
                             evaluacion="Regular";
                        }else if ( m_coherencia>=0.25 &&  m_coherencia<0.5) {
                                 evaluacion="Buena";
                            }else if ( m_coherencia>=0.5 &&  m_coherencia<0.75) {
                                     evaluacion="Muy buena";
                                }else if ( m_coherencia>=0.75 ) {
                                         evaluacion="Exelente";
                                }

                        // imprime  la evaluacion de la metrica
                       mensaje="* Coherencia de: "+ m_coherencia+"; "+ evaluacion;
                        //alert(mensaje);
                        return mensaje;
                            //echo "* Coherencia de: ". m_coherencia."; ". evaluacion."<br><br>";
                }else{
                     mensaje="* Metrica de coherencia  N/A";
                        //alert(mensaje);
                        return mensaje;
                }

            }