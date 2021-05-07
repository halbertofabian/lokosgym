<?php

session_set_cookie_params(60 * 60 * 24 * 14);
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LOKOS GYM</title>
  <?php
  $url = Rutas::ctrRtas();
  
  ?>

  <!-- Custom fonts for this template-->
  <link href="<?php echo $url ?>vista/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo $url ?>vista/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->


  <script src="<?php echo $url ?>vista/js/sweetalert.min.js"></script>



  <link href="<?php echo $url ?>vista/vendor/tags-bootstrap/tagsinput.css" rel="stylesheet" type="text/css">
  <script src="<?php echo $url ?>vista/vendor/jquery/jquery.min.js"></script>



  <link href="<?php echo $url ?>vista/vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
  <script src="<?php echo $url ?>vista/vendor/select2/dist/js/select2.min.js"></script>

  <!-- date range picker -->
  <link rel="stylesheet" type="text/css" href="<?php echo $url ?>vista/vendor/date-range-picker/css/daterangepicker.css" />



</head>

<body id="page-top">



  <?php if (isset($_SESSION['session']) && $_SESSION['session']) :
    
    ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <?php include_once 'vista/modulos/navbar_lateral.php'; ?>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <?php

          

          include_once 'vista/modulos/navbar.php';

          ?>

          <?php if (isset($_GET['ruta'])) {

            $rutas = explode("/", $_GET['ruta']);

            if (
              $rutas[0] == 'categorias' ||
              $rutas[0] == 'editar-productos' ||
              $rutas[0] == 'productos' ||

              $rutas[0] == 'usuarios' ||
              $rutas[0] == 'editar-usuarios' ||

              $rutas[0] == 'cajas' ||
              $rutas[0] == 'ventas' ||
              $rutas[0] == 'pagos' ||
              $rutas[0] == 'clientes' ||
              $rutas[0] == 'pos' ||
              $rutas[0] == 'salir' ||
              $rutas[0] == 'alta-membresia' ||
              $rutas[0] == 'renovar-membresia' ||
              $rutas[0] == 'membresias' ||
              $rutas[0] == 'abrir-caja' ||
              $rutas[0] == 'cerrar-caja' ||
              $rutas[0] == 'corte'

            ) {
              include_once 'vista/modulos/' . $rutas[0] . '.php';
            } else {
              include_once 'vista/modulos/404.php';
            }
          } else {
            include_once 'vista/modulos/inicio.php';
          }
          ?>





        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once 'vista/modulos/footer.php'; ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
  <?php else :
    include_once 'vista/modulos/login.php';
  ?>
  <?php endif; ?>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Bootstrap core JavaScript-->

  <script src="<?php echo $url ?>vista/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo $url ?>vista/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo $url ?>vista/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo $url ?>vista/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo $url ?>vista/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo $url ?>vista/js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo $url ?>vista/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $url ?>vista/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo $url ?>vista/js/demo/datatables-demo.js"></script>


  <script src="<?php echo $url ?>vista/vendor/tags-bootstrap/tagsinput.js"></script>

  <script src="<?php echo $url ?>vista/vendor/jquery-number/jquery.number.js"></script>

  <!-- date range picker -->
  <script src="<?php echo $url ?>vista/vendor/date-range-picker/js/moment.js"></script>

  <script src="<?php echo $url ?>vista/vendor/date-range-picker/js/daterangepicker.js"></script>
  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->



  <script src="<?php echo $url ?>vista/js/plantilla.js"></script>
  <script src="<?php echo $url ?>vista/js/categorias.js"></script>
  <script src="<?php echo $url ?>vista/js/productos.js"></script>
  <script src="<?php echo $url ?>vista/js/ventas.js"></script>
  <script src="<?php echo $url ?>vista/js/membresias.js"></script>
  <script src="<?php echo $url ?>vista/js/cajas.js"></script>
  <script src="<?php echo $url ?>vista/js/clientes.js"></script>

</body>

</html>