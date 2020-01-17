<?php

class  ProductosControlador
{


    public static function ctrAgregarProducto()
    {

        if (isset($_POST["btnGuardarProducto"])) {

            if (
                preg_match('/^.+$/', $_POST["GDcodigo"]) &&
                preg_match('/^.+$/', $_POST["GDnombre"]) &&
                preg_match('/^.+$/', $_POST["GDcategoria"]) &&
                preg_match('/^[0-9.]+$/', $_POST["GDstok"]) &&
                preg_match('/^[0-9.]+$/', $_POST["GDprecio_publico"])
            ) {
                $isset = Softmor::issetItem('tbl_productos', 'codigo', $_POST["GDcodigo"]);

                if ($isset) {
                    echo '<script>
                    swal({
                        title: "¡Mal :( !",
                        text: "Este producto ya existe con  el mismo código que intenta registrar",
                        icon: "error",
                        buttons: [,true],
                        
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            window.history.back();
                        }
                      });
        
                           
        
                          </script>';

                          return;
                }

                /*=============================================
                    VALIDAR IMAGEN
                    =============================================*/

                $ruta = "vista/img/productos/default/anonymous.png";

                /*if (isset($_FILES["GDimagen"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["GDimagen"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL Producto
                        =============================================*/
                /* $fileimg = md5('Refaccionaría en guero' . " " . $_POST["GDcodigo"]);

                    $directorio = "vista/img/productos/" . $fileimg;

                    mkdir($directorio, 0755);

                    /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                /* if ($_FILES["GDimagen"]["type"] == "image/jpeg") {

                        /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                /* $aleatorio = mt_rand(100, 999);

                        $ruta = "vista/img/productos/" . $fileimg . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["GDimagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["GDimagen"]["type"] == "image/png") {

                        /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                /* $aleatorio = mt_rand(100, 999);

                        $ruta = "vista/img/productos/" . $fileimg . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["GDimagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
            }*/



                date_default_timezone_set('America/Mexico_City');

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fecha_registro = $fecha . ' ' . $hora;

                $datos = array(
                    'codigo' => $_POST["GDcodigo"],
                    'nombre' => $_POST["GDnombre"],
                    'marca' => $_POST["GDmarca"],
                    'categoria' => $_POST["GDcategoria"],
                    'descripcion' => $_POST["GDdescripcion"],
                    'caracteristicas' => $_POST["GDcaracteristicas"],
                    'existencia' => $_POST["GDstok"],
                    'precio_compra' => $_POST["GDprecio_compra"],
                    'precio_publico' => $_POST["GDprecio_publico"],
                    'precio_mayoreo' => $_POST["GDprecio_mayoreo"],
                    'precio_especial' => $_POST["GDprecio_especial"],
                    'fecha' => $fecha_registro,
                    'imagen' => $ruta
                );


                $agregar = ProductosModelo::mdlIngresarProducto($datos);

                if ($agregar) {

                    //Ruta url 

                    $url = Rutas::ctrRtas();
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
                             location.href = "productos"
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

    //Mostrar Producto
    public static function ctrMostrarProducto($id_producto)
    {

        return ProductosModelo::mdlMostrarProducto($id_producto);
    }
    public static function ctrMostrarProductoBarras($id_producto)
    {

        return ProductosModelo::mdlMostrarProductoBarras($id_producto);
    }

    public static function ctrMostrarSumProductos()
    {

        return ProductosModelo::mdlMostrarSumProductos();
    }
    

    // Actualizar

    public static function ctrActualizarProducto()
    {

        if (isset($_POST["btnActualizarProducto"])) {

            if (
                preg_match('/^.+$/', $_POST["GDid"]) &&
                preg_match('/^.+$/', $_POST["GDcodigo"]) &&

                preg_match('/^.+$/', $_POST["GDnombre"]) &&
                preg_match('/^.+$/', $_POST["GDcategoria"]) &&
                preg_match('/^[0-9.]+$/', $_POST["GDstok"]) &&
                preg_match('/^[0-9.]+$/', $_POST["GDprecio_publico"])
            ) {


                /*=============================================
                    VALIDAR IMAGEN
                    =============================================*/

                $ruta = "vista/img/productos/default/anonymous.png";

                /*if (isset($_FILES["GDimagen"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["GDimagen"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL Producto
                        =============================================*/
                /* $fileimg = md5('Refaccionaría en guero' . " " . $_POST["GDcodigo"]);

                    $directorio = "vista/img/productos/" . $fileimg;

                    mkdir($directorio, 0755);

                    /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                /* if ($_FILES["GDimagen"]["type"] == "image/jpeg") {

                        /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                /* $aleatorio = mt_rand(100, 999);

                        $ruta = "vista/img/productos/" . $fileimg . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["GDimagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["GDimagen"]["type"] == "image/png") {

                        /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                /* $aleatorio = mt_rand(100, 999);

                        $ruta = "vista/img/productos/" . $fileimg . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["GDimagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
            }*/





                $datos = array(
                    'id' => $_POST["GDid"],
                    'codigo' => $_POST["GDcodigo"],
                    'nombre' => $_POST["GDnombre"],
                    'marca' => $_POST["GDmarca"],
                    'categoria' => $_POST["GDcategoria"],
                    'descripcion' => $_POST["GDdescripcion"],
                    'caracteristicas' => $_POST["GDcaracteristicas"],
                    'existencia' => $_POST["GDstok"],
                    'precio_compra' => $_POST["GDprecio_compra"],
                    'precio_publico' => $_POST["GDprecio_publico"],
                    'precio_mayoreo' => $_POST["GDprecio_mayoreo"],
                    'precio_especial' => $_POST["GDprecio_especial"],
                    'imagen' => $ruta
                );


                $actualizar = ProductosModelo::mdlActualizarProducto($datos);
                //var_dump($actualizar);

                if ($actualizar) {

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
                             location.href = "productos"
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

    public static function ctrMostrarProductosBuscados($consulta)
	{
		return ProductosModelo::mdlMostrarProductosBusqueda($consulta);
	}
}
