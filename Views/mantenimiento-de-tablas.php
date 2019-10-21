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
         
	<?php require_once "plantillas/cabecera.html"; ?>	
	<?php require_once "plantillas/cabecera-estilo.html"; ?>


    </head>
    <body>
		<?php require_once "plantillas/menu.html"; ?>        

		<div class="container" style="margin: 200px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right">
					<h3>MANTENIMIENTO DE TABLAS</h3>
					<hr>
				</div>	
				
			</div>
                    
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-list-alt" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"><a href="mantenimiento-de-area">Mantenimiento de área</a></span>
					<hr>
				</div>
			</div>
                    
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-list-alt" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"><a href="mantenimiento-de-tienda">Mantenimiento de tienda</a></span>
					<hr>
				</div>
			</div>                    
                    
			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-list-alt" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"><a href="mantenimiento-de-proveedor">Mantenimiento de proveedor</a></span>
					<hr>
				</div>
			</div>
                    
                        <div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-list-alt" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span  style="font-size: 28pt;"><a href="mantenimiento-de-cliente">Mantenimiento de cliente</a></span>
					<hr>
				</div>
			</div>
                    

            <div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-list-alt" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span style="font-size: 28pt;"><a href="mantenimiento-de-producto">Mantenimiento de producto</a></span>
					<hr>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<span class="glyphicon glyphicon-list-alt" style="font-size: 25pt;"></span>
                                        &nbsp&nbsp&nbsp&nbsp<span style="font-size: 28pt;"><a href="mantenimiento-de-colaborador">Mantenimiento de colaborador</a></span>
					<hr>
				</div>
			</div>
                    
                    

		</div> 

		
        
    </body>
</html>