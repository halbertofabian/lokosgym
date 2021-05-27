<?php
class ClientesControlador
{



    public static function ctrAgregarCliente()
    {

        if (isset($_POST["btnGuardarCliente"])) {

            if (
                preg_match('/^.+$/', $_POST["GDnombre"]) &&
                preg_match('/^.+$/', $_POST["GDcredito"]) &&
                preg_match('/^.+$/', $_POST["GDporcentaje"])
            ) {


                $direccion = "{$_POST["GDcalle"]}/{$_POST["GDnumero"]}/{$_POST["GDcp"]}/{$_POST["GDcolonia"]}/{$_POST["GDestado"]}/{$_POST["GDciudad"]}";




                $datos = array(
                    'nombre' => $_POST["GDnombre"],
                    'correo' => $_POST["GDcorreo"],
                    'telefono' => $_POST["GDtelefono"],
                    'wsp' => $_POST["GDcodigo_wsp"] . "/" . $_POST["GDwsp"],
                    'direccion' => $direccion,
                    'credito' => $_POST["GDcredito"],
                    'porcentaje' => $_POST["GDporcentaje"]
                );


                $agregar = ClientesModelo::mdlCrearCliente($datos);

                // var_dump($agregar);
                // return;

                if ($agregar) {

                    // Insersión
                    echo '<script>
    
                            swal({
                         title: "¡Muy bien!",
                         text: "Registro actualizado",
                         icon: "success",
                         buttons: [,true],
                         
                       })
                       .then((willDelete) => {
                         if (willDelete) {
                             location.href = "clientes"
                         }
                       });
    
                            </script>';
                } else {

                    echo '<script>
                    swal({
                        title: "¡Mal :( !",
                        text: "Algo salio mal, intente de nuevo",
                        icon: "error",
                        buttons: [,true],
                        
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            window.history.back();
                        }
                      });
        
                           
        
                          </script>';
                }
            } else {
                // Formato
                echo '<script>
                swal({
                    title: "¡Mal :( !",
                    text: "Los campos no cumplen con las especificaciones del sistema",
                    icon: "error",
                    buttons: [,true],
                    
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        window.history.back();
                    }
                  });
    
                       
    
                      </script>';
            }
        }
    }

    public static function ctrMostrarCliente($cliente)
    {
        return ClientesModelo::mdlMostrarCliente($cliente);
    }

    public static function ctrAgregarClienteAjax()
    {

        if (isset($_POST['GDnombre'])) {

            if (
                preg_match('/^.+$/', $_POST["GDnombre"]) &&
                preg_match('/^.+$/', $_POST["GDcredito"]) &&
                preg_match('/^.+$/', $_POST["GDporcentaje"])
            ) {


                $direccion = "{$_POST["GDcalle"]}/{$_POST["GDnumero"]}/{$_POST["GDcp"]}/{$_POST["GDcolonia"]}/{$_POST["GDestado"]}/{$_POST["GDciudad"]}";




                $datos = array(
                    'nombre' => $_POST["GDnombre"],
                    'correo' => $_POST["GDcorreo"],
                    'telefono' => $_POST["GDtelefono"],
                    'wsp' => $_POST["GDcodigo_wsp"] . "/" . $_POST["GDwsp"],
                    'direccion' => $direccion,
                    'credito' => $_POST["GDcredito"],
                    'porcentaje' => $_POST["GDporcentaje"]
                );


                $agregar = ClientesModelo::mdlCrearCliente($datos);

                if ($agregar) {
                    return  array(
                        'status' => true,
                        'mensaje' => 'Registro guardado',

                    );

                    // Insersión
                    /*
                    echo '<script>
    
                            swal({
                         title: "¡Muy bien!",
                         text: "Registro actualizado",
                         icon: "success",
                         buttons: [,true],
                         
                       })
                       .then((willDelete) => {
                         if (willDelete) {
                             location.href = "clientes"
                         }
                       });
    
                            </script>';
                            */
                } else {
                    return  array(
                        'status' => false,
                        'mensaje' => 'Error, no se registro',

                    );
                    /*

                    echo '<script>
                    swal({
                        title: "¡Mal :( !",
                        text: "Algo salio mal, intente de nuevo",
                        icon: "error",
                        buttons: [,true],
                        
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            window.history.back();
                        }
                      });
        
                           
        
                          </script>';
                          */
                }
            } else {
                // Formato
                echo '<script>
                swal({
                    title: "¡Mal :( !",
                    text: "Los campos no cumplen con las especificaciones del sistema",
                    icon: "error",
                    buttons: [,true],
                    
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        window.history.back();
                    }
                  });
    
                       
    
                      </script>';
            }
        }
    }

    public static function ctrImportarClientes()
    {
        try {
            //$nombreArchivo = $_SERVER['DOCUMENT_ROOT'] . '/dupont/exportxlsx/tbl_productos_dupont.xls';
            $nombreArchivo = $_FILES['archivoExcel']['tmp_name'];


            // Cargar hoja de calculo
            $leerExcel = PHPExcel_IOFactory::createReaderForFile($nombreArchivo);
            $objPHPExcel = $leerExcel->load($nombreArchivo);
            //var_dump($objPHPExcel);
            $objPHPExcel->setActiveSheetIndex(0);

            $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();



            $countInsert = 0;
            $countUpdate = 0;
            //echo "NumRows => ",$objPHPExcel->getActiveSheet()->getCell('B' . 2)->getCalculatedValue();

            for ($i = 2; $i <= $numRows; $i++) {



                $cts_id = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
                $cts_nombre = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                $cts_tel = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                $cts_obs = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
                $cts_estado = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
                $cts_vigencia = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();
                $cts_tipo = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue();




                $data = array(
                    'id_cliente' => $cts_id,
                    'nombre_cliente' => $cts_nombre,
                    'telefono_cliente' => $cts_tel,
                    'observaciones' => $cts_obs,
                    'estado' => $cts_estado,
                    'vigencia' => date('Y-m-d', strtotime($cts_vigencia)),
                    'tipo' => $cts_tipo,
                );

                $insert = ClientesModelo::mdlCrearClienteImport($data);


                if ($insert) {
                    $countInsert += 1;
                } else {
                    if (ClientesModelo::mdlActualizarClienteImport($data)) {
                        $countUpdate += 1;
                    }
                }
            }
            return array(
                'status' => true,
                'mensaje' => "Carga de clientes con éxito",
                'insert' =>  $countInsert,
                'update' => $countUpdate
            );
        } catch (Exception $th) {
            $th->getMessage();
            return array(
                'status' => false,
                'mensaje' => "No se encuentra el archivo solicitado, por favor carga el archivo correcto",
                'insert' =>  "",
                'update' => ""
            );
        }
    }

    public static function ctrActualizaFoto()
    {
        $aux='';
        $foto = base64_decode($_POST["foto"]);
        $route_photo = "../upload/fotos/f_" . $_POST["id"] . ".jpg";
        $file = fopen($route_photo, "w");
        if($file){
            $fotos = fwrite($file, $foto);
            fclose($file);
            if($fotos){
                $aux= 'act';
            }

        } 
        return $aux;
    }
}
