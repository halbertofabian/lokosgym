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
        if (isset($_POST['btnVender'])) {

            if ($_POST['listaProductos'] == "") {

                echo '<script>
    
                  swal({
               title: "¡Mal!",
               text: "La lista de productos esta vacia",
               icon: "error",
               buttons: [,true],
               
            })
            .then((willDelete) => {
              if (willDelete) {
                location.href = "pos"
              }
            });

                  </script>';
                return;
            }


            /*foreach ($_POST as $key => $value) {
                echo "<br> '$key' => '$value' <br>";
            }*/

            if ($_POST['listaMetodoPago'] == "") {
                $_POST['listaMetodoPago'] = "Efectivo-" . $_POST['nuevoValorEfectivo'];
            }
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
                'fecha' => $fecha_registro
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

                        if ($stock) {
                            // Insersión
                            echo '
                            <script>
                                window.location = "pos";
                                window.open("extensiones/tcpdf/pdf/ticket.php?codigo=' . $_POST['GDcodigo_venta'] . '", "_blank");
                            </script>';
                        }
                    }
                }
                /*echo "<pre> ";
                    print_r($productos);
                 echo "</pre>";*/
            }
        }

        # code...

    }
}
