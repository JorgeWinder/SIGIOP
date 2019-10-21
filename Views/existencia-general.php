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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/existencia-general.js"></script>       
        <script type="text/javascript">


		function PrintDiv(id) {
            var data=document.getElementById(id).innerHTML;
            var myWindow = window.open('', 'Imprimir reporte de ventas', 'height=500,width=800');
            myWindow.document.write('<html><head><title>Reporte de existencias - ALMACEN</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('<link rel="stylesheet" href="<?php echo URL;?>/Recursos/css/bootstrap.min.css" type="text/css" />');
            myWindow.document.write('<style type="text/css" media="print"> @page { size: landscape; } </style>');
            myWindow.document.write('</head><body style="width: 100%;">');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images
                myWindow.focus(); // necessary for IE >= 10                
                myWindow.print();
                myWindow.close();
            };
        }
		
        </script>      
        
    </head>
    <body>
		<?php require_once "plantillas/menu.html"; ?>                             
        

		<div class="container" style="margin: 160px auto 0px; max-width: 90%;font-family: Nunito;">

			<div class="row">
				<div class="col-lg-12 text-right"> 
					<h4>MÓDULO DE ALMACEN <span class="glyphicon glyphicon-triangle-right" style="font-size: 13pt;"></span>EXISTENCIA GENERAL</h4>
					<hr>
				</div>	
				
			</div>

			


			<div class="row">
				<!-- <div class="col-lg-1"></div> -->
				<div class="col-lg-12" style="margin: 25px auto 0px; max-width: 100%;">

					<div class="row">

						<div class='col-lg-6' style="padding-top: 5px;padding-right: 40px;">

							<div class="form-group">					
								<label for="cbotienda">TIENDA:</label>		                                                        
								<select id="cbotienda" class="form-control">
								<option value="0">-Seleccionar tienda-</option>
								<option value="">TODAS LAS TIENDAS</option>
								</select>                                                         
							</div>

						
						</div>
					</div>	
					
					<div class="row">						

						<div class="col-lg-12" style="padding-top: 5px;padding-right: 40px;">
							<div class="form-group">
								<button id="btnConsultar" type="submit" class="btn btn-default" style="width: 100%;background-color: #efefef;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> CONSULTAR EXISTENCIA</button>
							</div>							

						</div>					

					</div>

					<div class="row">						

						<div class="col-lg-6" style="padding-top: 5px;padding-right: 40px;">							

							<div class="form-group">
								<button id="btnImprimir" type="submit" class="btn btn-primary" style="width: 100%;" onclick="PrintDiv('VistaPedido')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> IMPRIMIR REPORTE</button>
							</div>

						</div>

						<div class="col-lg-6" style="padding-top: 5px;padding-right: 40px;">

							<div class="form-group">
								<button id="BtnExport" type="submit" class="btn btn-success" style="width: 100%;" ><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> EXPORTAR REPORTE</button>
							</div>

						</div>

					</div>



					<div class="row">
						<div class="col-lg-12">
							<hr>
						</div>	
					</div>			


					<div class="row">
						<div class="col-lg-5" style="padding-top: 5px;padding-right: 40px;">							

							<div class="form-group">					
					    		<label for="exampleInputName2">VISTA DE REPORTE :</label>	
					    	</div>						

						</div>

					</div>



					<div class="row" style="background-color: #777777;padding: 8px;">
				
						<div id="VistaPedido" class="col-xs-12" style="padding-top: 5px;padding-left: 40px;background: white;">	

								<table style="width: 100%;font-size: 9.0pt;">
									<tr>
										<td class="text-center" style="padding-top: 40px;">
											<u>REPORTE GENERAL DE EXISTENCIA - <label id="fecha"></label><br>SHANDONG TIANXIN TRADING COMPANY S.A.C.</u>
										</td>
									</tr>

								</table>				
								<br>		
								
								
								<hr>

								<table style="width: 100%;font-size: 9.0pt;">
									<tr><td style="width: 50px;">ID</td><td style="width: 200px;">NOMBRE DE PRODUCTO</td><td style="width: 150px;">CATEGORÍA DE PRODUCTO</td><td style="width: 100px;">STOCK MINI.</td><td style="width: 100px;">STOCK FINAL</td><td style="width: 100px;">PRECIO <br>COMPRA BASE</td><td style="width: 100px;">MONTO VALORIZADO</td></tr>
									
								</table>

								<hr>

								<table id="detalleventa" style="width: 100%;font-size: 9.0pt;">

									<!-- <tr><td style="width: 70px;">151</td><td style="width: 90px;">10453477342</td><td style="width: 250px;">JORGE WINDER AVILA</td><td style="width: 250px;">INGRESOS VARIOS</td><td style="width: 170px;">COBRANZA CANCELADA</td><td style="width: 100px;">0.00</td><td style="width: 100px;">0.00</td><td style="width: 100px;">CANT.</td><td style="width: 100px;">340.00</td>
									</tr>								
									 -->
								</table>

								<hr>

								

								

								<table style="width: 100%;">
									<tr>
										<td class="text-left" style="padding-top: 40px;font-size: 8.5pt;">
											<hr>
											<span>SIGOP - SISTEMA INTEGRADO DE GESTIÓN Y OPERRACIONES PUBLIFACTORY   v1.0</span>
										</td>
									</tr>

								</table>


						</div>	

					</div>
				




					                                                         
                                        
                </div>
				<!-- <div class="col-lg-1"></div> -->

			</div>

	



		</div> 

		<br><br>

	
        
    </body>
</html>