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
					<h3>MÓDULO DE ALMACEN <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span> CONSULTA DE EXISTENCIA</h3>
					<hr>
				</div>	
				
			</div>

			<?php if( $_SESSION["NombreArea"]=="ADMINISTRACIÓN" || $_SESSION["NombreArea"]=="ALMACEN / DESPACHO" || $_SESSION["NombreArea"]=="ALMACEN / COMPRAS" || $_SESSION["NombreArea"]=="VENTAS" || $_SESSION["NombreArea"]=="VENTAS / DESPACHO INT."  || $_SESSION["NombreArea"]=="VENTAS / GALERIA"){ ?>

			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-th-large" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"> <a href="existencia-general">Existencia general</a></span>
					<hr>
				</div>
			</div>

			<?php } ?>

			<?php if( $_SESSION["NombreArea"]=="ADMINISTRACIÓN" || $_SESSION["NombreArea"]=="ALMACEN / DESPACHO" ){ ?>

			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-th-list" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"> <a href="existencia-por-producto">Eixtencia por movimiento</a></span>
					<hr>
				</div>
			</div>

			<?php } ?>
			
		</div> 

		
        
    </body>
</html>