 $(document).ready(function () {

	CargarComboTipoMovimiento();
    setMoviento();
    
    ListarTienda();
    
    $("#cbotiendades").prop("disabled","true");

    $("#btnNuevoMovimiento").click(function(){

        $("#nompro").val("");    
        $("#categoria").val("");
        $("#stock").val("0");
        LimpiarTabla();
        $("#tipomovimiento option:selected").attr("value")==$("#tipomovimiento").val("0");
        
    });

    $("#tipomovimiento").change(function(){

        $("#valorcompra").val("0.00");
        $("#stock").val("0");

        if($("#tipomovimiento option:selected").attr("value")==6){
            $("#etiquetadoc").text("NÚMERO GUIA REMISIÓN :");
            $("#cbotiendades").prop("disabled","");
            $("#valorcompra").prop("disabled","true");
            $("#guia").prop("disabled","");
            
        }else if($("#tipomovimiento option:selected").attr("value")==1){            
            $("#etiquetadoc").text("NÚMERO DOC.COMPRA :");
            $("#valorcompra").prop("disabled","");
            $("#guia").prop("disabled","");            
        }else{
            $("#cbotiendades").prop("disabled","true");   
            $("#etiquetadoc").text("NÚMERO GUIA / DOC.COMPRA  :");         
            $("#guia").prop("disabled","true");
            $("#valorcompra").prop("disabled","true");
        }

    });



 });

   	function CargarComboTipoMovimiento() {
                $.ajax({
                    type: "GET",
                    url: './api-sigop/tipomovimiento/getTipo',
                    //scriptCharset: "utf-8",
                    success: function (resultado) {                        
                        var obj = $.parseJSON(resultado);
                        //alert(obj);
                        $("#tipomovimiento").append(obj);
                    },
                    error: function (resultado) {
                        alert("Error");
                    }
                });
    }



//BUSQUEDA AUTOCOMPLETADO PRODUCTO

 function autocompleta(){	 		         
        
        if($("#nompro").val()!="")
        {

            $.ajax({
               type: "POST",
               url: './api-sigop/producto/busqueda',
               data:  {NombreProducto: $("#nompro").val() , idTienda: $("#idtienda").val() },
               success: function (response) {
                              var obj = $.parseJSON(response);             
                              $("#autoproducto").css("display","block");                 
                              $("#autoproducto li").remove();
                              		for (var i = 0; i < obj.length; i++) {
                              			html="<a href='javascript:setProducto("+ i +","+ obj[i].idProducto.toString() +",\"" + obj[i].NombreProducto.toString() + "\"," + obj[i].PrecioVenta.toString() + ",\"" + obj[i].NombreCategoria + "\")' style='text-decoration:none;'><li class='list-group-item'>" + obj[i].idProducto.toString() + " - " + obj[i].NombreProducto.toString() + " <span class='badge'>STOCK : " + obj[i].getStock.toString() + "</span></li></a>";
                                    	$("#autoproducto").append(html);	                                    
                              		}
                    }
            });	 

        }else{ $("#autoproducto li").remove(); $("#codproducto").val("");}


 }

  function setProducto(item,cod,nombre,preciounit,categoria){

    $("#autoproducto").css("display","none");
    $("#codproducto").val(cod);
    $("#nompro").val(nombre);    
    $("#categoria").val(categoria);
    $("#stock").val("0");
    $("#stock").focus();

    getMovientos(cod);

    //$("#nompro").prop("readonly",true);  
    //$("#preciounit" + item).val(preciounit.toFixed(2));
    //var total = parseFloat($("#cantidad" + item).val()).toFixed(2) * parseFloat($("#preciounit" + item).val()).toFixed(2);
    //$("#total" + item).val(total.toFixed(2));
	//CalValTotalGeneral();


 }

 function setMoviento(){

 	$("#RegistrarMovimiento").click(function(){		 
            
	 	if($("#codproducto").val()!="" && $("#stock").val() > 0){

                    if($("#tipomovimiento option:selected").attr("value")==1 || $("#tipomovimiento option:selected").attr("value")==2 || $("#tipomovimiento option:selected").attr("value")==3 || $("#tipomovimiento option:selected").attr("value")==4 || $("#tipomovimiento option:selected").attr("value")==10 || $("#tipomovimiento option:selected").attr("value")==11 )
                    {
                        StockMoviento= 1 * $("#stock").val();

                        RegistrarMovimientoAlmacen($("#tipomovimiento option:selected").attr("value"), $("#idtienda").val(), StockMoviento, $("#codproducto").val(), $("#colaborador").val(), $("#guia").val(), 0, $("#valorcompra").val());

                    }else if($("#tipomovimiento option:selected").attr("value")==6){

                        StockMoviento= -1 * $("#stock").val();

                        RegistrarMovimientoAlmacen($("#tipomovimiento option:selected").attr("value"), $("#idtienda").val(), StockMoviento, $("#codproducto").val(), $("#colaborador").val(), $("#guia").val(), $("#cbotiendades option:selected").attr("value"), '');
                        RegistrarMovimientoAlmacen(7, $("#cbotiendades option:selected").attr("value"), (StockMoviento * -1 ), $("#codproducto").val(), $("#colaborador").val(), $("#guia").val(), '', '');
                    
                    }else{

                        StockMoviento= -1 * $("#stock").val();
                        RegistrarMovimientoAlmacen($("#tipomovimiento option:selected").attr("value"), $("#idtienda").val(), StockMoviento, $("#codproducto").val(), $("#colaborador").val(), $("#guia").val(), $("#idtienda").val(), '');
                    }

                    

	 	}else{ alert("FLATAN COMPLETAR DATOS"); }
		 		

 	});

}

