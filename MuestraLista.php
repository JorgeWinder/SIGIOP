<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    
    <meta charset="UTF-8">
    <title> MINEDU - Lista de Asistencia</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script type="text/javascript" src="js/validacion.js"></script>
    <script type="text/javascript" src="Ctrl/CtrlDF.js"></script>
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
        

        $( document ).ready(function() {                        
            
            ConsultarDatosDF('<?PHP echo $_REQUEST['modular']; ?>','<?PHP echo $_REQUEST['dni']; ?>');
            
			$("#BtnAdd").prop("disabled",true); 
			
            ValNumeros("[id*=DNI]");
            ValLetras("[id*=Apellido]");
            ValLetras("[id*=Nombre]");
            ValLetras("#NomDocente");
            
                                 
             $("#BtnAdd").click(function () {

                cant = $("#tabla tr").length;
                //var contenido = "<tr><td><label class='control-label'>" + cant + "</label></td><td><input id='DNI" + cant + "' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8'></td><td><input id='Apellido" + cant + "' type='text' placeholder='Escribir apellidos' class='form-control'></td><td><input id='Nombre" + cant + "' type='text' placeholder='Escribir nombres' class='form-control'></td><td><div class='radio'><label><input id='Radio_" + cant + "_1' name='Radio_" + cant + "' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + cant + "_2' name='Radio_" + cant + "' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_" + cant + "_3' name='Radio_" + cant + "' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + cant + "_4' name='Radio_" + cant + "' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar" + cant + "' onclick='Grabar(" + cant + ")'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate" + cant + "' onclick='Update(" + cant + ")' disabled='true'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td><td><button class='btn btn-danger' id='BtnDelete" + cant + "' onclick='Delete(" + cant + ")'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></button></td><td></td></tr>";
                var contenido = "<tr><td><label class='control-label'>" + cant + "</label></td><td><input id='DNI" + cant + "' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8'></td><td><input id='Apellido" + cant + "' type='text' placeholder='Escribir apellidos' class='form-control'></td><td><input id='Nombre" + cant + "' type='text' placeholder='Escribir nombres' class='form-control'></td><td><div class='radio'><label><input id='Radio_" + cant + "_1' name='Radio_" + cant + "' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + cant + "_2' name='Radio_" + cant + "' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_" + cant + "_3' name='Radio_" + cant + "' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + cant + "_4' name='Radio_" + cant + "' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar" + cant + "' onclick='Grabar(" + cant + ")'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate" + cant + "' onclick='Update(" + cant + ")' disabled='true'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td></tr>";
                $("#tabla").append(contenido);
                
                ValNumeros("[id*=DNI]");
                ValLetras("[id*=Apellido]");
                ValLetras("[id*=Nombre]");
                
            });
            
            
///////////////////////////////////////////////////////

        $("#BtnCrear").click(function () {            
                var conta=0;
              if(ValNoVacio("#NomDocente")  && ValNoVacio("#numsec"))
              {
        
              $.ajax({
                    url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                    type: 'POST',
                    scriptCharset: "utf-8",
                    async: false,
                    data: {op: 'ActualizarSec', CodModular: $('#CodModular').text(), DNI: $('#doc').val() , NombreDP: $("#NomDocente").val() , NumSecciones: $("#numsec").val() },
                    success: function (response) {
                      
                      for(var i=1;i<=parseInt($("#numsec").val());i++)
                      {                        
                        $('#ListaSec').append("<li><a href='javascrpit:void()' onclick='Sec("+ i +")'>Sección-" + i.toString() +"</a></li>");   
                      }
                        $("#BtnCrear").prop("disabled",true);
                       
                       $("#NomDocente").prop("readonly",true);
                                              
                       alert(response.toString());
                    },                    
                    error: function(){                                                
                        alert("Error");                        
                   }
              });

                              
        }            
            
    });   
    
    
    /////////////////////////////////////////////////
    
    $("#BtnModFecha").click(function () {
    
                var Fecha=$("#Fecha").val();               
                var HoraInicio= $("#hi").val();                  
                var HoraFin=$("#hf").val();  
                
                var Seccion=varseccion;
                var Sesion=varsesion;
        
        $.ajax({
                    url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                    type: 'POST',
                    scriptCharset: "utf-8",
                    async: false,
                    data: {op: 'ActualizarFecha', CodModular: $('#CodModular').text(), DNI: $('#doc').val() , Sesion: Sesion , Seccion: Seccion , Fecha:Fecha, HoraInicio:HoraInicio , HoraFin:HoraFin},
                    success: function (response) {                                                                    
                       alert("Fecha actualizada");
                    },                    
                    error: function(){                                                
                        alert("Error");                        
                   }
              });
    
    
    });
    
  /////////////////////////////////////////////////////////          
            
        });
        
        varseccion=0;
        varsesion=1;

        function Sec(id){
			
		$("#BtnAdd").prop("disabled",false);
                $("#BtnModFecha").prop("disabled",true);
                $("#Fecha").val("");
                $("#hi").val("");
                $("#hf").val("");
                $('#asistio1').attr("checked",false);
                $('#asistio2').attr("checked",false);
        
                var CodModular=$('#CodModular').text(); 
                var DNI=$('#doc').val(); 
                var Seccion=id;
                var Sesion = 1; //varsesion;
                varseccion=id;
                //alert(Seccion.toString());
                //dropdownMenu1 

                  $("#tabla tr").remove();
                  $("#tabla").append("<tr><td width='10'>ID</td><td width='135'>DNI</td><td width='200'>APELLIDOS</td><td width='200'>NOMBRES</td><td style='width: 8%'>Asistió</td><td style='width: 11%'>Tardanza</td><td style='width: 9%'>No Asistió</td><td style='width: 8%'>Retirado</td><td></td><td></td><td></td></tr>");
                  $("#labelseccion").text(id.toString());   
                  $("#labelsesion").text("1");   
                  
                  $.ajax({
                    url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                    type: 'POST',
                    scriptCharset: "utf-8",
                    async: false,
                    data: {op: 'ListarAsistencia', CodModular: CodModular, DNI: DNI , Seccion: Seccion , Sesion: Sesion},
                    success: function (response) {                        
                     var arreglo = $.parseJSON(response);      
                    //alert(arreglo.toString());
                     
                     
                     var dateString = arreglo[0].Fecha.toString();                                              
                     $("#Fecha").val(dateString.substring(0, 10));
                     $("#hi").val(arreglo[0].HoraInicio.toString());
                     $("#hf").val(arreglo[0].HoraFin.toString());
                     
                     $("#dropdownMenu1").text("Sección-"+ id.toString());
                     
                     for (var i = 0; i < arreglo.length; i++) {                         
                        var codid=arreglo[i].idListaAsistencia.toString();                         
                        var contenido = "<tr><td><label class='control-label'>" + (i + 1) + "</label></td><td><input id='DNI" + codid + "' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8' value='"+ arreglo[i].DNIAlumno.toString() +"'></td><td><input id='Apellido" + codid + "' type='text' placeholder='Escribir apellidos' class='form-control' value='"+ arreglo[i].Apellidos.toString() +"'></td><td><input id='Nombre" + codid + "' type='text' placeholder='Escribir nombres' class='form-control' value='"+ arreglo[i].Nombres.toString() +"'></td><td><div class='radio'><label><input id='Radio_" + codid + "_1' name='Radio_" + codid + "' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_2' name='Radio_" + codid + "' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_3' name='Radio_" + codid + "' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_4' name='Radio_" + codid + "' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar" + codid + "' onclick='Grabar(" + codid + ")' disabled='true'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate" + codid + "' onclick='Update(" + codid + ")' ><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td></tr>";
                        $("#tabla").append(contenido);                                            
                        $('#Radio_' + codid + '_' + arreglo[i].Asistencia.toString()).attr("checked",true);
                        $('#asistio'+ arreglo[i].AsistenciaParticipante.toString()).attr("checked",true);
                        $("#BtnModFecha").prop("disabled",false);
                     }
                     
                                                
                        //$('#visitada' + arreglo[0].visitada.toString()).attr("checked",true);
                       
                    },                    
                    error: function(){                                                
                        alert("Error");                        
                   }
            
                });  
                
        }
        
        function NumReg(CodModular,DNI,Seccion,Sesion){
           
            varcant=0;
                    $.ajax({
                    url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                    type: 'POST',
                    scriptCharset: "utf-8",
                    async: false,
                    data: {op: 'ListarAsistencia', CodModular: CodModular, DNI: DNI , Seccion: Seccion , Sesion: Sesion},
                    success: function (response) {                        

                    var arreglo = $.parseJSON(response);      
 
                      varcant=arreglo.length;;                                                                
                       
                    },                    
                    error: function(){                                                
                        alert("Error");                        
                   }
            
                });  
           
           return varcant;
        }
        
        function CambioSesion(ses){

                var CodModular=$('#CodModular').text();
                var DNI=$('#doc').val(); 
                var Seccion=varseccion;               
                varsesion=ses;
                $('#labelsesion').text(ses);
                
                //alert(NumReg(CodModular,DNI,Seccion,varsesion).toString());
 if(NumReg(CodModular,DNI,Seccion,varsesion)==0){               
                $.ajax({
                    url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                    type: 'POST',
                    scriptCharset: "utf-8",
                    async: false,
                    data: {op: 'ListarAsistencia', CodModular: CodModular, DNI: DNI , Seccion: Seccion , Sesion: 1},
                    success: function (response) {                        
                     var arreglo = $.parseJSON(response);      
                     
                    $("#tabla tr").remove();
                    $("#tabla").append("<tr><td width='10'>ID</td><td width='135'>DNI</td><td width='200'>APELLIDOS</td><td width='200'>NOMBRES</td><td style='width: 8%'>Asistió</td><td style='width: 11%'>Tardanza</td><td style='width: 9%'>No Asistió</td><td style='width: 8%'>Retirado</td><td></td><td></td><td></td></tr>");
                    
                     var dateString = arreglo[0].Fecha.toString();                         
                     
                     $("#Fecha").val("");
                     $("#hi").val("");
                     $("#hf").val("");
                     $("#BtnModFecha").prop("disabled",true);
                     $("#asistio1").prop("checked",false);
                     $("#asistio2").prop("checked",false);
                     
                     for (var i = 0; i < arreglo.length; i++) {                         
                        var codid=arreglo[i].idListaAsistencia.toString();                         
                        var contenido = "<tr><td><label class='control-label'>" + (i + 1) + "</label></td><td><input id='DNI" + codid + "' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8' value='"+ arreglo[i].DNIAlumno.toString() +"'></td><td><input id='Apellido" + codid + "' type='text' placeholder='Escribir apellidos' class='form-control' value='"+ arreglo[i].Apellidos.toString() +"'></td><td><input id='Nombre" + codid + "' type='text' placeholder='Escribir nombres' class='form-control' value='"+ arreglo[i].Nombres.toString() +"'></td><td><div class='radio'><label><input id='Radio_" + codid + "_1' name='Radio_" + codid + "' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_2' name='Radio_" + codid + "' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_3' name='Radio_" + codid + "' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_4' name='Radio_" + codid + "' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar" + codid + "' onclick='Grabar(" + codid + ")'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate" + codid + "' onclick='Update(" + codid + ")' disabled='true'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td></tr>";
                        $("#tabla").append(contenido); 
                                          
                     }                                                                                                                                                                              
                    },                    
                    error: function(){                                                
                        alert("Error");                        
                   }
            
                });  
}else{              
                /////////////////////////////////////////////////////////////////////////////////////////////
                
                $.ajax({
                    url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                    type: 'POST',
                    scriptCharset: "utf-8",
                    async: false,
                    data: {op: 'ListarAsistencia', CodModular: CodModular, DNI: DNI , Seccion: Seccion , Sesion: varsesion},
                    success: function (response) {                        
                     var arreglo = $.parseJSON(response);      
                     
                    $("#tabla tr").remove();
                    $("#tabla").append("<tr><td width='10'>ID</td><td width='135'>DNI</td><td width='200'>APELLIDOS</td><td width='200'>NOMBRES</td><td style='width: 8%'>Asistió</td><td style='width: 11%'>Tardanza</td><td style='width: 9%'>No Asistió</td><td style='width: 8%'>Retirado</td><td></td><td></td><td></td></tr>");
                    
                     var dateString = arreglo[0].Fecha.toString();                         
                     
                     $("#Fecha").val(dateString.substring(0, 10));
                     $("#hi").val(arreglo[0].HoraInicio.toString());
                     $("#hf").val(arreglo[0].HoraFin.toString());
                     $("#asistio" + arreglo[0].AsistenciaParticipante.toString()).prop("checked",true);
                     //alert(arreglo[0].AsistenciaParticipante.toString());
                     $("#BtnModFecha").prop("disabled",false);
                     
                     for (var i = 0; i < arreglo.length; i++) {                         
                        var codid=arreglo[i].idListaAsistencia.toString();                         
                        var contenido = "<tr><td><label class='control-label'>" + (i + 1) + "</label></td><td><input id='DNI" + codid + "' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8' value='"+ arreglo[i].DNIAlumno.toString() +"'></td><td><input id='Apellido" + codid + "' type='text' placeholder='Escribir apellidos' class='form-control' value='"+ arreglo[i].Apellidos.toString() +"'></td><td><input id='Nombre" + codid + "' type='text' placeholder='Escribir nombres' class='form-control' value='"+ arreglo[i].Nombres.toString() +"'></td><td><div class='radio'><label><input id='Radio_" + codid + "_1' name='Radio_" + codid + "' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_2' name='Radio_" + codid + "' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_3' name='Radio_" + codid + "' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_" + codid + "_4' name='Radio_" + codid + "' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar" + codid + "' onclick='Grabar(" + codid + ")' disabled='true'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate" + codid + "' onclick='Update(" + codid + ")' ><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td></tr>";
                        $("#tabla").append(contenido); 
                                               
                         $('#Radio_' + codid + '_' + arreglo[i].Asistencia.toString()).attr("checked",true);
                         
                     }                                                                                                                                                                              
                    },                    
                    error: function(){                                                
                        alert("Error");                        
                   }
            
                });  
}                
 /////////////////////////////////////////////////////////////////////////
            // Cuando la sesión es mayor a uno    
                if(ses>1){                    
                    $("[id*=DNI]").attr("readonly",false);
                    $("[id*=Apellido]").prop("readonly",false);
                    $("[id*=Nombre]").prop("readonly",false);
                }
                    
               
            
            
        }

        
        function Grabar(id)
        {
            if($("#Fecha").val()!="" && $("#hi").val()!="" && $("#hf").val()!="" && ($("#asistio1").prop("checked") || $("#asistio2").prop("checked") )){
                
                if(confirm("Confirma registro del alumno")){
            
            
                $("#BtnUpdate" + id).prop("disabled",false);
                $("#BtnDelete" + id).prop("disabled",true);
                $("#BtnGrabar" + id).prop("disabled",true);
                 
                var idListaAsistencia=id; 
                var CodModular=$('#CodModular').text(); 
                var DNI=$('#doc').val(); 
                var NombreDF=$('#NombreDF').text(); 
                var Seccion=varseccion;
                var Sesion=varsesion;
                var Fecha=$("#Fecha").val();               
                var HoraInicio= $("#hi").val();                  
                var HoraFin=$("#hf").val();                
                var Apellidos =$("#Apellido" + id).val(); 
                var Nombres =$("#Nombre" + id).val();
                var DNIAlumno =$("#DNI" + id).val();
                var Asistencia;
                var Asistio;
               
                       var objRadio = $("input:radio[name=Radio_" + id.toString() +"]");
                        $(objRadio).each(function (index) {
                            if ($(objRadio).eq(index).prop("checked"))
                            {
                                Asistencia= $(this).val();
                            }
                        });
                        
                        ///////////////////////////////////
                        
                        var objAsistio = $("input:radio[name=asistio]");
                        $(objAsistio).each(function (index) {
                            if ($(objAsistio).eq(index).prop("checked"))
                            {
                                Asistio= $(this).val();
                            }
                        });
                
                //alert(Asistencia);
                
                  $.ajax({
                        url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                        type: 'POST',
                        scriptCharset: "utf-8",
                        async: false,
                        data: {op: 'IngresarAlumno', idListaAsistencia:idListaAsistencia , CodModular: CodModular, DNI: DNI , NombreDF:NombreDF , Seccion: Seccion , Sesion: Sesion,
                        Fecha: Fecha, HoraInicio: HoraInicio, HoraFin:HoraFin, Apellidos:Apellidos, Nombres:Nombres, DNIAlumno:DNIAlumno, Asistencia:Asistencia , Asistio:Asistio},
                        success: function (response) {                        
                         //var arreglo = $.parseJSON(response);      
                         alert("Alumno registrado");
                         $("#BtnModFecha").prop("disabled",false);
                            //$('#visitada' + arreglo[0].visitada.toString()).attr("checked",true);
                        },                    
                        error: function(){                                                
                            alert("Error");                        
                       }
                    });
                                                            
                }
                
            }else{ alert("Debe especificar fecha y hora de la sesión / Participación del docente");}                                                                
                
        }
               
        function Update(id)
        {
            
                var idListaAsistencia=id; 
                var CodModular=$('#CodModular').text(); 
                var DNI=$('#doc').val();               
                var Seccion=varseccion;
                var Sesion=varsesion;
                                
                var Apellidos =$("#Apellido" + id).val(); 
                var Nombres =$("#Nombre" + id).val();
                var DNIAlumno =$("#DNI" + id).val();
                var Asistencia;
               
                       var objRadio = $("input:radio[name=Radio_" + id.toString() +"]");
                        $(objRadio).each(function (index) {
                            if ($(objRadio).eq(index).prop("checked"))
                            {
                                Asistencia= $(this).val();
                            }
                        });                
                
                  $.ajax({
                        url: 'http://'+ window.location.host +'/ListaDeAsistencia/Ctrl/CtrlDF.php',
                        type: 'POST',
                        scriptCharset: "utf-8",
                        async: false,
                        data: {op: 'ActualizarAlumno', idListaAsistencia:idListaAsistencia , CodModular: CodModular, DNI: DNI , Seccion: Seccion , Sesion: Sesion,
                        Apellidos:Apellidos, Nombres:Nombres, DNIAlumno:DNIAlumno, Asistencia:Asistencia},
                        success: function (response) {                        
                         //var arreglo = $.parseJSON(response);      
                         //$('#CodModular').html(response.toString());                       

                          alert("Registro actualizado");  
                            //$('#visitada' + arreglo[0].visitada.toString()).attr("checked",true);

                        },                    
                        error: function(){                                                
                            alert("Error");                        
                       }
                    });
            
            
            
    		
        }



        function Delete(id)
            {
              $(document).on("click", "#BtnDelete" + id, function () {
                    if ($("#tabla").find('tr').length > 2)
                    {
                        $(this).parents().get(1).remove();
                    }

                    $("#tabla tr").each(function (index) {
                        if (index > 0)
                        {
                            $(this).children('td').eq(0).text(index.toString());
                        }
                    });
                });
                
            }
        

    </script>
                
    </head>
    <body>
        <input id="doc" type="hidden" value="<?PHP echo $_REQUEST['dni']; ?>">
        <div class="panel panel-default" style="width: 90%; margin: 0 auto;margin-top: 1%;">
            <img src="http://www.perueduca-enlinea.pe/encuestas-online/eol/templates/citronade/Logo2.png" alt=" " id="logo">
        </div>
        <div class="panel panel-primary" style="width: 90%; margin: 0 auto;margin-top: 1%;">
                <div class="panel-heading">DATOS DE REGISTRO DE ASISTENCIA</div>
                <div class="panel-body">
                                                            
                        
 <div class="row">
    <div class="col-lg-6">
        
        <table class="table-responsive" style="border-collapse: separate; border-spacing: 5px;">
            <tr><td>IE: <label id="NombreIE"></label></td></tr>
            <tr><td>DRE: <label id="Departamento"></label><br></td></tr>
            <tr><td>UGEL: <label id="UGEL"></label><br></td></tr>
                        <tr><td>Código Modular: <label id="CodModular"></label><br></td></tr>
                        <tr><td>Docente Fortaleza: <label id="NombreDF"></label><br></td></tr>
                        <tr><td>Área curricular: <label id="Area"></label><br></td></tr>
