ALTER TABLE `tbl_usuarios` ADD `usr_perfil` VARCHAR(50) NOT NULL DEFAULT 'Administrador' AFTER `usr_caja`;




ALTER TABLE `tbl_clientes` CHANGE `fecha_registro` `fecha_registro` DATE NULL DEFAULT NULL;

CREATE TABLE `tbl_asistencia_ast` ( `ast_id` INT NOT NULL AUTO_INCREMENT , `ast_socio` INT NOT NULL , `ast_fecha_inicio` DATETIME NOT NULL , `ast_fecha_fin` DATETIME NOT NULL , PRIMARY KEY (`ast_id`)) ENGINE = InnoDB;


ALTER TABLE `tbl_asistencia_ast` ADD CONSTRAINT `ast_socio` FOREIGN KEY (`ast_socio`) REFERENCES `tbl_clientes`(`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT;