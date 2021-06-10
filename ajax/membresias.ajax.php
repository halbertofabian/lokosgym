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

	public function ajaxEliminarPago()
    {
        $res = MembresiasModelo::eliminarPagoById($_POST);
        echo json_encode($res, true);
    }
	public function ajaxMostrarInfoEstadoMem()
    {
        $res = ClientesModelo::MostrarinfoById($_POST);
        echo json_encode($res, true);
    }
}

if (isset($_POST['btn-elimina-pago'])) {

    $elimina = new AjaxMembresias();
    $elimina->ajaxEliminarPago();
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


if (isset($_POST['btnBuscarCliente'])) {
	$cliente = MembresiasModelo::mdlConsultarClientes($_POST['mbs_cts_id'], $_POST['mbs_cts_nombre']);
	date_default_timezone_set('America/Mexico_City');
	$fecha = date('Y-m-d');
	$hora = date('H:i:s');
	$fecha_hoy = $fecha . ' ' . $hora;
	$arrayDatos = array();

	foreach ($cliente as $key => $cts) {

		$estado = "";
		if ($cts['vigencia'] > $fecha_hoy) {
			$estado = "ACTIVO";
		} elseif ($cts['vigencia'] == $fecha_hoy) {
			$estado = "VENCE HOY";
		} else {
			$estado = "INACTIVO";
		}

		$array = array(
			'data' => $cliente,
			'estado' => $estado,
		);
		array_push($arrayDatos, $array);
		# code...
	}
	echo json_encode($arrayDatos, true);
}
if (isset($_POST['btn-elimina-venta'])) {

    $elimina = new AjaxVentas();
    $elimina->ajaxEliminarVenta();
}

if (isset($_POST['btn-inf-membresia'])) {

    $mostrar = new AjaxMembresias();
    $mostrar->ajaxMostrarInfoEstadoMem();
}

