<?php session_start();

require_once "../controlador/productos.controlador.php";
require_once "../modelo/productos.modelo.php";

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

