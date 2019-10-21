
$(document).ready(function () {


	$('#pedido').keydown(function (e) {
                
                if (e.which == 13) {                	

                    ConsultarPedido($('#pedido').val());

                } 
    
    });

	$("#btnRegistrarCobro").prop("disabled","true");
    $("#btnPedidoPorCob").prop("disabled","true");    
	$("#btnAnularCobro").prop("disabled","true");
    $("#btnImprimirCobro").prop("disabled","true");

	 $("#btnRegistrarCobro").click(function(){

	 	if(confirm("¿CONFIRMA REALIZAR COBRO?")){
	 		
	 	
            RegistrarCobro();         
	 	}

	 	
	 });


    $("#btnPedidoPorCob").click(function(){

        if(confirm("¿CONFIRMA QUE EL PEDIDO SERÁ POR COBRAR?")){
            PorCobrar();
        }         

    });

                //VER DATOS CLIENTE
            
                    
                $("#vercli").click(function () {

                    window.open ("./datos-de-cliente?dni=" + $("#dni").val(),"Registrar cliente","menubar=1,resizable=1,width=500,height=550,left=300,top=80");                 
                
                });
    


	$('#pedido').focus();
    

});




function ConsultarPedido(idPedido){


        $("#tablapedido tr").remove();      
        cabe = "<tr><td width='10'>ID</td><td width='450'>PRODUCTO</td><td width='100'>CANTIDAD</td><td style='width: 11%'>P.UNIT</td><td style='width: 11%'>P.TOTAL</td><td style='width: 9%'>DESCUENTO</td><td style='width: 8%'></td><td></td><td></td><td></td></tr>";   
        $("#tablapedido").append(cabe);

        $.ajax({
                type: "GET",
                url: './api-sigop/pedido/getPedido',
                data:  { idPedido: idPedido  },
                success: function (resultado) {                        
                    var obj = $.parseJSON(resultado);
                     
                    if(obj.Respuesta[0].Filas>0){

                        $('#idTienda').val(obj.Respuesta[0].idTienda);
                    	$('#nombretienda').val(obj.Respuesta[0].NombreTienda);
	                    $('#cliente').val(obj.Respuesta[0].RazonSocial); 
	                    $('#dni').val(obj.Respuesta[0].RucDnICL); 
                        $('#idColaborador').val(obj.Respuesta[0].idColaborador); 
	                    $('#atendido').val(obj.Respuesta[0].NombresCol); 
	                    $('#estado').val(obj.Respuesta[0].EstadoPedido); 
	                    $('#empresa').val(obj.Respuesta[0].NombreEmpresa); 

                        $('#MontoEfectivo').val(obj.Respuesta[0].MontoEfectivo); 
                        $('#MontoDeposito').val(obj.Respuesta[0].MontoDeposito);
                        $('#MontoSaldo').val(obj.Respuesta[0].MontoSaldo);

	                    $("#tablapedido").append(obj.Respuesta[0].detalle.toString());
                        $("#btnAnularCobro").prop("disabled","");
                        

                        if( obj.Respuesta[0].EstadoCobro == 'CANCELADO' || obj.Respuesta[0].EstadoCobro == 'PENDIENTE DE COBRO'){

                            $("#btnRegistrarCobro").prop("disabled","true");    
                            $("#btnPedidoPorCob").prop("disabled","true");                              
                            $("#btnImprimirCobro").prop("disabled","");
                            $("#EstadoCobro").val(obj.Respuesta[0].EstadoCobro);    

                        }else if(obj.Respuesta[0].EstadoCobro=="A LA ESPERA DE COBRANZA"){

                            $("#btnRegistrarCobro").prop("disabled","");
                            $("#btnPedidoPorCob").prop("disabled","");                                  
                            $("#btnImprimirCobro").prop("disabled","true");
                        } 
                        
                        $('#EstadoCobro').val(obj.Respuesta[0].EstadoCobro);

                        
	                    CalValTotalGeneral();

                    }else{ 
                    	alert("No existe registro para este pedido");
                    	$("#btnRegistrarCobro").prop("disabled","true");
	                    $("#btnAnularCobro").prop("disabled","true");

                        LimpiarDatos();
                    }
                    

                    },
                    error: function (resultado) {
                        alert("Error");
                    }
        });


	//alert(idPedido.toString());

}	

function LimpiarDatos(){

       $('#nombretienda').val("");
       $('#cliente').val(""); 
       $('#dni').val(""); 
       $('#atendido').val(""); 
       $('#estado').val(""); 
       $('#empresa').val("");         

      $('#MontoEfectivo').val("0.00"); 
      $('#MontoDeposito').val("0.00"); 
      $('#MontoSaldo').val("0.00");
      $("#total").val("0.00");

}



function CalValTotalGeneral(){

                sum=0.00;

                $("#tablapedido tr").each(function (index) {
                    if (index > 0)
                    {         
                        sum = sum + (parseFloat($("#PrecioTotal" + index).val()).toFixed(2) - parseFloat($("#Desct" + index).val()).toFixed(2));               
                        //sum = sum + parseFloat($(this).children('td').eq(4).children('input').val());                    
                    }
                });

                $("#total").val(sum.toFixed(2));

 }



