<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;    
//require '../../Slim/vendor/autoload.php';
//$app =new Slim\App;  
//
 

$app->get('/api/encuesta/{id}', function (Request $request, Response $response) {
    $name = $request->getAttribute('id');    
    $response->getBody()->write("Hello, $name");
    return $response;
});


 $app->post('/api-sigop/cliente/add', function(Request $request, Response $response){

    $RucDnICL = $request->getParam('RucDnICL');
    $idTipoCliente = $request->getParam('idTipoCliente');
    $RazonSocial = $request->getParam('RazonSocial');
    $correo = $request->getParam('correo');
    $Telefono = $request->getParam('Telefono');
    $idDistrito = $request->getParam('idDistrito');
    $direccion = $request->getParam('direccion');

    $NombresContac = $request->getParam('NombresContac');
    $DirEntrega = $request->getParam('DirEntrega');
    $NomMedioTransp = $request->getParam('NomMedioTransp');
    $OtrosApuntes = $request->getParam('OtrosApuntes');

    
//    $sql = "INSERT INTO Encuesta (Id_enc,Enc,P1,P1_OTRO,P2,P3)  values($Id_enc,$Enc,$P1,'$P1_OTRO',$P2,$P3)";

    $sql = "INSERT INTO cliente (RucDnICL, idTipoCliente, RazonSocial, correo, Telefono, idDistrito, direccion, NombresContac, DirEntrega, NomMedioTransp, OtrosApuntes) VALUES ('$RucDnICL', '$idTipoCliente', '$RazonSocial', '$correo', '$Telefono', '$idDistrito', '$direccion', '$NombresContac', '$DirEntrega', '$NomMedioTransp', '$OtrosApuntes')";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }
});


$app->post('/api-sigop/producto/busqueda',  function(Request $request, Response $response) { 
    
   $NombreProducto = $request->getParam('NombreProducto');
   $idTienda = $request->getParam('idTienda');
   
   //$sql = "SELECT * , getStockFinal(idProducto) as getStock  FROM Producto where NombreProducto like '%$NombreProducto%'";
   
   $sql="select  pro.* , CASE  when getStockTienda(pro.idProducto , $idTienda) is null then 0 else getStockTienda(pro.idProducto , $idTienda) 
                end as getStock , cat.NombreCategoria from producto pro , categoriaproducto cat 
                where pro.idCategoriaProducto=cat.idCategoriaProducto and pro.NombreProducto like '%$NombreProducto%'";

   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($productos)>0){
            echo json_encode($productos); 
        }else{
            echo json_encode("Objeto vacio"); 
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});



$app->get('/api-sigop/producto/getLista',  function(Request $request, Response $response) { 
    
    //$NombreProducto = $request->getParam('NombreProducto');
    $idTienda = $request->getQueryParam('idTienda');
    $idCategoriaProducto = $request->getQueryParam('idCategoriaProducto');
    
    //$sql = "SELECT * , getStockFinal(idProducto) as getStock  FROM Producto where NombreProducto like '%$NombreProducto%'";
    
    $sql="select  pro.* , CASE  when getStockTienda(pro.idProducto , $idTienda) is null then 0 else getStockTienda(pro.idProducto , $idTienda) 
                 end as getStock , cat.NombreCategoria from producto pro , categoriaproducto cat 
                 where pro.idCategoriaProducto=cat.idCategoriaProducto and pro.idCategoriaProducto=$idCategoriaProducto";
 
    try{
        
         // Get DB Object
         $db = new db();
         // Connect
         $db = $db->connect();
         $stmt = $db->query($sql);
         $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;
         
         if(count($productos)>0){
             echo json_encode($productos); 
         }else{
             echo json_encode("Objeto vacio"); 
         }



        //  if(count($productos)>0){            
            
        //     $resultado="{";
            
        //     foreach ($productos as  $row) {
        //         $resultado = $resultado . '"' . $row->NombreProducto . '" : ' . $row->getStock . ' , '; 
        //     }

        //     $resultado= $resultado . "}";

        //     echo json_encode($resultado);
        // }
        
        
    } catch(PDOException $e){
         echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
 });


$app->post('/api-sigop/cliente/busqueda',  function(Request $request, Response $response) { 
    
   $RazonSocial = $request->getParam('RazonSocial');
   
   //$sql = "SELECT * , getStockFinal(idProducto) as getStock  FROM Producto where NombreProducto like '%$NombreProducto%'";
   
   $sql="select * from cliente where  RazonSocial like '%$RazonSocial%' or  RucDnICL like '%$RazonSocial%'";

   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($productos)>0){
            echo json_encode($productos); 
        }else{
            echo json_encode("Objeto vacio"); 
        }
       
       
   } catch(PDOException $e){
        echo '{"error" : {"text": '.$e->getMessage().'}';
   }
   
});

$app->get('/api-sigop/cliente/dni',  function(Request $request, Response $response) { 
    
    $RucDnICL = $request->getParam('RucDnICL');
    
    //$sql="select * from cliente where  RazonSocial like '%$RazonSocial%' or  RucDnICL like '%$RazonSocial%'";

    $sql="select * from cliente where RucDnICL='$RucDnICL'";
 
    try{
        
         // Get DB Object
         $db = new db();
         // Connect
         $db = $db->connect();
         $stmt = $db->query($sql);
         $clientes = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;
         
         if(count($clientes)>0){
             echo json_encode($clientes); 
         }else{
             echo json_encode("Objeto vacio"); 
         }
        
        
    } catch(PDOException $e){
         echo '{"error" : {"text": '.$e->getMessage().'}}';
    }
    
 });

 $app->get('/api-sigop/producto/codigo',  function(Request $request, Response $response) { 
    
    $idProducto = $request->getParam('idProducto');
    
    //$sql="select * from cliente where  RazonSocial like '%$RazonSocial%' or  RucDnICL like '%$RazonSocial%'";

    $sql="select * from producto where idProducto='$idProducto'";
 
    try{
        
         // Get DB Object
         $db = new db();
         // Connect
         $db = $db->connect();
         $stmt = $db->query($sql);
         $clientes = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;
         
         if(count($clientes)>0){
             echo json_encode($clientes); 
         }else{
             echo json_encode("Objeto vacio"); 
         }
        
        
    } catch(PDOException $e){
         echo '{"error" : {"text": '.$e->getMessage().'}}';
    }
    
 });


$app->post('/api-sigop/producto/add', function(Request $request, Response $response){

    //$idProducto = $request->getParam('idProducto');
    $idCategoriaProducto = $request->getParam('idCategoriaProducto');
    $UniMedida = $request->getParam('UniMedida');
    $NombreProducto = $request->getParam('NombreProducto');
    $PrecioVenta = $request->getParam('PrecioVenta');
    $PrecioxMayor = $request->getParam('PrecioxMayor');
    $StockMini = $request->getParam('StockMini');

    $PrecioVenta2 = $request->getParam('PrecioVenta2');
    $PrecioVenta3 = $request->getParam('PrecioVenta3');
    
//    $sql = "INSERT INTO Encuesta (Id_enc,Enc,P1,P1_OTRO,P2,P3)  values($Id_enc,$Enc,$P1,'$P1_OTRO',$P2,$P3)";

    $sql = "INSERT INTO producto (idCategoriaProducto, UniMedida, NombreProducto, PrecioVenta, PrecioxMayor , StockMini, PrecioVenta2, PrecioVenta3) VALUES ('$idCategoriaProducto', '$UniMedida', '$NombreProducto', '$PrecioVenta', '$PrecioxMayor', '$StockMini', '$PrecioVenta2', '$PrecioVenta3')";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {

            $ucod=$db->lastInsertId();         
            echo '{ "Respuesta" : [{ "Id" : "' . $ucod .'" , "insert" : true }]}';
            //echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo '{ "Respuesta" : [{ "insert" : false }]}';
    }

});  

