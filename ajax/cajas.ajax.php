
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

session_start();

require_once "../controlador/cajas.controlador.php";
require_once "../modelo/cajas.modelo.php";
require_once "../modelo/usuarios.modelo.php";
require_once "../modelo/rutas.php";

class CajasAjax
{


    public function ajaxCerrarCaja()
    {
        $res = CajasControlador::ctrCerrarCaja();
        echo json_encode($res, true);
    }
}


if (isset($_POST['btnCerrarCaja'])) {
    $cerrarCaja = new CajasAjax();
    $cerrarCaja->ajaxCerrarCaja();
}
