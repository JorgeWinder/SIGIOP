<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, |choose Tools | Templates
and open the template in the editor.
-->

<?php  

    session_start(); 

 ?>

<html>
    <head>
        <meta charset="UTF-8">
	<?php require_once "plantillas/cabecera.html"; ?>	
	<?php require_once "plantillas/cabecera-estilo.html"; ?>
        
        <!--Escript de vista-->
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/comprobante-print.js"></script>

        <script type="text/javascript">
        
$(document).ready(function () {

            $('#pedidoval').val("<?php echo $_REQUEST["pedido"];?>");
            ConsultarPedido($('#pedidoval').val());
            
            setTimeout(function(){
                window.print();                
            },2000);
            
            
 });


function ConsultarPedido(idPedido){


        $.ajax({
                type: "GET",
                url: './api-sigop/pedido/VistaPrint',
                data:  { idPedido: idPedido  },
                success: function (resultado) {                        
                    var obj = $.parseJSON(resultado);
                    
                    if(obj.Respuesta[0].Filas>0){                    

                        $('#idpedido').text($('#pedidoval').val());

                        /*var d = new Date();
                        var n = d.getFullYear() + "-" + ("0" + (d.getMonth() + 1)).slice(-2) + "-" + ("0" + (d.getDate())).slice(-2); */              

                        //alert(obj.Respuesta[0].FechaPedido);    

                        $('#fecha').text(obj.Respuesta[0].FechaPedido);

                        $('#nombretienda').text(obj.Respuesta[0].NombreTienda);
                        $('#cliente').text(obj.Respuesta[0].RazonSocial); 
                        $('#dni').text(obj.Respuesta[0].RucDnICL); 
                        $('#atendido').text(obj.Respuesta[0].NombresCol); 
                        $('#estado').text(obj.Respuesta[0].EstadoPedido); 
                        $('#empresa').text(obj.Respuesta[0].NombreEmpresa); 
                        $('#Nota').html(obj.Respuesta[0].Nota); 
                        $('#lblEncargado').html(obj.Respuesta[0].Encargado); 
                        $('#lblDestino').html(obj.Respuesta[0].Destino); 

                        //alert(obj.Respuesta[0].Nota);
                        $("#detallepedido").append(obj.Respuesta[0].detalle.toString());

                        CalValTotalGeneral();

                    }
                    

                    },
                    error: function (resultado) {
                        alert("Error");
                    }
        });


} 


  function CalValTotalGeneral(){

                sum=0.00; 


                for(i=1;i<=$("#detallepedido .row").length;i++){

                        sum = sum + (parseFloat($("#precio" + i).text()).toFixed(2) - parseFloat($("#Desct" + i).val()).toFixed(2));
                        //sum = sum + parseFloat($("#precio" + i).text());
                        //alert(sum);                    
                }
                

                $("#total").text(sum.toFixed(2));

 }              



        </script>

    </head>
    <body style="font-size: 8pt;>">

        <input type="hidden" id="pedidoval" value="">

            <br>
            SHANDONG TIANXIN TRADING COMPANY S.A.C.
            <br>
            AV. ISABEL LA CATOLICA NRO. 1100 URB. EL PORVENIR LIMA - LIMA - LA VICTORIA | RUC : 20601871387
            <br><br>
            <!-- <b>SERIE: -</b> -->
            <br>
            <b><span style="font-size: 18pt;">NOTA DE PEDIDO: <label id='idpedido'></label></span></b>
            <br>
            FECHA: <label id='fecha'></label>
            <br>
            CAJERO(A): <label id='Cajero'><?php echo $_SESSION['Nombres'];?></label>
            <br>
            <br>
            VENDEDOR: <label id='atendido'></label>
            <br>
            TIENDA: <label id='nombretienda'></label>
            <br>
            <br>
            RUC / DNI: <label id='dni'></label> 
            <br>
            NOMBRE: <label id='cliente'></label>
            <br>
            TIPO CLIENTE: PERSONA NATURAL
            <br>
            <br>
        <div class="container-fluid">
                <div class="row" style="width: 100%;">
                   <div class="col-xs-9">DESCRIPCIÓN</div>
                   <div class="col-xs-3 text-right">TOTAL</div>
               </div>
        </div>
        
        <br>
        
        <div class="container-fluid">                
               <div class="row" style="width: 100%;border-top: 1px black solid;border-top-style: dashed;">
                   <div class="col-xs-12"></div>                   
               </div>
        </div>


    	<div id="detallepedido" class="container-fluid">
               
        </div>

        <div class="container-fluid">                
               <div class="row" style="width: 100%;border-top: 1px black solid;border-top-style: dashed;">
                   <div class="col-xs-12"></div>                   
               </div>
        </div>     

        <br>

        <div class="container-fluid">                
               <div class="row" style="width: 100%;">
                   <div class="col-xs-12 text-right">IMPORTE TOTAL S/ : <label id="total"> 0.00 </label> </div>                   
               </div>
        </div> 

        <br>

        <div class="container-fluid">  
            <div class="row" style="width: 100%;">
                       <div class="col-xs-12"><b>OBSERVACIONES </b></div>                               
            </div>
        </div>

        <div class="container-fluid">                
               <div class="row" style="width: 100%;">
                   <div class="col-xs-9" style="font-size: 8pt;border-top: 1px black solid;border-top-style: dashed;">
                    <label id='Nota'></label>
                </div>                   
               </div>
        </div>

         <br>

         <div class="container-fluid">  
            <div class="row" style="width: 100%;">
                       <div class="col-xs-12"><b>ENTREGA DE PEDIDO </b></div>                               
            </div>
        </div>

        <div class="container-fluid">                
               <div class="row" style="width: 100%;">
                   <div class="col-xs-9" style="font-size: 8pt;border-top: 1px black solid;border-top-style: dashed;">
                   <br> 
                    Encargado: <label id='lblEncargado'></label> <br>
                    Dirección: <label id='lblDestino'></label> <br><br>
                </div>                   
               </div>
        </div>   

    </body>
</html>    