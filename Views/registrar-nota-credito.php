<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, |choose Tools | Templates
and open the template in the editor.
-->
<?php  

    session_start(); 

    if(empty($_SESSION['idColaborador'])) {        
        echo '<script>  window.location.href = "'. URL . '/";</script>';
    } 

 ?>

<html>
    <head>
        <meta charset="UTF-8">
	<?php require_once "plantillas/cabecera.html"; ?>	
	<?php require_once "plantillas/cabecera-estilo.html"; ?>
        
        <!--Escript de vista-->
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/registrar-cobranza.js"></script>

        <script type="text/javascript">

        function PrintDiv(id) {
            var data=document.getElementById(id).innerHTML;
            var myWindow = window.open('', 'Imprimir comprobante', 'height=500,width=700');
            myWindow.document.write('<html><head><title>my div</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body style="font-family: tahoma;font-size: 11pt;width: 500px;">');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                myWindow.close();
            };
        }

        function PrintFinal() {
            
            var myWindow = window.open('<?php echo URL;?>/comprobante-print?pedido=' + $('#pedido').val(), 'Imprimir comprobante', 'height=500,width=700');
            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                //myWindow.print();
                //myWindow.close();
            };
        }        
        </script>        
        
    </head>
    <body> <INPUT type="password" name="prompt" />
		<?php require_once "plantillas/menu.html"; ?>        

