<?php
class VentasControlador
{

    public static function ctrMostrarUltimaVenta()
    {
        return VentasModelo::mdlMostrarUltimaVenta();
    }

    public static function ctrMostrarSumVentas()
    {
        return VentasModelo::mdlMostrarSumVentas();
    }
    public static function ctrMostrarVentas()
    {
        return VentasModelo::mdlMostrarVentas();
    }
    // Rango de fechas
    public static function ctrMostrarVentasRangoFachas($dateStart, $dateEnd)
    {
        return VentasModelo::mdlMostrarVentasRangoFachas($dateStart, $dateEnd);
    }
    public static function ctrMostrarVentasRangoFachasHome($dateStart, $dateEnd)
    {
        return VentasModelo::mdlMostrarVentasRangoFachasHome($dateStart, $dateEnd);
    }


    public static function ctrMostrarVentaTicket($codigo)
    {
        return VentasModelo::mdlMostrarVentaTicket($codigo);
    }

    public static function ctrCrearVenta()
    {

        //echo "<pre>", print_r($_POST), "</pre>";
        // return;
        $url = Rutas::ctrRtas();
        if ($_SESSION['usr_caja'] <= 0) {
            return array(
                'status' => false,
                'mensaje' => 'Necesita abrir caja para realizar está operación'
            );
        }

        // Identificar tipos de pagos

        $venta_mp = "";
        $_POST['lkg_cantidad_efectivo']  = str_replace(",", "", $_POST['lkg_cantidad_efectivo']);
        $_POST['lkg_cantidad_tarjeta']  = str_replace(",", "", $_POST['lkg_cantidad_tarjeta']);
        $_POST['lkg_monto_efectivo'] = str_replace(",", "", $_POST['lkg_monto_efectivo']);

        if ($_POST['lkg_cantidad_efectivo'] > 0 && $_POST['lkg_cantidad_tarjeta'] > 0) {

            $venta_mp = "DIVIDIDO";
            $_POST['listaMetodoPago'] = "Efectivo-" . $_POST['lkg_monto_efectivo'];
            $_POST['vts_efectivo'] = $_POST['lkg_cantidad_efectivo'];
            $_POST['vts_tarjeta'] = $_POST['lkg_cantidad_tarjeta'];
        } elseif ($_POST['lkg_cantidad_efectivo'] > 0 && $_POST['lkg_cantidad_tarjeta'] == 0) {

            $venta_mp = "EFECTIVO";
            $_POST['listaMetodoPago'] = "Efectivo-" . $_POST['lkg_monto_efectivo'];
            $_POST['vts_efectivo'] = $_POST['lkg_cantidad_efectivo'];
            $_POST['vts_tarjeta'] = 0;
        } elseif ($_POST['lkg_cantidad_tarjeta'] > 0 && $_POST['lkg_cantidad_efectivo'] == 0) {

            $venta_mp = "TARJETA CREDITO / DEBITO";
            $_POST['listaMetodoPago'] = "Tarjeta-" . $_POST['lkg_cantidad_tarjeta'];
            $_POST['vts_efectivo'] = 0;
            $_POST['vts_tarjeta'] = $_POST['lkg_cantidad_tarjeta'];
        } else {
            return array(
                'status' => false,
                'mensaje' => 'Algo salio mal, intenta de nuevo'
            );
        }

        if ($_POST['listaProductos'] == "") {

            return array(
                'status' => false,
                'mensaje' => 'La lista de productos esta vacia'
            );
        }




        // if ($_POST['listaMetodoPago'] == "") {
        //     $_POST['listaMetodoPago'] = "Efectivo-" . $_POST['nuevoValorEfectivo'];
        //     $venta_mp = "EFECTIVO";
        // } else {
        //     $venta_mp = "TARJETA CREDITO / DEBITO";
        // }
        // echo $_POST['listaMetodoPago'];
        //  echo $articulos;


        date_default_timezone_set('America/Mexico_City');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $fecha_registro = $fecha . ' ' . $hora;

        $tbl_ventas = array(
            'id_venta' => $_POST['GDcodigo_venta'],
            'id_cliente' => $_POST['GDcliente'],
            'id_vendedor' => $_POST['GDvendedorid'],
            'forma_pago' => $_POST['listaMetodoPago'],
            'neto' => $_POST['nuevoPrecioNeto'],
            'total' => $_POST['totalVenta'],
            'descuento' => $_POST['nuevoImpuestoVenta'],
            'fecha' => $fecha_registro,
            'estado_corte' => $_SESSION['usr_caja'],
            'venta_mp' => $venta_mp,
            'vts_efectivo' => $_POST['vts_efectivo'],
            'vts_tarjeta' => $_POST['vts_tarjeta']
        );
        // Realizar venta
        $crearVenta = VentasModelo::mdlCrearVenta($tbl_ventas);


        if ($crearVenta) {

            $productos = json_decode($_POST['listaProductos'], true);

           

            $articulos = 0;
            foreach ($productos as $key => $value) {
                //Sumar total de articulos aquiridos
                $articulos +=  $value['cantidad'];
                $tbl_detalle = array(
                    'id_venta' => $_POST['GDcodigo_venta'],
                    'id_producto' => $value['id'],
                    'cantidad' => $value['cantidad'],
                    'precio' => $value['precio'],
                    'neto' => $value['precio'],
                    'total' => $value['total']
                );
                //Realizar detalle venta
                $detalle = VentasModelo::mdlCrearDetalleVenta($tbl_detalle);

                if ($detalle) {
                    //Actualizar lista de productos
                    $stock_datos = array(
                        'existencia' => $value['stock'],
                        'id' => $value['id']
                    );
                    $stock = VentasModelo::mdlUpdateStock($stock_datos);

                    // if ($stock) {
                    //     // Insersión

                    //     // echo '
                    //     //     <script>
                    //     //         window.location = "pos";
                    //     //         window.open("extensiones/tcpdf/pdf/ticket.php?codigo=' . $_POST['GDcodigo_venta'] . '", "_blank");
                    //     //     </script>';
                    // }
                }
            }
            return array(
                'status' => true,
                'mensaje' => 'Venta registrada',
                'pagina' => 'pos',
                'codigo' => $_POST['GDcodigo_venta']
            );
        }
    }
}
