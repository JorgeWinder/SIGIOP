<?php
include './CnReporte.php';

            //$cc=$_REQUEST['cc'];
            $fi=$_REQUEST['FechaInicio'];
            $ff=$_REQUEST['FechaFin'];
            $idTienda=$_REQUEST['idTienda'];

$stmt = "SELECT pro.idProducto , pro.NombreProducto , sum(dpe.Cantidad) as CantVenta , sum(dpe.PrecioTotal) as MontVenta
FROM pedido pe , producto pro , detallepedido dpe
WHERE dpe.idPedido=pe.idPedido and dpe.idProducto=pro.idProducto and pe.EstadoCobro not in('') and date(pe.FechaPedido) >='$fi' and date(pe.FechaPedido)<='$ff' and pe.idTienda like '%$idTienda%' 
GROUP by pro.idProducto , pro.NombreProducto 
ORDER by MontVenta DESC
";

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
header("Content-Disposition: attachment; filename=ReporteRankingVentasPorInsumos.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data= utf8_decode($data);
print "$header\n$data";

?>