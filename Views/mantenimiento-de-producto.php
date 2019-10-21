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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/mantenimiento-de-producto.js"></script>

    </head>
    <body>
		<?php require_once "plantillas/menu.html"; ?>        

		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right">
					<h4>MÓDULO DE CONFIGURACIONES <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span> MANTENIMIENTO DE PRODUCTO</h4>
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
                                                    <label for="idProducto">CÓDIGO:</label>
                                                    <div class="input-group">
                                                        <input id="idProducto" class="form-control" type="text" placeholder="" maxlength="7" style="background-color: #ffed9e;">
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
                                                        <label for="idCategoriaProducto">TIPO DE PRODUCTO:</label>
                        				                <select id="idCategoriaProducto" class="form-control">
                                                              <option value="0">Seleccione el tipo de producto</option>
                                                        </select>		
                    				        </div>	
                                            </div>                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">					
					    		<label for="UniMedida">UNIDAD DE MEDIDA:</label>		
		 					<select id="UniMedida" class="form-control">
                                                              <option value="0">Seleccione la unidad de medida</option>
                                                              <option value="PLANCHA">UNIDAD</option>
                                                              <option value="PLANCHA">PLANCHA</option>                                                              
                                                        </select>
						</div>
                                                
                                            </div>                                            
                                        </div>                                        
                                        
					
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">					
					    		<label for="NombreProducto">NOMBRE DEL PRODUCTO:</label>		
		 						<input id="NombreProducto" class="form-control" placeholder="" style="width: 100%;" type="text">			
						</div>
                                                
                                            </div>                                            
                                        </div>    
					
                        <div class="row">
                               <div class="col-lg-3">
                                
                                <div class="form-group">					
					    		<label for="PrecioVenta">PRECIO DE VENTA:</label>		
		 						<input id="PrecioVenta" class="form-control" placeholder="" style="width: 100%;background-color: #ffed9e;" type="text">
                                </div>
                                                
                                </div> 

                                <div class="col-lg-3">
                                
                                <div class="form-group">                    
                                <label for="PrecioxMayor">PRECIO X MAYOR:</label>       
                                <input id="PrecioxMayor" class="form-control" placeholder="" style="width: 100%;" type="text">
                                </div>
                                                
                                </div>


                        </div>

                        <div class="row">
                               <div class="col-lg-3">
                                
                                <div class="form-group">					
					    		<label for="PrecioVenta2">PRECIO DE VENTA 2:</label>		
		 						<input id="PrecioVenta2" class="form-control" placeholder="" style="width: 100%;background-color: #ffed9e;" type="text">
                                </div>
                                                
                                </div> 

                                <div class="col-lg-3">
                                
                                <div class="form-group">                    
                                <label for="PrecioVenta3">PRECIO DE VENTA 3:</label>       
                                <input id="PrecioVenta3" class="form-control" placeholder="" style="width: 100%;background-color: #ffed9e;" type="text">
                                </div>
                                                
                                </div>


                        </div>


                                            
                        <div class="row">

                            <div class="col-lg-3">
                                
                                <div class="form-group">                    
                                <label for="StockMini">STOCK MÍNIMO:</label>       
                                <input id="StockMini" class="form-control" placeholder="" style="width: 100%;" type="number">
                                </div>
                                                
                            </div>


                                            <div class="col-lg-3">
                                                <div class="form-group">					
					    		                        <label for="StockFinal">STOCK FINAL:</label>		
                                                        <input id="StockFinal" class="form-control" placeholder="" style="width: 100%;" type="text" value="0" disabled="true">
                                                        <span class="text-info">El stock del producto se mostrará sugún almacen.</span>
						                        </div>
                                                
                                            </div>                                            
                        </div>
                                        

                                        
                    <div class="row text-left">
						<div class="col-md-12">
                           <!-- <button type="submit" class="btn btn-default" style="height: 50px;">LIMPIAR PRODUCTO</button> -->
							<button id="registrar" type="button" type="submit" class="btn btn-success" style="height: 50px;">REGISTRAR PRODUCTO</button>
							<button id="modificar" type="submit" class="btn btn-warning" style="height: 50px;">MODIFICAR PRODUCTO</button>
							<button type="submit" class="btn btn-danger" style="height: 50px;">ELIMINAR PRODUCTO</button>	
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