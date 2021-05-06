ALTER TABLE `tbl_clientes` ADD `observaciones` VARCHAR(100) NOT NULL AFTER `porcentaje_cliente`, ADD `estado` CHAR(1) NOT NULL AFTER `observaciones`, ADD `vigencia` DATETIME NOT NULL AFTER `estado`, ADD `tipo` VARCHAR(100) NOT NULL AFTER `vigencia`;

ALTER TABLE `tbl_clientes` CHANGE `estado` `estado` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL;

ALTER TABLE `tbl_clientes` ADD `usuario_registro` VARCHAR(100) NOT NULL AFTER `tipo`, ADD `fecha_registro` DATETIME NOT NULL AFTER `usuario_registro`;

ALTER TABLE `tbl_clientes` CHANGE `id_cliente` `id_cliente` INT(11) NOT NULL AUTO_INCREMENT, CHANGE `nombre_cliente` `nombre_cliente` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `correo_cliente` `correo_cliente` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `telefono_cliente` `telefono_cliente` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `wsp_cliente` `wsp_cliente` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `direccion_cliente` `direccion_cliente` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `credito_cliente` `credito_cliente` DOUBLE(10,2) NULL, CHANGE `porcentaje_cliente` `porcentaje_cliente` INT(11) NULL, CHANGE `observaciones` `observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `estado` `estado` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `vigencia` `vigencia` DATETIME NULL, CHANGE `tipo` `tipo` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `usuario_registro` `usuario_registro` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, CHANGE `fecha_registro` `fecha_registro` DATETIME NULL;

ALTER TABLE `tbl_clientes` CHANGE `vigencia` `vigencia` VARCHAR(100) NULL DEFAULT NULL;

ALTER TABLE `tbl_pagos_pmbs` ADD `id_cliente` INT NOT NULL AFTER `id_vendedor`;
ALTER TABLE `tbl_pagos_pmbs` ADD CONSTRAINT `cts_pago_fk` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes`(`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE db_lokosgym_2.tbl_pagos_pmbs DROP FOREIGN KEY rmbs_pagos_fk;