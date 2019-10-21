
 var formatNumber;

 $(document).ready(function () {

    ListarTienda();

    $("#btnImprimir").prop("disabled","true");
    $("#BtnExport").prop("disabled","true");

    // FECHA AUTOMÁTICA
    var d = new Date();
    var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2);
    $('#FechaInicio').val(n);
    $('#FechaFin').val(n);

    $('#btnConsultar').click(function(){
    
        getVentas();
        $("#btnImprimir").prop("disabled","");
        $("#BtnExport").prop("disabled","");

    });

    $("#BtnExport").click(function(){ 

        var idTienda=$("#cbotienda option:selected").val();
        var Fechaini=$("#FechaInicio").val();
        var Fechafin=$("#FechaFin").val();        

         win=window.open("./Reportes/ExcelReporteDeVentas.php?FechaInicio=" + Fechaini + "&FechaFin="+ Fechafin + "&idTienda="+ idTienda , "_blank", "menubar=yes, scrollbars=yes, resizable=yes, top=300, left=500, width=400, height=20","false");                        
          
    });

    // Formato decimales reporte

    formatNumber = {
             separador: ",", // separador para los miles
             sepDecimal: '.', // separador para los decimales
             formatear:function (num){
                 num +='';
                 var splitStr = num.split('.');
                 var splitLeft = splitStr[0];
                 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                 var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                return this.simbol + splitLeft +splitRight;
             },
             new:function(num, simbol){
             this.simbol = simbol ||'';
             return this.formatear(num);
             }
    }


 });


 function getVentas(){


    $("#efectivo").text("0.00");
    $("#deposito").text("0.00");
    $("#saldo").text("0.00");
    $("#total").text("0.00");    
    

    $("#detalleventa tr").remove();

			$.ajax({
                type: "GET",
                async: false,
                url: './api-sigop/pedido/getVentas',
                data:  { FechaInicio: $('#FechaInicio').val() , FechaFin: $('#FechaFin').val() , idTienda:  $("#cbotienda option:selected").attr("value") },
                success: function (resultado) {                        
                    var obj = $.parseJSON(resultado);

                    //alert(obj.Respuesta[0].Filas + "DF");

                    if(obj.Respuesta[0].Filas>0){
                        
                        $("#detalleventa").append(obj.Respuesta[0].detalle.toString());
                        //Get total reporte
                        $("#efectivo").text(formatNumber.new(obj.Respuesta[0].efectivo.toFixed(2)).toString());
                        $("#deposito").text(formatNumber.new(obj.Respuesta[0].deposito.toFixed(2)).toString());
                        $("#saldo").text(formatNumber.new(obj.Respuesta[0].saldo.toFixed(2)).toString());
                        $("#total").text(formatNumber.new(obj.Respuesta[0].total.toFixed(2)).toString());
                        
                        $('#finicio').html("<u>" + $('#FechaInicio').val() +  "</u>");
                        $('#ffin').html("<u>" + $('#FechaFin').val() +  "</u>");

                        $("#tienda").html("<u>" + $("#cbotienda option:selected").text() +  "</u>");

                        alert("REPORTE GENERADO");

                    }
                                                                            
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




