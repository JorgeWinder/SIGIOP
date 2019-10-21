 $(document).ready(function () {


 	/*Validar caracteres de los controles*/
// 	ValLetras('#RS');	
// 	ValNumeros("#Ruc");


 	$("#registrar").click(function(){ 		 
            
	 			if( $("select option:selected").attr("value") > 0  && $("#Ruc").val()!="" && $("#RS").val()!=""){

	 				$.ajax({
			           type: "POST",
			           url: './api-sigop/cliente/add',
			           data:  {RucDnICL: $("#Ruc").val() , idTipoCliente: $("#TipoCL option:selected").attr("value") , RazonSocial: $("#RS").val().toUpperCase() , correo: $("#correo").val().toUpperCase() , Telefono: $("#telefono").val() , idDistrito: $("#distrito option:selected").attr("value") , direccion: $("#direccion").val().toUpperCase() , NombresContac: $("#NombresContac").val().toUpperCase() , DirEntrega: $("#DirEntrega").val().toUpperCase() , NomMedioTransp: $("#NomMedioTransp").val().toUpperCase() , OtrosApuntes: $("#OtrosApuntes").val().toUpperCase() },
			           success: function (response) {
			                          var obj = $.parseJSON(response);                      
			                          obj ? alert("CLIENTE REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL CLIENTE");
		           		}
		         	});

	 			}else{ alert("FLATAN COMPLETAR DATOS"); }
		 		

		/*var imp =  $("#Ruc").val() + "  - " + $("#TipoCL option:selected").attr("value") + " - " + $("#RS").val().toUpperCase() + " - " + $("#correo").val().toUpperCase() + " - " + $("#telefono").val() + "  - " + $("#provincia option:selected").attr("value") + "  - " + $("#distrito option:selected").attr("value") + "  - " + $("#direccion").val().toUpperCase();

         alert(imp);
*/

	 });

	 
 	$("#modificar").click(function(){ 		 
            
		if( $("select option:selected").attr("value") > 0  && $("#Ruc").val()!="" && $("#RS").val()!=""){

			$.ajax({
			  type: "POST",
			  url: './api-sigop/cliente/update',
			  data:  {RucDnICL: $("#Ruc").val() , idTipoCliente: $("#TipoCL option:selected").attr("value") , RazonSocial: $("#RS").val().toUpperCase() , correo: $("#correo").val().toUpperCase() , Telefono: $("#telefono").val() , idDistrito: $("#distrito option:selected").attr("value") , direccion: $("#direccion").val().toUpperCase() },
			  success: function (response) {
							 var obj = $.parseJSON(response);                      
							 obj ? alert("LOS DATOS DEL CLIENTE FUERON MODIFICADOS") : alert("HUBO PROBLEMAS AL CAMBIAR REGISTRO DEL CLIENTE");
				  }
			});

		}else{ alert("FLATAN COMPLETAR DATOS"); }		

	});	 

	 $("#Ruc").keydown(function (e , index) {
                
		if (e.which == 13) {

			$.ajax({
				type: "GET",
				url: './api-sigop/cliente/dni',
				data:  {RucDnICL: $("#Ruc").val() },
				success: function (response) {
							   var obj = $.parseJSON(response);                      							   
								if(eval(obj[0].RucDnICL)){									
									$("#TipoCL option:selected").attr("value")==$("#TipoCL").val(obj[0].idTipoCliente);
									$("#RS").val(obj[0].RazonSocial);
									$("#correo").val(obj[0].correo);
									$("#telefono").val(obj[0].Telefono);
									$("#provincia option:selected").attr("value")==$("#provincia").val("1");
									$("#distrito option:selected").attr("value")==$("#distrito").val(obj[0].idDistrito);
									$("#direccion").val(obj[0].direccion);

									$("#NombresContac").val(obj[0].NombresContac);
									$("#DirEntrega").val(obj[0].DirEntrega);
									$("#NomMedioTransp").val(obj[0].NomMedioTransp);
									$("#OtrosApuntes").val(obj[0].OtrosApuntes);																		
									
									$("#registrar").prop("disabled","true");

								}else{ alert("EL CLENTE NO EXISTE"); }								   
					}
			  });
			
		 }

	});	 


});