<?php session_start();

require_once "../controlador/clientes.controlador.php";
require_once "../modelo/clientes.modelo.php";
require_once '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

class AjaxCliente
{

	/*=============================================
	EDITAR Cliente
	=============================================*/

	public $idCliente;
	public $ast_socio;
	public $ast_fecha_inicio;


	public function ajaxEditarCliente()
	{


		$valor = $this->idCliente;

		$respuesta = ClientesControlador::ctrMostrarCliente($valor);

		echo json_encode($respuesta);
	}

	public function ajaxImportarClientes()
	{
		$respuesta = ClientesControlador::ctrImportarClientes();

		echo json_encode($respuesta);
	}

	public function ajaxAsistencia()
	{
		$foto='';
		$cliente = ClientesControlador::ctrMostrarCliente($this->idCliente);
		$asistencia = ClientesModelo::mdlMostrarAsistencias($this->idCliente);
		
		$urlfoto ="../upload/fotos/f_" . $cliente['id_cliente'] . ".jpg";
		if (!file_exists($urlfoto)) {
			$foto='no';
		}else{
			$foto='si';
		}
		

		echo json_encode(
			array(

				'cliente' => $cliente,
				'asistencia' => $asistencia,
				'foto'=>$foto

			),
			true
		);
	}
	public function ajaxRegistrarAsistencia()
	{
		$res = ClientesModelo::mdlRegistrarAsistencia(
			array(
				'ast_socio' => $this->ast_socio,
				'ast_fecha_inicio' => $this->ast_fecha_inicio
			)

		);
		echo json_encode($res, true);
	}
	public function ajaxactualizafot()
	{
		$actFt = ClientesControlador::ctrActualizaFoto();
		echo json_encode($actFt, true);
	}

	public function ajaxEliminarCliente()
    {
        $res = ClientesModelo::eliminarClienteById($_POST);
        echo json_encode($res, true);
    }
}


/*=============================================
EDITAR Cliente
=============================================*/
if (isset($_POST["idCliente"])) {

	$cliente = new AjaxCliente();
	$cliente->idCliente = $_POST["idCliente"];
	$cliente->ajaxEditarCliente();
}


if (isset($_POST['btnImportarCliente'])) {
	$cliente = new AjaxCliente();
	$cliente->ajaxImportarClientes();
}


if (isset($_POST['btnBuscarClienteAsistencia'])) {
	$clienteAsistencia = new AjaxCliente();
	$clienteAsistencia->idCliente = $_POST["GDcliente"];
	$clienteAsistencia->ajaxAsistencia();
}

if (isset($_POST['btnRegistrarAsistencia'])) {
	$clienteAsistencia = new AjaxCliente();
	$clienteAsistencia->ast_socio = $_POST["ast_socio"];
	$clienteAsistencia->ast_fecha_inicio = $_POST["ast_fecha_inicio"];
	$clienteAsistencia->ajaxRegistrarAsistencia();
}

if (isset($_POST['btnactulizarfoto'])) {
	$actualizafot = new AjaxCliente();
	$actualizafot->ajaxactualizafot();
}

if (isset($_POST['btn-elimina-cliente'])) {

    $elimina = new AjaxCliente();
    $elimina->ajaxEliminarCliente();
}
