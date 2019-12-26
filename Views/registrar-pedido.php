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
	<?php require_once "plantillas/cabeceraV2.html"; ?>	
	<?php //require_once "plantillas/cabecera-estilo.html"; ?>
        
        <!--Escript de vista-->
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/registrar-pedido.js"></script>

        <script type="text/javascript">

        </script>        
        
    </head>
    <body>

		<main>

			<?php require_once "plantillas/menuV2.html"; ?>

			<div class='container'>

				<div class='section'></div>

				<h4>Registar pedido</h4>
                <div class='divider black'></div>
				
				<div class='section'>

					<div class='row'>
						<div class='input-field col s12 l3'>
							<input type="number" id="idPedido" name="idPedido" value="" readonly>
                            <label for="idPedido">Código de pedido</label>
						</div>
						<div class='input-field col s12 l5'>
							<input type="text" id="cliente" name="cliente" value="">
							<label for="cliente">Cliente</label>
							<input type="hidden" name="idcliente" id='idcliente'>
						</div>
						<div class='input-field col s6 l2'>
							<a class="btn-flat red-text" name="action" style="width: 100%; margin-top: 10px; padding: 0 0px 0 0px;">Nuevo cliente
                                <i class="material-icons left">add_box</i>
							</a>
						</div>
						<div class='input-field col s6 l2'>
							<a class="btn-flat red-text" name="action" style="width: 100%; margin-top: 10px; padding: 0 0px 0 0px;">Datos de cliente
                                <i class="material-icons left">remove_red_eye</i>
							</a>
						</div>

					</div>

					<div class='row'>
						<div class='input-field col s12 l3'>
							<input type="number" id="tienda" name="tienda" value="" readonly>
							<label for="tienda">Tienda</label>
							<input type="hidden" id="idtienda" value="1">
						</div>
						<div class='input-field col s12 l5'>
							<input type="date" id="fechapedido" name="fechapedido" value="">
							<label for="fechapedido">Fecha pedido</label>							
						</div>
						<div class='input-field col s12 l4'>
							<input type="date" id="fechaentrega" name="fechaentrega" value="">
							<label for="fechaentrega">Fecha entrega</label>							
						</div>

						<div class="input-field input-field-select col s12 l12" style="padding-top: 5px;">
							<select id="empresa" name="empresa" class="browser-default">
								<option value="" disabled="" selected="">Seleccione empresa</option>
								<option value="" selected="true">SHANDONG TIANXIN TRADING COMPANY S.A.C.</option>
							</select>
							<label style="padding-top: 5px;">Empresa responsable del pedido</label>
						</div>

						<div class='col s12 l12 right-align'>
							<label>
								<input type="checkbox" class="filled-in"/>
								<span>DESPACHO A DOMICILIO</span>
							</label>							
						</div>
						

					</div>

				</div>

				<div class='section' style='margin-top: -50px;'>

					<h5>Detalle de pedido</h5>
					<div class='divider black'></div>

					<table class="highlight">
						<thead>
							<tr>
								<th>ID</th>
								<th width='450'>PRODUCTO</th>
								<th width='60'>CANTIDAD</th>
								<th width='100'>P.UNIT</th>
								<th width='100'>P.TOTAL</th>
								<th>DESCUENTO</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>
									<div class='input-field' style='margin-right: 10px;'>
										<input type="text" id="nompro" name="nompro" value="">								
										<input type="hidden" id="idProducto" value="">
									</div>
								</td>
								<td>
									<div class='input-field' style='margin-right: 10px;'>
										<input type="number" id="cantidad" name="cantidad" value="">								
									</div>
								</td>
								<td>
									<div class="input-field input-field-select" style="">
										<select id="empresa" name="empresa" class="browser-default">
											<option value="" disabled="" selected="">--</option>
											<option value="" selected="true">122 PU</option>
										</select>
									</div>
								</td>
								<td>
									<div class='input-field' style='margin-right: 10px;'>
										<input type="number" id="total" name="total" step="0.01" value="">								
									</div>
								</td>
								<td>
									<div class='input-field' style='margin-right: 10px;'>
										<input type="number" id="desc" name="desc" step="0.01" value="">								
									</div>
								</td>
								<td>
									<button class="btn-small waves-effect red lighten-2" type="submit" name="action" style=""> Eliminar
										<i class="material-icons left">delete</i>
									</button>
								</td>
								
							</tr>
						</tbody>
					</table>


				</div>




			</div>


			<div class="fixed-action-btn" style="bottom: 45px;">
				<a class="btn-floating btn-large waves-effect tooltipped red" data-position="left" data-tooltip="Agregar producto a pedido">
					<i class="material-icons">add</i>
				</a>
			</div>


		</main>
		
	
        
    </body>
</html>