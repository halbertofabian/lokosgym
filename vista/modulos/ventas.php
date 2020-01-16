 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Ventas</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->

     
     <button type="button" id="daterange-btn" class="d-none d-sm-inline-block btn btn-default   mr-sm-2 shadow-sm  float-right mb-4">
         <span>
             <i class="fa fa-calendar"></i> Rango de fecha
         </span>
         <i class="fa fa-caret-down"></i>
     </button>
     <a href="caja" class="d-none d-sm-inline-block btn btn-primary mr-sm-2   shadow-sm  float-right mb-4">
         <i class="fas fa-cash-register"></i> Nueva venta
     </a>



     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Forma pago</th>
                 <th>Neto</th>
                 <th>Descuento</th>
                 <th>Total venta</th>
                 <th>Fecha venta</th>
                 <th>Vendedor</th>
                 <th>Acciones</th>

             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>#</th>
                 <th>Forma pago</th>
                 <th>Neto</th>
                 <th>Descuento</th>
                 <th>Total venta</th>
                 <th>Fecha venta</th>
                 <th>Vendedor</th>
                 <th>Acciones</th>

             </tr>
         </tfoot>
         <tbody>
             <?php
                //Productos

                $dateStart = null;
                $dateEnd = null;
                if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){
                    $dateStart = $_GET['fechaInicial'];
                    $dateEnd = $_GET['fechaFinal'];
                }
                $ventas = VentasControlador::ctrMostrarVentasRangoFachas($dateStart,$dateEnd);

               // var_dump($ventas);

                foreach ($ventas as $key => $value) :


                    ?>
                 <tr>
                     <td>

                         <a class=" btn btn-default text-primary " href="detalleVenta/<?php echo $value['id_venta'] ?>" idCategoria="<?php echo $value['id_venta'] ?>"><i class="fas fa-eye"></i> <?php echo $value['id_venta'] ?> </a>

                     </td>

                     <td><?php echo $value['forma_pago'] ?></td>
                     <td><?php echo $value['neto'] ?></td>
                     <td><?php echo $value['descuento'] ?></td>
                     <td><?php echo $value['total'] ?></td>
                     <td><?php echo $value['fecha'] ?></td>
                     <td><?php echo $value['nombre'] ?></td>
                     <td>
                         <a class="btn btn-primary" href="extensiones/tcpdf/pdf/ticket.php?codigo=<?php echo $value['id_venta'] ?>" target="_blank">
                             <i class="fas fa-print"></i>
                         </a>
                     </td>


                 </tr>
             <?php endforeach; ?>


         </tbody>
     </table>








 </div>
 <!-- /.container-fluid -->