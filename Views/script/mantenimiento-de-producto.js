	

 $(document).ready(function () {


 /*Validar caracteres de los controles*/
// 	ValLetras('#RS');	
// 	ValNumeros("#Ruc");


 	$("#registrar").click(function(){ 		 
            
	 			if( $("select option:selected").attr("value") > 0 ){

	 				$.ajax({
			           type: "POST",
			           url: './api-sigop/producto/add',
			           data:  {idProducto: $("#idProducto").val() , idCategoriaProducto: $("#idCategoriaProducto option:selected").attr("value") , UniMedida: $("#UniMedida option:selected").attr("value") , NombreProducto: $("#NombreProducto").val().toUpperCase() , PrecioVenta: $("#PrecioVenta").val() , PrecioxMayor: $("#PrecioxMayor").val() ,  StockMini: $("#StockMini").val() , PrecioVenta2: $("#PrecioVenta2").val() , PrecioVenta3: $("#PrecioVenta3").val() },
			           success: function (response) {
			                          var obj = $.parseJSON(response);                      

                                       $("#idProducto").val(obj.Respuesta[0].Id);                                       
                                       alert("PRODUCTO " + obj.Respuesta[0].Id + ", REGISTRADO"); 
			                          //obj ? alert("PRODUCTO REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL PRODUCTO");
		           		}
		         	});

	 			}else{ alert("FLATAN COMPLETAR DATOS"); }
		 		

     });
     

     $("#modificar").click(function(){ 		 
            
        if( $("select option:selected").attr("value") > 0 ){

            $.ajax({
              type: "POST",
              url: './api-sigop/producto/update',
              data:  {idProducto: $("#idProducto").val() , idCategoriaProducto: $("#idCategoriaProducto option:selected").attr("value") , UniMedida: $("#UniMedida option:selected").attr("value") , NombreProducto: $("#NombreProducto").val().toUpperCase() , PrecioVenta: $("#PrecioVenta").val() , PrecioxMayor: $("#PrecioxMayor").val() ,  StockMini: $("#StockMini").val() , PrecioVenta2: $("#PrecioVenta2").val() , PrecioVenta3: $("#PrecioVenta3").val() },
              success: function (response) {
                             var obj = $.parseJSON(response);                      

                             alert("PRODUCTO MODIFICADO");
                              //$("#idProducto").val(obj.Respuesta[0].Id);                                       
                              //alert("PRODUCTO " + obj.Respuesta[0].Id + ", REGISTRADO"); 
                             //obj ? alert("PRODUCTO REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL PRODUCTO");
                  }
            });

        }else{ alert("FLATAN COMPLETAR DATOS"); }
        

     });

     // KEY COD. PRODUCTO

     $("#idProducto").keydown(function (e , index) {
                
		if (e.which == 13) {

			$.ajax({
				type: "GET",
				url: './api-sigop/producto/codigo',
				data:  {idProducto: $("#idProducto").val() },
				success: function (response) {
							   var obj = $.parseJSON(response);                      							   
								if(eval(obj[0].idProducto)){									
									$("#TipoCL option:selected").attr("value")==$("#TipoCL").val(obj[0].idTipoCliente);
									$("#RS").val(obj[0].RazonSocial);
                                    $("#correo").val(obj[0].correo);

                                    $("#idCategoriaProducto option:selected").attr("value")==$("#idCategoriaProducto").val(obj[0].idCategoriaProducto); 
                                    $("#UniMedida option:selected").attr("value")==$("#UniMedida").val(obj[0].UniMedida); 
                                    $("#NombreProducto").val(obj[0].NombreProducto); 
                                    $("#PrecioVenta").val(obj[0].PrecioVenta);
                                    $("#PrecioxMayor").val(obj[0].PrecioxMayor);
                                    $("#StockFinal").val(obj[0].StockFinal);
                                    $("#PrecioVenta2").val(obj[0].PrecioVenta2);
                                    $("#PrecioVenta3").val(obj[0].PrecioVenta3);   
                                    $("#StockMini").val(obj[0].StockMini)                                                                   

									$("#registrar").prop("disabled","true");

								}else{ alert("EL PRODUCTO NO EXISTE"); }								   
					}
			  });
			
		 }

	});	



 	CargarComboTipoProducto();
 	
 	
    document.querySelector("#PrecioVenta").value = 0.00
    document.querySelector("#PrecioxMayor").value = 0.00
    
    document.querySelector("#StockFinal").value = 0.00
    document.querySelector("#PrecioVenta2").value = 0.00
    document.querySelector("#PrecioVenta3").value = 0.00
    document.querySelector("#StockMini").value = 0.00
    

});



  	function CargarComboTipoProducto() {
                $.ajax({
                    type: "GET",
                    url: './api-sigop/producto/getTipo',
                    //scriptCharset: "utf-8",
                    success: function (resultado) {                        
                        var obj = $.parseJSON(resultado);
                        //alert(obj);
                        $("#idCategoriaProducto").append(obj);
                    },
                    error: function (resultado) {
                        alert("Error");
                    }
                });
    }