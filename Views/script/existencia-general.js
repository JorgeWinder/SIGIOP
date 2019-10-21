

 $(document).ready(function () {


    $("#btnImprimir").prop("disabled","true");
    $("#BtnExport").prop("disabled","true");

    ListarTienda();

    // FECHA AUTOMÁTICA
    var d = new Date();
    var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2);
    $('#fecha').html("<u>" + n + "</u>");

    $('#btnConsultar').click(function(){
    
        getExistencia();
        $("#btnImprimir").prop("disabled","");
        $("#BtnExport").prop("disabled","");

    });

    $("#BtnExport").click(function(){ 

                  //var cc=$("#ComboCC option:selected").val();
                  var Fechaini=$("#Fechaini").val();
                  var Fechafin=$("#Fechafin").val();        
                  var idTienda=$("#cbotienda option:selected").attr("value");        

                   win=window.open("./Reportes/ExcelExistenciaGeneral.php?Fechaini=" + Fechaini + "&Fechafin=" + Fechafin + "&idTienda=" + idTienda , "_blank", "menubar=yes, scrollbars=yes, resizable=yes, top=300, left=500, width=400, height=20","false");                        
                    
    });


 });


 function getExistencia(){

  $("#detalleventa tr").remove();

			$.ajax({
                type: "GET",
                async: false,
                url: './api-sigop/Producto/getExistencia',
                //data:  { FechaInicio: $('#FechaInicio').val() , FechaFin: $('#FechaFin').val() },
                data:  { idTienda: $("#cbotienda option:selected").attr("value") },
                success: function (resultado) {                        
                    var obj = $.parseJSON(resultado);                    
                    $("#detalleventa").append(obj);  
                    alert("Reporte generado");
                    },
                    error: function (resultado) {
                        alert("Error");
                    }
        	});


}

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





