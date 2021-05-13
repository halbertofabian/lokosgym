<?php

class MembresiasControlador
{


    public function ctrRegistrarMembresiaCliente()
    {
        if (isset($_POST['btnRegistrarMenbresiasCliente'])) {



            $membresiTipoId = MembresiasModelo::mdlMostrarMembresiaID($_POST['mbs_id']);


            $_POST['rmbs_costo_renovacion'] = $membresiTipoId['mbs_costo'];

            $crearMembresia = MembresiasModelo::mdlRegistrarMembresiaCliente($_POST);







            if ($crearMembresia) {

                $membresia = MembresiasModelo::mdlMostrarUltimaMembresiaCliente();

                $_POST['pmbs_rmbs'] = $membresia['rmbs_id'];
                $_POST['pmbs_monto'] = $membresia['mbs_costo'];
                date_default_timezone_set('America/Mexico_City');
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fecha_registro = $fecha . ' ' . $hora;

                $_POST['pmbs_fecha_pago'] = $fecha_registro;

                $_POST['pmbs_corte'] = $_SESSION["usr_caja"];
                $_POST['id_vendedor'] = $_SESSION["id"];

                $crearPago = MembresiasModelo::mdlRegistrarMembresiaPago($_POST);

                if ($crearPago) {

                    echo '
                            <script>
                                
                                window.open("./extensiones/tcpdf/pdf/pagos.php?pmbs_id=", "_blank");
                            </script>';

                    echo '<script>
    
                    swal({
                 title: "¡Muy bien!",
                 text: "Membresia creada y pago agregado",
                 icon: "success",
                 buttons: [,true],
                 
               })
               .then((willDelete) => {
                 if (willDelete) {
                     location.href = "./pagos"
                 }
               });

                    </script>';
                }
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
        }
    }

    public static function ctrRegistrarMembresiaPago()
    {

        if (isset($_POST['btnRegistrarMembresiaPago'])) {

            $url = Rutas::ctrRtas();
            if ($_SESSION['usr_caja'] <= 0) {
                PlantillaControlador::msj('warning', 'Error', 'Necesita abrir caja para realizar está operación', $url . 'abrir-caja');
                return;
            }

            // $fechaRen = MembresiasModelo::mdlActualizarMembresiaCliente($_POST['rmbs_fecha_termino'], $_POST['pmbs_rmbs']);


            // Actualizar Fecha de renovación
            $fechaRen = MembresiasModelo::mdlCambiarVigencia(
                $_POST['rmbs_fecha_termino'],
                $_POST['pmbs_tipo'],
                $_POST['id_cliente']
            );



            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $fecha_registro = $fecha . ' ' . $hora;

            $_POST['pmbs_fecha_pago'] = $fecha_registro;

            $_POST['pmbs_corte'] = $_SESSION["usr_caja"];
            $_POST['id_vendedor'] = $_SESSION["id"];

            $_POST['pmbs_monto'] = str_replace(",", "", $_POST['pmbs_monto']);




            $crearPago = MembresiasModelo::mdlRegistrarMembresiaPago($_POST);

            if ($crearPago) {

                echo '
                            <script>
                                
                                window.open("./extensiones/tcpdf/pdf/pagos.php?pmbs_id=", "_blank");
                            </script>';
                echo '<script>

                swal({
             title: "¡Muy bien!",
             text: "Membresia creada y pago agregado",
             icon: "success",
             buttons: [,true],
             
           })
           .then((willDelete) => {
             if (willDelete) {
                 location.href = "./pagos"
             }
           });

                </script>';
            }
            // } else {

            //     echo '<script>
            //     swal({
            //         title: "¡Mal :( !",
            //         text: "Algo salio mal, intente de nuevo cambiando la fecha de renovación, debe de ser diferente a la actual",
            //         icon: "error",
            //         buttons: [,true],

            //       })
            //       .then((willDelete) => {
            //         if (willDelete) {
            //             location.href = "renovar-membresia" 
            //         }
            //       });



            //           </script>';
            // }
        }
    }

    public static function ctrContadorEstadoSocios()
    {
        $sociosActivos = 0;
        $sociosInactivos = 0;
        $sociosInactivosHoy = 0;
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y-m-d');

        $sucrcipiones = MembresiasModelo::mdlConsultarClientesMembresias();

        foreach ($sucrcipiones as $key => $mbs) {
            # code...

            if ($mbs['vigencia'] < $fecha) {
                $sociosInactivos += 1;
            } elseif ($mbs['vigencia'] == $fecha) {
                $sociosInactivosHoy += 1;
            } else {
                $sociosActivos += 1;
            }
        }

        return array(
            'sociosInactivos' => $sociosInactivos,
            'sociosInactivosHoy' => $sociosInactivosHoy,
            'sociosActivos' => $sociosActivos
        );
    }
}
