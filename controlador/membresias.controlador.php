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

                $crearPago = MembresiasModelo::mdlRegistrarMembresiaPago($_POST);

                if ($crearPago) {
                    echo '<script>
    
                    swal({
                 title: "¡Muy bien!",
                 text: "Membresia creada y pago agregado",
                 icon: "success",
                 buttons: [,true],
                 
               })
               .then((willDelete) => {
                 if (willDelete) {
                     location.href = "./"
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


            $fechaRen = MembresiasModelo::mdlActualizarMembresiaCliente($_POST['rmbs_fecha_termino'], $_POST['pmbs_rmbs']);


            

            if ($fechaRen) {

                date_default_timezone_set('America/Mexico_City');
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fecha_registro = $fecha . ' ' . $hora;

                $_POST['pmbs_fecha_pago'] = $fecha_registro;

                $crearPago = MembresiasModelo::mdlRegistrarMembresiaPago($_POST);

                if ($crearPago) {
                    echo '<script>

                swal({
             title: "¡Muy bien!",
             text: "Membresia creada y pago agregado",
             icon: "success",
             buttons: [,true],
             
           })
           .then((willDelete) => {
             if (willDelete) {
                 location.href = "./"
             }
           });

                </script>';
                }
            } else {

                echo '<script>
                swal({
                    title: "¡Mal :( !",
                    text: "Algo salio mal, intente de nuevo cambiando la fecha de renovación, debe de ser diferente a la actual",
                    icon: "error",
                    buttons: [,true],
                    
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        location.href = "renovar-membresia" 
                    }
                  });
    
                       
    
                      </script>';
            }
        }
    }
}