$app->post('/api-sigop/producto/update', function(Request $request, Response $response){

    $idProducto = $request->getParam('idProducto');

    $idCategoriaProducto = $request->getParam('idCategoriaProducto');
    $UniMedida = $request->getParam('UniMedida');
    $NombreProducto = $request->getParam('NombreProducto');
    $PrecioVenta = $request->getParam('PrecioVenta');
    $PrecioxMayor = $request->getParam('PrecioxMayor');
    $StockMini = $request->getParam('StockMini');
    $PrecioVenta2 = $request->getParam('PrecioVenta2');
    $PrecioVenta3 = $request->getParam('PrecioVenta3');
    
//    $sql = "INSERT INTO Encuesta (Id_enc,Enc,P1,P1_OTRO,P2,P3)  values($Id_enc,$Enc,$P1,'$P1_OTRO',$P2,$P3)";

    $sql = "UPDATE producto SET idCategoriaProducto='$idCategoriaProducto' , 
    UniMedida='$UniMedida' , 
    NombreProducto='$NombreProducto' , 
    PrecioVenta='$PrecioVenta' , 
    PrecioxMayor='$PrecioxMayor' , 
    StockMini='$StockMini' , 
    PrecioVenta2='$PrecioVenta2' , 
    PrecioVenta3='$PrecioVenta3' 
    WHERE idProducto='$idProducto'";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }
});

$app->post('/api-sigop/cliente/update', function(Request $request, Response $response){

    $RucDnICL = $request->getParam('RucDnICL');
    $idTipoCliente = $request->getParam('idTipoCliente');
    $RazonSocial = $request->getParam('RazonSocial');
    $correo = $request->getParam('correo');
    $Telefono = $request->getParam('Telefono');
    $idDistrito = $request->getParam('idDistrito');
    $direccion = $request->getParam('direccion');
    
//    $sql = "INSERT INTO Encuesta (Id_enc,Enc,P1,P1_OTRO,P2,P3)  values($Id_enc,$Enc,$P1,'$P1_OTRO',$P2,$P3)";

    $sql = "UPDATE cliente SET idTipoCliente='$idTipoCliente' , RazonSocial='$RazonSocial' , correo='$correo' , Telefono='$Telefono' , idDistrito='$idDistrito' , direccion='$direccion' WHERE RucDnICL='$RucDnICL'";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }
});


$app->get('/api-sigop/producto/getTipo',  function(Request $request, Response $response) { 
    
   
   $sql = "SELECT * FROM categoriaproducto";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="<option value='' disabled selected>Seleccione Categoría</option>";
            
            foreach ($CategoriaProducto as  $row) {
                $resultado = $resultado . "<option value='" . $row->idCategoriaProducto . "'>" . $row->NombreCategoria . "</option>"; 
            }

            echo json_encode($resultado);
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});




$app->get('/api-sigop/tipomovimiento/getTipo',  function(Request $request, Response $response) { 
    
   
   $sql = "SELECT * FROM tipomovimiento where 	idTipoMovimiento not in(7)";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="<option value='' disabled selected>Seleccione movimiento</option>";            
            
            session_start(); 

            foreach ($CategoriaProducto as  $row) {
                
                //if( ($_SESSION['NombreArea'] == "ALMACEN / DESPACHO" || $_SESSION['NombreArea'] == "VENTAS / DESPACHO INT.") && ($row->idTipoMovimiento!=1 && $row->idTipoMovimiento!=3 && $row->idTipoMovimiento!=8  && $row->idTipoMovimiento!=4) ){
                
                if( ($_SESSION['NombreArea'] == "ALMACEN / DESPACHO") && ($row->idTipoMovimiento!=1 && $row->idTipoMovimiento!=3 && $row->idTipoMovimiento!=8 && $row->idTipoMovimiento!=9 && $row->idTipoMovimiento!=10 && $row->idTipoMovimiento!=4) ){
                    //$resultado = $resultado . "<option value='" . $row->idTipoMovimiento . "'>" . $row->Descripcion . "</option>";     
                    $resultado = $resultado . "";
                }
                
                if( ($_SESSION['NombreArea'] == "VENTAS / DESPACHO INT.") && ($row->idTipoMovimiento!=2 && $row->idTipoMovimiento!=4 && $row->idTipoMovimiento!=5  && $row->idTipoMovimiento!=6  && $row->idTipoMovimiento!=7   && $row->idTipoMovimiento!=8 && $row->idTipoMovimiento!=9 && $row->idTipoMovimiento!=10 ) ){
                    $resultado = $resultado . "<option value='" . $row->idTipoMovimiento . "'>" . $row->Descripcion . "</option>";     
                }

                if( ($_SESSION['NombreArea'] == "ALMACEN / COMPRAS") && ($row->idTipoMovimiento!=2 && $row->idTipoMovimiento!=5 && $row->idTipoMovimiento!=6 && $row->idTipoMovimiento!=4) ){
                    $resultado = $resultado . "<option value='" . $row->idTipoMovimiento . "'>" . $row->Descripcion . "</option>";     
                }
                
                if( ($_SESSION['NombreArea'] == "ADMINISTRACIÓN") ){
                    $resultado = $resultado . "<option value='" . $row->idTipoMovimiento . "'>" . $row->Descripcion . "</option>";     
                }

                //$resultado = $resultado . "<option value='" . $row->idTipoMovimiento . "'>" . $row->Descripcion . $_SESSION['NombreArea'] . "</option>"; 
            }

            echo json_encode($resultado);
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});


$app->post('/api-sigop/MovimientoAlmacen/add', function(Request $request, Response $response){


    $idTipoMovimiento = $request->getParam('idTipoMovimiento');
    $idTienda = $request->getParam('idTienda');
    $StockMoviento = $request->getParam('StockMoviento');
    $idProducto = $request->getParam('idProducto');
    $idColaborador = $request->getParam('idColaborador');
    
    $GuiaRemision = $request->getParam('GuiaRemision');
    $idTiendaDestino = $request->getParam('idTiendaDestino');
    $ValorCompra = $request->getParam('ValorCompra');
    
    if($GuiaRemision==""){
        $GuiaRemision = "NULL";
    }
    
    if($ValorCompra==""){
        $ValorCompra = "NULL";
    }
    
    if($idTiendaDestino!=0){
        
        $sql = "INSERT INTO movimientoalmacen (idTipoMovimiento, idTienda, FechaMovimiento,  StockMoviento, idProducto, GuiaRemision , idColaborador , idPedido, idTiendaDestino, ValorCompra) VALUES ('$idTipoMovimiento', '$idTienda', CURRENT_TIMESTAMP ,'$StockMoviento', '$idProducto', $GuiaRemision , '$idColaborador' , NULL, '$idTiendaDestino', $ValorCompra)";
        
    }else{ 
        
        $sql = "INSERT INTO movimientoalmacen (idTipoMovimiento, idTienda, FechaMovimiento,  StockMoviento, idProducto, GuiaRemision , idColaborador , idPedido, idTiendaDestino, ValorCompra) VALUES ('$idTipoMovimiento', '$idTienda', CURRENT_TIMESTAMP ,'$StockMoviento', '$idProducto', $GuiaRemision , '$idColaborador' , NULL, NULL, $ValorCompra)";
    }

    

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
        //echo json_encode(FALSE);
    }



});

$app->post('/api-sigop/MovimientoAlmacenOP/add', function(Request $request, Response $response){


    $idTipoMovimiento = $request->getParam('idTipoMovimiento');
    $idTienda = $request->getParam('idTienda');
    $StockMoviento = $request->getParam('StockMoviento');
    $idProducto = $request->getParam('idProducto');
    $idColaborador = $request->getParam('idColaborador');
    $idPedido = $request->getParam('idPedido');

    $sql = "INSERT INTO movimientoalmacen (idTipoMovimiento, idTienda, FechaMovimiento,  StockMoviento, idProducto, GuiaRemision , idColaborador , idPedido) VALUES ('$idTipoMovimiento', '$idTienda', CURRENT_TIMESTAMP ,'$StockMoviento', '$idProducto', NULL , '$idColaborador' , '$idPedido')";
    

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }



});


