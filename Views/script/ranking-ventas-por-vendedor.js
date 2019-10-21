

 $(document).ready(function () {


    $("#btnImprimir").prop("disabled","true");
    $("#BtnExport").prop("disabled","true");

    // FECHA AUTOMÁTICA
    var d = new Date();
    var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2);
    $('#FechaInicio').val(n);
    $('#FechaFin').val(n);

    $('#btnConsultar').click(function(){
    
        getExistencia();
        $('#fechai').html("<u>" + $('#FechaInicio').val() + "</u>");
        $('#fechaf').html("<u>" + $('#FechaFin').val() + "</u>");
        $("#btnImprimir").prop("disabled","");
        $("#BtnExport").prop("disabled","");

    });

    $("#BtnExport").click(function(){ 

        //var cc=$("#ComboCC option:selected").val();
        var Fechaini=$("#FechaInicio").val();
        var Fechafin=$("#FechaFin").val();        

         win=window.open("./Reportes/ExcelRankingVentasPorVendedor.php?FechaInicio=" + Fechaini +"&FechaFin="+ Fechafin , "_blank", "menubar=yes, scrollbars=yes, resizable=yes, top=300, left=500, width=400, height=20","false");                        
          
    });

 });


 function getExistencia(){

  $("#detalleventa tr").remove();

			$.ajax({
                type: "GET",
                async: false,
                url: './api-sigop/ranking/vendedores',
                data:  { FechaInicio: $('#FechaInicio').val() , FechaFin: $('#FechaFin').val() },
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






