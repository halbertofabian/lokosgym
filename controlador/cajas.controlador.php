
<?php
/**
 *  Desarrollador: ifixitmor
 *  Fecha de creación: 10/01/2021 19:49
 *  Desarrollado por: Softmor
 *  Software de Morelos SA.DE.CV 
 *  Sitio web: https://softmor.com
 *  Facebook:  https://www.facebook.com/softmor/
 *  Instagram: http://instagram.com/softmormx
 *  Twitter: https://twitter.com/softmormx
 */
class CajasControlador
{
    /*public function ctrAgregarCajas()
    {
        if (isset($_POST['btnRegistrarCaja'])) {
            $_POST['cja_usuario_registro'] = $_SESSION['session_usr']['usr_nombre'];
            $_POST['cja_fecha_registro'] = FECHA;
            $_POST['cja_uso'] = 0;

            $agregarCaja = CajasModelo::mdlAgregarCajas($_POST);



            if ($agregarCaja) {
                AppControlador::msj('success', '¡Muy bien!', 'Caja registrada', HTTP_HOST . 'cajas');
            } else {
                AppControlador::msj('error', '¡Error!', 'No se pudo registrar la caja, intenta de nuevo');
            }
        }
    }
    public function ctrActualizarCajas()
    {
    }
    public function ctrMostrarCajas()
    {
    }
    public function ctrEliminarCajas()
    {
    }

   */

    public static function ctrCerrarCaja()
    {

        if (isset($_POST['btnCerrarCaja'])) {

            $crt_id = $_SESSION['usr_caja'];


            $montos = array(
                'monto_venta_e' => CajasModelo::mdlReporteVentasByMPCorte('EFECTIVO', $crt_id),
                'monto_venta_b' => CajasModelo::mdlReporteVentasByMPCorte('TARJETA CREDITO / DEBITO', $crt_id),
                'monto_pagos_e' => CajasModelo::mdlReportePagosByMPCorte('EFECTIVO', $crt_id),
                'monto_pagos_b' => CajasModelo::mdlReportePagosByMPCorte('', $crt_id),
            );


            $monto_e = $montos['monto_venta_e']['venta_total'] + $montos['monto_pagos_e']['pagos_total'];

            $monto_b = $montos['monto_venta_b']['venta_total'] + $montos['monto_pagos_b']['pagos_total'];


            $totalEfectivo = $monto_e;
            $totalBanco = $monto_b;


            $_POST['copn_ingreso_efectivo'] = str_replace(",", "", $_POST['copn_ingreso_efectivo']);
            $_POST['copn_ingreso_banco'] = str_replace(",", "", $_POST['copn_ingreso_banco']);

            $_POST['copn_usuario_cerro'] = $_SESSION['nombre'];
            $_POST['copn_efectivo_real'] = $totalEfectivo;
            $_POST['copn_banco_real'] = $totalBanco;

            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $fecha_registro = $fecha . ' ' . $hora;

            $_POST['copn_fecha_cierre'] = $fecha_registro;

            $url = Rutas::ctrRtas();


            $ActaulizarCajaCierre = CajasModelo::mdlCerrarCaja($_POST);

            if ($ActaulizarCajaCierre) {
                $cerrarCajaUsuario = UsuariosModelo::mdlActualizarCajaUsuario($_SESSION['id'], 0);
                if ($cerrarCajaUsuario) {
                    $cerrarCaja = CajasModelo::mdlActualizarDisponibilidadCaja(0, $_POST['cja_id_caja'], 0);
                    if ($cerrarCaja) {
                        $_SESSION['usr_caja'] =  0;

                        return array(
                            'mensaje' => 'Corte realizado',
                            'status' => true,
                            'pagina' => $url
                        );
                    } else {
                        return array(
                            'mensaje' => 'Ocurrio un error',
                            'status' => false,
                            'pagina' => $url
                        );
                    }
                }
            }


            // var_dump($totalEfectivo);
            // echo "<br>";
            // var_dump($totalBanco);
        }
    }

    public  function ctrAbrirCaja()
    {
        if (isset($_POST['btnAbrirCaja'])) {

            $url = Rutas::ctrRtas();

            $_POST['copn_usuario_abrio'] = $_SESSION['id'];

            date_default_timezone_set('America/Mexico_City');

            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $fecha_registro = $fecha . ' ' . $hora;
            $_POST['copn_fecha_abrio'] = $fecha_registro;
            $_POST['copn_id_sucursal'] = "";
            $_POST['copn_ingreso_inicio'] = str_replace(",", "", $_POST['copn_ingreso_inicio']);

            $abrirCaja = CajasModelo::mdlAbrirCaja($_POST);

            if ($abrirCaja) {

                $ultimaCajaAbierta = CajasModelo::mdlConsultarUltimaCajaAbierta(
                    array(
                        'copn_usuario_abrio' => $_SESSION['id'],
                        'copn_id_caja' => $_POST['copn_id_caja']
                    )
                );

                $asignarCajaUsuario = UsuariosModelo::mdlActualizarCajaUsuario($_SESSION['id'], $ultimaCajaAbierta['copn_id']);

                if ($asignarCajaUsuario) {
                    CajasModelo::mdlActualizarDisponibilidadCaja(1, $_POST['copn_id_caja'], $ultimaCajaAbierta['copn_id']);
                    $_SESSION['usr_caja'] =  $ultimaCajaAbierta['copn_id'];
                    PlantillaControlador::msj('success', 'CAJA ABIERTA', '', $url);
                } else {
                }
            }
        }
    }

    public static function ctrTotales($crt_id)
    {



        $montos = array(
            'monto_venta_e' => CajasModelo::mdlReporteVentasByMPCorte('EFECTIVO', $crt_id),
            'monto_venta_b' => CajasModelo::mdlReporteVentasByMPCorte('TARJETA CREDITO / DEBITO', $crt_id),
            'monto_pagos_e' => CajasModelo::mdlReportePagosByMPCorte('EFECTIVO', $crt_id),
            'monto_pagos_b' => CajasModelo::mdlReportePagosByMPCorte('', $crt_id),
        );


        $monto_e = $montos['monto_venta_e']['venta_total'] + $montos['monto_pagos_e']['pagos_total'];

        $monto_b = $montos['monto_venta_b']['venta_total'] + $montos['monto_pagos_b']['pagos_total'];


        $totalEfectivo = $monto_e;
        $totalBanco = $monto_b;

        return array(
            "total_efectivo" => $totalEfectivo,
            "total_banco" => $totalBanco
        );
    }
}
