
<?php
/**
 *  Desarrollador: ifixitmor
 *  Fecha de creación: 11/02/2021 21:19
 *  Desarrollado por: Softmor
 *  Software de Morelos SA.DE.CV 
 *  Sitio web: https://softmor.com
 *  Facebook:  https://www.facebook.com/softmor/
 *  Instagram: http://instagram.com/softmormx
 *  Twitter: https://twitter.com/softmormx
 */

class ComprasControlador
{
    public static function ctrGuardarCompra()
    {

        if (isset($_POST['btnGuardarCompra'])) {

            date_default_timezone_set('America/Mexico_city');
            $url = Rutas::ctrRtas();


            $_POST['cps_cantidad'] = str_replace(",", "", $_POST['cps_cantidad']);
            $_POST['abs_monto'] = str_replace(",", "", $_POST['abs_monto']);
            $_POST['abs_adeudo'] = $_POST['cps_cantidad'] - $_POST['abs_monto'];

            $_POST['cps_fecha_pagado'] = null;
            $_POST['cps_estado_pagado'] = 0;



            if ($_POST['cps_tp'] == 'Contado' || $_POST['cps_cantidad'] == $_POST['abs_monto']) {
                if ($_POST['abs_adeudo'] != 0 && $_POST['cps_cantidad'] != $_POST['abs_monto']) {
                    PlantillaControlador::msj('warning', 'Verfica los datos', 'El tipo de pago es de contado y el monto total es diferente de la cantidad introducida', '');
                    die();
                }

                $_POST['cps_fecha_pagado'] = date("Y-m-d H:i:s");
                $_POST['cps_estado_pagado'] = 1;
            }

            $_POST['cps_usuario_registro'] = $_SESSION['session_usr']['usr_nombre'];


            $crearCompra = ComprasModelo::mdlCrearCompra($_POST);

            if ($crearCompra) {
                $crearAbono = ComprasModelo::mdlCrearAbonoCompra(array(
                    'abs_compra' => $_POST['cps_folio'],
                    'abs_monto' => $_POST['abs_monto'],
                    'abs_fecha' => date("Y-m-d H:i:s"),
                    'abs_usuario_registro' => $_SESSION['session_usr']['usr_nombre'],
                    'abs_adeudo' => $_POST['abs_adeudo'],
                    'abs_mp' => $_POST['cps_mp'],

                ));
                if ($crearAbono) {
                    PlantillaControlador::msj('success', 'Muy bien', 'Compra guardada', $url . 'listar-compras');
                }
            } else {
                PlantillaControlador::msj('error', 'Ocurrio un error', 'Folio de compra repetido', '');
            }
        }
    }

    public static function ctrCrearProveedor($proveedor)
    {



        $crearProveedor = ComprasModelo::mdlCrearProveedor(array(
            'pvs_nombre' => $proveedor['pvs_nombre'],
            'pvs_telefono' => ""
        ));

        if ($crearProveedor) {
            return array(
                'status' => true,
                'mensaje' => 'Proveedor creado con éxito'
            );
        } else {
            return array(
                'status' => false,
                'mensaje' => 'Ocurrio un error, es probable que ya exista este registro'
            );
        }
    }

    public static function ctrLiquidarCompra($cps_folio)
    {
        $url = Rutas::ctrRtas();
        date_default_timezone_set('America/Mexico_city');


        $detalleCompra = ComprasModelo::mdlConsultarCompra($cps_folio);
        $adeudo = ComprasModelo::mdlAdeudoCompra($cps_folio);

        //echo '<pre>', print_r($adeudo), '</pre>';
        //echo '<pre>', print_r($detalleCompra), '</pre>';

        $datosCompra = array(
            'cps_fecha_pagado' => date("Y-m-d H:i:s"),
            'cps_estado_pagado' => 1,
            'abs_compra' => $cps_folio,
            'abs_monto' => $adeudo['abs_adeudo'],
            'abs_fecha' => date("Y-m-d H:i:s"),
            'abs_usuario_registro' => $_SESSION['session_usr']['usr_nombre'],
            'abs_adeudo' => 0.00,
            'abs_mp' => $detalleCompra['cps_mp'],

        );
        $actualizarCompra = ComprasModelo::mdlActualizarCompraAbono($datosCompra);
        if ($actualizarCompra) {
            $crearAbono = ComprasModelo::mdlCrearAbonoCompra($datosCompra);
            if ($crearAbono) {
                return array(
                    'status' => true,
                    'mensaje' => 'Compra liquidada',
                    'pagina' => 'listar-compras'
                );
            } else {
                return array(
                    'status' => false,
                    'mensaje' => 'La compra se liquido, pero no registro el abono',
                    'pagina' => 'listar-compras'
                );
            }
        } else {
            return array(
                'status' => false,
                'mensaje' => 'Ocurrio un error, intente de nuevo',
                'pagina' => 'listar-compras'
            );
        }
    }

