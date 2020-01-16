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
                    'wsp' => $_POST["GDcodigo_wsp"]."/".$_POST["GDwsp"],
                    'direccion' => $direccion,
                    'credito' => $_POST["GDcredito"],
                    'porcentaje' => $_POST["GDporcentaje"]
                );

                var_dump($datos);
                $agregar = ClientesModelo::mdlCrearCliente($datos);

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

    public static function ctrMostrarCliente($cliente){
        return ClientesModelo::mdlMostrarCliente($cliente);
    }
}
