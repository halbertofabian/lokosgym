<?php
class UsuariosControlador
{
    public static function ctrAgregarUsuario()
    {
        if (isset($_POST['btnAgregarUsuario'])) {
            if (
                preg_match('/^[-_a-zA-Z0-9]+$/', $_POST["GDusuario"]) ||
                preg_match('/^.+$/', $_POST["GDclave"])


            ) {
                $encriptar = crypt($_POST["GDclave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos = array(
                    'usuario' => $_POST["GDusuario"],
                    'correo' => $_POST["GDcorreo"],
                    'clave' => $encriptar,
                    'telefono' => $_POST["GDtelefono"],
                    'nombre' => $_POST["GDnombre"],
                    'apellido' => $_POST["GDpaterno"] . ' ' . $_POST["GDmaterno"],
                    'domicilio' => $_POST["GDdireccion"]

                );
                /*echo '<pre>';
                print_r($datos);
                echo '</pre>';*/
                $agregar = UsuariosModelo::mdlAgregarUsuarios($datos);
                if ($agregar) {
                    echo  '<script>
                    swal({
                        title: "¡Muy bien!",
                        text: "Registro guardado",
                        icon: "success",
                        buttons: [,true],
                        
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            location.href = "usuarios"
                        }
                      });
                      
                      
                    </script>';
                } else {
                    echo '
                        <script>
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
                          
                          
                        </script>
                    ';
                }
            } else {
                echo '
                        <script>
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
                          
                          
                        </script>
                    ';
            }
        }
    }
    public static function ctrMostrarUsuarios($id)
    {
        return UsuariosModelo::mdlMostrarUsuarios($id);
    }
    public static function ctrIniciarSesion()
    {
        if (isset($_POST['btnIniciarSesion'])) {
            $encriptar = crypt($_POST["SESIONpass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $datos = array(
                'value' => $_POST["SESIONval"],
                'pass' => $encriptar
            );
            $sesion = UsuariosModelo::mdlIniciarSesion($datos);
            //echo $sesion['usuario'];

            if ($sesion) {
                /*echo '<pre>';
                print_r($sesion);
                echo '</pre>';*/
                $_SESSION['session'] = true;
                $_SESSION['usuario'] = $sesion['usuario'];
                $_SESSION['correo'] = $sesion['correo'];
                $_SESSION['nombre'] = $sesion['nombre'];
                $_SESSION['apellido'] = $sesion['apellido'];
                $_SESSION['telefono'] = $sesion['telefono'];
                $_SESSION['id'] = $sesion['id'];

                echo '<script>

                    window.location = "./";

                </script>';
            } else {

                echo '
                        <div class="alert alert-danger mt-4" role="alert">
                                        <strong>Las credenciales no coinciden</strong>
                                    </div>
                    ';
            }
        }
    }

    public static function ctrActualizarUsuario()
    {
        if (isset($_POST['btnActualizarUsuario'])) {
            if (
                preg_match('/^[-_a-zA-Z0-9]+$/', $_POST["GDusuario"])


            ) {
                $clave = "";
                if($_POST["GDclave"]==""){
                    $clave = $_POST["GDclaveVieja"];
                }else{
                    $clave = crypt($_POST["GDclave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                }
                
                $datos = array(
                    'id' => $_POST["GDid"],
                    'usuario' => $_POST["GDusuario"],
                    'correo' => $_POST["GDcorreo"],
                    'clave' => $clave,
                    'telefono' => $_POST["GDtelefono"],
                    'nombre' => $_POST["GDnombre"],
                    'apellido' => $_POST["GDpaterno"] . ' ' . $_POST["GDmaterno"],
                    'domicilio' => $_POST["GDdireccion"]

                );
                /*echo '<pre>';
                print_r($datos);
                echo '</pre>';*/
                $actualizar = UsuariosModelo::mdlActualizarUsuarios($datos);
                if ($actualizar) {
                    echo  '<script>
                    swal({
                        title: "¡Muy bien!",
                        text: "Registro actualizado",
                        icon: "success",
                        buttons: [,true],
                        
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            location.href = "usuarios"
                        }
                      });
                      
                      
                    </script>';
                } else {
                    echo '
                        <script>
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
                          
                          
                        </script>
                    ';
                }
            } else {
                echo '
                        <script>
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
                          
                          
                        </script>
                    ';
            }
        }
    }
}
