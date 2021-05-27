<?php session_start();

/*require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";*/



class imprimirFactura
{

	public $codigo;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		//Informacion de la sucursal
		$nombre_suc = "REFACCIONARIA EL GÜERO";
		$rfc = "";
		$direccion_suc = "
		CALLE NARCISO MENDOZA, NUM. 205 <br>
		COL. CENTRO, CP. 62900 <br>
		JOJUTLA, MORELOS.
	
	";

		//Tipo de impresión
		$tipo_impresion = '58';


		$impresion = $tipo_impresion == '58mm' ? 135  : 160;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '58mm' ? 'A4' : 'A7';


		$itemVenta = "codigo";
		$valorVenta = $this->codigo;

		//Codigo de la venta
		$codigo_venta = "NUM:" . $valorVenta;

		/*$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

	$fecha = substr($respuestaVenta["fecha"],0,-8);
	$productos = json_decode($respuestaVenta["productos"], true);
	$neto = number_format($respuestaVenta["neto"],2);
	$impuesto = number_format($respuestaVenta["impuesto"],2);
	$total = number_format($respuestaVenta["total"],2);*/

		//TRAEMOS LA INFORMACIÓN DEL CLIENTE

		/*$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "usuario";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF*/

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		//$pdf->setPrintHeader(false);
		//$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 2, 0);
		$pdf->SetFont('helvetica', '', 14);
		
		//$pdf->SetHeaderMargin(0);
		//$pdf->SetFooterMargin(0);
		//$pdf->setCellPaddings(0,0,0,0);
		//$pdf->SetAutoPageBreak(TRUE, 0);

		$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea 
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', 'A7');
		

		//---------------------------------------------------------

$bloque1 = <<<EOF
		<div>
		<table style="font-size:7px;">

			<tr>
				<td style="width:$impresion px;" style="text-align:center">
				
					$nombre_suc

					<br>
						
					$direccion_suc
						
					<br>

					<div style="text-align:right">
							
					$codigo_venta
						
					</div>
				</td>

			</tr>

		</table>
		<br>
EOF;

	$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF

		<table style="font-size:7px;">

			<tr>
				<td style="width:$impresion px;" style="text-align:left">
				
				
					<p>	
					05/08/2019 01:23:50 pm
					</p>
					<p>	
					Atd.: Alberto Fabián
					</p>	
					<div style="text-align:center">
					 - - - - - - - - - - - - - - - - 
					</div>
					
					<p style="text-align:center">Samuel Fabián Arriaga</p>
					<div style="text-align:center">
					 - - - - - - - - - - - - - - - - 
					</div>
				</td>

			</tr>

		</table>
EOF;

	$pdf->writeHTML($bloque2, false, false, false, false, '');

	for ($i=0; $i < 5 ; $i++){

	$bloque3 = <<<EOF

		<table style="font-size:7px;">

			<tr>
				<td style="width:$impresion px;" style="text-align:left" >
					1 PZA
					
			
				</td>
				<td style="width:$impresion px;" style="text-align:right">
					50.00 44.00
				</td>

			</tr>
			<tr>
				<td colspan="2"  style="width:$impresion px;" style="text-align:center" >
					PRODUCTO DE PRUEBA CON CODIGO 377863-676 $i
			
				</td>
				

			</tr>
			

		</table>
		
EOF;
	

	$pdf->writeHTML($bloque3, false, false, false, false, '');
}
$bloque4 = <<<EOF
		<br>
		<div style="text-align:center">
			 - - - - - - - - - -
		</div>
		

		<table style="font-size:7px;">

			<tr>
			<br>
				<td style="width:$impresion px;" style="text-align:left" >
					Descuento
				</td>
				<td style="width:$impresion px;" style="text-align:right">
					23.03
					<hr>
				</td>

			</tr>
			<tr>
				<td   style="width:$impresion px;" style="text-align:left" >
					<strong>Total</strong>
			
				</td>
				<td style="width:$impresion px;" style="text-align:right" >
					
				<strong>187.50</strong>
				</td>
				

			</tr>
			

		</table>
		
EOF;
	

	$pdf->writeHTML($bloque4, false, false, false, false, '');


	$bloque4 = <<<EOF
		<br>
		
		

		<table style="font-size:7px;">

			<tr>
			<br>
				<td style="width:$impresion px;" style="text-align:center">
					<p>**REVISE SU MERCANCIA**</p>
					<pre>EN PARTES ELECTRICAS NO HAY GARANTIA</pre>
					<pre style="text-align:center" >
				PARA CUALQUIER ACLARACION ES 
							OBLIGATORIO PRESENTAR TICKET Y
							PRODUCTO EN SU EMPAQUE ORIGINAL
					</pre>
				
					
				</td>
				
			</tr>
			
			

		</table>
		</div>
EOF;
	

	$pdf->writeHTML($bloque4, false, false, false, false, '');
		// ---------------------------------------------------------


		/*foreach ($productos as $key => $item) {

			$valorUnitario = number_format($item["precio"], 2);

			$precioTotal = number_format($item["total"], 2);

			$bloque2 = <<<EOF

<table style="font-size:7px;">

	<tr>
	
		<td style="width:$impresion px; text-align:left">
		$item[descripcion] 
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px; text-align:right">
		$ $valorUnitario Und * $item[cantidad]  = $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

			$pdf->writeHTML($bloque2, false, false, false, false, '');
		}

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

<table style="font-size:7px; text-align:right">

	<tr>
	
		<td style="width:$impresions2 px;">
			 NETO: 
		</td>

		<td style="width:$impresions2 px;">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 IMPTO: 
		</td>

		<td style="width:$impresions2 px;">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px;">
			 <hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 TOTAL: 
		</td>

		<td style="width:$impresions2 px;">
			$ $total
		</td>

	</tr>
	<tr>
	
		<td style="width:$impresion px; text-align:center">
		<style>
		.p{
			font-size:4px;
		}
	 	</style>
			
		<p><strong>$politicas_ventas</strong></p>
		</td>

	</tr>
	
	<tr>
	
		<td style="width:$impresion px; text-align:center">
			
			
			Muchas gracias por su compra
		</td>

	</tr>

</table>



EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');*/
		$pdf->Output('factura.pdf');
	}
}

$factura = new imprimirFactura();
$factura->codigo = '1002';
$factura->traerImpresionFactura();