    public static function ctrEliminaCompra($cps_folio)
    {

        $eliminarCompra = ComprasModelo::mdlEliminarCompra($cps_folio);


        if ($eliminarCompra) {
            return array(
                'status' => true,
                'mensaje' => 'Compra eliminada con éxito',
                'pagina' => 'listar-compras'
            );
        } else {
            return array(
                'status' => false,
                'mensaje' => 'Ocurrio un error, vuelve a intentarlo',
                'pagina' => 'listar-compras'

            );
        }
    }

    public static function ctrImportarProductosExcel()
    {
        try {
            //$nombreArchivo = $_SERVER['DOCUMENT_ROOT'] . '/dupont/exportxlsx/tbl_productos_dupont.xls';
            $nombreArchivo = $_FILES['archivoExcel']['tmp_name'];
            //var_dump($nombreArchivo);
            // Cargar hoja de calculo
            $leerExcel = PHPExcel_IOFactory::createReaderForFile($nombreArchivo);
            $objPHPExcel = $leerExcel->load($nombreArchivo);
            //var_dump($objPHPExcel);
            $objPHPExcel->setActiveSheetIndex(0);

            $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
            $countInsert = 0;
            $countUpdate = 0;
            //echo "NumRows => ",$objPHPExcel->getActiveSheet()->getCell('B' . 2)->getCalculatedValue();
            $sumaCompra = 0;
            $sumaArticulos = 0;
            $datosMostrar = array();
            for ($i = 2; $i <= $numRows; $i++) {



                $codigo = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                $cantidad = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                $pu = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();


                $ptotal = $pu * $cantidad;



                $isExitSku = ComprasModelo::mdlMostrarProductosAlamacenExistentes($codigo);



                if ($isExitSku) {
                    $data = array(
                        "pds_nombre" => $isExitSku['descripcion'],
                        "codigo" => $codigo,
                        "stock" => $cantidad,
                        "pds_pu" => $pu,
                        "total" => $ptotal

                    );

                    $sumaCompra += $ptotal;
                    $sumaArticulos += $cantidad;
                    array_push($datosMostrar, $data);

                    /* $actualizar = ComprasModelo::mdlActualizarProductosExcel($data);



                    if ($actualizar) {
                        $sumaCompra += $ptotal;
                        $sumaArticulos += $cantidad;
                        array_push($datosMostrar, $data);
                        $countUpdate += 1;
                    }*/
                }
                //var_dump($data);
            }

            return array(
                'status' => true,
                'mensaje' => "Carga de productos con éxito",
                'insert' =>  $countInsert,
                'update' => $countUpdate,
                'data' => $datosMostrar,
                'sumaCompra' => $sumaCompra,
                'sumaArticulos' => $sumaArticulos,
            );
        } catch (Exception $th) {
            $th->getMessage();
            return array(
                'status' => false,
                'mensaje' => "No se encuentra el archivo solicitado, por favor carga el archivo correcto",
                'insert' =>  "",
                'update' => ""
            );
        }
    }

    public static function ctrGuardarCompraP()
    {

        $url = Rutas::ctrRtas();

        $compra = json_decode($_POST['cps_productos'], true);
        $countUpdate = 0;
        foreach ($compra as $key => $cps) {
            $actualizar = ComprasModelo::mdlActualizarProductosExcel($cps);
            if ($actualizar) {
                $countUpdate += 1;
            }
        }


        // $_POST['abs_costoEnvio'] = str_replace(",", "", $_POST['abs_costoEnvio']);
        // $_POST['cps_monto'] = str_replace(",", "", $_POST['cps_monto']);
        $_POST['cps_monto'] = str_replace(",", "", $_POST['cps_gran_total']);
        $crearCompraP = ComprasModelo::mdlCrearCompraP($_POST);

        if ($crearCompraP) {
            return array(
                'status' => true,
                'mensaje' => 'Registro creado con éxito. Se alteraron ' . $countUpdate . ' productos.',
                'pagina' => $url . 'listar-compras',
                'cps_id' => $crearCompraP
            );
        } else {
            return array(
                'status' => false,
                'mensaje' => 'Ocurrio un error, es probable que ya exista este registro'
            );
        }
    }
}
