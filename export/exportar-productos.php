<?php
header('Content-Encoding: UTF-8');

header('Content-type: text/csv; charset=UTF-8');

header("Content-Disposition: attachment; filename=exportar_productos.csv");

header("Pragma: no-cache");

header("Expires: 0");

header('Content-Transfer-Encoding: binary');

echo "\xEF\xBB\xBF";

require_once "../modelo/productos.modelo.php";

$productos = ProductosModelo:: mdlMostrarProducto(null);
echo "#,";
echo "#Nombre,";
echo "#Categoria,";
echo "#Caracteristicas,";
echo "#Existencias,";
echo "#Precio publico\n";

foreach ($productos as $key => $pds):
    echo $pds['codigo'] . ",";
    echo $pds['producto'] . ",";
    echo $pds['categoria'] . ",";
    echo $pds['caracteristicas_producto'] . ",";
    echo $pds['existencia'] . ",";
    echo $pds['precio_publico'] . "\n";
endforeach;