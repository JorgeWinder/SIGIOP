<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './Slim/vendor/autoload.php';
require './src/config/db.php';
require './Libs/PHPMailer/PHPMailerAutoload.php';

$app = new \Slim\App();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers', 'Origin, Accept, Accept-  Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version, X-Response-Time, X-PINGOTHER, X-CSRF-Token,Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


$app->get('/',  function(Request $request, Response $response) {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];    
    include_once 'Views/Login.php';    
});

//-------------- Vista de paginas ------------------//

$app->get('/pagina-de-inicio',  function(){  
   include_once 'Views/Home.php';  
});

$app->get('/modulo-de-ventas',  function(){  
   include_once 'Views/modulo-ventas.php';  
});

$app->get('/comprobante-print',  function(){  
   include_once 'Views/comprobante-print.php';  
});

$app->get('/vista-pedido',  function(){  
   include_once 'Views/vista-pedido.php';  
});


$app->get('/modulo-de-cobranzas',  function(){  
   include_once 'Views/modulo-de-cobranzas.php';  
});

$app->get('/modulo-de-almacen',  function(){  
   include_once 'Views/modulo-de-almacen.php';  
});

$app->get('/modulo-de-configuracion',  function(){  
   include_once 'Views/modulo-de-configuracion.php';  
});


$app->get('/registrar-pedido',  function(){  
   include_once 'Views/registrar-pedido.php';  
});

$app->get('/registrar-pedido-v2',  function(){  
    include_once 'Views/registrar-pedido-v2.php';  
 });

 $app->get('/registrar-pedido-v3',  function(){  
    include_once 'Views/registrar-pedido-v3.php';  
 });


$app->get('/registrar-cobranza',  function(){  
   include_once 'Views/registrar-cobranza.php';  
});

$app->get('/registrar-movientos-almacen',  function(){  
   include_once 'Views/registrar-movientos-almacen.php';  
});

$app->get('/mantenimiento-de-tablas',  function(){  
   include_once 'Views/mantenimiento-de-tablas.php';  
});


$app->get('/mantenimiento-de-area',  function(){  
   include_once 'Views/mantenimiento-de-area.php';  
});

$app->get('/mantenimiento-de-tienda',  function(){  
   include_once 'Views/mantenimiento-de-tienda.php';  
});

$app->get('/mantenimiento-de-proveedor',  function(){  
   include_once 'Views/mantenimiento-de-proveedor.php';  
});

$app->get('/mantenimiento-de-cliente',  function(){  
   include_once 'Views/mantenimiento-de-cliente.php';  
});

$app->get('/mantenimiento-de-producto',  function(){  
   include_once 'Views/mantenimiento-de-producto.php';  
});

$app->get('/mantenimiento-de-colaborador',  function(){  
   include_once 'Views/mantenimiento-de-colaborador.php';  
});

$app->get('/gestionar-despacho-de-pedidos',  function(){  
   include_once 'Views/gestionar-despacho-de-pedidos.php';  
});

$app->get('/traslados-internos',  function(){  
   include_once 'Views/traslados-internos.php';  
});

$app->get('/reporte-de-ventas',  function(){  
   include_once 'Views/reporte-de-ventas.php';  
});

$app->get('/consulta-de-existencias',  function(){  
   include_once 'Views/consulta-de-existencias.php';  
});

$app->get('/existencia-general',  function(){  
   include_once 'Views/existencia-general.php';  
});

$app->get('/existencia-por-producto',  function(){  
   include_once 'Views/existencia-por-producto.php';  
});

$app->get('/ranking-de-ventas-y-pedidos',  function(){  
    include_once 'Views/ranking-de-ventas-y-pedidos.php';  
 });

$app->get('/ranking-ventas-por-insumos',  function(){  
    include_once 'Views/ranking-ventas-por-insumos.php';  
});

 $app->get('/ranking-ventas-por-cliente',  function(){  
    include_once 'Views/ranking-ventas-por-clientes.php';  
 });

 $app->get('/ranking-ventas-por-vendedor',  function(){  
    include_once 'Views/ranking-ventas-por-vendedor.php';  
 });
 
 $app->get('/ranking-montos-ventas-por-insumos',  function(){  
    include_once 'Views/ranking-montos-ventas-por-insumos.php';  
 });


 $app->get('/datos-de-cliente',  function(){  
    include_once 'Views/datos-de-cliente.php';  
 });

 $app->get('/restablecer-contrasenia',  function(){  
    include_once 'Views/restablecer-contrasenia.php';  
 });

//-------------------------------------------------//

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

// -------------------Clases o Archivos de ruteo-------------------

require './src/config/ini.php';
require './src/routers/api-sigop.php';

$app->run();
 
