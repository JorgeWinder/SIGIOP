$(document).ready(function () {


 	/*Validar caracteres de los controles*/
	//ValLetras('#nombres');
	//ValLetras('#apellidos');	
	//ValNumeros("#iddocumento");


 	$("#btnRegistrarColaborador").click(function(){ 		 
                       
            //alert($("#sexo option:selected").attr("value") + $("#correo").val().toUpperCase());

	 			if( $("#iddocumento").val()!=""){

	 				$.ajax({
			           type: "POST",
			           url: './api-sigop/colaborador/add',
			           data:  {idColaborador: $("#iddocumento").val() , idTienda:  $("#cbotienda option:selected").attr("value") , idArea:  $("#cboarea option:selected").attr("value") , Nombres: $("#nombres").val().toUpperCase() , Apellidos: $("#apellidos").val().toUpperCase()  , Correo: $("#correo").val().toUpperCase() },
			           success: function (response) {
			                          var obj = $.parseJSON(response);                      
			                          obj ? alert("COLABORADOR REGISTRADO") : alert("HUBO PROBLEMAS AL REGISTAR EL COLABORADOR");
		           		}
		         	});

	 			}else{ alert("FLATAN COMPLETAR DATOS"); }
		 		


 	});


	$("#btnNuevoAlumno").click(function(){ 		 
		$("#iddocumento").val("");
		$("#nombres").val("");
		$("#apellidos").val("");		
		$("#correo").val("");
	});	


	ListarTienda();
	ListarArea();


});


function ListarTienda(){

	 				$.ajax({
			           type: "GET",
			           url: './api-sigop/area/ListarTienda',			           
			           success: function (response) {
			                          var obj = $.parseJSON(response);                      
			                          $("#cbotienda").append(obj);
		           		}
		         	});

}


function ListarArea(){

					$.ajax({
			           type: "GET",
			           url: './api-sigop/area/ListarArea',			           
			           success: function (response) {
			                          var obj = $.parseJSON(response);                      
			                          $("#cboarea").append(obj);
		           		}
		         	});

}