<!--                        <tr><td>Número de sesión: <label>1</label><br></td></tr>                        -->
                    </table>
                                
                                
                                
    </div>
    <div class="col-lg-6">

                    <div class="form-group">                          
                        <label>Docente participante: </label> <input id='NomDocente' type='text' placeholder='Nombres de docente' class='form-control'>                            
                    </div>
                        

                        <div class="form-group">                            
                            <label>Número de secciones asignadas: </label>                             
                            <div class="form-inline">
                                <div class="form-group"><input id='numsec' type='number' style="width: 100px;" min="1" max="3" value="0" class="form-control"></div>
                                <button class='btn btn-primary form-control' style="min-width: 255px;" id='BtnCrear'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Crear secciones</button>                       
                            </div>    
                        </div>                                                 
                    
                    <div class="form-inline">
  
                            <label style="display: inline-block">Lista de secciones creadas: </label> 
                            <div class="dropdown" style="display: inline-block;">
                                     <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Seleccionar sección                                        
                                      </button>
                                      <ul id='ListaSec' class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                          <!--<li><a href='javascrpit:void()'>Sección 1</a></li>-->
<!--                                        <li><a href="#">Sección 2</a></li>
                                        <li><a href="#">Sección 3</a></li>                                        -->
                                      </ul>
                            </div>
                                            
                    </div>                                                                                                 
                                                                
   </div>
