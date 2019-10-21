function ValNumeros(control){
                    
                    $(control).keypress(function (e) {                        
                       
                        tecla_pulsada = String.fromCharCode(e.which);
                          
                        var exp= /^([0-9])*$/;

                           if(e.which!=8)
                           {
                               if(!exp.test(tecla_pulsada))
                               {
                                   e.preventDefault();
                               }
                           }

                    }).on("cut copy paste",function(e){
                    e.preventDefault();
                    }); 
}

//function ValNumeros(control){
//                    
//                    $(control).keypress(function(e) {
//                        if(isNaN(this.value + String.fromCharCode(e.charCode))) 
//                        return false;
//                    })
//                    .on("cut copy paste",function(e){
//                    e.preventDefault();
//                    });  
//                    
//                      $(control).keypress(function(e) {
//  if(isNaN(this.value+""+String.fromCharCode(e.charCode))) 
//      return false;
//  })
//  .on("paste",function(e){
//    e.preventDefault();
//  });
//                    
//}
                
function ValLetras(control){
                    
                    $(control).keypress(function (e) {                        
                       
                        tecla_pulsada = String.fromCharCode(e.which);
                          
                          var exp= /^([a-zA-ZñÑ\s\W])*$/;
                          
                           if(e.which!=8)
                           {
                               if(!exp.test(tecla_pulsada))
                               {
                                   e.preventDefault();
                               }
                           }

                    });
}

function ValAlfaNumerico(control){
                    
                    $(control).keypress(function (e) {                        
                       
                        tecla_pulsada = String.fromCharCode(e.which);
                          
                        var exp= /^([0-9a-zA-ZñÑ\s\W])*$/;

                           if(e.which!=8)
                           {
                               if(!exp.test(tecla_pulsada))
                               {
                                   e.preventDefault();
                               }
                           }

                    });
}
 
function ValCorreo(control,etiqueta){
                    
                    $(control).keydown(function (e) {                        
      
                            if(e.which==13 || e.which==9)
                            {
                                
                                var exp= /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                               
                                if(!exp.test($(this).val()))
                                {
                                    $(control).css({
                                        "background-color": "#F5A9A9"
                                    });
                                    $(etiqueta).css({
                                        "color": "#F5A9A9"
                                    });
                                    $(etiqueta).text("correo invalido");
                                }else{  
                                      
                                    $(control).css({
                                        "background-color": ""
                                    });
                                    $(etiqueta).text("");                                    
                                }
                                
                            }
                    });                                                            
} 

function ValRequerimiento(control,etiqueta){                    
                    $(control).keydown(function (e) {                        
      
                            if(e.which==13 || e.which==9)
                            {                                
                                var exp= /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                             

                                if(!exp.test($(this).val()))
                                {
                                    $(control).css({
                                        "background-color": "#F5A9A9"
                                    });
                                    $(etiqueta).css({
                                        "color": "#F5A9A9"
                                    });
                                    $(etiqueta).text("correo invalido");
                                }else{  
                                      
                                    $(control).css({
                                        "background-color": ""
                                    });
                                    $(etiqueta).text("");                                    
                                }                                
                            }
                    });                                                            
} 


function ValTelefono(control,etiqueta){
                    
                    $(control).keydown(function (e) {                        
      
                            if(e.which==13 || e.which==9)
                            {
                                
                                var exp= /^[9|6]{1}[-][0-9]*$/;
                               
                                if(!exp.test($(this).val()))
                                {
                                    $(control).css({
                                        "background-color": "#F5A9A9"
                                    });
                                    $(etiqueta).css({
                                        "color": "#F5A9A9"
                                    });
                                    $(etiqueta).text("correo invalido");
                                }else{  
                                      
                                    $(control).css({
                                        "background-color": ""
                                    });
                                    $(etiqueta).text("");                                    
                                }
                                
                            }

                    });                                                                                
}

              