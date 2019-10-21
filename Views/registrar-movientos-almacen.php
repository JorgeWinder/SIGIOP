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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/registrar-movientos-almacen.js"></script>       
              
        
    </head>
    <body>
		<?php require_once "plantillas/menu.html"; ?>                             
        

		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right"> 
					<h4>MÓDULO DE ALMACEN <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span> REGISTRAR MOVIMIENTOS DE ALMACEN</h4>
					<hr>
				</div>	
				
			</div>

			


			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-12" style="margin: 70px auto 0px; max-width: 100%;">

					<!-- Inicio de formulario -->					

					<div class="row">

						<div class="col-lg-4">
							<div class="form-group">					
					    		<label for="exampleInputName2">TIENDA :</label>		                                                        
							<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></span>	
		 							<input id="nombretienda" class="form-control" style="width: 100%; background-color: #ffed9e;" type="text" readonly="true" value="<?php echo $_SESSION['NombreTienda'];?>">			
									<input type="hidden" id="idtienda" value="<?php echo $_SESSION['idTienda'];?>">
 							</div>                                                         
                                                        </div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label for="exampleInputName2">ENCARGADO DE ALMACEN :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                                                        <input id="encargado" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="<?php echo $_SESSION['Nombres']; ?>">
		 							<input id="colaborador" type="hidden" value="<?php echo $_SESSION['idColaborador']; ?>">
									
 								</div> 									
							</div>

						</div>						


					</div>
				

					<div class="row">
                                                <div class="col-lg-3" style="padding-top: 6px;">
                                                            <div class="form-group ">					
                                                            <label for="exampleInputName2">TIPO DE MOVIMIENTO :</label>				 						
                                                            </div>
                                                </div>
						<div class="col-lg-4">
							<div class="form-group">
								<select id="tipomovimiento" class="form-control">
									<option value="0">-Seleccionar tipo de movimiento-</option>
					    			<!-- <option value="1">INGRESO POR COMPRA</option>
					    			<option value="2">INGRESO POR DEVOLUCIÓN</option>
					    			                                                                <option value="2">SALIDA POR DESPACHO</option>
					    			                                                                <option value="2">SALIDA POR DEVOLUCIÓN</option> -->
					    		</select>		
							</div>

						</div>

						<div class="col-lg-3">
							<button id="btnNuevoMovimiento" type="submit" class="btn btn-default" style="width: 100%;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> NUEVO MOVIMIENTO</button>
						</div>	
			</div>

		
<div class="row">

<div class="col-lg-4">
	<div class="form-group">					
		<label for="cbotienda">TIENDA DE DESTINO:</label>		                                                        
		<select id="cbotiendades" class="form-control">
		<option value="0" selected>-Seleccionar tienda-</option>
		</select>                                                         
	</div>
</div>

<div class="col-lg-6">
	<div class="form-group">
		<label id='etiquetadoc' for="exampleInputName2">NÚMERO DE GUIA / DOC.COMPRA :</label>
		<div class="input-group" >
			<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span></span>
			<input id="guia" class="form-control" placeholder="Número documento" style="width: 100%;" type="text" >
		 </div> 									
	</div>

</div>						


</div>

					<div class="row">
						<div class="col-lg-10">
							<div class="form-group">					
					    		<label for="exampleInputName2">PRODUCTO EN MOVIEMTO :</label>		
		 						<input id="nompro" class="form-control" placeholder="Ingrese producto" style="width: 100%;" type="text" onkeyup='autocompleta()'>
		 						<input type="hidden" id="codproducto" value="">
		 						<ul id='autoproducto' class='list-group'></ul>			
							</div>
						</div>					
					</div>

					<div class="row">
						<div class="col-lg-4" style="padding-top: 5px;">
							<div class="form-group">					
                                <label for="exampleInputName2">CATEGORÍA DE PRODUCTO :</label>		
		 						<input id="categoria" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text">			
							</div>
						</div>
						<div class="col-lg-3" style="padding-top: 5px;">
							<div class="form-group">					
                                <label for="exampleInputName2">VALOR TOTAL DE COMPRA :</label><input id="valorcompra" class="form-control" placeholder="" style="width: 100%;" type="number" value="0.00" disabled="true">		 				
							</div>										    				 					
						</div>
						<div class="col-lg-3" style="padding-top: 5px;">
							<div class="form-group">					
                                <label for="exampleInputName2">STOCK EN MOVIMIENTO :</label><input id="stock" class="form-control" placeholder="" style="width: 100%;" type="number" value="0">		 				
							</div>										    				 					
						</div>

					</div>

					<div class="row">

						<div class="col-lg-4">
							
						</div>

						<div class="col-lg-4">
							
						</div>
						
					</div>

