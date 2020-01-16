 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo  $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Clientes</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->

     <button type="button" class="d-none d-sm-inline-block btn btn-primary  shadow-sm  float-right mb-4" data-toggle="modal" data-target="#AgregarCliente">
         <i class="fas fa-user-tag"></i> Nuevo cliente
     </button>

     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Nombre</th>
                 <th>Telefono</th>
                 <th>Whatsapp</th>
                 <th>Crédito</th>
                 <th>Acciones</th>

             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>#</th>
                 <th>Nombre</th>
                 <th>Telefono</th>
                 <th>Whatsapp</th>
                 <th>Crédito</th>
                 <th>Acciones</th>

             </tr>
         </tfoot>
         <tbody>

             <?php
                $clientes = ClientesControlador::ctrMostrarCliente(null);


                foreach ($clientes as $key => $value) :

                    ?>

                 <tr>
                     <td><?php echo $key + 1 ?></td>
                     <td><?php echo $value['nombre_cliente'] ?></td>
                     <td><?php echo $value['telefono_cliente'] ?></td>
                     <td>

                         <a href="#" class="btn btn-success" target="_blank">
                             <i class="fab fa-whatsapp"></i>
                             <?php echo str_replace("/", "", $value['wsp_cliente']) ?>
                         </a>


                     </td>
                     <td><?php echo $value['credito_cliente'] ?></td>
                     <td>

                         <a href="" class="btn btn-warning disabled">
                             <i class="fas fa-edit"></i>
                         </a>
                         <a class="btn btn-danger btnBorrarCliente disabled">
                             <i class="fas fa-trash"></i>
                         </a>
                     </td>
                 </tr>


             <?php endforeach; ?>


         </tbody>
     </table>








 </div>
 <!-- /.container-fluid -->




 <!-- Modal -->
 <div class="modal fade" id="AgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="#" method="post">
                     <div class="row">
                         <div class="col-12">
                             <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                         </div>
                         <div class="col-12">
                             <nav aria-label="breadcrumb">

                                 <ol class="breadcrumb float-left">
                                     <li class="breadcrumb-item active" aria-current="page"><strong>1001</strong></li>
                                 </ol>
                             </nav>
                         </div>


                         <div class="accordion" id="accordionExample">
                             <div class="card">
                                 <div class="card-header" id="headingOne">
                                     <h2 class="mb-0">
                                         <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                             Información general
                                         </button>
                                     </h2>
                                 </div>

                                 <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                     <div class="card-body">
                                         <div class="row">
                                             <div class="col-12 col-md-6">
                                                 <label class="" for="GDnombre">Nombre</label>
                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i><strong class="text-danger"> * </strong></div>
                                                     </div>
                                                     <input type="text" name="GDnombre" class="form-control" id="GDnombre" placeholder="Nombre" required>
                                                 </div>
                                             </div>
                                             <div class="col-12 col-md-6">
                                                 <label class="" for="GDcorreo">Correo</label>
                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDcorreo" class="form-control" id="GDcorreo" placeholder="Correo">
                                                 </div>
                                             </div>
                                             <div class="col-12 col-md-5">
                                                 <label class="" for="GDtelefono">Teléfono</label>
                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="number" name="GDtelefono" class="form-control" id="GDtelefono" placeholder="Teléfono">
                                                 </div>
                                             </div>
                                             <div class="col-12 col-md-3">
                                                 <label class="" for="GDcodigo_wsp">Código</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><strong class="text-dark"> + </strong></div>
                                                     </div>
                                                     <input type="number" name="GDcodigo_wsp" class="form-control" id="GDcodigo_wsp" placeholder="Código" value="52">
                                                 </div>

                                             </div>
                                             <div class="col-12 col-md-4">
                                                 <label class="" for="GDwsp">Whatsapp</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="number" name="GDwsp" class="form-control" id="GDwsp" placeholder="Whatsapp">
                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="card">
                                 <div class="card-header" id="headingTwo">
                                     <h2 class="mb-0">
                                         <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                             Dirección
                                         </button>
                                     </h2>
                                 </div>
                                 <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                     <div class="card-body">
                                         <div class="row">
                                             <div class="col-12 col-md-6">
                                                 <label class="" for="GDcalle">Calle</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDcalle" class="form-control" id="GDcalle" placeholder="Calle">
                                                 </div>

                                             </div>
                                             <div class="col-12 col-md-3">
                                                 <label class="" for="GDnumero">Número</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDnumero" class="form-control" id="GDnumero" placeholder="Número">
                                                 </div>

                                             </div>
                                             <div class="col-12 col-md-3">
                                                 <label class="" for="GDcp">Código postal</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDcp" class="form-control" id="GDcp" placeholder="Código postal">
                                                 </div>

                                             </div>
                                             <div class="col-12 col-md-4">
                                                 <label class="" for="GDcolonia">Colonia</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDcolonia" class="form-control" id="GDcolonia" placeholder="Colonia">
                                                 </div>

                                             </div>

                                             <div class="col-12 col-md-4">
                                                 <label class="" for="GDciudad">Ciudad</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDciudad" class="form-control" id="GDciudad" placeholder="Ciudad">
                                                 </div>

                                             </div>
                                             <div class="col-12 col-md-4">
                                                 <label class="" for="GDestado">Estado</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDestado" class="form-control" id="GDestado" placeholder="Estado">
                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="card">
                                 <div class="card-header" id="headingTwo">
                                     <h2 class="mb-0">
                                         <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseT" aria-expanded="false" aria-controls="collapseTwo">
                                             Tienda
                                         </button>
                                     </h2>
                                 </div>
                                 <div id="collapseT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                     <div class="card-body">
                                         <div class="row">

                                             <div class="col-12 col-md-6">
                                                 <label class="" for="GDcredito">Crédito</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDcredito" class="form-control" id="GDcredito" placeholder="Crédito" value="0" required>
                                                 </div>

                                             </div>
                                             <div class="col-12 col-md-6">
                                                 <label class="" for="GDporcentaje">Porcentaje de descuento</label>

                                                 <div class="input-group mb-2">
                                                     <div class="input-group-prepend">
                                                         <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                     </div>
                                                     <input type="text" name="GDporcentaje" class="form-control" id="GDporcentaje" placeholder="Porcentaje de descuento" value="0" required>
                                                 </div>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                         <button type="submit" class="btn btn-primary" name="btnGuardarCliente">Guardar cliente</button>
                     </div>
                     <?php $cliente = new ClientesControlador();
                        $cliente->ctrAgregarCliente();
                        ?>
                 </form>
             </div>
         </div>
     </div>