$app->post('/api-sigop/MovimientoAlmacenOP/delete', function(Request $request, Response $response){

    $idPedido = $request->getParam('idPedido');

    $sql = "DELETE FROM movimientoalmacen WHERE idPedido='$idPedido'";
    

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }


});


$app->post('/api-sigop/MovimientoAlmacenID/delete', function(Request $request, Response $response){

    $idMovimientoAlmacen = $request->getParam('idMovimientoAlmacen');

    $sql = "DELETE FROM movimientoalmacen WHERE idMovimientoAlmacen='$idMovimientoAlmacen'";
    
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }


});


$app->get('/api-sigop/MovimientoAlmacen/getMovimientos',  function(Request $request, Response $response) { 
    
    $idProducto = $request->getParam('idProducto');
    $idTienda = $request->getParam('idTienda');
   
   /*$sql = "SELECT pro.NombreProducto , mov.StockMoviento,  tm.Descripcion , mov.FechaMovimiento , mov.idPedido
FROM movimientoalmacen mov, producto pro , tipomovimiento tm
where mov.idProducto=pro.idProducto and tm.idTipoMovimiento=mov.idTipoMovimiento and mov.idProducto=$idProducto";
   */

  $sql = "SELECT mov.idMovimientoAlmacen, pro.NombreProducto , mov.StockMoviento,  tm.Descripcion , date(mov.FechaMovimiento) as FechaMovimiento , mov.idPedido , 
  (select NombreTienda from tienda where idTienda=mov.idTiendaDestino) as td
  FROM movimientoalmacen mov, producto pro , tipomovimiento tm 
  where mov.idProducto=pro.idProducto and tm.idTipoMovimiento=mov.idTipoMovimiento and date(mov.FechaMovimiento)>='2019-10-06' and mov.idProducto=$idProducto and mov.idTienda=$idTienda
  order by mov.FechaMovimiento desc
  limit 150"; 


   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            session_start(); 
            
            foreach ($CategoriaProducto as  $row) {
  

                if ($_SESSION["idArea"]==1) {
                    # code...
    //                 $resultado = $resultado . "<tr>
    // <td><input type='hidden' value='" . $row->idMovimientoAlmacen . "'><input id='nompro1' type='text' value='" . $row->NombreProducto . "' class='form-control' readonly='true'></td>
    // <td><input id='stock' class='form-control' type='text' value='" . $row->StockMoviento . "' readonly='true'></td>
    // <td><input id='preciounit1' class='form-control' style='font-size:8pt;' value='" . $row->Descripcion . "' readonly='true'></td>
    // <td><input id='fecha' readonly='true' class='form-control' placeholder='' style='width: 100%;' type='input' value='" . $row->FechaMovimiento . "'><input id='idPedido' type='hidden' value='" . $row->idPedido . "'></td>
    // <td><input id='destino' readonly='true' class='form-control' placeholder='' style='width: 100%;' type='input' value='" . $row->td . "'></td>
    // <td><button type='button' class='btn btn-danger'>Eliminar</button></td>
    // </tr>"; 

    $resultado = $resultado . "<tr>
    <td><input type='hidden' value='" . $row->idMovimientoAlmacen . "'>" . $row->NombreProducto . "</td>
    <td>" . $row->StockMoviento . "</td>
    <td>" . $row->Descripcion . "</td>
    <td>" . $row->FechaMovimiento . "<input id='idPedido' type='hidden' value='" . $row->idPedido . "'></td>
    <td>" . $row->td . "</td>
    <td><button class='btn waves-effect red lighten-2' type='button' name='action' style='width: 100%;'><i class='material-icons center'>delete</i></button></td>
    </tr>"; 


                }else{

    //                 $resultado = $resultado . "<tr>
    // <td><input type='hidden' value='" . $row->idMovimientoAlmacen . "'><input id='nompro1' type='text' value='" . $row->NombreProducto . "' class='form-control' readonly='true'></td>
    // <td><input id='stock' class='form-control' type='text' value='" . $row->StockMoviento . "' readonly='true'></td>
    // <td><input id='preciounit1' class='form-control' style='font-size:8pt;' value='" . $row->Descripcion . "' readonly='true'></td>
    // <td><input id='fecha' readonly='true' class='form-control' placeholder='' style='width: 100%;' type='input' value='" . $row->FechaMovimiento . "'><input id='idPedido' type='hidden' value='" . $row->idPedido . "'></td>
    // <td><input id='destino' readonly='true' class='form-control' placeholder='' style='width: 100%;' type='input' value='" . $row->td . "'></td>
    // <td></td>
    // </tr>"; 

    $resultado = $resultado . "<tr>
    <td><input type='hidden' value='" . $row->idMovimientoAlmacen . "'>" . $row->NombreProducto . "</td>
    <td>" . $row->StockMoviento . "</td>
    <td>" . $row->Descripcion . "</td>
    <td>" . $row->FechaMovimiento . "<input id='idPedido' type='hidden' value='" . $row->idPedido . "'></td>
    <td>" . $row->td . "</td>
    <td></td>
    </tr>"; 


                }

            }

            echo json_encode($resultado);
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});




$app->get('/api-sigop/MovimientoAlmacen/getMovimientosFecha',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getParam('FechaInicio');
    $FechaFin = $request->getParam('FechaFin');
  
   
    $sql = "SELECT t.NombreTienda as TiendaOrigen,  tm.Descripcion as Movimiento, pro.NombreProducto , mov.StockMoviento, 
        mov.FechaMovimiento , mov.idPedido , (select NombreTienda from tienda where idTienda=mov.idTiendaDestino) as TiendaDestino
FROM movimientoalmacen mov, producto pro , tipomovimiento tm , colaborador col , tienda t
where mov.idProducto=pro.idProducto and tm.idTipoMovimiento=mov.idTipoMovimiento and col.idColaborador=mov.idColaborador
and t.idTienda=mov.idTienda
and date(mov.FechaMovimiento)>='$FechaInicio' and date(mov.FechaMovimiento)<='$FechaFin'";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            
            foreach ($CategoriaProducto as  $row) {
        
        /*$resultado = $resultado . "<tr><td><label class='control-label'>1</label></td>
    <td><input id='nompro1' type='text' value='" . $row->NombreProducto . "' class='form-control' readonly='true'></td>
    <td><input id='stock' class='form-control' type='text' value='" . $row->StockMoviento . "' readonly='true'></td>
    <td><input id='preciounit1' class='form-control' value='" . $row->Descripcion . "' readonly='true'></td>
    <td><input id='fecha' readonly='true' class='form-control' placeholder='' style='width: 100%;' type='input' value='" . $row->FechaMovimiento . "'><input id='idPedido' type='hidden' value='" . $row->idPedido . "'></td>
</tr>"; */
        
        $resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 100px;'>" . $row->TiendaOrigen . "</td><td style='width: 100px;'>" . $row->Movimiento . "</td><td style='width: 200px;'>" . $row->NombreProducto . "</td><td class='text-center' style='width: 100px;'>" . $row->StockMoviento . "</td><td style='width: 100px;'>" . $row->FechaMovimiento . "</td><td class='text-center' style='width: 50px;'>" . $row->idPedido . "</td><td style='width: 100px;'>" . $row->TiendaDestino . "</td><td class='text-center' style='width: 100px;''>-</td></tr>";
        
            }

            echo json_encode($resultado);
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});



