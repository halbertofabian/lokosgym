<?php
header('Content-Encoding: UTF-8');

header('Content-type: text/csv; charset=UTF-8');

header("Content-Disposition: attachment; filename=exportar_pagos.csv");

header("Pragma: no-cache");

header("Expires: 0");

header('Content-Transfer-Encoding: binary');

echo "\xEF\xBB\xBF";

require_once "../modelo/cajas.modelo.php";

$pagos = CajasModelo::mdlPagosFiltro($_GET);

echo "#Pago,";
echo "#Vendedor,";
echo "#MP,";
echo "#Total,";
echo "#Fecha\n";

foreach ($pagos as $key => $pgs):
    echo $pgs['pmbs_id'] . ",";
    echo $pgs['nombre'] . ",";
    echo $pgs['pmbs_mp'] . ",";
    echo $pgs['pmbs_monto'] . ",";
    echo $pgs['pmbs_fecha_pago'] . "\n";
endforeach;
