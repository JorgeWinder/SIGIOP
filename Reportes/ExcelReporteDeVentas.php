<?php
include './CnReporte.php';

            $idTienda=$_REQUEST['idTienda'];
            $FechaInicio=$_REQUEST['FechaInicio'];
            $FechaFin=$_REQUEST['FechaFin'];

$stmt = "SELECT p.idPedido, p.Correlativo , t.NombreTienda , p.FechaPedido , p.RucDnICL , cl.RazonSocial , 
case 
    when (select count(*) from detallepedido where idPedido=p.idPedido)=1 then pro.NombreProducto 
    when (select count(*) from detallepedido where idPedido=p.idPedido)>1 then 'IGRESOS VARIOS' 
end AS Nomproducto, 
case 
when p.EstadoCobro='P' then 'PENDIENTE DE COBRO' 
when p.EstadoCobro='C' then 'CANCELADO' 
when p.EstadoCobro='A' then 'ANULADO' 
when p.EstadoCobro='' then 'A LA ESPERA' 
end as EstadoCobro, (select SUM(Cantidad) from detallepedido where idPedido=p.idPedido) as Cant , 
p.MontoEfectivo , p.MontoDeposito , p.MontoSaldo , sum(dp.PrecioTotal) as PrecioTotal , sum(dp.Desct) as Desct , CONCAT(col.Nombres, ' ' , col.Apellidos) as NomColaborador
FROM pedido p , cliente cl , detallepedido dp , producto pro , tienda t , colaborador col
where p.idPedido=dp.idPedido and dp.idProducto=pro.idProducto and cl.RucDnICL=p.RucDnICL and col.idColaborador=p.idColaborador and p.idTienda like '%$idTienda%' 
and t.idTienda=p.idTienda and date(p.FechaPedido) >='$FechaInicio' and date(p.FechaPedido)<='$FechaFin'
group by p.idPedido , p.RucDnICL , cl.RazonSocial , p.EstadoCobro , p.MontoEfectivo , p.MontoDeposito , p.MontoSaldo, Nomproducto";

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
header("Content-Disposition: attachment; filename=ExcelReporteDeVentas.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data= utf8_decode($data); 
print "$header\n$data";

?>