$app->post('/api-sigop/entrega/add', function(Request $request, Response $response){
 
    $idPedido = $request->getParam('idPedido'); 
    $Encargado = $request->getParam('Encargado');
    $Destino = $request->getParam('Destino'); 
    $Receptor = $request->getParam('Receptor'); 

        $sql = "INSERT INTO EntregaPedidos (idPedido, Encargado, Destino, Receptor) VALUES ($idPedido, '$Encargado', '$Destino', '$Receptor')";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
            $ucod=$db->lastInsertId();
         
            echo '{ "Respuesta" : [{ "Id" : "' . $ucod .'" , "insert" : true }]}';

        }
    
    } catch(PDOException $e){

            //echo '{ "Respuesta" : [{ "insert" : false }]}';
            echo '{"error": {"text": '.$e->getMessage().'}}';
    }


});




$app->post('/api-sigop/pedido/add', function(Request $request, Response $response){

    $TipoComprobante = $request->getParam('TipoComprobante'); 
    $idPedido_ref = $request->getParam('pedido'); 

    $RucDnICL = $request->getParam('RucDnICL');
    $idTienda = $request->getParam('idTienda');
    $idColaborador = $request->getParam('idColaborador');
    $FechaEntrega = $request->getParam('FechaEntrega');
    $EmpresaRuc = $request->getParam('EmpresaRuc');
    $EstadoPedido = $request->getParam('EstadoPedido'); // R : REGISTRADO  |  E: ENTREGADO   |  A: ANULADO
    $ValoTipoCambio = 1.00;

    $MontoEfectivo = $request->getParam('MontoEfectivo');
    $MontoDeposito = $request->getParam('MontoDeposito');
    $MontoSaldo = $request->getParam('MontoSaldo');

    $EstadoCobro = $request->getParam('EstadoCobro'); // P: POR COBRAR  |  A: ANULADO |  C: CANCELADO
    $EstadoDespacho = $request->getParam('EstadoDespacho');

    $Nota = $request->getParam('Nota');

    if ($TipoComprobante=='NC') {
        $sql = "INSERT INTO pedido (RucDnICL, idTienda, idColaborador, FechaPedido , FechaEntrega, EmpresaRuc, EstadoPedido, ValoTipoCambio, MontoEfectivo, MontoDeposito, EstadoCobro, EstadoDespacho, Nota, MontoSaldo, Correlativo, TipoComprobante, idPedido_ref) VALUES ('$RucDnICL', '$idTienda', '$idColaborador', CURRENT_TIMESTAMP , '$FechaEntrega', '$EmpresaRuc', '$EstadoPedido', '$ValoTipoCambio', '$MontoEfectivo', '$MontoDeposito', '$EstadoCobro', '$EstadoDespacho', '$Nota' , '$MontoSaldo', Correlativo($idTienda), '$TipoComprobante', $idPedido_ref )";
    }else{
        $sql = "INSERT INTO pedido (RucDnICL, idTienda, idColaborador, FechaPedido , FechaEntrega, EmpresaRuc, EstadoPedido, ValoTipoCambio, MontoEfectivo, MontoDeposito, EstadoCobro, EstadoDespacho, Nota, MontoSaldo, Correlativo, TipoComprobante) VALUES ('$RucDnICL', '$idTienda', '$idColaborador', CURRENT_TIMESTAMP , '$FechaEntrega', '$EmpresaRuc', '$EstadoPedido', '$ValoTipoCambio', '$MontoEfectivo', '$MontoDeposito', '$EstadoCobro', '$EstadoDespacho', '$Nota' , '$MontoSaldo', Correlativo($idTienda), '$TipoComprobante' )";
    }

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
            $ucod=$db->lastInsertId();
         
            echo '{ "Respuesta" : [{ "Id" : "' . $ucod .'" , "insert" : true }]}';

        }
    
    } catch(PDOException $e){

            //echo '{ "Respuesta" : [{ "insert" : false }]}';
            echo '{"error": {"text": '.$e->getMessage().'}}';
    }


});




$app->post('/api-sigop/pedido/update', function(Request $request, Response $response){


    $idPedido = $request->getParam('idPedido');
    $EstadoPedido = $request->getParam('EstadoPedido');
    $EstadoCobro = $request->getParam('EstadoCobro');

    $MontoEfectivo = $request->getParam('MontoEfectivo');
    $MontoDeposito = $request->getParam('MontoDeposito');
    $MontoSaldo = $request->getParam('MontoSaldo');

    $sql = "UPDATE pedido SET EstadoPedido='$EstadoPedido' , EstadoCobro='$EstadoCobro' , MontoEfectivo=$MontoEfectivo , MontoDeposito=$MontoDeposito , MontoSaldo=$MontoSaldo  WHERE idPedido='$idPedido'";

/*$sql = "INSERT INTO pedido (RucDnICL, idTienda, idColaborador, FechaPedido, FechaEntrega, EmpresaRuc, EstadoPedido, ValoTipoCambio, idEnvioPedidos, idComprobanteVenta) VALUES (RucDnICL, '1', '1', CURRENT_TIMESTAMP, '2018-02-01', '2147483647', 'P', '1.00', NULL, NULL)";
*/
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
            $ucod=$db->lastInsertId();
         
            echo '{ "Respuesta" : [{ "Id" : "' . $ucod .'" , "update" : true }]}';

        }
    
    } catch(PDOException $e){

            echo '{ "Respuesta" : [{ "insert" : false }]}';
    }


});


$app->post('/api-sigop/pedido/anular', function(Request $request, Response $response){


    $idPedido = $request->getParam('idPedido');  
    $EstadoPedido = $request->getParam('EstadoPedido');  
    $EstadoCobro = $request->getParam('EstadoCobro');  

    $sql = "UPDATE pedido SET EstadoPedido='$EstadoPedido' , EstadoCobro='$EstadoCobro' ,  MontoEfectivo=0.00 , MontoDeposito=0.00 , MontoSaldo=0.00 WHERE idPedido='$idPedido'; UPDATE detallepedido SET Cantidad=0.00 , PrecioUnit=0.00 , PrecioTotal=0.00 , Desct=0.00 WHERE idPedido='$idPedido' ";

/*$sql = "INSERT INTO pedido (RucDnICL, idTienda, idColaborador, FechaPedido, FechaEntrega, EmpresaRuc, EstadoPedido, ValoTipoCambio, idEnvioPedidos, idComprobanteVenta) VALUES (RucDnICL, '1', '1', CURRENT_TIMESTAMP, '2018-02-01', '2147483647', 'P', '1.00', NULL, NULL)";
*/
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
            $ucod=$db->lastInsertId();
         
            echo '{ "Respuesta" : [{ "Id" : "' . $ucod .'" , "update" : true }]}';

        }
    
    } catch(PDOException $e){

            echo '{ "Respuesta" : [{ "insert" : false }]}';
    }


});


$app->post('/api-sigop/pedido/setDespacho', function(Request $request, Response $response){


    $idPedido = $request->getParam('idPedido');  
    $EstadoDespacho = $request->getParam('EstadoDespacho');  


    $sql = "UPDATE pedido SET EstadoDespacho='$EstadoDespacho' WHERE idPedido='$idPedido'";

/*$sql = "INSERT INTO pedido (RucDnICL, idTienda, idColaborador, FechaPedido, FechaEntrega, EmpresaRuc, EstadoPedido, ValoTipoCambio, idEnvioPedidos, idComprobanteVenta) VALUES (RucDnICL, '1', '1', CURRENT_TIMESTAMP, '2018-02-01', '2147483647', 'P', '1.00', NULL, NULL)";
*/
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
            $ucod=$db->lastInsertId();
         
            echo '{ "Respuesta" : [{ "Id" : "' . $ucod .'" , "update" : true }]}';

        }
    
    } catch(PDOException $e){

            echo '{ "Respuesta" : [{ "insert" : false }]}';
    }


});




