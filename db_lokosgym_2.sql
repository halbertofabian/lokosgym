ALTER TABLE `tbl_ventas` ADD `vts_efectivo` DOUBLE(10,2) NOT NULL AFTER `venta_mp`, ADD `vts_tarjeta` DOUBLE(10,2) NOT NULL AFTER `vts_efectivo`;

ALTER TABLE `tbl_pagos_pmbs` ADD `pmbs_efectivo` DOUBLE(10,2) NOT NULL AFTER `id_cliente`, ADD `pmbs_tarjeta` DOUBLE(10,2) NOT NULL AFTER `pmbs_efectivo`;

TARJETA CREDITO / DEBITO
EFECTIVO