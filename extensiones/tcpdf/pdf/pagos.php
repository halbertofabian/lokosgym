<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
session_start();

require_once '../../../modelo/cajas.modelo.php';



class imprimirTicketPago
{

    public $pmbs_id;

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

        $itemVenta = "pmbs_id";
        $valorVenta = $this->pmbs_id;

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

        $ventaTicket = CajasModelo::mdlConsultarPagosTiket($valorVenta);



        $cliente = $ventaTicket['nombre_cliente'];



        $vendedor = $ventaTicket['nombre'];
        $fecha_venta = $ventaTicket['pmbs_fecha_pago'];




        // Calcular el cambio
        $forma_pago = $ventaTicket['pmbs_mp'];





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
				<br>
		
				
				
				
				
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

			Cliente: $cliente
			
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





        $bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:$impresion px; text-align:left">
        TIPO MEMBRESIA: <br> <strong> $ventaTicket[mbs_tipo] </strong> <br>
        FECHA INICIO: <strong> $ventaTicket[rmbs_fecha_inicio] </strong> <br>
        FECHA FIN: <strong> $ventaTicket[rmbs_fecha_termino] </strong>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px; text-align:right">
		<strong>Total: $ $ventaTicket[mbs_costo] </strong>
		<br>
       
		</td>

       
       
	</tr>

    <tr>
    
    <td style="width:$impresion px; text-align:center">
    ***** Forma de pago ***** <br>
    $ventaTicket[pmbs_mp] <br>
    $ventaTicket[pmbs_ref] <br>

   
    </td>
    </tr>

</table>

EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');



        // ---------------------------------------------------------

        $bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	
	<tr>
	
		<td style="width:$impresion px; text-align:center; font-size:7px">
			$politicas_ventas
			GRACIAS POR SU COMPRA 
		</td>

	</tr>
	

</table>



EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 

        //$pdf->Output('factura.pdf', 'D');
        ob_end_clean();
        $pdf->Output('factura.pdf');
    }
}

$factura = new imprimirTicketPago();
$factura->pmbs_id = $_GET["pmbs_id"];
$factura->traerImpresionFactura();