$app->post('/api-sigop/detallepedido/add', function(Request $request, Response $response){

    
    $idPedido = $request->getParam('idPedido');
    $idProducto = $request->getParam('idProducto');
    $Cantidad = $request->getParam('Cantidad');
    $PrecioUnit = $request->getParam('PrecioUnit');
    $PrecioTotal = $request->getParam('PrecioTotal');    
    $Desct = $request->getParam('Desct');    
 
    $sql = "INSERT INTO detallepedido (idPedido, idProducto, Cantidad, PrecioUnit, PrecioTotal, Desct) VALUES ('$idPedido', '$idProducto', '$Cantidad', '$PrecioUnit', '$PrecioTotal', '$Desct')";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
/*            session_start(); 
            $_SESSION["pagina"]='/encuesta/pagina-dos';*/
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }



});


$app->get('/api-sigop/pedido/getVentas',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getQueryParam('FechaInicio');
    $FechaFin = $request->getQueryParam('FechaFin');
    $idTienda = $request->getQueryParam('idTienda');
   

$sql = "SELECT p.idPedido , p.Correlativo, p.TipoComprobante , p.FechaPedido , p.RucDnICL , cl.RazonSocial , 
case 
    when (select count(*) from detallepedido where idPedido=p.idPedido)=1 then pro.NombreProducto 
    when (select count(*) from detallepedido where idPedido=p.idPedido)>1 then 'INGRESOS VARIOS' 
end AS Nomproducto, 
case 
when p.EstadoCobro='P' then 'PENDIENTE DE COBRO' 
when p.EstadoCobro='C' then 'CANCELADO' 
when p.EstadoCobro='A' then 'ANULADO' 
when p.EstadoCobro='' then 'A LA ESPERA' 
end as EstadoCobro, (select SUM(Cantidad) from detallepedido where idPedido=p.idPedido) as Cant , 
p.MontoEfectivo , p.MontoDeposito , p.MontoSaldo , sum(dp.PrecioTotal) as PrecioTotal , sum(dp.Desct) as Desct
FROM pedido p , cliente cl , detallepedido dp , producto pro
where p.idPedido=dp.idPedido and dp.idProducto=pro.idProducto and cl.RucDnICL=p.RucDnICL and p.idTienda like '%$idTienda%'
and date(p.FechaPedido) >='$FechaInicio' and date(p.FechaPedido)<='$FechaFin' 
group by p.idPedido , p.RucDnICL , cl.RazonSocial , p.EstadoCobro , p.MontoEfectivo , p.MontoDeposito , p.MontoSaldo, Nomproducto";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            $conta=0;
            $efectivo=0;
            $deposito=0;
            $saldo=0;
            $total=0;
            $Desct=0;

            foreach ($CategoriaProducto as  $row) {

                $efectivo = $efectivo + $row->MontoEfectivo;
                $deposito = $deposito + $row->MontoDeposito;
                $saldo = $saldo + $row->MontoSaldo;            
                $total = $total + ( $row->PrecioTotal - $row->Desct );                

                $conta = $conta + 1;
                $idPedido=$row->idPedido;
                $resultado = $resultado . "<tr><td style='width: 70px;'>" . $row->idPedido . " - " . $row->Correlativo . "</td><td style='width: 30px;'>" . $row->TipoComprobante . "</td><td style='width: 70px;font-size: 7pt;'>" . $row->FechaPedido . "</td><td style='width: 90px;'>" . $row->RucDnICL . "</td><td style='width: 250px;'>" . $row->RazonSocial . "</td><td style='width: 250px;'>" . $row->Nomproducto . "</td><td style='width: 100px;'>" . $row->EstadoCobro . "</td><td style='width: 100px;'>" . $row->Cant . "</td><td style='width: 100px;'>" . $row->MontoEfectivo . "</td><td style='width: 100px;'>" . $row->MontoDeposito . "</td><td style='width: 100px;'>" . $row->MontoSaldo . "</td><td style='width: 100px;'><b>" . $row->PrecioTotal . "</b></td><td style='width: 100px;'>" . $row->Desct . "</td></tr>";

            }

    echo '{ "Respuesta" : [{ "idPedido" : "' . $idPedido .'" ,  "detalle" : "' . $resultado .'" , "Filas" : ' . $conta . ' , "efectivo" : ' . $efectivo . ' , "deposito" : ' . $deposito . ' , "saldo" : ' . $saldo . ' , "total" : ' . $total . ' }]}';
    
            //echo '{ "Respuesta" : [{ "Filas" : ' . $conta  . ' }]}';
        }else{
             echo '{ "Respuesta" : [{ "Filas" : 0 }]}';    
        }

        //echo '{ "Respuesta" : [{ "Filas" : 0 }]}';
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
   }

   
   
});


$app->get('/api-sigop/ranking/vendedor',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getParam('FechaInicio');
    $FechaFin = $request->getParam('FechaFin');
   

$sql = "and date(p.FechaPedido) >='$FechaInicio' and date(p.FechaPedido)<='$FechaFin'";
   
try{
       
    // Get DB Object
    $db = new db();
    // Connect
    $db = $db->connect();
    $stmt = $db->query($sql);
    $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    
    if(count($CategoriaProducto)>0){            
        
        $resultado="";
        
        foreach ($CategoriaProducto as  $row) {


//$resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 50px;'>" . $row->idProducto . "</td><td style='width: 200px;'>" . $row->NombreProducto . "</td><td style='width: 150px;'>" . $row->NombreCategoria . "</td><td style='width: 100px;'>" . $row->StockTotal . "</td></tr>";

        }

        echo json_encode($resultado);
    }
   
   
} catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
}
   
   
});


$app->get('/api-sigop/ranking/insumos',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getQueryParam('FechaInicio');
    $FechaFin = $request->getQueryParam('FechaFin');
    $idTienda = $request->getQueryParam('idTienda');
   

$sql = "SELECT pro.idProducto , pro.NombreProducto , sum(dpe.Cantidad) as CantVenta FROM pedido pe , producto pro , detallepedido dpe
WHERE dpe.idPedido=pe.idPedido and dpe.idProducto=pro.idProducto and date(pe.FechaPedido) >='$FechaInicio' and date(pe.FechaPedido)<='$FechaFin' and pe.idTienda like '%$idTienda%' 
GROUP by pro.idProducto , pro.NombreProducto 
ORDER by CantVenta DESC
LIMIT 10";
   
try{
       
    // Get DB Object
    $db = new db();
    // Connect
    $db = $db->connect();
    $stmt = $db->query($sql);
    $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    
    if(count($CategoriaProducto)>0){            
        
        $resultado="";
        $conta = 0;
        
        foreach ($CategoriaProducto as  $row) {
         
        $conta = $conta + 1;

$resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 50px;'>" . $conta . "</td><td style='width: 200px;'>" . $row->NombreProducto . "</td><td style='width: 150px;'>" . $row->CantVenta  . "</td></tr>";


        }

        echo json_encode($resultado);
    }
   
   
} catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
}
   
   
});


$app->get('/api-sigop/ranking/montinsumos',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getParam('FechaInicio');
    $FechaFin = $request->getParam('FechaFin');
    $idTienda = $request->getParam('idTienda');

$sql = "SELECT pro.idProducto , pro.NombreProducto , sum(dpe.Cantidad) as CantVenta , sum(dpe.PrecioTotal) as MontVenta FROM pedido pe , producto pro , detallepedido dpe
WHERE dpe.idPedido=pe.idPedido and dpe.idProducto=pro.idProducto and date(pe.FechaPedido) >='$FechaInicio' and date(pe.FechaPedido)<='$FechaFin' and pe.idTienda like '%$idTienda%' 
GROUP by pro.idProducto , pro.NombreProducto 
ORDER by MontVenta DESC
LIMIT 10";
   
try{
       
    // Get DB Object
    $db = new db();
    // Connect
    $db = $db->connect();
    $stmt = $db->query($sql);
    $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    
    if(count($CategoriaProducto)>0){            
        
        $resultado="";
        $conta = 0;
        
        foreach ($CategoriaProducto as  $row) {
         
        $conta = $conta + 1;

        $resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 50px;'>" . $conta . "</td><td style='width: 200px;'>" . $row->NombreProducto . "</td><td style='width: 150px;'>" . $row->CantVenta  . "</td><td style='width: 150px;'>" . $row->MontVenta  . "</td></tr>";


        }

        echo json_encode($resultado);
    }
   
   
} catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
}
   
   
});


