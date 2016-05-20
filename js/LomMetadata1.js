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
    var calificacion;
 
}

function processXml(xml) {
            // alert("REALIZANDO EVALUACION");
            var lom = new LOMMetadata();
            lom.identifier= $(xml).find("identifier").text();
            lom.aggregationlevel = $(xml).find("lom\\:aggregationlevel").text();
            lom.structure = $(xml).find("lom\\:structure").text();
            lom.title = $(xml).find("lom\\:title").text();
            //alert("Objeto evaluado "+lom.title);
            lom.keyword = $(xml).find("lom\\:keyword").first().text();
            lom.description = $(xml).find("lom\\:description").first().text();
            lom.language = $(xml).find("lom\\:language").first().text();
            lom.semanticdensity = $(xml).find("lom\\:semanticdensity").text();

            var arrayContext = [];

            $(xml).find("lom\\:context").each(function(){
                console.log($(this).text());
                arrayContext.push($(this).text());
            });

            lom.context = arrayContext.slice(0);


            lom.learningresourcetype = $(xml).find("lom\\:learningresourcetype").text();
            lom.interactivitytype = $(xml).find("lom\\:interactivitytype").text();
            lom.typicalagerange = $(xml).find("lom\\:typicalagerange").text();
            lom.interactivityLevel = $(xml).find("lom\\:interactivitylevel").text();
            lom.intendedenduserrole = $(xml).find("lom\\:intendedenduserrole").text();
            lom.difficulty = $(xml).find("lom\\:difficulty").text();

            
           var arrayLocation = [];

            $(xml).find("lom\\:location").each(function(){
                console.log($(this).text());
                arrayLocation.push($(this).text());
            });
            lom.location = arrayLocation.slice(0);

            lom.format = $(xml).find("lom\\:format").text();
            lom.entity = $(xml).find("lom\\:entity").text();
            lom.rolelifecycle = $(xml).find("lom\\:role").first().text();
            lom.status = $(xml).find("lom\\:status").text();
            lom.cost = $(xml).find("lom\\:cost").text();
            lom.copyrightandotherrestrictions = $(xml).find("lom\\:varcopyrightandotherrestrictions").text();
            lom.role = $(xml).find("lom\\:metametadata").find("lom\\:role").text();
            lom.purpose = $(xml).find("lom\\:purpose").text();
            lom.calificacion=0;



            return lom;
        }


function reusabilidad(objeto1){
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

                    
                    var m_reusabilidad=0;
                    //alert(r);
                    //condiciona la evaluacion del objeto
                    
                    if (r>0) {
                    // hace la sumatoria de los pesos 
                        m_reusabilidad=(pesor1/r)+(pesor2/r)+(pesor3/r)+(pesor4/r);

                        
                        //alert(mensaje);
                        return m_reusabilidad;
                    }else {
                        return m_reusabilidad;
                    }

}

 // funcion encargada de verificar si la ruta  si conduce a un objeto
