 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Categorias</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->

     <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#AgregarCategoria">
         Agregar categoria
     </button>

     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Nombre</th>
                 <th>Descripción</th>
                 <th>Acciones</th>

             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>#</th>
                 <th>Nombre</th>
                 <th>Descripción</th>
                 <th>Acciones</th>

             </tr>
         </tfoot>
         <tbody>
             <?php
                //Categorias 
                $id = null;
                $categoria = CategoriasControlador::ctrMostrarcategoria($id);

                foreach ($categoria as $key => $value) :
                    ?>
             <tr>
                 <td><?php echo $key + 1 ?></td>
                 <td><?php echo $value['categoria'] ?></td>
                 <td><?php echo $value['caracteristicas_categoria'] ?></td>
                 <td>
                     <div class="btn-group">
                         <button class="btn btn-warning btnEditarCategoria" idCategoria="<?php echo $value['id'] ?>" data-toggle="modal" data-target="#EditarCategoria"><i class="fas fa-edit"></i></button>
                         <button class="btn btn-danger btnEliminarCategoria" idCategoria="<?php echo $value['id'] ?>"><i class="fas fa-trash"></i></button>

                     </div>

                 </td>

             </tr>
             <?php endforeach; ?>


         </tbody>
     </table>








 </div>
 <!-- /.container-fluid -->
 <?php
    $eliminar = new CategoriasControlador();
    $eliminar->ctrEliminarCategoria();
?>


 <!-- Modal editar -->
 <div class="modal fade " id="EditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-gray-900 text-white">
                 <h5 class="modal-title" id="exampleModalLabel">Agregar Categoría</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="./categorias" method="post">
                 <div class="modal-body">
                     <div class="col-auto">
                         <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                     </div>

                     <div class="col-auto">
                         <label class="sr-only" for="EDcategoria">Nombre de la categoría</label>
                         <div class="input-group mb-2">
                             <div class="input-group-prepend">
                                 <div class="input-group-text"> <i class="fas fa-project-diagram"> </i><strong class="text-danger"> * </strong> </div>
                             </div>
                             <input type="hidden" name="EDid" class="form-control" id="EDid" required readonly>
                             <input type="text" name="EDcategoria" class="form-control" id="EDcategoria" placeholder="Nombre de la categoría" required>
                             
                         </div>

                     </div>
                     <div class="col-auto">
                         <label class="sr-only" for="EDdescripcion">Descripción de la categoría</label>
                         <div class="input-group mb-2">
                             <div class="input-group-prepend">
                                 <div class="input-group-text"><i class="fas fa-audio-description"></i></div>
                             </div>
                             <input type="text" name="EDdescripcion" class="form-control" id="EDdescripcion" placeholder="Descripción de la categoría">
                         </div>

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" class="btn btn-primary" value="Guardar" name="btnActualizarCategoria">
                     </div>
                 </div>
                 <?php
                    $actualizar = new CategoriasControlador();
                    $actualizar->ActualizarCategoria();
                    ?>
             </form>
         </div>
     </div>
 </div> 
 <!-- Modal agregar -->
 <div class="modal fade" id="AgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-gray-900 text-white">
                 <h5 class="modal-title" id="exampleModalLabel">Agregar Categoría</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="./categorias" method="post">
                 <div class="modal-body">
                     <div class="col-auto">
                         <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                     </div>

                     <div class="col-auto">
                         <label class="sr-only" for="GDcategoria">Nombre de la categoría</label>
                         <div class="input-group mb-2">
                             <div class="input-group-prepend">
                                 <div class="input-group-text"> <i class="fas fa-project-diagram"> </i><strong class="text-danger"> * </strong> </div>
                             </div>
                             <input type="text" name="GDcategoria" class="form-control" id="GDcategoria" placeholder="Nombre de la categoría" required>
                         </div>

                     </div>
                     <div class="col-auto">
                         <label class="sr-only" for="GDdescripcion">Descripción de la categoría</label>
                         <div class="input-group mb-2">
                             <div class="input-group-prepend">
                                 <div class="input-group-text"><i class="fas fa-audio-description"></i></div>
                             </div>
                             <input type="text" name="GDdescripcion" class="form-control" id="GDdescripcion" placeholder="Descripción de la categoría">
                         </div>

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" class="btn btn-primary" value="Guardar" name="btnGuardarCategoria">
                     </div>
                 </div>
                 <?php
                    $agregar = new CategoriasControlador();
                    $agregar->ctrAgregarCategoria();
                    ?>
             </form>
         </div>
     </div>
 </div> 