function RegistrarCobro(){

                //var str = "CANCELDO";
                //estado = str.substring(0, 1);

      sumatotal =  parseFloat($("#MontoEfectivo").val()) + parseFloat($("#MontoDeposito").val()) + parseFloat($("#MontoSaldo").val()); 

      if(parseFloat($("#MontoSaldo").val())==0.00){

      if( sumatotal==parseFloat($("#total").val()) ){


                //--------------------------------------------//

                if( $("#pedido").val()!=""){

                    $.ajax({
                       type: "POST",
                       url: './api-sigop/pedido/update',
                       data:  {idPedido: $("#pedido").val() , EstadoPedido: "R" , EstadoCobro: "C" , MontoEfectivo : $("#MontoEfectivo").val() , MontoDeposito : $("#MontoDeposito").val() , MontoSaldo : $("#MontoSaldo").val() },
                       success: function (response) {
                                      var obj = $.parseJSON(response);                                                                                                  

                                       //$("#pedido").val(obj.Respuesta[0].Id);
                                       $('#EstadoCobro').val("CANCELADO");
                                       $("#btnRegistrarCobro").prop("disabled","true");
                                       //$("#btnAnularCobro").prop("disabled",""); 
                                       $("#btnImprimirCobro").prop("disabled","");                                      
                                       alert("COBRANZA: PEDIDO " + $("#pedido").val() + ", REGISTRADO");                                         
                                       RegistrarSalidaEnAlmacen();
                        }
                    });

                }else{ alert("FLATAN COMPLETAR DATOS DE PEDIDO"); }

                //--------------------------------------------//

      }else{

                  alert("Los  montos de efectivo y depósito no suman el monto total");
            }   
            
        }else{ alert("El monto saldo debe estar en valor 0.00");}                    

 }


 function PorCobrar(){

                //var str = "POR COBRAR";
                //EstadoCobro = str.substring(0, 1);
                    

      sumatotal =  parseFloat($("#MontoEfectivo").val()) + parseFloat($("#MontoDeposito").val()) + parseFloat($("#MontoSaldo").val()); 

      if(parseFloat($("#MontoSaldo").val())>0.00){
      
      if( sumatotal==parseFloat($("#total").val()) ){

                //--------------------------------------------//        

                if( $("#pedido").val()!=""){

                    $.ajax({
                       type: "POST",
                       url: './api-sigop/pedido/update',
                       data:  {idPedido: $("#pedido").val() , EstadoPedido: "R" , EstadoCobro: "P" , MontoEfectivo : $("#MontoEfectivo").val() , MontoDeposito : $("#MontoDeposito").val() , MontoSaldo : $("#MontoSaldo").val() },
                       success: function (response) {
                                      var obj = $.parseJSON(response);                                                                                                  

                                       //$("#pedido").val(obj.Respuesta[0].Id);   
                                       $('#EstadoCobro').val("PENDIENTE DE COBRO"); 
                                       $("#btnPedidoPorCob").prop("disabled","true");
                                       $("#btnAnularCobro").prop("disabled","");  
                                       $("#btnImprimirCobro").prop("disabled","");                                       
                                       alert("COBRANZA: PEDIDO " + $("#pedido").val() + ", ESTÁ POR COBRAR");                                        
                                       RegistrarSalidaEnAlmacen();                                     
                        }
                    });

                }else{ alert("FLATAN COMPLETAR DATOS DE PEDIDO"); }

                     //--------------------------------------------//

      }else{

                  alert("Los  montos de efectivo, depósito y saldo no suman el monto total");
            } 
            
        }else{ alert("El monto saldo debe tener un valor");}                       

 }



 function AnularComprobante(){

            var std1 = "ANULADO";
            EstadoPedido = std1.substring(0, 1);
            EstadoCobro =  std1.substring(0, 1);


            var pass = prompt("Ingrese su código de autorización :"); 

            if(pass=="156215"){

                if(confirm("¿ CONFIRMA ANULAR PEDIDO ?")){

                    $.ajax({
                       type: "POST",
                       url: './api-sigop/pedido/anular',
                       data:  {idPedido: $("#pedido").val() , EstadoPedido: EstadoPedido , EstadoCobro: EstadoCobro },
                       success: function (response) {
                                      var obj = $.parseJSON(response);                                                                                                  

                                       //$("#pedido").val(obj.Respuesta[0].Id);
                                       $('#estado').val("ANULADO"); 
                                       $('#EstadoCobro').val("ANULADO");
                                       $("#btnImprimirCobro").prop("disabled",""); 
                                       EliminarSalida();
                                       alert("PEDIDO : " + $("#pedido").val() + ", ANULADO");                                       
                        }
                    });

                }


            }else{ alert("CONTRASEÑA NO VALIDA");}

 }


function EliminarSalida(){


                  $.ajax({
                       type: "POST",
                       url: './api-sigop/MovimientoAlmacenOP/delete',
                       data:  { idPedido: $("#pedido").val() },
                       success: function (response) {
                                      var obj = $.parseJSON(response);                      
                                      alert("SE ELIMINÓ SALIDA DEL PRODUCTO EN ALMACÉN");
                                      //obj ? alert("MOVIMIENTO REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL MOVIMIENTO");                                      
                        }
                    });

  

}


function RegistrarSalidaEnAlmacen(){

       $("#tablapedido tr").each(function (index) {
                if (index > 0)
                {

                    //alert($("#idProducto" + index).val());

                    StockMoviento= -1 * $("#Cantidad" + index).val();

                    $.ajax({
                       type: "POST",
                       url: './api-sigop/MovimientoAlmacenOP/add',
                       data:  {idTipoMovimiento: 5 , idTienda: $("#idTienda").val() , StockMoviento: StockMoviento , idProducto: $("#idProducto" + index).val() , idColaborador: $("#idColaborador").val() , idPedido: $("#pedido").val() },
                       success: function (response) {
                                      var obj = $.parseJSON(response);                      
                                      //obj ? alert("MOVIMIENTO REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL MOVIMIENTO");                                      
                        }
                    });                            
            
                    
                }
       });

        alert("EL PEDIDO YA FUE PROCESADO EN ALMACEN");
 }






