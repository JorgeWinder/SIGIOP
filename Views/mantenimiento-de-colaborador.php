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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/mantenimiento-de-colaborador.js"></script>	

    </head>

    <body>
		<?php require_once "plantillas/menu.html"; ?>        


		<div class="container" style="margin: 200px auto 0px; max-width: 80%;font-family: Nunito;">
		
			<div class="row">
				<div class="col-lg-12 text-right">
					<h4>REGISTRO DE COLABORADOR</h4>
					<hr>
				</div>	
				
			</div>
			<br>

			<div class="row">

				<div class="col-lg-3">
					<div class="form-group">
						<label for="exampleInputName2">DOCUMENTO DE IDENTIDAD :</label>	
					</div>
					
				</div>

				<div class="col-lg-3">
					<div class="form-group">
								<input id="iddocumento" class="form-control"  placeholder="" style="width: 100%;background-color: #ffed9e;" type="text" value="">	
					</div>
				
				</div>
			</div>


			<div class="row">

				<div class="col-lg-3">
					<div class="form-group">
						<label for="exampleInputName2">NOMBRES :</label>	
					</div>
					
				</div>

				<div class="col-lg-5">
					<div class="form-group">
								<input id="nombres" class="form-control" placeholder="" style="width: 100%;background-color: white;" type="text" value="">	
					</div>
				
				</div>
			</div>


			<div class="row">

				<div class="col-lg-3">
					<div class="form-group">
						<label for="exampleInputName2">APELLIDOS :</label>	
					</div>
					
				</div>

				<div class="col-lg-5">
					<div class="form-group">
								<input id="apellidos" class="form-control" placeholder="" style="width: 100%;background-color: white;" type="text" value="">	
					</div>
				
				</div>
			</div>
		
                                   

           <div class="row">

				<div class="col-lg-3">
					<div class="form-group">
						<label for="exampleInputName2">CORREO ELECTRÓNICO :</label>	
					</div>
					
				</div>

				<div class="col-lg-5">
					<div class="form-group">
						<input id="correo" class="form-control" placeholder="" style="width: 100%;background-color: white;" type="text" value="">	
					</div>
				
				</div>
			</div>

			
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label for="cbotienda">TIENDA :</label>	
					</div>
					
				</div>
                <div class="col-lg-4">
                <div class="form-group">                    
                    	<select id="cbotienda" class="form-control">
                            <option value="0">Seleccione la tienda</option>
                        </select>		
                </div>	
                </div>                                            
            </div>

            <div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label for="cboarea">ÁREA :</label>	
					</div>
					
				</div>
                <div class="col-lg-4">
                <div class="form-group">                    
                    	<select id="cboarea" class="form-control">
                            <option value="0">Seleccione el área</option>
                        </select>		
                </div>	
                </div>                                            
            </div>			
                        		
					

			<br>
			<div class="row">
				<div class="col-lg-9">
					<hr>
					<button id="btnNuevoAlumno" type="submit" class="btn btn-default" style="height: 50px;">NUEVO COLABORADOR</button>
					<button id="btnRegistrarColaborador" type="submit" class="btn btn-warning" style="height: 50px;">REGISTRAR COLABORADOR</button>
					<button id="btnActualizarAlumno" type="submit" class="btn btn-success" style="height: 50px;">ACTUALIZAR COLABORADOR</button>
				</div>
			</div>
		</div> 


<br>
		
        
    </body>
</html>
