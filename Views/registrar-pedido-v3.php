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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/registrar-pedido-v3.js"></script>            
        
    </head>
    <body>

		<form>
		<?php require_once "plantillas/menu.html"; ?>                             
        

		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right"> 
					<h4>MÓDULO DE VENTAS Y PEDIDOS <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span> REGISTRAR PEDIDO</h4>
					<hr>
				</div>	
				
			</div>
			

			<!-- <div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="margin: 70px auto 0px; max-width: 100%;"> -->

					<!-- Inicio de formulario -->					
					

					<div class="row">

						<div class="col-lg-3">
							<div class="form-group">					
					    		<label for="exampleInputName2">PEDIDO NÚMERO :</label>		
		 						<input id="pedido" name='idPedido' class="form-control" readonly="true" placeholder="PEDIDO" style="width: 100%; background-color: #ffed9e;" type="text">	
								<input type="hidden" id="colaborador" value="<?php echo $_SESSION['idColaborador']; ?>">

							</div>

						</div>

						<div class="col-lg-5">
							<div class="form-group">
								<label for="exampleInputName2">CLIENTE :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span></span>	
		 							
		 							<input id="clientenom" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="">
		 							<input id="idcliente" type="hidden" value=""> 

		 							<!-- <input id="idcliente" class="form-control" placeholder="RUC DE CLIENTE" style="width: 100%;" type="number" value=""> -->
									

									<div id="busqueda" class="container text-right" style="position: fixed;width: 540px;z-index: 100;height: 250px;background: #293a4a;padding-top: 5px;margin-top: 40px;display: none;">
										<span class="badge badge-info" style="position: relative;top: 0;margin-bottom: 5px;"> <a id="cerrar" href="javascrpit:void()" onclick="VistaPanelBusqueda()" style="color: white"> X CERRAR</a> </span>
										<div class="form-group">
											<input id="cliente" class="form-control" placeholder="NOMBRE DE CLIENTE O NRO. DE DOCUMENTO" style="width: 100%; background-color: #ffed9e;" type="text" onkeyup='autocompletacliente()'>
											<ul id="autocliente" class="list-group"></ul> 	
										</div>										
									</div>

									
									<div id="panelnotas" class="container text-right" style="position: fixed;width: 540px;z-index: 100;height: 150px;background: #293a4a;padding-top: 5px;margin-top: 40px;display: none;">
										<span class="badge badge-info" style="position: relative;top: 0;margin-bottom: 5px;"> <a id="cerrar" href="javascrpit:void()" onclick="VistaPanelNotas()" style="color: white"> X CERRAR</a> </span>
										<div class="form-group">
											<textarea id="nota" placeholder="ESCRIBE UNA NOTA U OBSERVACIÓN PARA ESTE PEDIDO" class="form-control" maxlength="500" style="border: 1px solid #00953a !important;" rows="9"></textarea>	
										</div>										
									</div>

									<div id="panelentrega" class="container text-right" style="position: fixed;width: 540px;z-index: 100;height: 300px;background: #293a4a;padding-top: 5px;margin-top: 40px;display: none;">
										<span class="badge badge-info" style="position: relative;top: 0;margin-bottom: 5px;"> <a id="cerrardestino" style="color: white"> X CERRAR</a> </span>
										<div class="form-group">
											<input type="hidden" name="EstadoEntrega">
											<input class="form-control" type="text" name="Encargado" id="Encargado" placeholder='Nombre de encargado de entrega'>
										</div>
										<br>
										<br>
										<div class="form-group">
											<input class="form-control" type="text" name="Receptor" id="Receptor" placeholder='¿Quién recibirá el pedido?'>
										</div>
										
										<br>
										<br>
										<div class="form-group">
											<textarea id="Destino" name="Destino" placeholder="ESCRIBE LA DIRECIÓN Y/O DESTINO DEL PEDIDO" class="form-control" maxlength="140" style="border: 1px solid #00953a !important;" rows="4"></textarea>	
											<br><br>
											
										<br>
											<button id="btnGuardarEntrega" type="button" class="btn btn-warning" style="height: 50px;width: 100%; margin-top: 10px;">GRABAR DATOS PARA ENTREGA</button>											
										
										</div>	
								
									</div>

									<div id="panelacceso" class="container text-right" style="position: fixed;width: 540px;z-index: 100;top: 50px;background: #293a4a;padding-top: 5px;margin-top: 40px;display: none;">
										<span class="badge badge-info" style="position: relative;top: 0;margin-bottom: 5px;"> <a id="cerrar" href="#" onclick="VistaPanelAcceso()" style="color: white"> X CERRAR</a> </span>
										<div class="form-group  text-left">
											<label for="acceso" style="color: white;">INGRESE CONTRASEÑA PARA DESCUENTO</label>
											<input type="password" class="form-control" name="" id="acceso"><br>
											<label for="acceso" style="color: white;margin-top: 20px;">1. Presione la tecla "ENTER" para validar contraseña.</label><br>
											<label for="acceso" style="color: white;">2. Si la contraseña es valida, se registrará el pedido.</label>
											<br>											
										</div>										
									</div>


									<div id="panelaccesocv" class="container text-right" style="position: fixed;width: 540px;z-index: 100;top: 50px;background: #293a4a;padding-top: 5px;margin-top: 40px;display: none;">
										<span class="badge badge-info" style="position: relative;top: 0;margin-bottom: 5px;"> <a id="cerrar" href="#" onclick="document.querySelector('#panelaccesocv').style.display = 'none'; document.querySelector('#btnRegistrarPedido').disabled = false;" style="color: white"> X CERRAR</a> </span>
										<div class="form-group  text-left">
											<label for="accesocv" style="color: white;">INGRESE CONTRASEÑA PARA CLIENTE VARIOS</label>
											<input type="password" class="form-control" name="" id="accesocv"><br>
											<label for="accesocv" style="color: white;margin-top: 20px;">1. Presione la tecla "ENTER" para validar contraseña.</label><br>
											<label for="accesocv" style="color: white;">2. Si la contraseña es valida, se continuará el proceso registro.</label>
											<br>											
										</div>										
									</div>


 								</div> 									
							</div>

						</div>						

						<div class="col-lg-4 text-left " style="padding-top: 25px;">
							
							<button type="button" class="btn btn-default" onclick="VistaPanelBusqueda()">Buscar</button>
							<button id="nuevocli" type="button" class="btn btn-success">Nuevo cliente</button>
							<button id="vercli" type="button" class="btn btn-info">Ver datos</button>
						</div>
					</div>
				

					<div class="row">

						<div class="col-lg-4">
							<div class="form-group">
								<label for="exampleInputName2">TIENDA DE :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></span>	
		 							<input id="tienda" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="<?php echo $_SESSION['NombreTienda']; ?>">
									<input type="hidden" id="idtienda" value="<?php echo $_SESSION['idTienda']; ?>">
 								</div> 									
							</div>

						</div>

						<div class="col-lg-4">
							<div class="form-group">					
					    		<label for="exampleInputName2">FECHA DE PEDIDO :</label>		
		 						<input id="fechapedido" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="date">			
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label for="exampleInputName2">FECHA DE ENTREGA :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>	
		 							<input id="fechaentrega" class="form-control" placeholder="" style="width: 100%;" type="date">
									
 								</div> 									
							</div>
						</div>
						

					</div>

					<div class="row">
						<div class="col-lg-4 text-right" style="padding-top: 5px;">
												
					    		<label for="exampleInputName2">EMPRESA RESPONSABLE DEL PEDIDIDO :</label>		
		 					
						</div>
						<div class="col-lg-8">
							<div class="form-group">
								<select id="empresa" class="form-control">
									<option value="0">-- Selecciones empresa --</option>
					    			<option value="1" selected>SHANDONG TIANXIN TRADING COMPANY S.A.C.</option>
					    			<!-- <option value="2">PUBLIFACTORY S.A.C.</option> -->
					    		</select>		
							</div>										    				 					
						</div>

					</div>

					<div class="row">	

						<div class="col-lg-6 text-right" style="padding-top: 10px;">					
					    		<label for="exampleInputName2">DESPACHO A DOMICILIO  :</label>		
						</div>		
						<div class="col-lg-1 text-left" style="padding-top: 5px;">											
								<input type="checkbox" name="despacho" id="despacho" style="width:30px; height:30px;">
						</div>

						<div class="col-lg-2 text-right" style="padding-top: 10px;">	
					    		<label for="exampleInputName2">ESTADO DE PEDIDO :</label>		
		 					
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<input id="pedidostd" class="form-control" readonly="true" placeholder="" style="width: 100%;" type="text" value="">	
							</div>
							
						</div>
					</div>

