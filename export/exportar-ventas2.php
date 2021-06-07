<?php
header('Content-Encoding: UTF-8');

header('Content-type: text/csv; charset=UTF-8');

header("Content-Disposition: attachment; filename=exportar_ventas.csv");

header("Pragma: no-cache");

header("Expires: 0");

header('Content-Transfer-Encoding: binary');

echo "\xEF\xBB\xBF";

require_once "../modelo/ventas.modelo.php";
require_once "../controlador/ventas.controlador.php";

$dateStart = null;
$dateEnd = null;
$usuario=null;
$mp=null;
if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {
    $dateStart = $_GET['fechaInicial'];
    $dateEnd = $_GET['fechaFinal'];
} else {
    date_default_timezone_set('America/Mexico_City');

    $fecha = date('Y-m-d');
    $dateStart = $fecha;
    $dateEnd = $fecha;
}

if(isset($_GET['mp'])){
$mp=$_GET['mp'];
}
if(isset($_GET['user'])){
    $usuario=$_GET['user'];
}

$ventas=VentasModelo::mdlMostrarVentasRangoFachasHome2($dateStart, $dateEnd,$usuario,$mp);
$totalventas = 0;
$totalCompraVentas = 0;
echo "#,";
echo "vendedor,";
echo "MP,";
echo "Producto,";
echo "Precio de compra,";
echo "Precio venta,";
echo "Cantidad,";
echo "Total,";
echo "Ganancia,";
echo "Fecha\n";

foreach ($ventas as $key => $value) :
    $totalV = $value['precio'] - ($value['precio'] * $value['descuento'] / 100);

    $totalventas += $totalV * $value['cantidad'];
    $totalCompraVentas  +=   $totalV * $value['cantidad'] - $value['precio_compra'] * $value['cantidad'];
    echo $value['id_venta'] . ",";
    echo $value['nombre'] . ",";
    echo $value['venta_mp'] . ",";
    echo $value['producto'] . ",";
    echo $value['precio_compra'] . ",";
    echo $value['precio'] . ",";
    echo $value['cantidad'] . ",";
    echo $totalV * $value['cantidad'] . ",";
    echo $totalV * $value['cantidad'] - $value['precio_compra'] * $value['cantidad'] . ",";
    echo $value['fecha'] . "\n";
endforeach;