function RegistrarMovimientoAlmacen(tipomovimiento, origen, StockMoviento, idProducto, idColaborador, GuiaRemision, idTiendaDestino, ValorCompra){

    //data:  {idTipoMovimiento: $("#tipomovimiento option:selected").attr("value") , idTienda: $("#idtienda").val() , StockMoviento: StockMoviento , idProducto: $("#codproducto").val() , idColaborador: $("#colaborador").val() },

    if(confirm("¿CONFIRMA REGISTRAR EL MOVIEMIENTO EN EL ALMACEN?")){
        
        $.ajax({
            type: "POST",
            url: './api-sigop/MovimientoAlmacen/add',
            data:  {idTipoMovimiento: tipomovimiento , idTienda: origen , StockMoviento: StockMoviento , idProducto: idProducto , idColaborador: idColaborador, GuiaRemision: GuiaRemision, idTiendaDestino: idTiendaDestino, ValorCompra: ValorCompra },
            success: function (response) {
                        var obj = $.parseJSON(response);                      
                        obj ? alert("MOVIMIENTO REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL MOVIMIENTO");
                            getMovientos($("#codproducto").val());
                }
        });
    
    }
        
    
}


 function getMovientos(cod){
     
                //alert($("#idtienda").val());

                $("#tablapedido tr").remove();
                $("#tablapedido thead").append("<tr><td style='width: 350px;'>PRODUCTO</td><td style='width: 10px;'>STOCK</td><td style='width: 150px;'>MOVIMIENTO</td><td style='width: 50px;'>FECHA MOV.</td><td style='width: 50px;'>TIENDA DESTINO</td><td style='width: 50px;'></td>");

                $.ajax({
                    type: "GET",
                    url: './api-sigop/MovimientoAlmacen/getMovimientos',
                    //scriptCharset: "utf-8",
                    data:  { idProducto: cod , idTienda: $("#idtienda").val() },
                    success: function (resultado) {                        
                        var obj = $.parseJSON(resultado);
                        //alert(obj);                      
                        $("#tablapedido tbody").append(obj);

                    },
                    error: function (resultado) {
                        alert("Error");
                    },
                    complete: function(data) {
                        
                        const detalle = $('#tablapedido tbody tr');

                        $.each(detalle, function (index, value) {

                            let idmov = $(this).children('td').eq(0).children('input').val()
                            let fila = $(this)

                            $(this).children('td').eq(5).children('button').eq(0).click( function(){

                                if(confirm('Confirma eliminar movimiento?')){
                                    //alert(idmov)

                                    $.ajax({
                                        type: "POST",
                                        url: './api-sigop/MovimientoAlmacenID/delete',
                                        data:  {idMovimientoAlmacen: idmov },
                                        success: function (response) {
                                                    var obj = $.parseJSON(response);                      
                                                    obj ? alert("Movimiento eliminado: " + idmov) : alert("HUBO PROBLEMAS AL ELIMINAR EL MOVIMIENTO");
                                                      
                                            },
                                        complete: function(data) {
                                            fila.remove()
                                        }
                                    });

                                }

                               
                            })
                        });

                        // detalle.forEach(element => {
                        //     element.children[5].querySelector('button').addEventListener('click', function(){
                        //          alert(element.children[0].querySelector('input').value)
                        //     })
                        // });
                    }
                });

}


function LimpiarTabla(){

                  $("#tablapedido tr").each(function (index) {
                      if (index > 0)
                      {
                        $(this).remove();
                      }
                  });

}

function ListarTienda(){

    $.ajax({
      type: "GET",
      url: './api-sigop/area/ListarTienda',			           
      success: function (response) {
                     var obj = $.parseJSON(response);                      
                     $("#cbotiendades").append(obj);
          }
    });

}



 
document.addEventListener("DOMContentLoaded", function(){


    (async function Load(){

        async function getData(url){

            const response = await fetch(url);
            const data = await response.json();
            return data;
  
        }
  
        async function postData(url, form){
  
              const response = await fetch(url,
                {
                  method: "POST",
                  body: form
                }
                );    
                const data = await response.json();              
                return data;                          
        }


       // ------------------ Funciones --------------- // 




       
        

       // ------------------ Eventos --------------- // 

       

       

       // Bloqueo de submit en inputs al presionar enter

       const inputs = document.querySelectorAll("form")

       inputs.forEach(element => {
           element.addEventListener("keypress",function(e){
               var keyCode = e.keyCode || e.which;
               if (keyCode === 13) { 
                   e.preventDefault();
                   return false;
               }
           })    
       });




    })()


})

