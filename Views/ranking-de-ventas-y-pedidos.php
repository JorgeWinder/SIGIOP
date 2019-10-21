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

    </head>
    <body>
		<?php require_once "plantillas/menu.html"; ?>        


		<div class="container" style="margin: 200px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right">
					<h3>RANKING DE PEDIDOS Y VENTAS</h3>
					<hr>
				</div>	
				
			</div>
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-record" style="font-size: 25pt;"></span>
					&nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"> <a href="ranking-ventas-por-insumos">Ranking de ventas por insumos</a></span>
					<hr>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-record" style="font-size: 25pt;"></span>
					&nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"> <a href="ranking-montos-ventas-por-insumos">Ranking de montos vendidos por insumos</a></span>
					<hr>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-record" style="font-size: 25pt;"></span>
					&nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"> <a href="ranking-ventas-por-cliente">Ranking de ventas por cliente</a></span>
					<hr>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-record" style="font-size: 25pt;"></span>
					&nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"> <a href="ranking-ventas-por-vendedor">Ranking de ventas por vendedor</a></span>
					<hr>
				</div>
			</div>
			
			
		</div> 

		
        
    </body>
</html>