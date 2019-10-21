<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, |choose Tools | Templates
and open the template in the editor.
-->
<?php require_once './src/config/ini.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
	<?php require_once "plantillas/cabecera.html"; ?>	
	<?php require_once "plantillas/cabecera-estilo.html"; ?>

        <!--Escript de vista-->
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/datos-de-cliente.js"></script>

    </head>
    <body>
		<?php //require_once "plantillas/menu.html"; ?>        


		<div class="container" style="margin: 50px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right">
					<h4>DATOS DE CLIENTE</h4>
					<hr>
				</div>	
				
			</div>
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10" style="margin: 30px auto 0px; max-width: 100%;">

					<!-- Inicio de formulario -->
					
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">					
                                                    <label for="Ruc">RUC / DNI:</label>
                                                    <div class="input-group">
                                                        <input id="Ruc" class="form-control" type="text" placeholder="" maxlength="11" style="background-color: #ffed9e;" value="<?php echo $_REQUEST['dni']; ?>" readonly>
                                                        <div class="input-group-btn">
                                                        <button id="btnBusqueda" type="button" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>                            
                                                        </div>
                                                    </div>                          
						                          </div>
                                            </div>                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-4">
                    							<div class="form-group">
                        								<select id="TipoCL" class="form-control" readonly>
                                                              <option value="0">Seleccione el tipo de cliente</option>
                                                              <option value="1">EMPRESA</option>
                                                              <option value="2">PERSONA NATURAL</option>
                                                        </select>		
                    							</div>	
                                            </div>                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                               <div class="form-group">					
                					    		<label for="RS">RAZÓN SOCIAL / NOMBRES:</label>		
                		 						<input id="RS" class="form-control" placeholder="" style="width: 100%;" type="text" readonly>	
						                      </div>
                                            </div>                                            
                                        </div>
                                                                                                                                                                
					
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
                					    		<label for="direccion">DIRECCIÓN :</label>		
                		 					    <input id="direccion" class="form-control" placeholder="" style="width: 100%;" type="text" readonly>
						                        </div>
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            
                                            <div class="col-lg-3">
                                             <div class="form-group">
                                                <select id="provincia" class="form-control" readonly>
                                                    <option value="0">Seleccione provincia</option>
                                                    <option value="1">LIMA</option>
                                                    <option value="2">CALLAO</option>
                                                </select>       
                                             </div> 
                                            </div>
                                            
                                            <div class="col-lg-3">
                                             <div class="form-group">
                                                <select id="distrito" class="form-control" readonly>
                                                    <option value="0">Seleccione distrito</option>
                                                    <option value="1">CRECADO DE LIMA</option>
                                                    <option value="2">PUEBLO LIBRE</option>
                                                </select>       
                                             </div> 
                                            </div> 

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-10">
                                                <h4>Datos de contacto y entrega: </h4>                                            	
                                                <hr> 
                                            </div>
                                        </div>    

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
                					    		<label for="direccion">NOMBRES Y APELLIDOS DE CONTACTO:</label>		
                		 					    <input id="NombresContac" class="form-control" placeholder="" style="width: 100%;" type="text" readonly>
						                        </div>
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">					
                    					    		<label for="correo">CORREO:</label>		
                    		 						<input id="correo" class="form-control" placeholder="" style="width: 100%;" type="email" readonly>
						                      </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">					
					    		                    <label for="telefono">TELÉFONO:</label>		
                                                    <input id="telefono" class="form-control" type="number" readonly>			
						                        </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="form-group">					
                					    		<label for="direccion">DIRECCIÓN ENTREGA:</label>		
                		 					    <input id="DirEntrega" class="form-control" placeholder="" style="width: 100%;" type="text" readonly>
						                        </div>
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
                					    		<label for="direccion">EMPRESA MEDIO DE TRASPORTE:</label>		
                		 					    <input id="NomMedioTransp" class="form-control" placeholder="" style="width: 100%;" type="text" readonly>
						                        </div>
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="form-group">					
                					    		<label for="direccion">OTROS APUNTES:</label>		
                		 					    <input id="OtrosApuntes" class="form-control" placeholder="" style="width: 100%;" type="text" readonly>
						                        </div>
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