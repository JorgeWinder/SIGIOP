 
 $(document).ready(function () {

    getPedidos();            

    setInterval(function(){

       UltimoPedido();   
            	//alert("");                    
                
    },15000);

    // FECHA AUTOMÁTICA
    var d = new Date();
    var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2);
    $('#FechaPedido').val(n);

    $('#btnConsultar').click(function(){

      $("#pedidos div").remove();      
      getPedidos();

    });


 });



	var UPedido=0;
	var MaxPedido=0;	
	var pedido = [];


 function getPedidos(){

			$.ajax({
                type: "GET",
                async: false,
                url: './api-sigop/pedido/getPedidos',
                data:  { FechaPedido: $('#FechaPedido').val() },
                success: function (resultado) {                        
                    var obj = $.parseJSON(resultado);
                    
                   //alert(obj[0].idPedido);
                   //alert(obj[obj.length -1].idPedido);

                   	pedido = obj;
                   	cadena = "";

                   	//alert(pedido[pedido.length -1].idPedido);	
                   	MaxPedido=pedido[0].idPedido;

                    for (i=0;i<pedido.length;i++) {

                    	if(pedido[i].EstadoDespacho=="D"){

                    		cadena = cadena + '<div class="form-group"><button id="RegistrarMovimiento" type="submit" class="btn btn-default" style="height:50px;width: 15%;float: left;" disabled="true"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button><button id="pedido'+ pedido[i].idPedido +'" type="submit" class="btn btn-success" style="height: 50px;width: 85%;" onclick="VistaPedido('+ pedido[i].idPedido +')">PEDIDO: '+ pedido[i].idPedido +'</button></div>';	

                    	}else{

                        if(pedido[i].idPedido!=0){
                           cadena = cadena + '<div class="form-group"><button id="RegistrarMovimiento" type="submit" class="btn btn-default" style="height:50px;width: 15%;float: left;" onclick="AtenderPedido('+ pedido[i].idPedido +')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button><button id="pedido'+ pedido[i].idPedido +'" type="submit" class="btn btn-warning" style="height: 50px;width: 85%;" onclick="VistaPedido('+ pedido[i].idPedido +')">PEDIDO: '+ pedido[i].idPedido +'</button> </div>'; 
                           


                        }

                    		
                    	}

                    					
                    }

                    //$("#pedidos").prepend(cadena);
                    $("#pedidos").append(cadena);
                                        
                        /*var d = new Date();
                        var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2); */              

                        //alert(obj.Respuesta[0].FechaPedido);            
                    

                    },
                    error: function (resultado) {
                        alert("Error");
                    }
        	});


		}



function UltimoPedido(){

			$.ajax({
                type: "GET",
                async: false,
                url: './api-sigop/pedido/getPedidos',
                data:  { FechaPedido: $('#FechaPedido').val() },
                success: function (resultado) {                        
                   var obj = $.parseJSON(resultado);                             
                   UPedido = obj[0].idPedido;
                   cadena="";                   

			            if(UPedido>MaxPedido){

			            	cadena = cadena + '<div class="form-group"><button id="RegistrarMovimiento" type="submit" class="btn btn-default" style="height:50px;width: 15%;float: left;" onclick="AtenderPedido('+ UPedido +')"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></button><button id="pedido'+ UPedido +'" type="submit" class="btn btn-warning" style="height: 50px;width: 85%;" onclick="VistaPedido('+ UPedido +')">PEDIDO: '+ UPedido +'</button></div>';	

			            	$("#pedidos").prepend(cadena);
			            	MaxPedido = UPedido;

                           document.getElementById('audiopedido').play();
                           setTimeout(function(){
                              document.getElementById('audiopedido').play();
                           },5000);
                           setTimeout(function(){
                              document.getElementById('audiopedido').play();
                           },9000);


			            }

                    },
                    error: function (resultado) {
                        alert("Error");
                    }
        	});

}		

		

function AtenderPedido(pedido){

			if(confirm("¿CONFIRMA HABER DESPACHADO EL PEDIDO " + pedido + " ?")){

                    $.ajax({
                       type: "POST",
                       url: './api-sigop/pedido/setDespacho',
                       data:  {idPedido: pedido , EstadoDespacho: "D" },
                       success: function (response) {
                                     var obj = $.parseJSON(response);                                                                                                                                                   
                                     alert("PEDIDO " + pedido + " DESPACHADO")
                                     $("#pedido" + pedido).prop("class","btn btn-success");                                                                              
                        }
                    });
              

			}

}


