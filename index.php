<?php
ob_start();
    require_once 'controlador/plantilla.controlador.php';
    require_once 'controlador/categorias.controlador.php';
    require_once 'controlador/productos.controlador.php';
    require_once 'controlador/usuarios.controlador.php';
    require_once 'controlador/ventas.controlador.php';
    require_once 'controlador/clientes.controlador.php';
   require_once 'controlador/membresias.controlador.php';
   require_once 'controlador/cajas.controlador.php';


    //Modelos

    require_once 'modelo/categorias.modelo.php';
    require_once 'modelo/productos.modelo.php';
    require_once 'modelo/rutas.php';
    require_once 'modelo/usuarios.modelo.php';

    require_once 'modelo/softmor.moodelo.php';
  

    require_once 'modelo/ventas.modelo.php';

    require_once 'modelo/clientes.modelo.php';
    
    require_once 'modelo/membresias.modelo.php';
    require_once 'modelo/cajas.modelo.php';

    

    // Presentar la plantilla

    $rutas = array();

    
    $startTemplate = PlantillaControlador::startTemplate();

