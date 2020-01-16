<?php session_start();

require_once "../controlador/clientes.controlador.php";
require_once "../modelo/clientes.modelo.php";

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
	
	
}

/*=============================================
EDITAR Cliente
=============================================*/	
if(isset($_POST["idCliente"])){

	$cliente = new AjaxCliente();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();
}


