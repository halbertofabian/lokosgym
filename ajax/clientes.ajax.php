<?php session_start();

require_once "../controlador/clientes.controlador.php";
require_once "../modelo/clientes.modelo.php";
require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

class AjaxCliente{

	/*=============================================
	EDITAR Cliente
	=============================================*/	

	public $idCliente;
	

	public function ajaxEditarCliente(){

		
		$valor = $this->idCliente;

		$respuesta = ClientesControlador::ctrMostrarCliente($valor);

		echo json_encode($respuesta);

		

	}

	public function ajaxImportarClientes(){
		$respuesta = ClientesControlador::ctrImportarClientes();

		echo json_encode($respuesta);
	}
	
	
}


/*=============================================
EDITAR Cliente
=============================================*/	
if(isset($_POST["idCliente"])){

	$cliente = new AjaxCliente();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();
}


if(isset($_POST['btnImportarCliente'])){
	$cliente = new AjaxCliente();
	$cliente -> ajaxImportarClientes();
}



