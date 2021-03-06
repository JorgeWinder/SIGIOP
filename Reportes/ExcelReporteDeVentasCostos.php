<?php
include './CnReporte.php';

            $idTienda=$_REQUEST['idTienda'];
            $FechaInicio=$_REQUEST['FechaInicio'];
            $FechaFin=$_REQUEST['FechaFin'];

$stmt = "SELECT p.idPedido, p.Correlativo , t.NombreTienda , p.FechaPedido , p.RucDnICL , cl.RazonSocial ,
pro.NombreProducto AS Nomproducto,
case 
when p.EstadoCobro='P' then 'PENDIENTE DE COBRO' 
when p.EstadoCobro='C' then 'CANCELADO' 
when p.EstadoCobro='A' then 'ANULADO' 
when p.EstadoCobro='' then 'A LA ESPERA' 
end as EstadoCobro, dp.Cantidad as Cant , 
dp.PrecioTotal as PrecioTotal , dp.Desct as Desct , pro.PrecioCompraBase as PrecioCosto , CONCAT(col.Nombres, ' ' , col.Apellidos) as NomColaborador
FROM pedido p , cliente cl , detallepedido dp , producto pro , tienda t , colaborador col
where p.idPedido=dp.idPedido and dp.idProducto=pro.idProducto and cl.RucDnICL=p.RucDnICL and col.idColaborador=p.idColaborador and p.idTienda like '%$idTienda%' 
and t.idTienda=p.idTienda and date(p.FechaPedido) >='$FechaInicio' and date(p.FechaPedido)<='$FechaFin'";

$select = $stmt;

$export = mysql_query ( $select ); //or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

$header="";
$data="";

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . "\t";
}

while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            //$value = '"' . $value . '"' . "\t";
            $value = '' . $value . '' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

//http://www.jonasjohn.de/snippets/php/headers.htm

//header('Content-Type: text/html; charset=UTF-8');
//header("Content-type: application/octet-stream");
header("Content-type: application/vnd-ms-excel;"); 
header("Content-Disposition: attachment; filename=ExcelReporteDeVentasyCostos.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data= utf8_decode($data); 
print "$header\n$data";

?>