<!-- 					<div class="row">
	<div class="col-lg-4 text-right" style="padding-top: 5px;">
		<div class="form-group">
			<label for="exampleInputName2">MONEDA : </label>
			<label class="checkbox-inline">
		  						<input type="checkbox" id="inlineCheckbox1" value="option1"> SOLES
			</label>
			<label class="checkbox-inline">
		 						<input type="checkbox" id="inlineCheckbox2" value="option2"> DÓLARES
			</label>
		</div>
	</div>			
	<div class="col-lg-5 text-left" style="">
		<form class="form-inline">
		  <div class="form-group text-right">
		    <label for="exampleInputName2">VALOR TIPO DE CAMBIO : </label>
                                                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" value="1.00" readonly="true">							  
                                </div>
		 </form> 
	</div>			
</div> -->
                                        
                    
                            <!-- Tabla de detalle -->        
                            <br><br>
                            
                            <fieldset>
                            <legend style="color:dimgrey; text-align: left;">DETALLE DE PEDIDO</legend>
                            <br>
                            
                                        <div class="form-group">
                                            <table id="tablapedido" class="table table-striped">
                                                <tr><td width="10">ID</td><td width="550">PRODUCTO</td><td width="100">CANTIDAD</td><td style="width: 9%;">P.UNIT</td><td style="width: 100px;">P.TOTAL</td><td style="width: 9%"></td><td style="width: 150px;"></td><td></td></tr>                                                
                                                <tr><td><label class='control-label'>1</label></td><td><input id='nompro1' type='text' placeholder='Ingresar producto' class='form-control' onkeyup='autocompleta(1)'><input type='hidden' id='codpro1' value=''>
                                                             <ul id='autoproducto1' class='list-group'></ul>
                                                    </td><td><input id="cantidad1" onchange='CalValTotal(1,this.value)' class="form-control" type="number" required maxlength="2" value="0"></td>
													<td>
														<!--<input id="preciounit1" class="form-control" value="0.00" readonly='true'>-->
														<select id="preciounit1" class="form-control"><option value="0">---</option></select>
													</td>
													
													<td><input id="total1" class="form-control" onkeyup="CalPreUnit(1,this.value)" onclick="CalPreUnit(1,this.value)" value="0.00" readonly="false">
														<input id='totalx1' type='hidden' value='0.00'><input id='stockmax1' type='hidden' value='0'>
													</td>
													<td><button class='btn btn-danger' id='BtnDelete'><span class='glyphicon glyphicon-minus' aria-hidden='true'></span> Eliminar</button></td>
													<td style='width: 150px;'>
														<div class='form-inline'><input id='Desct1' type='number' class="form-control"  value='0.00' style="width: 81px; margin-right: 10px;"><label for="Desct1"> DESC.</label></div>
														<!-- <div class='form-group'>
	                                						<div class='radio'><label><input id='Pormayor1' type='checkbox' value='1'> POR MAYOR</label>
	                                						</div>                                
                            							</div> -->
                                                    </td><td></td></tr>

                                            </table>


											<table id="tablapie" class="table table-striped">
                                                <tr>
                                                	
                                                	<td width="80" style="text-align: center;padding-top: 15px;">PAGO :</td>
                                                	<td width="30" style="text-align: right;padding-top: 15px;"><label>EFECTIVO</label></td>
                                                	<td width="120"><input id="MontoEfectivo" class="form-control" value="0.00"></td>
                                                	<td width="40" style="text-align: right;padding-top: 15px;"><label>DEPOSITO</label></td>
                                                	<td width="120">                                                		
                                                		<input id="MontoDeposito" class="form-control" value="0.00">
                                                	</td>
                                                	<td width="40" style="text-align: right;padding-top: 15px;"><label>SALDO</label></td>
                                                	<td width="120">                                                		
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
                            
                                        <button id="BtnAdd" class="btn btn-default" name="BtnAdd" type="button" style="padding: 4px;margin:4px; float: left" ><span style="float: left;padding:2px;"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> AGREGAR ELEMENTO</span></button>        
                            </fieldset>
							<br>	
            

                                        <!-- ----------------------- -->    
                            

						

                            
					<div class="row text-right">
						<div class="col-lg-11">


													<button id="btnAgregarNota" type="button" class="btn btn-default" onclick="VistaPanelNotas()" style="height: 50px;">OBSERVACIONES DE DESPACHO</button>       

                                                    <button id="btnRegistrarPedido" type="button" class="btn btn-success" style="height: 50px;">REGISTRAR PEDIDO</button>                                                                                                                        
													<button id="btnNuevo" type="button" class="btn btn-warning" style="height: 50px;">NUEVO PEDIDO</button>

													<br><br>
                                                    
						</div>	
										
					</div>	
					<!-- Fin de formulario -->
                                        
                                        
               <!-- </div>

				 <div class="col-lg-1"></div>
				
							</div> -->


		</div> 

	
        </form>
    </body>
</html>