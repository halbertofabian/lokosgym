ALTER TABLE `tbl_registro_membresias_rmbs` CHANGE `rmbs_status` `rmbs_status` CHAR(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1';
ALTER TABLE `tbl_pagos_pmbs` ADD `pmbs_ref` TEXT NOT NULL AFTER `pmbs_monto`;

ALTER TABLE `tbl_pagos_pmbs` ADD PRIMARY KEY( `pmbs_id`);

ALTER TABLE `tbl_pagos_pmbs` CHANGE `pmbs_id` `pmbs_id` INT(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tbl_registro_membresias_rmbs` ADD `rmbs_costo_renovacion` DOUBLE(10,2) NOT NULL AFTER `rmbs_status`;