$app->get('/api-sigop/ranking/clientes',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getParam('FechaInicio');
    $FechaFin = $request->getParam('FechaFin');
   
 $sql = "SELECT pe.RucDnICL , cl.RazonSocial, SUM( pe.MontoEfectivo  + pe.MontoDeposito +  pe.MontoSaldo ) as TotalVentas
    FROM pedido pe , cliente cl
    WHERE cl.RucDnICL=pe.RucDnICL and date(pe.FechaPedido) >='$FechaInicio' and date(pe.FechaPedido)<='$FechaFin' 
    GROUP BY pe.RucDnICL , cl.RazonSocial
    ORDER BY TotalVentas DESC
    LIMIT 10";
   
try{
       
    // Get DB Object
    $db = new db();
    // Connect
    $db = $db->connect();
    $stmt = $db->query($sql);
    $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    
    if(count($CategoriaProducto)>0){            
        
        $resultado="";
        $conta = 0;
        
        foreach ($CategoriaProducto as  $row) {

        $conta = $conta + 1;

$resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 50px;'>" . $conta . "</td><td style='width: 50px;'>" . $row->RucDnICL . "</td><td style='width: 200px;'>" . $row->RazonSocial . "</td><td style='width: 150px;'>" . $row->TotalVentas  . "</td></tr>";

        }

        echo json_encode($resultado);
    }
   
   
} catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
}
      
});


$app->get('/api-sigop/ranking/vendedores',  function(Request $request, Response $response) { 
    
    $FechaInicio = $request->getParam('FechaInicio');
    $FechaFin = $request->getParam('FechaFin');
   
 $sql = "SELECT col.idColaborador , CONCAT(col.Nombres, ' ' , col.Apellidos) as Nombres , t.NombreTienda ,  FORMAT(sum(pe.MontoEfectivo + pe.MontoDeposito + pe.MontoSaldo),2) AS Total
 FROM pedido pe , colaborador col , tienda t
 WHERE col.idColaborador=pe.idColaborador and col.idTienda=t.idTienda and pe.EstadoCobro in('C') and date(pe.FechaPedido) >='$FechaInicio' and date(pe.FechaPedido)<='$FechaFin'
 GROUP BY col.idColaborador , Nombres
 ORDER BY sum(pe.MontoEfectivo + pe.MontoDeposito + pe.MontoSaldo) DESC";
   
try{
       
    // Get DB Object
    $db = new db();
    // Connect
    $db = $db->connect();
    $stmt = $db->query($sql);
    $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    
    if(count($CategoriaProducto)>0){            
        
        $resultado="";
        $conta = 0;
        
        foreach ($CategoriaProducto as  $row) {

        $conta = $conta + 1;

$resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 50px;'>" . $conta . "</td><td style='width: 50px;'>" . $row->idColaborador . "</td><td style='width: 200px;'>" . $row->Nombres . "</td><td style='width: 100px;'>" . $row->NombreTienda . "</td><td style='width: 150px;'>" . $row->Total  . "</td></tr>";

        }

        echo json_encode($resultado);
    }
   
   
} catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
}
   
   
});



$app->get('/api-sigop/pedido/getPedido',  function(Request $request, Response $response) { 
    
    //$idPedido = $request->getParam("idPedido");
    $idPedido = $request->getQueryParam('idPedido');
   
   $sql = "SELECT ti.idTienda , ti.NombreTienda , em.RazonSocial as NombreEmpresa , col.idColaborador, CONCAT(Nombres , ' ' , Apellidos) as NombresCol , cl.RucDnICL , cl.RazonSocial, 
case 
when pe.EstadoPedido='A' then 'ANULADO'
when pe.EstadoPedido='R' then 'PEDIDO REGISTRADO' 
end as EstadoPedido,
case 
when pe.EstadoCobro='P' then 'PENDIENTE DE COBRO' 
when pe.EstadoCobro='C' then 'CANCELADO' 
when pe.EstadoCobro='A' then 'ANULADO' 
when pe.EstadoCobro='' then 'A LA ESPERA DE COBRANZA' 
end as EstadoCobro,
dp.idPedido , p.idProducto , 
p.NombreProducto , dp.Cantidad , dp.PrecioUnit , dp.PrecioTotal , dp.Desct , pe.MontoEfectivo , pe.MontoDeposito , pe.MontoSaldo 
FROM detallepedido dp , producto p , pedido pe , cliente cl , colaborador col , empresa em , tienda ti
where pe.idPedido=dp.idPedido and p.idProducto=dp.idProducto and pe.RucDnICL=cl.RucDnICL and col.idColaborador=pe.idColaborador 
and em.EmpresaRuc=pe.EmpresaRuc and ti.idTienda=pe.idTienda
and pe.idPedido = $idPedido";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            $conta=0;

            foreach ($CategoriaProducto as  $row) {

                $conta = $conta + 1;

                $idTienda=$row->idTienda;
                $NombreTienda=$row->NombreTienda;
                $RucDnICL=$row->RucDnICL;
                $RazonSocial=$row->RazonSocial;
                $idColaborador=$row->idColaborador;
                $NombresCol=$row->NombresCol;
                $EstadoPedido=$row->EstadoPedido;
                $EstadoCobro=$row->EstadoCobro;
                $NombreEmpresa=$row->NombreEmpresa;

                $MontoEfectivo=$row->MontoEfectivo;
                $MontoDeposito=$row->MontoDeposito;
                $MontoSaldo=$row->MontoSaldo;                

                $resultado = $resultado . "<tr><td><label class='control-label'>" . $conta . "</label></td><td><input id='idProducto" . $conta . "' type='hidden' value='" . $row->idProducto . "'><input id='NombreProducto" . $conta . "' type='text' class='form-control' readonly='true' value='" . $row->NombreProducto . "'></td><td><input id='Cantidad" . $conta . "' class='form-control' type='text' required maxlength='3' readonly='true' value='" . $row->Cantidad . "'></td><td><input id='PrecioUnit" . $conta . "' class='form-control' value='" . $row->PrecioUnit . "' readonly='true'></td><td><input id='PrecioTotal" . $conta . "' class='form-control' value='" . $row->PrecioTotal . "' readonly='true'></td><td>  <input id='Desct" . $conta . "' type='text' class='form-control'  value='" . $row->Desct . "' style='width: 81px; margin-right: 10px;' disabled> </td><td></td><td></td><td></td><td></td></tr>"; 
            }

            echo '{ "Respuesta" : [{ "idTienda" : "' . $idTienda .'" , "NombreTienda" : "' . $NombreTienda .'" , 
            "RucDnICL" : "' . $RucDnICL .'" , 
            "RazonSocial" : "' . $RazonSocial .'" , 
            "idColaborador" : "' . $idColaborador .'" , 
            "NombresCol" : "' . $NombresCol .'" , 
            "EstadoPedido" : "' . $EstadoPedido .'" , 
            "EstadoCobro" : "' . $EstadoCobro .'" , 
            "NombreEmpresa" : "' . $NombreEmpresa .'" ,
            "MontoEfectivo" : "' . $MontoEfectivo .'" ,
            "MontoDeposito" : "' . $MontoDeposito .'" ,             
            "MontoSaldo" : "' . $MontoSaldo .'" ,             
            "Filas" : ' . $conta .' ,             
            "detalle" : "' . $resultado .'" }]}';
            
        }else{
             echo '{ "Respuesta" : [{ "Filas" : 0 }]}';    
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }

   
});




