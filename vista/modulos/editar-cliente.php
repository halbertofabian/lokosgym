 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Editar Clientes</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->
     <?php if (isset($rutas[1]) && $rutas[1] != "") :

            $cliente = ClientesModelo::MostrarinfoById2($rutas[1]);
            if (!$cliente) :

                echo '
                <script>
                location.href = "' . $url . 'clientes"
                </script>
                '

        ?>


         <?php return;
            else :

               // $apellido = explode(' ', $cliente['apellido']);
               // $paterno = $apellido[0];
              //  $materno = $apellido[1];
                
            ?>

             <form action="#" method="post">
                 <div class="modal-body">

                     <div class="row">
                         <div class="col-12">
                             <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                         </div>

                         <div class="col-12 col-md-6">
                         <label class="" for="nombre_cliente">Cliente</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 
                                 <input type="hidden" name="id_cliente" class="form-control" id="id_cliente" value="<?= $cliente['id_cliente'] ?>" required readonly>
                                 <input type="text" name="nombre_cliente" class="form-control" id="nombre_cliente" placeholder="Nombre" pattern="^[-_a-zA-Z0-9 ]+$" value="<?= $cliente['nombre_cliente']; ?>" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="correo_cliente">Correo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="email" name="correo_cliente" class="form-control" id="correo_cliente" value="<?=$cliente['correo_cliente'] ?>" placeholder="Correo">
                             </div>

                         </div>
                         
                         <div class="col-12 col-md-6">
                             <label class="" for="telefono_cliente">Teléfono</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="telefono_cliente" class="form-control" id="telefono_cliente" value="<?=$cliente['telefono_cliente']; ?>" placeholder="Teléfono">
                             </div>

                         </div>

                         <div class="col-12 col-md-6">
                             <label class="" for="vigencia">Vigencia</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="date" name="vigencia" class="form-control" id="vigencia" value="<?=$cliente['vigencia'] ?>" required>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         
                         <div class="col-12 col-md-6">
                             <label class="" for="tipo">Tipo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="text" name="tipo" class="form-control" id="tipo" value="<?=$cliente['tipo']?>" placeholder="Tipo">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="fecha_registro">Fecha de registro</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <input type="date" name="fecha_registro" class="form-control" id="fecha_registro" value="<?=$cliente['fecha_registro'] ?>" >
                             </div>

                         </div>

                     </div>
                     <div class="row">


                         <div class="col-12 col-md-6">
                             <label class="" for="observaciones">Observaciones</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i></div>
                                 </div>
                                 <textarea name="observaciones" id="observaciones" class="form-control" cols="30" rows="4" placeholder="Observaciones"><?php echo $cliente['observaciones']; ?></textarea>

                             </div>

                         </div>

                     </div>

                     <div class="modal-footer">
                         <a class="btn btn-secondary" href="<?php echo $url ?>clientes">Cancelar</a>
                         <input type="submit" class="btn btn-primary" value="Actualizar" name="btnActualizarCliente">
                     </div>
                 </div>
                 <?php
                    $actualizar = new ClientesControlador();
                    $actualizar->ctrActualizarCliente();
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