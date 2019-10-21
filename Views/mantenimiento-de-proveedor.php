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


		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right">
					<h4>MÓDULO DE CONFIGURACIONES <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span> MANTENIMIENTO DE PROVEEDOR</h4>
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
                                                    <label for="exampleInputName2">CÓDIGO:</label>
                                                    <div class="input-group">
                                                        <input id="socio_id" class="form-control" type="text" placeholder="" maxlength="7" style="background-color: #ffed9e;">
                                                        <div class="input-group-btn">
                                                        <button id="btnBusqueda" type="button" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>                            
                                                        </div>
                                                    </div>                          
						</div>
                                                
                                                
                                            </div>                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">					
                                                    <label for="exampleInputName2">RUC:</label>
                                                    
                                                        <input id="ruc" class="form-control" type="number" placeholder="" maxlength="11" style="background-color: #ffed9e;">

                                                                              
						</div>
                                                
                                                
                                            </div>                                            
                                        </div>
                                        
                                        
					
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
					    		<label for="exampleInputName2">RAZÓN SOCIAL:</label>		
		 						<input id="razon" class="form-control" placeholder="" style="width: 100%;" type="text">			
						</div>
                                            </div>                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
					    		<label for="exampleInputName2">NOMBRE CONTACTO:</label>		
		 						<input id="nombres" class="form-control" placeholder="" style="width: 100%;" type="text">			
						</div>
                                            </div>                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
					    		<label for="exampleInputName2">CORREO CONTACTO:</label>		
		 						<input id="correo" class="form-control" placeholder="" style="width: 100%;" type="text">			
						</div>
                                            </div>                                            
                                        </div>
					
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">					
					    		<label for="exampleInputName2">TELÉFONO:</label>		
                                                        <input id="telefono" class="form-control" type="number" placeholder="" maxlength="9" style="background-color: #ffed9e;">
			
						</div>
                                            </div>                                            
                                        </div>
                                        
                                        
                                        <div class="row text-left">
						<div class="col-md-11">
                                                        <button type="submit" class="btn btn-default" style="height: 50px;">LIMPIAR PROVEEDOR</button>
							<button type="submit" class="btn btn-success" style="height: 50px;">REGISTRAR PROVEEDOR</button>
							<button type="submit" class="btn btn-warning" style="height: 50px;">MODIFICAR PROVEEDOR</button>
							<button type="submit" class="btn btn-danger" style="height: 50px;">ELIMINAR PROVEEDOR</button>	
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