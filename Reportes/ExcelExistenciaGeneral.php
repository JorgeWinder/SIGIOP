<?php
include './CnReporte.php';

            //$cc=$_REQUEST['cc'];
            $fi=$_REQUEST['Fechaini'];
            $ff=$_REQUEST['Fechafin'];
            $idTienda=$_REQUEST['idTienda'];

$stmt = "SELECT mov.idProducto , pro.NombreProducto , cat.NombreCategoria , pro.StockMini , sum(mov.StockMoviento) as StockTotal , pro.PrecioCompraBase , FORMAT(sum(mov.StockMoviento) * pro.PrecioCompraBase,2) as MontoValorizado , getStockProductoObservado(mov.idProducto , $idTienda) as StockProductoMalogrado 
FROM movimientoalmacen mov , producto pro , categoriaproducto cat
where pro.idProducto=mov.idProducto and cat.idCategoriaProducto=pro.idCategoriaProducto and mov.idTienda like '%$idTienda%' and pro.idProducto NOT IN(489,498,74,75,76,78,114,134,154,191,206,231,240,245,353,355) and date(mov.FechaMovimiento)>='2019-10-06' 
group by mov.idProducto , pro.NombreProducto order by pro.NombreProducto asc";

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
header("Content-Disposition: attachment; filename=ReporteExistenciaGeneral.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data= utf8_decode($data);
print "$header\n$data";

?>