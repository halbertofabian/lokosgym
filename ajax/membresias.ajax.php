<?php session_start();

require_once "../controlador/clientes.controlador.php";
require_once "../modelo/membresias.modelo.php";
require_once "../modelo/cajas.modelo.php";
require_once "../modelo/clientes.modelo.php";

class AjaxMembresias
{

	/*=============================================
	Agregar cliente
	=============================================*/

	public $datos;
	public $rmbs_id;

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

	public function ajaxBuscarMembresiaCliente()
	{




		$respuesta = MembresiasModelo::mdlMostrarMembresiaCliente($this->rmbs_id);

		echo json_encode($respuesta, true);
	}

	public function ajaxBuscarPagosFiltro()
    {
        $res = CajasModelo::mdlPagosFiltro($_POST);
        echo json_encode($res, true);
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


if (isset($_POST['btnConsultarMembresiaCliente'])) {


	$buscarClienteMembresia = new AjaxMembresias();
	$buscarClienteMembresia->rmbs_id = $_POST['rmbs_id'];
	$buscarClienteMembresia->ajaxBuscarMembresiaCliente();
}


if (isset($_POST['btnBuscarPagosFiltro'])) {


    $buscar = new AjaxMembresias();
    $buscar->ajaxBuscarPagosFiltro();
}