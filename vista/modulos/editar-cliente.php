 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Ediar Usuarios</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->
     <?php if (isset($rutas[1]) && $rutas[1] != "") :

            $usuario = UsuariosControlador::ctrMostrarUsuarios($rutas[1]);
            if (!$usuario) :

                echo '
                <script>
                location.href = "' . $url . 'usuarios"
                </script>
                '

        ?>


         <?php return;
            else :
                //echo '<pre>';
                //print_r($usuario);
                //echo '</pre>';

                $apellido = explode(' ', $usuario['apellido']);
                $paterno = $apellido[0];
                $materno = $apellido[1];
                // echo '<pre>';
                //print_r($apellido);
                //echo '</pre>';
            ?>

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
                                 <input type="hidden" name="GDid" class="form-control" id="GDid" value="<?php echo $usuario['id']; ?>" required readonly>
                                 <input type="text" name="GDusuario" class="form-control" id="GDusuario" placeholder="Usuario" pattern="^[-_a-zA-Z0-9]+$" value="<?php echo $usuario['usuario']; ?>" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDcorreo">Correo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="email" name="GDcorreo" class="form-control" id="GDcorreo" value="<?php echo $usuario['correo']; ?>" placeholder="Correo">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDclave">Contraseña</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="hidden" name="GDclaveVieja" class="form-control" id="GDclaveVieja" value="<?php echo $usuario['clave']; ?>" required readonly>
                                 <input type="password" name="GDclave" class="form-control" id="GDclave" placeholder="Contraseña">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="sr-only" for="GDtelefono">Teléfono</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="GDtelefono" class="form-control" id="GDtelefono" value="<?php echo $usuario['telefono']; ?>" placeholder="Teléfono">
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
                                 <input type="text" name="GDnombre" class="form-control" id="GDnombre" value="<?php echo $usuario['nombre']; ?>" placeholder="Nombre" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-4">
                             <label class="sr-only" for="GDpaterno">Apellido paterno</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="GDpaterno" class="form-control" id="GDpaterno" value="<?php echo $paterno; ?>" placeholder="Apellido paterno">
                             </div>

                         </div>
                         <div class="col-12 col-md-4">
                             <label class="sr-only" for="GDmaterno">Apellido materno</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="GDmaterno" class="form-control" id="GDmaterno" value="<?php echo $materno; ?>" placeholder="Apellido materno">
                             </div>

                         </div>

                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="usr_perfil">Perfil</label>
                                 <select class="form-control" name="usr_perfil" id="usr_perfil">

                                     <?php

                                        $perfiles = array(0 => 'Administrador', 1 => 'Cajero');
                                        foreach ($perfiles as $pfs) :

                                            if ($pfs == $usuario['usr_perfil']) {
                                                $select = "selected";
                                            } else {
                                                $select = "";
                                            }

                                        ?>
                                         <option value="<?= $pfs; ?>" <?= $select ?>> <?= $pfs; ?> </option>
                                     <?php
                                        endforeach; ?>
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
                                 <textarea name="GDdireccion" id="GDdireccion" class="form-control" cols="30" rows="4" placeholder="Dirección"><?php echo $usuario['domicilio']; ?></textarea>

                             </div>

                         </div>

                     </div>

                     <div class="modal-footer">
                         <a class="btn btn-secondary" href="<?php echo $url ?>usuarios">Cancelar</a>
                         <input type="submit" class="btn btn-primary" value="Actualizar" name="btnActualizarUsuario">
                     </div>
                 </div>
                 <?php
                    $actualizar = new UsuariosControlador();
                    $actualizar->ctrActualizarUsuario();
                    ?>
             </form>
         <?php endif; ?>
     <?php else :
            echo ' <script>
        location.href = "' . $url . 'productos"
        </script>';

        ?>


     <?php endif; ?>









 </div>
 <!-- /.container-fluid -->