<!-- 					<div class="row">
	<div class="col-lg-6 text-right" style="padding-top: 5px;">
							
    		<label for="exampleInputName2">VALOR MONETARIO :</label>		
		 					
	</div>
	<div class="col-lg-3">
		<div class="form-group">
			<input id="nombres" class="form-control" placeholder="" style="width: 100%;" type="text" value="0.00">	
		</div>
		
	</div>
</div> -->

					<div class="row">
						<div class="col-lg-10 text-right" style="padding-top: 5px;">
							<div class="form-group">
								<button id="RegistrarMovimiento" type="submit" class="btn btn-success" style="height: 50px;width: 100%;">REGISTRAR MOVIMIENTO</button>
							</div>
						</div>						
					</div>
                                        
                    
                            <!-- Tabla de detalle -->        
                            <br><br>
                            
                            <fieldset>
                            <legend style="color:dimgrey; text-align: left;">ÚLTIMOS MOVIMIENTOS</legend>
                            <br>
                            
                                        <div class="form-group">
                                            <table id="tablapedido" class="table table-striped">
                                                 <tr><td style="width: 350px;">PRODUCTO</td><td style="width: 10px;">STOCK</td><td style="width: 150px;">MOVIMIENTO</td><td style="width: 50px;">FECHA MOV.</td><td style="width: 50px;">TIENDA DESTINO</td></tr>
<!--                                                
<tr><td><label class='control-label'>1</label></td><td><input id='nompro1' type='text' value='PRODUCTO UNO' class='form-control' onkeyup='autocompleta(1)' readonly="true">                                                             
    </td><td><input id="stock" class="form-control" type="text" value="100" readonly="true"></td><td><input id="preciounit1" class="form-control" value="INGRESO POR COMPRA" readonly="true"></td><td><input id="fechapedido" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="date"></td>
</tr>
<tr><td><label class='control-label'>1</label></td><td><input id='nompro1' type='text' value='PRODUCTO UNO' class='form-control' onkeyup='autocompleta(1)' readonly="true">                                                             
    </td><td><input id="stock" class="form-control" type="text" value="100" readonly="true"></td><td><input id="preciounit1" class="form-control" value="INGRESO POR COMPRA" readonly="true"></td><td><input id="" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="date" value="2018-01-05"></td>
</tr>    
<tr><td><label class='control-label'>1</label></td><td><input id='nompro1' type='text' value='PRODUCTO UNO' class='form-control' onkeyup='autocompleta(1)' readonly="true">                                                             
    </td><td><input id="stock" class="form-control" type="text" value="100" readonly="true"></td><td><input id="preciounit1" class="form-control" value="SALIDA POR DESPACHO" readonly="true"></td><td><input id="" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="date" value="2017-12-22"></td>
</tr> -->

                                            </table>


						<table id="tablapie" class="table table-striped">
                                                <tr><td width="10"></td><td width="420"></td><td width="100"></td><td style="width: 8%;padding-top: 17px;"></td><td style="width: 11%">
<!--                                                        <input id="total" class="form-control" value="0.00" readonly="true"></td><td style="width: 9%">   -->
                                                    </td><td style="width: 8%"></td><td></td><td></td><td></td></tr>
                                    		</table>



                                        </div> 
                                                                    
                            </fieldset>
							<br>	
            

                                        <!-- ----------------------- -->    
                            

						

                            
					<!-- Fin de formulario -->
                                        
                                        
                </div>
				<div class="col-lg-1"></div>

			</div>



			

		</div> 

	
        
    </body>
</html>