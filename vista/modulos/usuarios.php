 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Usuarios</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->

     <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#agregarUsuario">
         Agregar Usuarios
     </button>

     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Usuario</th>
                 <th>Correo</th>
                 <th>Perfil</th>
                 <th>Nombre</th>
                 <th>Telefono</th>
                 <th>Acciones</th>

             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>#</th>
                 <th>Usuario</th>
                 <th>Correo</th>
                 <th>Perfil</th>
                 <th>Nombre</th>
                 <th>Telefono</th>
                 <th>Acciones</th>

             </tr>
         </tfoot>
         <tbody>
             <?php $usuarios = UsuariosControlador::ctrMostrarUsuarios(null);
                foreach ($usuarios as $key => $value) :
                ?>
                 <tr>
                     <td><?php echo $key + 1; ?></td>

                     <td>

                         <a class="btn btn-default " href="editar-usuarios/<?php echo $value[0] ?>"><i class="fas fa-eye"></i> <?php echo  $value['usuario']; ?> </a>

                     </td>
                     <td><?php echo  $value['correo']; ?></td>
                     <td><?php echo  $value['usr_perfil']; ?></td>
                     <td><?php echo  $value['nombre'] . ' ' . $value['apellido'] ?></td>
                     <td><?php echo  $value['telefono']; ?></td>
                     <td>
                         <div class="btn-group">
                             <!--<button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                         <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                -->
                         </div>

                     </td>

                 </tr>
             <?php endforeach; ?>


         </tbody>
     </table>








 </div>
 <!-- /.container-fluid -->



 <!-- Modal -->
 <div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-gray-900 text-white">
                 <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="#" method="post">
                 <div class="modal-body">

                     <div class="row">
                         <div class="col-12">
                             <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                         </div>

                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDusuario">Usuario</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDusuario" class="form-control" id="GDusuario" placeholder="Usuario" pattern="^[-_a-zA-Z0-9]+$" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDcorreo">Correo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="email" name="GDcorreo" class="form-control" id="GDcorreo" placeholder="Correo">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDclave">Contraseña</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="password" name="GDclave" class="form-control" id="GDclave" placeholder="Contraseña" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDtelefono">Teléfono</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="GDtelefono" class="form-control" id="GDtelefono" placeholder="Teléfono">
                             </div>

                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12 col-md-4">
                             <label class="sr-only" for="GDnombre">Nombre</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDnombre" class="form-control" id="GDnombre" placeholder="Nombre" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-4">
                             <label class="sr-only" for="GDpaterno">Apellido paterno</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="GDpaterno" class="form-control" id="GDpaterno" placeholder="Apellido paterno">
                             </div>

                         </div>
                         <div class="col-12 col-md-4">
                             <label class="sr-only" for="GDmaterno">Apellido materno</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="GDmaterno" class="form-control" id="GDmaterno" placeholder="Apellido materno">
                             </div>

                         </div>

                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="usr_perfil">Perfil</label>
                                 <select class="form-control" name="usr_perfil" id="usr_perfil">
                                     <option>Administrador</option>
                                     <option>Cajero</option>
                                 </select>
                             </div>
                         </div>

                     </div>
                     <div class="row">


                         <div class="col-12">
                             <label class="sr-only" for="GDdireccion">Dirección</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <textarea name="GDdireccion" id="GDdireccion" class="form-control" cols="30" rows="4" placeholder="Dirección"></textarea>

                             </div>

                         </div>

                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" class="btn btn-primary" value="Guardar" name="btnAgregarUsuario">
                     </div>
                 </div>
                 <?php
                    $agregarUsuario = new UsuariosControlador();
                    $agregarUsuario->ctrAgregarUsuario();
                    ?>
             </form>
         </div>
     </div>
 </div>