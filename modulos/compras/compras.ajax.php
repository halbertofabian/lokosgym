
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


include_once '../../../config.php';

require_once DOCUMENT_ROOT . 'app/modulos/compras/compras.modelo.php';
require_once DOCUMENT_ROOT . 'app/modulos/compras/compras.controlador.php';
require_once DOCUMENT_ROOT . 'app/modulos/app/app.controlador.php';



require_once DOCUMENT_ROOT . 'app/libs/PHPExcel/Classes/PHPExcel/IOFactory.php';

class ComprasAjax
{
    public $pvs_nombre;
    public $cps_folio;
    public $pds_nombre;

    public function ajaxCrearProveedor()
    {
        $proveedor = array('pvs_nombre' => $this->pvs_nombre);

        $res = ComprasControlador::ctrCrearProveedor($proveedor);

        echo json_encode($res);
    }


    public function ajaxLiquidarCompra()
    {

        $res = ComprasControlador::ctrLiquidarCompra($this->cps_folio);

        echo json_encode($res);
    }
    public function ajaxlistarCompras()
    {
        $res = ComprasModelo::mdlConsultarGastosPorFecha($_POST);
        echo json_encode($res, true);
    }

    public function ajaxEliminarCompra()
    {
        $eliminarCompra = ComprasControlador::ctrEliminaCompra($this->cps_folio);
        echo json_encode($eliminarCompra);
    }

    public function ajaxImportarProductos()
    {
        $respuesta = ComprasControlador::ctrImportarProductosExcel();
        echo json_encode($respuesta, true);
    }

    public function ajaxGuardarCompraP()
    {
        $respuesta = ComprasControlador::ctrGuardarCompraP();
        echo json_encode($respuesta, true);
    }
    public function ajaxBuscarProductos()
    {
        $res = ComprasModelo::mdlAutocompleteProductos($this->pds_nombre);
        echo json_encode($res, true);
    }

}


if (isset($_POST['btnCrearProveedor'])) {
    $crearVendedor = new ComprasAjax();
    $crearVendedor->pvs_nombre = $_POST['pvs_nombre'];
    $crearVendedor->ajaxCrearProveedor();
}



if (isset($_POST['btnLiquidarCompra'])) {
    $liquidarCompra = new ComprasAjax();
    $liquidarCompra->cps_folio = $_POST['cps_folio'];
    $liquidarCompra->ajaxLiquidarCompra();
}


if (isset($_POST['listarCompras'])) {
    $listarCompras = new ComprasAjax();
    $listarCompras->ajaxlistarCompras();
}

if (isset($_POST['btnEliminarCompra'])) {
    $eliminarCompra = new ComprasAjax();
    $eliminarCompra->cps_folio = $_POST['cps_folio'];
    $eliminarCompra->ajaxEliminarCompra();
}
if (isset($_POST['btnImportarProductosExcel'])) {
    $impotarProductos = new ComprasAjax();
    $impotarProductos->ajaxImportarProductos();
}

if(isset($_POST['btnGuardarCompra'])){
    $guardarcomprap=new ComprasAjax();
    $guardarcomprap->ajaxGuardarCompraP();
}
if (isset($_GET['term'])) {
    $buscarProductos = new ComprasAjax();
    $buscarProductos->pds_nombre = $_GET['term'];
    $buscarProductos->ajaxBuscarProductos();
}
