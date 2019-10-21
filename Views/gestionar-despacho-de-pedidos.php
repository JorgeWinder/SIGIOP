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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/gestionar-despacho-de-pedidos.js"></script>       
        <script type="text/javascript">


        $(document).ready(function () {
            
            
 		});	
        	

		function VistaPedido(pedido){				
   			$("#VistaPedido").load("<?php echo URL;?>/vista-pedido?pedido="  + pedido);
		}

		

		

        </script>      
        
    </head>
    <body>
		<?php require_once "plantillas/menu.html"; ?>                             
        

		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right"> 
					<h4>MÓDULO DE ALMACEN <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span>GESTIONAR DESPACHO DE ALMACEN</h4>
					<hr>
				</div>	
				
			</div>

			


			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="margin: 25px auto 0px; max-width: 100%;">

					<!-- Inicio de formulario -->					

<!-- 					<div class="row">

	<div class="col-lg-6">
		<div class="form-group">
			<label for="exampleInputName2">ENCARGADO DE RECEPCIÓN :</label>
			<div class="input-group" >
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                                                        <input id="encargado" readonly="true" class="form-control" placeholder="" style="width: 100%;" type="text" value="<?php echo $_SESSION['Nombres']; ?>">
		 							<input id="colaborador" type="hidden" value="<?php echo $_SESSION['idColaborador']; ?>">
				
 								</div> 									
		</div>

	</div>	

	<div class="col-lg-6">
		<div class="form-group">					
    		<label for="exampleInputName2">TIENDA :</label>		                                                        
		<div class="input-group" >
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></span>	
		 							<input id="nombretienda" class="form-control" style="width: 100%; background-color: #ffed9e;" type="text" readonly="true" value="<?php echo $_SESSION['NombreTienda'];?>">			
				<input type="hidden" id="idtienda" value="<?php echo $_SESSION['idTienda'];?>">
 							</div>                                                         
                                                        </div>
	</div>

						
</div> -->

					<div class="row">
						<div class="col-lg-6" style="padding-top: 5px;padding-right: 40px;">
							<div class="form-group">
								<label for="exampleInputName2">FECHA DE DESPACHO :</label>
								<div class="input-group" >
									<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>	
		 							<input id="FechaPedido" class="form-control" placeholder="" style="width: 100%;" type="date">
									
 								</div> 									
							</div>

						</div>

						<div class="col-lg-6" style="padding-top: 30px;padding-right: 40px;">
							<div class="form-group">
								<button id="btnConsultar" type="submit" class="btn btn-default" style="width: 100%;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> CONSULTAR FECHA DESPACHO</button>
							</div>	
						</div>

					</div>			


					<div class="row">
						<div class="col-lg-5" style="padding-top: 5px;padding-right: 40px;">

								

							<div class="form-group">					
					    		<label for="exampleInputName2">PEDIDOS EN COLA :</label>	
					    	</div>
							
							<div id="pedidos">
								
							<!-- <div class="form-group">
													<button id="RegistrarMovimiento" type="submit" class="btn btn-default" style="height: 50px;width: 15%;float: left;" onclick="AtenderPedido(9)"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
													</button>
													<button id="RegistrarMovimiento" type="submit" class="btn btn-success" style="height: 50px;width: 85%;" onclick="VistaPedido(9)">PEDIDO: 9
													</button>									
												</div>	 -->					


							</div>


						</div>


						<div id="VistaPedido" class="col-lg-7" style="padding-top: 5px;border-left: 1px solid #848484;padding-left: 40px;">
							


						</div>	

					</div>
				

					                                                         
                                        
                </div>
				<div class="col-lg-1">

				<!-- <audio autoplay src="mi-archivo-de-audio.mp3"></audio>  -->

					<audio id="audiopedido" src="nuevopedido.mp3"></audio> 
				</div>

			</div>



			









		</div> 

	
        
    </body>
</html>