<?php
session_start();
ob_start();

if (isset($_GET['cps_id'])) {


    //require_once DOCUMENT_ROOT . 'app/modulos/cajas/cajas.modelo.php';
    //require_once DOCUMENT_ROOT . 'app/modulos/sucursales/sucursales.modelo.php';
    require_once '../../../modelo/compras.modelo.php';
    //require_once DOCUMENT_ROOT . 'app/lib/phpqrcode/qrlib.php';
    /**
     * Creates an example PDF TEST document using TCPDF
     * @package com.tecnick.tcpdf
     * @abstract TCPDF - Example: Default Header and Footer
     * @author Nicola Asuni
     * @since 2008-03-04
     */



    // Include the main TCPDF library (search for installation path).

    require_once('tcpdf_include.php');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');



    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('helvetica', '', 9, '', true);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage('P');

    // set text shadow effect
    // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

    // Declaración de variables

    // $ruta_logo = $_SESSION['session_scl']['ruta_logo'];


    // if (!empty($ruta_logo)) {
    //     $ruta = 'https://app.ifixitmor.com/';
    //     $logo = $ruta . $_SESSION['session_scl']['ruta_logo'];
    // } else {
    //     $logo = HTTP_HOST . 'app/app-assets/images/softmor/logo-gris-softmor2.jpg';
    // }
    $logo = '<img src="../../../vista/img/logo_lokos.jpeg" width="110"> ';
    //
    $infoTps = ComprasModelo::mdlConsultarCompraPorID($_GET['cps_id']);

    $listp = json_decode($infoTps["cps_productos"], true);

    $scl_nombre = "LOKOS GYM";
    $scl_direccion = "Mariano Otero #5733
    Paseos del Sol, Zapopan.";

    $header = <<<EOF
    <table>
        <thead>
            <tr>
                <td style="text-align: left;">
                    {$logo}
                </td>
                <td style="text-align:center ;">
                        SUCURSAL: <strong>$scl_nombre</strong> <br>
                        DIRECCION: $scl_direccion <br>
                        TOTAL DE PRODUCTOS:<strong></strong>
                </td>
                <td style="text-align: center;">
                FOLIO: <strong>$infoTps[cps_folio]</strong><br>
               
                FECHA: <strong>$infoTps[cps_fecha_compra]</strong><br>
                </td>
            </tr>
            <tr>
                <td style="background-color:#24008D; width:100%; color:#fff;text-align: center;vertical-align:text-top; font-size:12px ">
                        REPORTE DE COMPRA
                </td>
            </tr>
            
        </thead>
    </table>
   
    <table style="background-color: #f8f9fa; padding-top:5px; padding-bottom:5px; font-weight:bold;">
    <thead>
        <tr  style="text-align: center;">
            <th>CODIGO</th>
            <th>PRODUCTO</th>
            <th>CANTIDAD</th>    
        </tr> 
    </thead>
    
    </table>
    
EOF;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
    foreach ($listp as $key => $infP) {
        # code...
        $tps_body = <<<EOF

<table style="background-color: #e9ecef; padding-top:10px; padding-bottom:2px;">
    <thead>
        <tr style="text-align: center; ">
            <td >$infP[codigo]</td>
            <td >$infP[pds_nombre]</td>
            <td >$infP[stock]</td>
        </tr>
        
    </thead>
    </table>
    

EOF;


        $pdf->writeHTMLCell(0, 0, '', '', $tps_body, 0, 1, 0, true, '', true);
        //********* */

    }

    //--------------------------
    $seccionTOTAL = <<<EOF

    <table  style="background-color: #e9ecef; padding-top: 20px;">
        <thead>
            <tr>
            <td></td>
            <td><strong>TOTAL DE PRODUCTOS:</strong></td>
            <td style="text-align: center;"><strong>$infoTps[cps_num_articulos]</strong></td>
            </tr>
        </thead>
    </table>
    
EOF;

    $pdf->writeHTMLCell(0, 0, '', '', $seccionTOTAL, 0, 1, 0, true, '', true);

    //----------------------------------

    // ---------------------------------------------------------

    $firma = <<<EOF
    
    <table style="padding-top:30px; ">
        <thead>
        <tr>
        <td style="text-align: center; width:33%;">
           
            <p style="border-top: 1px solid #000;">ENTREGA</p><br>
            <strong>$infoTps[tps_user_registro]</strong>
        
        </td>
        <td style="text-align: center; width:33%;">
           
            
        
        </td>
        <td style="text-align: center;width:33%;">
        <p style="border-top: 1px solid #000;">RECIBE</p>
        <br>
            <strong>$infoTps[tps_user_receptor]</strong>
        
        </td>
    </tr>
            
        </thead>
    </table>
 
EOF;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $firma, 0, 1, 0, true, '', true);


    ob_end_clean();

    $registro = str_replace(".", "", "prueba");
    $pdf->Output($registro . '.pdf', 'I');
}
