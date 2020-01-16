<?php
require_once '../modelo/categorias.modelo.php';
require_once '../modelo/productos.modelo.php';
require_once '../controlador/categorias.controlador.php';
require_once '../controlador/productos.controlador.php';
require_once '../modelo/rutas.php';

    

class AjaxVentas
{
    public $valueSearch;


    public function ajaxCargarProductosBuscados()
    {


        $valor = $this->valueSearch;

         $respuesta = ProductosControlador::ctrMostrarProductosBuscados($valor);
         $url = Rutas::ctrRtas();
         //echo json_encode($respuesta);
       $salida = "";

        foreach ($respuesta as $key => $value) {

            if($value['existencia']<=10){
                $stok = '<span class="btn btn-danger">'.$value['existencia'].'</span>';
            }else if($value['existencia'] >= 11 && $value['existencia'] <= 20){
                $stok = '<span class="btn btn-warning">'.$value['existencia'].'</span>';
            }else{
                $stok = '<span class="btn btn-succes">'.$value['existencia'].'</span>';
            }

            $salida .= '<div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12 mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="'.$url.'editar-productos/'.$value[0].'"> <strong class="text-dark"> '.$value['categoria'].' </strong> <br> '.$value['caracteristicas_producto'].' <br> <strong class="text-second">'.$value['producto'].'</strong>  <p>( '.$value['codigo'].')</p> </a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$ '.$value['precio_publico'] .'</div>
                        </div>
                        <div class="col-12">
                            <img src="'.$url.'/vista/img/productos/default/anonymous.png" alt="" width="80">
                        </div>
                        <div class="col-12 btn-group">
                        
                        <button class="btn btn-info btnAgregarProducto recuperarBoton" idProducto="'.$value[0].'"  ><i class="fas fa-plus"></i></button>
                        '.$stok.'
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>';
        }
        if ($salida == "") {
            echo '
      			<div class="col-12 col-md-12">
	      			<div class="alert alert-link text-center">
					<strong>No se encontaron resultados :( </strong>
					</div>
				</div>	
			';
        } else {
            echo $salida;
        }
    }
}


if (isset($_POST["consulta"])) {

    $nota = new AjaxVentas();
    $nota->valueSearch = $_POST["consulta"];
    $nota->ajaxCargarProductosBuscados();
} 