function disponibilidad(ruta){
                    var cantidad=ruta.length;

                    
                    var campos=0;
                    for (var y=0; y <cantidad ; y++) { 
                        // invoca la funcion si url_exist para verificar existencia con un llamado al servidor
                        var existe= isURL( ruta[y] );
                        // alert("existe ruta "+ existe);
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
            

function completitud(oa, es){
                    var titulo=0; var keyword=0; var descripcion=0; var autor=0;
                    var tipoRE=0; var formato=0; var contexto=0; var idioma=0;
                    var tipointer=0; var rangoedad=0; var nivelagregacion=0;
                    var ubicacion=0; var costo=0; var estado=0; var copyright=0;

                    // verifica que la variable tenga  un valor y asigna el peso a las variables
                    if (oa.title!="") {
                        titulo=0.15;
                    }
                    if (oa.keyword!="") {
                        keyword=0.14;
                    }
                    if (oa.description!="") {
                        descripcion=0.12;
                    }
                    if (oa.entity!="") {
                        autor=0.11;
                    }
                    if (oa.learningresourcetype!="") {
                        tipoRE=0.09;
                    }
                    if (oa.format!="") {
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
                        if (context[w]!="") {
                            // calcula el nuevo peso para entregar para el calculo de la metrica
                            contexto=contexto+pesocontexto;
                        }
                    }





                    if (oa.language!="") {
                        idioma=0.05;
                    }
                    if (oa.interactivitytype!="") {
                        tipointer=0.04;
                    }
                    if (oa.typicalagerange!="") {
                        rangoedad=0.03;
                    }
                    if (oa.aggregationlevel!="") {
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
                        if (location[i]!="") {
                            // calcula el nuevo peso para entregar para el calculo de la metrica
                            ubicacion=ubicacion+peso;
                        }
                    }
                    

                    if (oa.cost!="") {
                        costo=0.03;
                    }
                    if (oa.status!="") {
                        estado=0.02;
                    }
                    if (oa.copyrightandotherrestrictions!="") {
                        copyright=0.02;
                    }

                    
                    
                        // hace la sumatoria de los pesos 
                        var m_completitud=titulo + keyword + descripcion + autor + tipoRE + formato + contexto + idioma +
                                       tipointer + rangoedad + nivelagregacion + ubicacion + costo + estado + copyright;

                        
                        //alert(mensaje);
                        return m_completitud;
                        
                        //echo "* Completitud de: ".m_completitud."; ".evaluacion."<br>";
                    }

function consistencia(oa){
                var nivelagregacion=0; var estructura=0; var rol=0; var estado=0; var metarol=0; var tipointer=0;
                var tiporecursoeducativo=0; var nivelinter=0; var densidadsemantica=0; var rolusuariofinal=0;
                var contexto=0; var dificultad=0; var copyright=0; var costo=0; var proposito=0; var r=15;

                if (oa.aggregationlevel==="1" || 
                    oa.aggregationlevel==="2" || 
                    oa.aggregationlevel==="3" ||
                    oa.aggregationlevel==="4"  ) {
                        nivelagregacion=1;
                    
                }

                if (oa.structure==="atomic" || 
                    oa.structure==="collection" || 
                    oa.structure==="networked" ||
                    oa.structure==="hierarchical" || 
                    oa.structure==="linear" ) {
                        estructura=1;
                }
                if (oa.rolelifecycle==="author" ||
                    oa.rolelifecycle==="publisher" || 
                    oa.rolelifecycle==="unknown" ||
                    oa.rolelifecycle==="initiator" || 
                    oa.rolelifecycle==="terminator" || 
                    oa.rolelifecycle==="validator" || 
                    oa.rolelifecycle==="editor" || 
                    oa.rolelifecycle==="graphical designer" || 
                    oa.rolelifecycle==="technical implementer" || 
                    oa.rolelifecycle==="content provider" || 
                    oa.rolelifecycle==="technical validator" || 
                    oa.rolelifecycle==="educational validator" || 
                    oa.rolelifecycle==="script writer" || 
                    oa.rolelifecycle==="instructional designer" || 
                    oa.rolelifecycle==="subject matter expert" ) {
                        rol=1;
                }
                if (oa.status==="draft" || 
                    oa.status==="final" || 
                    oa.status==="revised" ||
                    oa.status==="unavailable" ) {
                        estado=1;
                }
                if (oa.role==="creator" || 
                    oa.role==="validator"  ) {
                        metarol=1;
                }
                if (oa.interactivitytype==="active" || 
                    oa.interactivitytype==="expositive" || 
                    oa.interactivitytype==="mixed" ) {
                        tipointer=1;
                }
                if (oa.learningresourcetype==="exercise" ||
                    oa.learningresourcetype==="simulation" || 
                    oa.learningresourcetype==="questionnaire" ||
                    oa.learningresourcetype==="diagram" || 
                    oa.learningresourcetype==="figure" || 
                    oa.learningresourcetype==="graph" || 
                    oa.learningresourcetype==="index" || 
                    oa.learningresourcetype==="slide" || 
                    oa.learningresourcetype==="table" || 
                    oa.learningresourcetype==="narrative text" || 
                    oa.learningresourcetype==="exam" || 
                    oa.learningresourcetype==="experiment" || 
                    oa.learningresourcetype==="problem" || 
                    oa.learningresourcetype==="statement" || 
                    oa.learningresourcetype==="self assessment" || 
                    oa.learningresourcetype==="lecture" ) {
                        tiporecursoeducativo=1;

                }
                
                
                if (oa.interactivityLevel==="very low" ||
                    oa.interactivityLevel==="low" || 
                    oa.interactivityLevel==="medium" || 
                    oa.interactivityLevel==="high" || 
                    oa.interactivityLevel==="very high" ) {
                        nivelinter=1;
                }
                
                if (oa.semanticdensity==="very low" || 
                    oa.semanticdensity==="low" || 
                    oa.semanticdensity==="medium" || 
                    oa.semanticdensity==="high" || 
                    oa.semanticdensity==="very high" ) {
                        densidadsemantica=1;
                }
                if (oa.intendedenduserrole==="teacher" || 
                    oa.intendedenduserrole==="author" || 
                    oa.intendedenduserrole==="learner" || 
                    oa.intendedenduserrole==="manager" ) {
                        rolusuariofinal=1;
                }

                // analisa cada uno de los contextos existentes en el objeto 
                // verifica que sea consistente  de lo contrario entrega 0
                var context=oa.context;
                var cantidad=context.length;
                var cumple=true;
                var s=0;
                while ( cumple && s<cantidad) {
                    if (context[s]==="school" || 
                        context[s]==="higher education" || 
                        context[s]==="training" || 
                        context[s]==="other" ) {
                        cumple=false;
                        contexto=1;
                    }else{
                        s++;
                    }
                }
                
                if (oa.difficulty==="very easy" || 
                    oa.difficulty==="easy" || 
                    oa.difficulty==="medium" || 
                    oa.difficulty==="difficult" || 
                    oa.difficulty==="very difficult" ) {
                        dificultad=1;
                }
                if (oa.copyrightandotherrestrictions==="yes" || 
                    oa.copyrightandotherrestrictions==="no"  ) {
                        copyright=1;
                }
                if (oa.cost==="yes" || 
                    oa.cost==="no"  ) {
                        costo=1;
                }
                if (oa.purpose==="discipline" ||
                    oa.purpose==="idea" || 
                    oa.purpose==="prerequisite" ||
                    oa.purpose==="educational objective" || 
                    oa.purpose==="accessibility" || 
                    oa.purpose==="restrictions" || 
                    oa.purpose==="educational level" || 
                    oa.purpose==="skill level" || 
                    oa.purpose==="security level" || 
                    oa.purpose==="competency"  ) {
                        proposito=1;
                }
                var m_consistencia=(nivelagregacion + estructura + rol + estado + metarol + tipointer +
                                tiporecursoeducativo + nivelinter + densidadsemantica + rolusuariofinal + 
                                contexto + dificultad + copyright + costo + proposito) /  r;
                
                
                        //alert(mensaje);
                        return m_consistencia;
                       // echo "* Consistencia de: ".m_consistencia."; ".evaluacion."<br>";
            }

            // verifica que tan coherente son los metadatos del oa
function coherencia(objeto){
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
                if (estructura==="atomic" && nivelagregacion==="1"){
                    r++;
                    pesor1=1;
                }else if (estructura==="atomic" && nivelagregacion==="2"){
                        r++;
                        pesor1=0.5;
                    }else if (estructura==="atomic" && nivelagregacion==="3"){
                            r++;
                            pesor1=0.25;
                        }else if (estructura==="atomic" && nivelagregacion==="4"){
                                r++;
                                pesor1=0.125;
                            }else if (estructura==="collection" && nivelagregacion==="1"){
                                    r++;
                                    pesor1=0.5;
                                }else if (estructura==="networked" && nivelagregacion==="1"){
                                        r++;
                                        pesor1=0.5;    
                                    }else if (estructura==="hierarchical" && nivelagregacion==="1"){
                                            r++;
                                            pesor1=0.5;    
                                        }else if (estructura==="linear" && nivelagregacion==="1"){
                                                r++;
                                                pesor1=0.5;    
                                            }else if (estructura==="collection" && (nivelagregacion==="2" || 
                                                                                        nivelagregacion==="3" || 
                                                                                        nivelagregacion==="4") ){
                                                    r++;
                                                    pesor1=1;  
                                                }else if (estructura==="networked" && (nivelagregacion==="2" || 
                                                                                           nivelagregacion==="3" || 
                                                                                           nivelagregacion==="4") ){
                                                        r++;
                                                        pesor1=1;  
                                                    }else if (estructura==="hierarchical" && (nivelagregacion==="2" || 
                                                                                                  nivelagregacion==="3" || 
                                                                                                  nivelagregacion==="4") ){
                                                            r++;
                                                            pesor1=1;  
                                                        }else if (estructura==="linear" && (nivelagregacion==="2" || 
                                                                                                nivelagregacion==="3" || 
                                                                                                nivelagregacion ==="4") ){
                                                                r++;
                                                                pesor1=1;  
                                                        }

                if (tipointeractividad==="active" && (nivelinteractivo==="very high" || 
                                                            nivelinteractivo==="high" || 
                                                            nivelinteractivo==="medium" || 
                                                            nivelinteractivo==="low" ||
                                                            nivelinteractivo==="very low") ){
                        $r++;
                        $pesor2=1;  
                }else if (tipointeractividad==="mixed" && (nivelinteractivo==="very high" || 
                                                            nivelinteractivo==="high" || 
                                                            nivelinteractivo==="medium" || 
                                                            nivelinteractivo==="low" ||
                                                            nivelinteractivo==="very low") ){
                        r++;
                        pesor2=1;
                    }else if (tipointeractividad==="expositive" && (nivelinteractivo==="very high" || 
                                                                         nivelinteractivo==="high") ){
                             r++;
                             pesor2=0;
                        }else if (tipointeractividad==="expositive" && nivelinteractivo==="medium" ){
                                 r++;
                                 pesor2=0.5;
                            }else if (tipointeractividad==="expositive" && ( nivelinteractivo==="low" ||
                                                                                    nivelinteractivo==="very low") ){
                                     r++;
                                     pesor2=1;
                            }   
                if ( tipointeractividad==="active" && (tiporecursoeducativo==="exercise" || 
                                                            tiporecursoeducativo==="simulation" || 
                                                            tiporecursoeducativo==="questionnaire" || 
                                                            tiporecursoeducativo==="exam" ||
                                                            tiporecursoeducativo==="experiment" ||
                                                            tiporecursoeducativo==="problem statement" ||
                                                            tiporecursoeducativo==="self assessment") ){
                         r++;
                         pesor3=1;  
                }else if (tiporecursoeducativo==="active" && (tiporecursoeducativo==="diagram" || 
                                                                 tiporecursoeducativo==="figure" || 
                                                                 tiporecursoeducativo==="graph" || 
                                                                 tiporecursoeducativo==="index" ||
                                                                 tiporecursoeducativo==="slide" ||
                                                                 tiporecursoeducativo==="table" ||
                                                                 tiporecursoeducativo==="narrative text" ||
                                                                 tiporecursoeducativo==="lecture") ){
                         r++;
                         pesor3=0;
                    
                    }else if (tipointeractividad==="expositive" && (tiporecursoeducativo==="exercise" || 
                                                                         tiporecursoeducativo==="simulation" || 
                                                                         tiporecursoeducativo==="questionnaire" || 
                                                                         tiporecursoeducativo==="exam" ||
                                                                         tiporecursoeducativo==="experiment" ||
                                                                         tiporecursoeducativo==="problem statement" ||
                                                                         tiporecursoeducativo==="self assessment") ){
                             r++;
                             pesor3=0;  
                        }else if (tipointeractividad==="expositive" && (tiporecursoeducativo==="diagram" || 
                                                                             tiporecursoeducativo==="figure" || 
                                                                             tiporecursoeducativo==="graph" || 
                                                                             tiporecursoeducativo==="index" ||
                                                                             tiporecursoeducativo==="slide" ||
                                                                             tiporecursoeducativo==="table" ||
                                                                             tiporecursoeducativo==="narrative text" ||
                                                                             tiporecursoeducativo==="lecture") ){
                                 r++;
                                 pesor3=1;
                            }else if (tipointeractividad==="mixed" && (tiporecursoeducativo==="exercise" || 
                                                                         tiporecursoeducativo==="simulation" || 
                                                                         tiporecursoeducativo==="questionnaire" || 
                                                                         tiporecursoeducativo==="exam" ||
                                                                         tiporecursoeducativo==="experiment" ||
                                                                         tiporecursoeducativo==="problem statement" ||
                                                                         tiporecursoeducativo==="self assessment" ||
                                                                         tiporecursoeducativo==="diagram" ||
                                                                         tiporecursoeducativo==="figure" ||
                                                                         tiporecursoeducativo==="graph" ||
                                                                         tiporecursoeducativo==="index" ||
                                                                         tiporecursoeducativo==="slide" ||
                                                                         tiporecursoeducativo==="table" ||
                                                                         tiporecursoeducativo==="narrative text" ||
                                                                         tiporecursoeducativo==="lecture" )){
                                     r++;
                                     pesor3=1;  
                            }   
                m_coherencia=0;
                if (r>0) {

                // hace la sumatoria de los pesos 
                         m_coherencia= ( pesor1 +  pesor2 +  pesor3) /  r;
                         
                    
                        //alert(mensaje);
                        return m_coherencia;
                            //echo "* Coherencia de: ". m_coherencia."; ". evaluacion."<br><br>";
                }else{
                    
                        return m_coherencia;
                    
                }


            }


