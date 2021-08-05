<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
session_start();


require_once '../../../controlador/ventas.controlador.php';
require_once '../../../modelo/ventas.modelo.php';



class imprimirFactura
{

	public $codigo;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		//$sucursal = ControladorSucursal::ctrMostrarSucursal();
		$direccion = "
	
		Mariano Otero #5733 <br>
		Paseos del Sol, Zapopan. <br><br>
		Tel: 31335471 <br>
		Facebook: LokosGym <br>
		Instagram: LokosGym <br>
		www.lokosgym.com
		
		";
		$nombre_suc = '<img src="../../../vista/img/logo_lokos.jpeg" width="110px"> ';
		//$telefono_suc = "7341006945";
		$web = "";
		$tipo_impresion = "58mm";
		$politicas_ventas = "
	<strong></strong>
	";

		$impresion = $tipo_impresion == '58mm' ? 130  : 160;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '58mm' ? 'A4' : 'A7';

		$itemVenta = "codigo";
		$valorVenta = $this->codigo;

		//$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

		/*$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);*/

		//TRAEMOS LA INFORMACIÓN DEL CLIENTE

		$itemCliente = "id";
		//$valorCliente = $respuestaVenta["id_cliente"];

		//$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

		//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

		$itemVendedor = "usuario";
		//$valorVendedor = $respuestaVenta["id_vendedor"];

		//$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

		//REQUERIMOS LA CLASE TCPDF

		$ventaTicket = VentasControlador::ctrMostrarVentaTicket($valorVenta);
		//print_r($ventaTicket);

		$cliente = $ventaTicket[0]['nombre_cliente'];

		$vendedor = $ventaTicket[0]['nombre'];
		$fecha_venta = $ventaTicket[0]['fecha'];

		$total = $ventaTicket[0]['total'];
		$neto = $ventaTicket[0]['neto'];

		$descuentoTotal = $ventaTicket[0][12] - $total;

		// Calcular el cambio
		$forma_pago = $ventaTicket[0]['forma_pago'];
		$forma_pago = explode("-", $forma_pago);

		$leyend1 = "";
		$leyend2 = "";
		$pagocon = "";
		$cambio = "";

		$leyend3 = "";

		if ($descuentoTotal > 0) {
			$leyend3 = "Descuento:";
			$descuentoTotal = "- $" . $descuentoTotal;
		} else {
			$descuentoTotal = "";
		}
		if ($forma_pago[0] == 'Efectivo') {
			if (!empty($forma_pago[1])) {
				$leyend1 = "Pago con:";
				$leyend2 = "Cambio:";
				$pagocon = $forma_pago[1];
				$cambio = $forma_pago[1] - $total;
			}
		} else {
			$leyend1 = "Pago con:";

			$pagocon = $ventaTicket[0]['forma_pago'];
		}


		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		//$pdf->setPrintHeader(false);
		//$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 2, 0);
		//$pdf->SetHeaderMargin(0);
		//$pdf->SetFooterMargin(0);
		//$pdf->setCellPaddings(0,0,0,0);
		//$pdf->SetAutoPageBreak(TRUE, 0);
		//$pdf->SetFont('times', '', 12, '', true);
		$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea 
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', $formato);


		//---------------------------------------------------------

		$bloque1 = <<<EOF

<table style="font-size:9px;">

	<tr>
		<td style="width:$impresion px;">
	
			<div>
				<strong style="text-align:center;font-size:14px">
				
				$nombre_suc 
				
				</strong> 
				
				
				
				
				<div style="width:$impresion px;" style="text-align:center; font-size:8px;">
				
			
				
					$direccion
					
				<br>
				
		

			
				</div>
				<strong style="text-align:left">Ticket: $valorVenta</strong>
				<br>
				<strong style="text-align:left">Fecha: $fecha_venta</strong>
				<br>
				Atiende: $vendedor
				<br>
				<hr>		
			<div style="text-align:center">

			$cliente
			
			</div>

				
			
				<hr>
				<br>
				

			</div>

		</td>

	</tr>


</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------




		foreach ($ventaTicket as $key => $value) {

			$descuento = $value['precio'] / 100 *   $value['descuento'];
			$descuento = $value['precio'] - $descuento;
			$totalDescuento = $descuento * $value['cantidad'];
			$totalDescuento = number_format($totalDescuento, 2);
			$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:$impresion px; text-align:left">
		 $value[producto] 
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px; text-align:center">
		<strong>$ $value[precio]   x $value[cantidad]= $ $totalDescuento </strong>
		<br>
		</td>

	</tr>

</table>

EOF;

			$pdf->writeHTML($bloque2, false, false, false, false, '');
		}


		// ---------------------------------------------------------

		$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:$impresions2 px;">
			 = <br>
			 $leyend3 
		</td>

		<td style="width:$impresions2 px;">
			$ $neto 
			<br>
			 $descuentoTotal
			<hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 <strong>Total:</strong><br>
			 $leyend1 <br>
			 $leyend2

		</td>

		<td style="width:$impresions2 px;">
			$ $total <br>
			$pagocon <br>
			$cambio

		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px;">
			 <hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px; text-align:center; font-size:7px">
			$politicas_ventas
			GRACIAS POR SU COMPRA
		</td>

	</tr>
	<tr>
	
		<td style="width:$impresion px; text-align:center; font-size:7px;">
		
		
		</td>

	</tr>

</table>



EOF;

		$total_efectivo_lkg = $ventaTicket[0]['vts_efectivo'];
		$total_tarjeta_lkg = $ventaTicket[0]['vts_tarjeta'];

		$bloque3_dividido = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:$impresions2 px;">
			 = <br>
			 $leyend3 
		</td>

		<td style="width:$impresions2 px;">
			$ $neto 
			<br>
			 $descuentoTotal
			<hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 <strong>Total:</strong><br>
			 <strong>EFECTIVO:</strong> <br>
			 <strong>TARJETA:</strong>

		</td>

		<td style="width:$impresions2 px;">
			$ $total <br>
			$ $total_efectivo_lkg <br>
			$ $total_tarjeta_lkg

		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px;">
			 <hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px; text-align:center; font-size:7px">
			$politicas_ventas
			GRACIAS POR SU COMPRA
		</td>

	</tr>
	<tr>
	
		<td style="width:$impresion px; text-align:center; font-size:7px;">
		
		
		</td>

	</tr>

</table>



EOF;

		$pdf->writeHTML($bloque3_dividido, false, false, false, false, '');

		//$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');
		ob_end_clean();
		$pdf->Output('factura.pdf');
	}
}

$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();
