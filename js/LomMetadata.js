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
    var varcopyrightandotherrestrictions;
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
            lom.varcopyrightandotherrestrictions = $(xml).find("lom\\:varcopyrightandotherrestrictions").text();


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
