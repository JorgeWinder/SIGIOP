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
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-user" style="font-size: 25pt;"></span>
					&nbsp;&nbsp;&nbsp;&nbsp;<span  style="font-size: 28pt;"> Bienvenido, <?php echo $_SESSION['Nombres']; ?></span>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-map-marker" style="font-size: 25pt;"></span>
					&nbsp;&nbsp;&nbsp;&nbsp;<span  style="font-size: 28pt;">Tienda: <?php echo $_SESSION['NombreTienda']; ?></span>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-briefcase" style="font-size: 25pt;"></span>
					&nbsp;&nbsp;&nbsp;&nbsp;<span  style="font-size: 28pt;">Área: <?php echo $_SESSION['NombreArea']; ?></span>
					<hr>
				</div>
			</div>
		</div> 

		
        
    </body>
</html>
