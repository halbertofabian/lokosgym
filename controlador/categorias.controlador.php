<?php

class CategoriasControlador
{
    //Mostrar Categoría
    public static function ctrMostrarcategoria($id_categoria)
    {

        return $categoria = CategoriasModelo::mdlMostrarCategoria($id_categoria);
    }

    // Agregar categoría
    public static function ctrAgregarCategoria()
    {
        if (isset($_POST['btnGuardarCategoria'])) {
            if (preg_match('/^.+$/', $_POST["GDcategoria"])) {
                $datos = array(
                    'nombre' => $_POST["GDcategoria"],
                    'caracteristicas' => $_POST["GDdescripcion"]
                );

                $agregar =  CategoriasModelo::mdlIngresarCategoria($datos);

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
                            location.href = "categorias"
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
    // Agregar categoría
    public static function ActualizarCategoria()
    {
        if (isset($_POST['btnActualizarCategoria'])) {
            if (preg_match('/^.+$/', $_POST["EDcategoria"])) {
                $datos = array(
                    'nombre' => $_POST["EDcategoria"],
                    'caracteristicas' => $_POST["EDdescripcion"],
                    'id' => $_POST["EDid"]
                );

                $actualizar =  CategoriasModelo::mdlActualizarCategoria($datos);

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
                             location.href = "categorias"
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


    // Eliminar categoría 
    public static function ctrEliminarCategoria()
    {
        if (isset($_GET['deleteCategoria'])) {
            $eliminar = CategoriasModelo::mdlEliminarCategoria($_GET['deleteCategoria']);

            if ($eliminar) {
                echo  '<script>
                    swal({
                        title: "¡Muy bien!",
                        text: "Registro eliminado",
                        icon: "success",
                        buttons: [,true],
                        
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            location.href = "categorias"
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
        }
    }
}
