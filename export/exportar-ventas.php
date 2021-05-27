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
if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {
    $dateStart = $_GET['fechaInicial'];
    $dateEnd = $_GET['fechaFinal'];
} else {
    date_default_timezone_set('America/Mexico_City');

    $fecha = date('Y-m-d');
    $dateStart = $fecha;
    $dateEnd = $fecha;
}
$ventas = VentasControlador::ctrMostrarVentasRangoFachasHome($dateStart, $dateEnd);
$totalventas = 0;
$totalCompraVentas = 0;
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

    echo $value['producto'] . ",";
    echo $value['precio_compra'] . ",";
    echo $value['precio'] . ",";
    echo $value['cantidad'] . ",";
    echo $totalV * $value['cantidad'] . ",";
    echo $totalV * $value['cantidad'] - $value['precio_compra'] * $value['cantidad'] . ",";
    echo $value['fecha'] . "\n";
endforeach;
