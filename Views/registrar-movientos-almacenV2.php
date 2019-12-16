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
        <script type="text/javascript" src="<?php echo URL;?>/Views/script/registrar-movimientos-almacenV2.js"></script>

        <script type="text/javascript">

        </script>        
        
    </head>
    <body> 

        <form>

		<main>

        <?php require_once "plantillas/menuV2.html"; ?>	

        <div class='container'>

            <div class='section'>

                <h4>Movimientos de almacen</h4>
                <div class='divider black'></div>

                <div class='section'>

                    <div class='row'>
                        <div class="input-field col s12 l6">
                            <!-- <i class="material-icons prefix">home</i> -->
                            <input type="text" id="nombretienda" name="nombretienda" value="<?php echo $_SESSION['NombreTienda'];?>" readonly>
                            <input type="hidden" id="idTienda" name="idTienda" value="<?php echo $_SESSION['idTienda'];?>">
                            <label for="tienda">Tienda</label>
                        </div>

                        <div class="input-field col s12 l6">
                            <!-- <i class="material-icons prefix">person</i> -->
                            <input type="text" id="encargado" class="validate" value="<?php echo $_SESSION['Nombres']; ?>" readonly>
                            <input type="hidden" id='idColaborador' name="idColaborador" value="<?php echo $_SESSION['idColaborador']; ?>">
                            <label for="encargado">Encargado de almacen</label>
                        </div>

                        <div class="input-field input-field-select col s12 l6">
                            <select id="tipomovimiento" name='tipomovimiento' class="browser-default">
                            <option value="" disabled selected>Seleccione movimiento</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            </select>
                            <label>Tipo de movimiento</label>
                        </div>

                        <div class="input-field input-field-select col s12 l6">
                            <select id="cbotiendades" name='cbotiendades' class="browser-default">
                            <option value="" disabled selected>Seleccione tienda de destino</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            </select>
                            <label>Tienda de destino</label>
                        </div>

                        <div class="input-field col s12 l12">
                                <!-- <i class="material-icons prefix">person</i> -->
                                <input type="number" id="nrodoc" name='nrodoc' class="validate">
                                <label id='etiquetadoc' for="nrodoc">Número de guia / documento de compra</label>
                        </div>


                        <div class="input-field input-field-select col s12 l12" style='padding-top: 5px;'>
                            <select id="CategoriaProducto"  name='CategoriaProducto' class="browser-default">
                            <option value="" disabled selected>Seleccione Categoría</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            </select>
                            <label style='padding-top: 5px;'>Categoría de producto para búsqueda</label>
                        </div>

                        <div class="input-field col s12 l12" style="">
                            <!-- <i class="material-icons prefix">person</i> -->
                            <input type="text" id="producto" class="autocomplete validate">
                            <label for="producto">Nombre de producto</label>
                            <input type="hidden" id='idProducto' name="idProducto">

                            <div id='divcarga' style="text-align: center; display: none;">

                                    <div class="preloader-wrapper active" style="position: absolute; top: 0; margin-left: 30px;">
                                        <div class="spinner-layer spinner-red-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div><div class="gap-patch">
                                            <div class="circle"></div>
                                        </div><div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <span style='color: red;'>Cargando productos</span>

                            </div>
                            

                        </div>

                        

                        <div class="input-field col s12 l6">
                            <!-- <i class="material-icons prefix">person</i> -->
                            <input type="number" id="vcompra" name='vcompra' class="validate" value=''>
                            <label for="vcompra">Valor total de compra</label>
                        </div>

                        <div class="input-field col s12 l6">
                            <!-- <i class="material-icons prefix">person</i> -->
                            <input type="number" id="stock" name='stock' class="validate" value='0'>
                            <label for="stock">Stock en movimiento</label>
                        </div>

                        <div class='col s12 l12'>
                            <button class="btn-large waves-effect red lighten-2" type="submit" name="action" style='width: 100%'>Registrar movimiento
                                <i class="material-icons left">save</i>
                            </button>
                        </div>

                        
                        
                    </div>

                </div>

                <div class='seccion'>

                    
                        <table id='detamov' class="highlight">
                            <thead>
                                <tr>
                                    <th>PRODUCTO</th>
                                    <th>STOCK</th>
                                    <th>MOVIMIENTO</th>
                                    <th>FECHA MOV.</th>
                                    <th>TIENDA DESTINO</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td>Producto 1</td>
                                    <td>100</td>
                                    <td>Salida por despacho</td>
                                    <td>22/10/2019</td>
                                    <td>Tienda Lampa</td>
                                </tr>
                                <tr>
                                    <td>Producto 2</td>
                                    <td>150</td>
                                    <td>Salida por despacho</td>
                                    <td>03/12/2019</td>
                                    <td>Tienda Lampa</td>
                                </tr>
                                <tr>
                                    <td>Producto 3</td>
                                    <td>230</td>
                                    <td>Salida por despacho</td>
                                    <td>15/12/2019</td>
                                    <td>Tienda Lampa</td>
                                </tr> -->
                            </tbody>
                        </table>

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                </div>


            </div>

        </div>
        

        </main>
        
        </form>
				
        
    </body>
</html>