$app->get('/api-sigop/pedido/getPedidoNC',  function(Request $request, Response $response) { 
    
    //$idPedido = $request->getParam("idPedido");
    $idPedido = $request->getQueryParam('idPedido');
   
   $sql = "SELECT ti.idTienda , ti.NombreTienda , em.EmpresaRuc , em.RazonSocial as NombreEmpresa , col.idColaborador, CONCAT(Nombres , ' ' , Apellidos) as NombresCol , cl.RucDnICL , cl.RazonSocial, 
   pe.EstadoPedido as EstadoPedidoID,
case 
when pe.EstadoPedido='A' then 'ANULADO'
when pe.EstadoPedido='R' then 'PEDIDO REGISTRADO' 
end as EstadoPedido,
    pe.EstadoCobro as EstadoCobroID,
case 
when pe.EstadoCobro='P' then 'PENDIENTE DE COBRO' 
when pe.EstadoCobro='C' then 'CANCELADO' 
when pe.EstadoCobro='A' then 'ANULADO' 
when pe.EstadoCobro='' then 'A LA ESPERA DE COBRANZA' 
end as EstadoCobro,
dp.idPedido , p.idProducto , 
p.NombreProducto , dp.Cantidad , dp.PrecioUnit , dp.PrecioTotal , dp.Desct , pe.MontoEfectivo , pe.MontoDeposito , pe.MontoSaldo 
FROM detallepedido dp , producto p , pedido pe , cliente cl , colaborador col , empresa em , tienda ti
where pe.idPedido=dp.idPedido and p.idProducto=dp.idProducto and pe.RucDnICL=cl.RucDnICL and col.idColaborador=pe.idColaborador 
and em.EmpresaRuc=pe.EmpresaRuc and ti.idTienda=pe.idTienda
and pe.idPedido = $idPedido";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            $conta=0;

            foreach ($CategoriaProducto as  $row) {

                $conta = $conta + 1;

                $idTienda=$row->idTienda;
                $NombreTienda=$row->NombreTienda;
                $RucDnICL=$row->RucDnICL;
                $RazonSocial=$row->RazonSocial;
                $idColaborador=$row->idColaborador;
                $NombresCol=$row->NombresCol;
                $EstadoPedidoID=$row->EstadoPedidoID;
                $EstadoPedido=$row->EstadoPedido;
                $EstadoCobroID=$row->EstadoCobroID;
                $EstadoCobro=$row->EstadoCobro;
                $EmpresaRuc=$row->EmpresaRuc;
                $NombreEmpresa=$row->NombreEmpresa;

                $MontoEfectivo=$row->MontoEfectivo;
                $MontoDeposito=$row->MontoDeposito;
                $MontoSaldo=$row->MontoSaldo;                

                $resultado = $resultado . "<tr><td><label class='control-label'>" . $conta . "</label></td><td><input id='idProducto" . $conta . "' type='hidden' value='" . $row->idProducto . "'><input id='NombreProducto" . $conta . "' type='text' class='form-control' readonly='true' value='" . $row->NombreProducto . "'></td><td><input id='Cantidad" . $conta . "' class='form-control' type='text' value='" . $row->Cantidad . "'></td><td><input id='PrecioUnit" . $conta . "' class='form-control' value='" . $row->PrecioUnit . "' readonly='true'></td><td><input id='PrecioTotal" . $conta . "' class='form-control' value='" . $row->PrecioTotal . "' readonly='true'></td><td>  <input id='Desct" . $conta . "' type='text' class='form-control'  value='" . $row->Desct . "' style='width: 81px; margin-right: 10px;' disabled> </td><td> <button type='button' class='btn btn-danger btnEliminar' onclick=''>Eliminar</button> </td></tr>"; 

            }

            echo '{ "Respuesta" : [{ "idTienda" : "' . $idTienda .'" , "NombreTienda" : "' . $NombreTienda .'" , 
            "RucDnICL" : "' . $RucDnICL .'" , 
            "RazonSocial" : "' . $RazonSocial .'" , 
            "idColaborador" : "' . $idColaborador .'" , 
            "NombresCol" : "' . $NombresCol .'" , 
            "EstadoPedidoID" : "' . $EstadoPedidoID .'" , 
            "EstadoPedido" : "' . $EstadoPedido .'" , 
            "EstadoCobroID" : "' . $EstadoCobroID .'" , 
            "EstadoCobro" : "' . $EstadoCobro .'" , 
            "EmpresaRuc" : "' . $EmpresaRuc .'" ,
            "NombreEmpresa" : "' . $NombreEmpresa .'" ,
            "MontoEfectivo" : "' . $MontoEfectivo .'" ,
            "MontoDeposito" : "' . $MontoDeposito .'" ,             
            "MontoSaldo" : "' . $MontoSaldo .'" ,             
            "Filas" : ' . $conta .' ,             
            "detalle" : "' . $resultado .'" }]}';
            
        }else{
             echo '{ "Respuesta" : []}';    
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }

   
});





// Consulta los pedidos para el despacho en almacen

$app->get('/api-sigop/pedido/getPedidos',  function(Request $request, Response $response) { 
    
   $FechaPedido = $request->getParam('FechaPedido');
   
   /*$sql = "SELECT * FROM pedido where EstadoCobro in('P', 'C') and FechaPedido > '2018-02-26 00:00:01' and FechaPedido < '2018-02-26 23:00:01' order by idPedido desc";*/

   $sql = "SELECT * FROM pedido where EstadoCobro in('P', 'C') and date(FechaPedido) = '$FechaPedido' and idTienda=1 order by idPedido desc";

   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Pedido = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $stmt = null;        
        
        if(count($Pedido)>0){                        
            
            echo json_encode($Pedido);
            
        }else{
             echo '[{ "idPedido" : 0 }]';    
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});


$app->get('/api-sigop/pedido/VistaPrint',  function(Request $request, Response $response) { 
    
    $idPedido = $request->getParam('idPedido');
   
   $sql = "SELECT ti.NombreTienda , em.RazonSocial as NombreEmpresa , col.idColaborador, CONCAT(Nombres , ' ' , Apellidos) as NombresCol , cl.RucDnICL , cl.RazonSocial, 
   case 
   when pe.EstadoPedido='P' then 'PENDIENTE' 
   when pe.EstadoPedido='C' then 'CANCELADO' 
   when pe.EstadoPedido='A' then 'ANULADO' 
   end as EstadoPedido,
   dp.idPedido , p.idProducto , 
   p.NombreProducto , dp.Cantidad , dp.PrecioUnit , dp.PrecioTotal , dp.Desct , p.NombreProducto , pe.FechaPedido , cast(pe.Nota as CHAR) as Nota,
   (SELECT Encargado from EntregaPedidos ep where idPedido = pe.idPedido) as Encargado,
   (SELECT Destino from EntregaPedidos ep where idPedido = pe.idPedido)  AS Destino,
   (SELECT Receptor from EntregaPedidos ep where idPedido = pe.idPedido)  AS Receptor
   FROM detallepedido dp , producto p , pedido pe , cliente cl , colaborador col , empresa em , tienda ti 
   where pe.idPedido=dp.idPedido and p.idProducto=dp.idProducto and pe.RucDnICL=cl.RucDnICL and col.idColaborador=pe.idColaborador
   and em.EmpresaRuc=pe.EmpresaRuc and ti.idTienda=pe.idTienda 
   and pe.idPedido=$idPedido";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            $conta=0;

            foreach ($CategoriaProducto as  $row) {

                $conta = $conta + 1;

                $NombreTienda=$row->NombreTienda;
                $RucDnICL=$row->RucDnICL;
                $RazonSocial=$row->RazonSocial;
                $NombresCol=$row->NombresCol;
                $EstadoPedido=$row->EstadoPedido;
                $NombreEmpresa=$row->NombreEmpresa;
                $FechaPedido=$row->FechaPedido;
                $Nota=$row->Nota;
                $Encargado=$row->Encargado;
                $Destino=$row->Destino;
                $Receptor=$row->Receptor;

                if ($row->Desct>0) {                          
$resultado = $resultado . "<div class='row' style='width: 100%;'><div class='col-xs-1' ' style='font-size: 8pt;'><label>" . $row->Cantidad . "</label></div><div class='col-xs-8' style='font-size: 6pt;'><label>" . $row->NombreProducto . "</label></div><div class='col-xs-2 text-right'><label id='precio" . $conta . "'>" . $row->PrecioTotal . "</label><input type='hidden' id='Desct" . $conta . "' value='". $row->Desct ."'><br><label>-" . $row->Desct . "</label></div></div>"; 
                }else{
                           
$resultado = $resultado . "<div class='row' style='width: 100%;'><div class='col-xs-1' ' style='font-size: 8pt;'><label>" . $row->Cantidad . "</label></div><div class='col-xs-8' style='font-size: 6pt;'><label>" . $row->NombreProducto . "</label></div><div class='col-xs-2 text-right'><label id='precio" . $conta . "'>" . $row->PrecioTotal . "</label><input type='hidden' id='Desct" . $conta . "' value='". $row->Desct ."'></div></div>"; 
                }
         

            }

            echo '{ "Respuesta" : [{ "NombreTienda" : "' . $NombreTienda .'" , 
            "RucDnICL" : "' . $RucDnICL .'" , 
            "RazonSocial" : "' . $RazonSocial .'" , 
            "NombresCol" : "' . $NombresCol .'" , 
            "EstadoPedido" : "' . $EstadoPedido .'" , 
            "NombreEmpresa" : "' . $NombreEmpresa .'" ,
            "FechaPedido" : "' . $FechaPedido .'" ,             
            "Filas" : ' . $conta .' , 
            "Encargado" : "' . $Encargado .'" ,             
            "Destino" : "' . $Destino .'" , 
            "Receptor" : "' . $Receptor .'" , 
            "Nota" : ' . json_encode($Nota) .' ,  
            "detalle" : "' . $resultado .'" }]}';
            
        }else{
             echo '{ "Respuesta" : [{ "Filas" : 0 }]}';    
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});




