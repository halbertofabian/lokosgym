<?php session_start();

require_once "../controlador/clientes.controlador.php";
require_once "../modelo/membresias.modelo.php";
require_once "../modelo/clientes.modelo.php";

class AjaxMembresias
{

	/*=============================================
	Agregar cliente
	=============================================*/

	public $datos;

	public function ajaxCrearCliente()
	{





		//$valor = $this->datos;

		$respuesta = ClientesControlador::ctrAgregarClienteAjax();

		echo json_encode($respuesta, true);
	}

	public function ajaxBuscarUltimoCliente()
	{




		$respuesta = MembresiasModelo::mdlMostrarUltimoCliente();

		echo json_encode($respuesta, true);
	}
}

if (isset($_POST["GDnombre"])) {

	$crearMembreria = new AjaxMembresias();
	$crearMembreria->ajaxCrearCliente();
}
if (isset($_POST["btnBuscarUltimoCliente"])) {

	$buscarUltimoCliente = new AjaxMembresias();
	$buscarUltimoCliente->ajaxBuscarUltimoCliente();
}