<div id="myDiv" style="display: none;">
            <img src="#" width="1" />
            <br>
            SHANDONG TIANXIN TRADING COMPANY S.A.C.
            <br>
            AV. ISABEL LA CATOLICA NRO. 1100 URB. EL PORVENIR LIMA - LIMA - LA VICTORIA | RUC : 20601871387
            <br><br>
            <b>SERIE: TC6Y305660</b>
            <br>
            <b>NÚMERO DE PEDIDO: 1800001</b>
            <br>
            FECHA: 02/01/2018
            <br>
            CAJERO(A): DAVID MONTOYA
            <br>
            <br>
            RUC / DNI: 10453477342
            <br>
            NOMBRE: JORGE WINDER AVILA
            <br>
            TIPO CLIENTE: PERSONA NATURAL
            <br>
            <br>
            DESCRIPCIÓN&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TOTAL
            <br>
            ----------------------------------------------------------------------------------------
            PRODUCTO 1&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1.50 <br>
            PRODUCTO 2&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1.50 <br>
            PRODUCTO 3&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1.50 <br>
            PRODUCTO 4&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1.50 <br>
            PRODUCTO 5&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;1.50 <br>
            ----------------------------------------------------------------------------------------
            <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;OP. GRAVADA: 5.40 <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;IGV: 2.10 <br>
            ----------------------------------------------------------------------------------------
            <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>IMPORTE TOTAL: S/ 7.50 </b><br>
            <br><br><br><br><br><br>.
            
        </div>

    
        
		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right">
					<h4>MÓDULO DE COBRANZAS / CAJA <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span> REGISTRAR NOTA DE CREDITO</h4>
					<hr>
				</div>	
				
			</div>
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="margin: 70px auto 0px; max-width: 100%;">

					<!-- Inicio de formulario -->
					

					<div class="row">

						<div class="col-lg-3">
							<div class="form-group">					
					    		<label for="pedido">PEDIDO NÚMERO :</label>		
		 						<input id="pedido" class="form-control" placeholder="PEDIDO" style="width: 100%; background-color: #ffed9e;" type="text">			
							</div>
						</div>

						<div class="col-lg-3 text-left ">
							
							<div class="form-group">					
					    		<label for="exampleInputName2">RUC / DNI :</label>		
                                                        <input id="dni" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">			
							</div>
						</div>

						<div class="col-lg-5">
							<div class="form-group">
								<label for="exampleInputName2">CLIENTE :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span></span>	
                                                                        <input id="cliente" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">
									
 								</div>
								 
							</div>

						</div>


						<div class="col-lg-1" style="padding: 25px 10px 0 0;">
							<div class="form-group">					
								<button id="vercli" type="submit" class="btn btn-info" >Ver datos</button>  									
							</div>
						</div>



						

					</div>


					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">					
					    		<label for="exampleInputName2">PEDIDO ATENDIDO POR :</label>		
		 						<input id="atendido" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">
		 						<input type="hidden" id="idColaborador" value="">			
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label for="exampleInputName2">TIENDA DE :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></span>	
		 							<input id="nombretienda" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">
		 							<input type="hidden" id="idTienda" value="">	
 								</div> 									
							</div>

						</div>
                                            
                                                <div class="col-lg-3 text-left ">
							
							<div class="form-group">					
					    		<label for="exampleInputName2">ESTADO DE PEDIDO :</label>		
                                                        <input id="estado" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">			
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group" style="padding-top: 8px;">					
					    		<label for="exampleInputName2">EMPRESA RESPONSABLE DEL PEDIDIDO :</label>		
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<input id="empresa" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">		
								 									
							</div>


						</div>

                        <div class="col-lg-3 text-left ">
							
							<div class="form-group">					
					    		<label for="exampleInputName2">MONEDA :</label>		
                                                        <input id="nombres" readonly="true" class="form-control" placeholder="" style="width: 100%;background-color: #ccffd7" type="text" value="SOLES">			
							</div>
						</div>                                            
                                            
					</div>

					<div class="row">
						<div class="col-lg-4 text-right" style="padding-top: 5px;">
							<div class="form-group">
								<label>ESTADO DE COBRANZA</label>
							</div>							    				 				
						</div>
						<div class="col-lg-5">
							<div class="form-group">								
								<div class="form-group">
								<input id="EstadoCobro" class="form-control" readonly="true" placeholder="" style="width: 100%; background-color: #ebff96;" type="text" value="">	
								</div>		
							</div>										    				 					
						</div>
                                            
                                                <div class="col-lg-3 text-left ">
							
							<div class="form-group">					
					    		<!--<label for="exampleInputName2">VALOR CAMBIO:</label>-->		
                                                        <input id="nombres" readonly="true" class="form-control" placeholder="" style="width: 100%;background-color: #ccffd7;" type="text" value="1.00">			
							</div>
						</div>                                            

					</div>


					
                                       
                                        
                                        <!-- Tabla de detalle -->        
                            <br><br>
                            
                            <fieldset>
                            <legend style="color:dimgrey; text-align: left;">DETALLE DE PEDIDO</legend>
                            <br>
                            
                                        <div class="form-group">
                                            <table id="tablapedido" class="table table-striped">
                                                <tr><td width="10">ID</td><td width="450">PRODUCTO</td><td width="100">CANTIDAD</td><td style="width: 11%">P.UNIT</td><td style="width: 11%">P.TOTAL</td><td style="width: 9%">DESCUENTO</td><td style="width: 8%"></td><td></td><td></td><td></td></tr>                                                
                                                <!-- <tr><td><label class='control-label'>1</label></td><td><input id='Nombre1' type='text' class='form-control' readonly="true" value="PRODUCTO 1"></td><td><input class="form-control" type="number" required maxlength="2" readonly="true" value="1"></td><td><input class="form-control" value="1.50" readonly="true"></td><td><input class="form-control" value="1.50" readonly="true"></td><td></td><td></td><td></td><td></td><td></td></tr>
                                                <tr><td><label class='control-label'>2</label></td><td><input id='Nombre1' type='text' class='form-control' readonly="true" value="PRODUCTO 2"></td><td><input class="form-control" type="number" required maxlength="2" readonly="true" value="1"></td><td><input class="form-control" value="1.50" readonly="true"></td><td><input class="form-control" value="1.50" readonly="true"></td><td></td><td></td><td></td><td></td><td></td></tr>
                                                <tr><td><label class='control-label'>3</label></td><td><input id='Nombre1' type='text' class='form-control' readonly="true" value="PRODUCTO 3"></td><td><input class="form-control" type="number" required maxlength="2" readonly="true" value="1"></td><td><input class="form-control" value="1.50" readonly="true"></td><td><input class="form-control" value="1.50" readonly="true"></td><td></td><td></td><td></td><td></td><td></td></tr>
                                                <tr><td><label class='control-label'>4</label></td><td><input id='Nombre1' type='text' class='form-control' readonly="true" value="PRODUCTO 4"></td><td><input class="form-control" type="number" required maxlength="2" readonly="true" value="1"></td><td><input class="form-control" value="1.50" readonly="true"></td><td><input class="form-control" value="1.50" readonly="true"></td><td></td><td></td><td></td><td></td><td></td></tr>
                                                <tr><td><label class='control-label'>5</label></td><td><input id='Nombre1' type='text' class='form-control' readonly="true" value="PRODUCTO 5"></td><td><input class="form-control" type="number" required maxlength="2" readonly="true" value="1"></td><td><input class="form-control" value="1.50" readonly="true"></td><td><input class="form-control" value="1.50" readonly="true"></td><td></td><td></td><td></td><td></td><td></td></tr> -->
                                            </table>

                                            <table id="tablapie" class="table table-striped">
                                                <!-- <tr><td width="10"></td><td width="420"></td><td width="100"></td><td style="width: 8%;padding-top: 17px;">TOTAL : </td><td style="width: 11%"><input id="total" class="form-control" value="0.00" readonly="true"></td><td style="width: 9%"></td><td style="width: 8%"></td><td></td><td></td><td></td>
                                                </tr> -->

												<tr>
                                                	
                                                	<!-- <td width="80" style="text-align: center;padding-top: 15px;">PAGO :</td> -->
                                                	<td width="30" style="text-align: right;padding-top: 15px;"><label>EFECTIVO</label></td>
                                                	<td width="100"><input id="MontoEfectivo" class="form-control" value="0.00"></td>
                                                	<td width="40" style="text-align: right;padding-top: 15px;"><label>DEPOSITO</label></td>
                                                	<td width="100">                                                		
                                                		<input id="MontoDeposito" class="form-control" value="0.00">
                                                	</td>
                                                    <td width="40" style="text-align: right;padding-top: 15px;"><label>SALDO</label></td>
                                                    <td width="100">                                                        
                                                        <input id="MontoSaldo" class="form-control" value="0.00">
                                                    </td>
                                                	<td style="width: 8%;padding-top: 15px;">TOTAL : </td>
                                                	<td style="width: 11%">
                                                		<input id="total" class="form-control" value="0.00" readonly="true" value="0.00">
                                                	</td>
                                                	<td style="width: 22%"></td>
                                                </tr>

                                    		</table>

                                        </div> 
                            
                                        
                            </fieldset>

                                        <!-- ----------------------- -->    
                            <br>
					<div class="row text-right">
						<div class="col-lg-10">
                                                    <button id="btnRegistrarCobro" type="submit" class="btn btn-success" style="height: 50px;">REGISTRAR COBRANZA</button>

                                                    <button id="btnPedidoPorCob" type="submit" class="btn btn-warning" style="height: 50px;">PEDIDO POR COBRAR</button>


                                                    <button id="btnAnularCobro" type="submit" class="btn btn-danger" style="height: 50px;" onclick="AnularComprobante()">ANULAR COBRANZA</button>
                                                    

													<button id="btnImprimirCobro" type="button" onclick="PrintFinal()" class="btn btn-primary" style="height: 50px;">IMPRIMIR COMPROBANTE</button>

						</div>
						
					</div>	
					<!-- Fin de formulario -->
                                        
                                        
                                        
					<br><br>
				</div>
				<div class="col-lg-1"></div>
			</div>
			
		</div> 

		
        
    </body>
</html>