$app->get('/api-sigop/area/ListarArea',  function(Request $request, Response $response) { 
    
    //$idPrograma = $request->getParam('idPrograma');
    
   
   $sql = "SELECT * FROM area";
   
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            
            foreach ($CategoriaProducto as  $row) {
                $resultado = $resultado . "<option value='" . $row->idArea . "'> " . $row->NombreArea . "</option>"; 
            }

            echo json_encode($resultado);
        }
    
       
       
   } catch(PDOException $e){

        //echo $e->getMessage();
        echo '{"error": { "text": '. $e->getMessage() .' } }';
   }
   
});




$app->get('/api-sigop/area/ListarTienda',  function(Request $request, Response $response) { 
    
    //$idPrograma = $request->getParam('idPrograma');
    
   
   $sql = "SELECT * FROM tienda ORDER BY NombreTienda ASC";
   
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="<option value='' disabled selected>Seleccione tienda de destino</option>";
            
            foreach ($CategoriaProducto as  $row) {
                $resultado = $resultado . "<option value='" . $row->idTienda . "'> " . $row->NombreTienda . "</option>"; 
            }

            echo json_encode($resultado);
        }
    
       
       
   } catch(PDOException $e){

        //echo $e->getMessage();
        echo '{"error": { "text": '. $e->getMessage() .' } }';
   }
   
});


// ---------- API PARA COLABORADOR ------

 $app->post('/api-sigop/colaborador/add', function(Request $request, Response $response){

    $idColaborador = $request->getParam('idColaborador');
    $idTienda = $request->getParam('idTienda');
    $idArea = $request->getParam('idArea');
    $Nombres = $request->getParam('Nombres');
    $Apellidos = $request->getParam('Apellidos');
    $Correo = $request->getParam('Correo');
    $Pass = password_hash($idColaborador, PASSWORD_DEFAULT);
    

    $sql = "INSERT INTO colaborador (idColaborador, idTienda, idArea,  Nombres, Apellidos, Correo, Pass) VALUES ('$idColaborador', $idTienda, $idArea, '$Nombres', '$Apellidos', '$Correo', '$Pass')";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        if($stmt->execute())
        {
            echo json_encode(TRUE);
        }
    
    } catch(PDOException $e){
        //echo '{"error": {"text": '.$e->getMessage().'}';
        echo json_encode(FALSE);
    }
});


 $app->post('/api-sigop/usuario/acceso-colaborador',  function(Request $request, Response $response) {        
 
    $dni = $request->getParam('dni');    
    $password = $request->getParam('password');
    
    $sql = "SELECT col.idColaborador , ti.idTienda, ti.NombreTienda, ar.idArea, ar.NombreArea , concat(col.Nombres , ' ' , col.Apellidos) as Nombres , col.Correo , col.Pass
FROM colaborador col, tienda ti, area  ar where col.idTienda=ti.idTienda and col.idArea=ar.idArea and idColaborador='$dni'";


    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $colaboradores = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;                 
        
        if(count($colaboradores)==1 && password_verify($password, $colaboradores[0]->Pass))
        {   
           session_start(); 

           $_SESSION["NombreTienda"]=$colaboradores[0]->NombreTienda;
           $_SESSION["idTienda"]=$colaboradores[0]->idTienda;
           $_SESSION["idArea"]=$colaboradores[0]->idArea;           
           $_SESSION["NombreArea"]=$colaboradores[0]->NombreArea;           
           $_SESSION['idColaborador']=$colaboradores[0]->idColaborador;
           $_SESSION['Nombres']=$colaboradores[0]->Nombres;           
           
           echo json_encode(TRUE); 
        }  else {       

           echo json_encode(FALSE); 
        }

        } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }

          
});




$app->get('/api-sigop/Producto/getExistencia',  function(Request $request, Response $response) { 
    
    //Fecha de cierre fue incluido:  date(mov.FechaMovimiento)>='2019-01-09'   |   2019-10-06 
    
    $idTienda = $request->getParam('idTienda');
   
   $sql = "SELECT mov.idProducto , pro.NombreProducto , cat.NombreCategoria , pro.StockMini , sum(mov.StockMoviento) as StockTotal , pro.PrecioCompraBase , FORMAT(sum(mov.StockMoviento) * pro.PrecioCompraBase,2) as MontoValorizado 
FROM movimientoalmacen mov , producto pro , categoriaproducto cat
where pro.idProducto=mov.idProducto and cat.idCategoriaProducto=pro.idCategoriaProducto and date(mov.FechaMovimiento)>='2019-10-06' and mov.idTienda like '%$idTienda%' and pro.idProducto NOT IN(489,498,74,75,76,78,114,134,154,191,206,231,240,245,353,355)
group by mov.idProducto , pro.NombreProducto order by pro.NombreProducto asc";
   
   try{
       
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CategoriaProducto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        if(count($CategoriaProducto)>0){            
            
            $resultado="";
            
            foreach ($CategoriaProducto as  $row) {


    $resultado = $resultado . "<tr onmouseover='this.style.backgroundColor=\"#fffc6b\"' onmouseout='this.style.backgroundColor=\"\"'><td style='width: 50px;'>" . $row->idProducto . "</td><td style='width: 200px;'>" . $row->NombreProducto . "</td><td style='width: 150px;'>" . $row->NombreCategoria . "</td><td style='width: 100px;'>" . $row->StockMini . "</td><td style='width: 100px;'>" . $row->StockTotal . "</td><td style='width: 100px;'>" . $row->PrecioCompraBase . "</td></td><td style='width: 100px;'>" . $row->MontoValorizado . "</td></tr>";

            }

            echo json_encode($resultado);
        }
       
       
   } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
   }
   
});
