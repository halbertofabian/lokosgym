<?php
class PlantillaControlador
{
    public static function startTemplate()
    {
        include_once 'vista/plantilla.php';
    }

    public static function msj($tipo, $titulo, $mensaje, $pagina = "")
    {

        if ($pagina == "") {
            echo
            '
            <script>    
                swal({
                    title: "' . $titulo . '",
                    text: "' . $mensaje . '",
                    icon: "' . $tipo . '",
                    buttons: [false,"Continuar"],
                    dangerMode: true,
                    closeOnClickOutside: false,

                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.history.back();
                    } else {
                        window.history.back();
                    }
                });
            </script> 
        ';
        } else {
            echo
            '
            <script> 
                swal({
                    title: "' . $titulo . '",
                    text: "' . $mensaje . '",
                    icon: "' . $tipo . '",
                    buttons: [false,"Continuar"],
                    dangerMode: true,
                    closeOnClickOutside: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        location.href = "' . $pagina . '"
                    } else {
                        location.href = "' . $pagina . '"
                    }
                });
            </script> 
        ';
        }
    }


    public static function restringir($array)
    {
        $ruta = Rutas::ctrRtas();
        $badera = false;
        foreach ($array as $key => $item) {
            
            if ($_SESSION['perfil'] == $item)
                $badera = true;
        }
       
        if ($badera) {
            echo '<script>

	                window.location = "'.$ruta.'";

                </script>';
        }
    }
}
