<?php session_start();

require_once "../controlador/productos.controlador.php";
require_once "../modelo/productos.modelo.php";
require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

class AjaxProducto{

	/*=============================================
	EDITAR Producto
	=============================================*/	

	public $idProducto;
	

	public function ajaxEditarProducto(){
		$valor = $this->idProducto;
		$respuesta = ProductosControlador::ctrMostrarProducto($valor);
		echo json_encode($respuesta);
	}

	public function ajaxEditarProductoBarras(){
		$valor = $this->idProducto;
		$respuesta = ProductosControlador::ctrMostrarProductoBarras($valor);
		echo json_encode($respuesta);
	}

	public function ajaxEliminarProducto()
    {	
		$id=$_POST['id'];
        $res = ProductosModelo::eliminarProductoById($id);
        echo json_encode($res, true);
    }

	public function ajaxImportarProductos()
	{
		$respuesta = ProductosControlador::ctrImportarProductos();

		echo json_encode($respuesta);
	}
	
}

/*=============================================
EDITAR Producto
=============================================*/	
if(isset($_POST["idProducto"])){

	$producto = new AjaxProducto();
	$producto -> idProducto = $_POST["idProducto"];
	$producto -> ajaxEditarProducto();
}
if(isset($_POST["idBarras"])){

	$producto = new AjaxProducto();
	$producto -> idProducto = $_POST["idBarras"];
	$producto -> ajaxEditarProductoBarras();
}

if (isset($_POST['btn-elimina-producto'])) {

    $elimina = new AjaxProducto();
    $elimina->ajaxEliminarProducto();
}
if (isset($_POST['btnImportarProductos'])) {
	$productos = new AjaxProducto();
	$productos->ajaxImportarProductos();
}