</div>      
                        
                        
                </div>

                               
                
            </div>                               
        
<!--------------------------------------------------------------------------------------------------------------->

                <div class="panel panel-primary" style="width: 90%; margin: 0 auto;margin-top: 2%;margin-bottom: 2%;">
                    <div class="panel-heading">LISTADO DE ASISTENCIA - SECCIÓN <label id="labelseccion">1</label> - SESIÓN N° <label id="labelsesion">1</label></div>
                <div class="panel-body">

                <div class="form-group">                            
                        <label>Fecha y hora de la sessión: </label>                             
                        <div class="form-inline">
                            <div class="form-group"><input id='Fecha' type='date' class="form-control"></div>
                            <label>De</label>
                            <div class="form-group"><input id='hi' type='time' class="form-control"></div>
                            <label>hasta</label>
                            <div class="form-group"><input id='hf' type='time' class="form-control"></div>
                            <div class="form-group"><button id="BtnModFecha" class="btn btn-warning" disabled="true"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Modificar Fecha / Hora</button></div>
                            <label>El Docente Participante participó :</label>
                            <div class="form-group">
                                <div class='radio'><label><input id='asistio1' name='asistio' type='radio' value='1'> Sí asistió</label></div>
                                <div class='radio'><label><input id='asistio2' name='asistio' type='radio' value='2'> No asistió</label></div>
                            </div>
                             
                        </div>    
                </div>                       
                    
                <div class="form-group">
                <table id="tabla" class="table table-striped">
                    <tr><td width="10">ID</td><td width="135">DNI</td><td width="200">APELLIDOS</td><td width="200">NOMBRES</td><td style="width: 8%">Asistió</td><td style="width: 11%">Tardanza</td><td style="width: 9%">No Asistió</td><td style="width: 8%">Retirado</td><td></td><td></td><td></td></tr>
                    <!--<tr><td><label class='control-label'>1</label></td><td><input id='DNI1' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8'></td><td><input id='Apellido1' type='text' placeholder='Escribir apellidos' class='form-control'></td><td><input id='Nombre1' type='text' placeholder='Escribir nombres' class='form-control'></td><td><div class='radio'><label><input id='Radio_1_1' name='Radio_1' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_1_2' name='Radio_1' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_1_3' name='Radio_1' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_1_4' name='Radio_1' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar1' onclick='Grabar(1)'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate1' onclick='Update(1)' disabled='true'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td><td><button class='btn btn-danger' id='BtnDelete1' onclick='Delete(1)' disabled='true'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span></button></td></tr>-->
                    <tr><td><label class='control-label'>1</label></td><td><input id='DNI1' type='text' placeholder='Ingresar DNI' class='form-control' maxlength='8'></td><td><input id='Apellido1' type='text' placeholder='Escribir apellidos' class='form-control'></td><td><input id='Nombre1' type='text' placeholder='Escribir nombres' class='form-control'></td><td><div class='radio'><label><input id='Radio_1_1' name='Radio_1' type='radio' value='1'> Sí asistió</label></div></td><td><div class='radio'><label><input id='Radio_1_2' name='Radio_1' type='radio' value='2'> Con tardanza</label></div></td><td><div class='radio'><label><input id='Radio_1_3' name='Radio_1' type='radio' value='3'> No asistió</label></div></td><td><div class='radio'><label><input id='Radio_1_4' name='Radio_1' type='radio' value='4'> Se retiró</label></div></td><td><button class='btn btn-primary' id='BtnGrabar1' onclick='Grabar(1)'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> Registrar</button></td><td><button class='btn btn-warning' id='BtnUpdate1' onclick='Update(1)' disabled='true'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></td><td></td></tr>
                </table>
                </div>                        
                
                    
                </div>
                 <div class="panel-footer">
                        <button id="BtnAdd" class="btn btn-default">
                         <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                            Agregar alumno
                        </button>
                        <label> SESIÓN:</label>
                        <div class="btn-group" role="group" aria-label="...">

                            <button type="button" class="btn btn-default" onclick="CambioSesion(1)">1</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(2)">2</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(3)">3</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(4)">4</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(5)">5</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(6)">6</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(7)">7</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(8)">8</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(9)">9</button>
                            <button type="button" class="btn btn-default" onclick="CambioSesion(10)">10</button>
                        </div>
                </div>                                

                </div>
        
        <?php
        // put your code here
                        
        ?>
    </body>
</html>
