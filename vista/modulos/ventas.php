 <!-- Begin Page Content -->
 <!-- <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Ventas</li>


         </ol>

     </nav>
     


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
                if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {
                    $dateStart = $_GET['fechaInicial'];
                    $dateEnd = $_GET['fechaFinal'];
                } else {
                    date_default_timezone_set('America/Mexico_City');

                    $fecha = date('Y-m-d');
                    $dateStart = $fecha;
                    $dateEnd = $fecha;
                }
                $ventas = VentasControlador::ctrMostrarVentasRangoFachas($dateStart, $dateEnd);

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








 </div> -->
 <!-- /.container-fluid -->

 <div class="container">
     <div class="row">
         <div class="col-md-4">
             <div class="form-group">
                 <label for="vts_vendedor">Usuario</label>
                 <select class="form-control" name="vts_vendedor" id="vts_vendedor">
                     <option value="">Seleccione un usuario</option>
                     <?php
                     
                     $usuarios = UsuariosModelo::mdlMostrarUsuarios(null);
                     foreach ($usuarios as $key => $usr) :
                     
                     ?>

                     <option value="<?php echo $usr['id'] ?>"><?php echo $usr['nombre'] ?></option>

                     <?php endforeach; ?>
                 </select>
             </div>
         </div>
         <div class="col-md-8"></div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for="vts_fecha_inicio">Fecha inicio</label>
                 <input type="datetime-local" name="vts_fecha_inicio" id="vts_fecha_inicio" class="form-control todayTimeStart">
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for="vts_fecha_fin">Fecha fin</label>
                 <input type="datetime-local" name="vts_fecha_fin" id="vts_fecha_fin" class="form-control todayTimeEnd">
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group">
                 <label for="vts_mp">Tipo de pago</label>
                 <select class="form-control" name="vts_mp" id="vts_mp">
                     <option value="">Seleccione un metodo de pago</option>
                     <option>EFECTIVO</option>
                     <option>BANCO</option>
                 </select>
             </div>
         </div>

         <div class="col-12">
             <button id="btnBuscarVentasFiltro" class="btn btn-primary float-right btn-load  mb-3">Buscar</button>
         </div>
     </div>

     <div class="row">
         <div class="col-12">
             <table class="table" id="">
                 <thead>
                     <tr>
                         <th># Venta</th>
                         <th>Vendedor</th>
                         <th>MP</th>
                         <th>Total</th>
                         <th>Fecha</th>
                         <th>Ticket</th>
                     </tr>
                 </thead>
                 <tbody id="ventasBody">

                 </tbody>
             </table>
         </div>

         <div class="col-12">
             <div class="card">

                 <div class="card-body">
                     <h4 class="card-title">Total</h4>
                     <p class="card-text"><strong id="vts_total"></strong></p>
                     <?php if ($_SESSION['perfil'] != 'Cajero') : ?>
                        <a id="btnExpVts" href="#" class="btn btn-success float-right ml-1"><i class="fas fa-file-excel"></i> Descargar Excel</a>
                    <?php endif; ?>
                 </div>
             </div>
         </div>

     </div>
 </div>