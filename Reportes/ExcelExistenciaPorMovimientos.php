<?php
include './CnReporte.php';

            //$cc=$_REQUEST['cc'];
            $FechaInicio=$_REQUEST['FechaInicio'];
            $FechaFin=$_REQUEST['FechaFin'];

$stmt = "SELECT t.NombreTienda as TiendaOrigen,  tm.Descripcion as Movimiento, pro.NombreProducto , mov.StockMoviento, 
mov.FechaMovimiento , mov.idPedido , (select NombreTienda from tienda where idTienda=mov.idTiendaDestino) as TiendaDestino , pro.PrecioCompraBase , (mov.StockMoviento * pro.PrecioCompraBase) as BaseTotalCompra 
FROM movimientoalmacen mov, producto pro , tipomovimiento tm , colaborador col , tienda t
where mov.idProducto=pro.idProducto and tm.idTipoMovimiento=mov.idTipoMovimiento and col.idColaborador=mov.idColaborador and date(mov.FechaMovimiento)>='2019-10-06' 
and t.idTienda=mov.idTienda and date(mov.FechaMovimiento)>='$FechaInicio' and date(mov.FechaMovimiento)<='$FechaFin'";

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
header("Content-Disposition: attachment; filename=ExcelExistenciaPorMovimientos.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data= utf8_decode($data); 
print "$header\n$data";

?>