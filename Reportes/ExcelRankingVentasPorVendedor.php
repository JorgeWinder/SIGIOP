<?php
include './CnReporte.php';

            //$cc=$_REQUEST['cc'];
            $fi=$_REQUEST['FechaInicio'];
            $ff=$_REQUEST['FechaFin'];

$stmt = "SELECT col.idColaborador , CONCAT(col.Nombres, ' ' , col.Apellidos) as Nombres , t.NombreTienda ,  FORMAT(sum(pe.MontoEfectivo + pe.MontoDeposito + pe.MontoSaldo),2) AS TOTAL
FROM pedido pe , colaborador col , tienda t
WHERE col.idColaborador=pe.idColaborador and col.idTienda=t.idTienda and date(pe.FechaPedido) >='$fi' and date(pe.FechaPedido)<='$ff'
GROUP BY col.idColaborador , Nombres
ORDER BY sum(pe.MontoEfectivo + pe.MontoDeposito + pe.MontoSaldo) DESC";

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
header("Content-Disposition: attachment; filename=ReporteRankingVentasPorVendedor.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data= utf8_decode($data);
print "$header\n$data";

?>