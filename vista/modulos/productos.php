 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Productos</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->
     <?php if ($_SESSION['perfil'] != 'Administrador') : ?>

         <a id="btn-exp-pts" href="<?php echo $url . 'export/exportar-productos.php'; ?>" class="btn btn-success float-right ml-1"><i class="fas fa-file-excel"></i> Descargar Excel</a>
     <?php endif; ?>

     <button type="button" class="d-none d-sm-inline-block btn btn-primary  shadow-sm  float-right mb-4" data-toggle="modal" data-target="#AgregarProducto">
         <i class="fab fa-product-hunt"></i> Nuevo producto
     </button>



     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Nombre</th>
                 <th>Categoría</th>
                 <th>Características</th>
                 <th>Existencias</th>
                 <th>Precio publico</th>
                 <th>Acciones</th>

             </tr>
         </thead>
         <tfoot>
             <tr>
                 <th>#</th>
                 <th>Nombre</th>
                 <th>Categoría</th>
                 <th>Características</th>
                 <th>Existencias</th>
                 <th>Precio publico</th>
                 <th>Acciones</th>

             </tr>
         </tfoot>
         <tbody>
             <?php
                //Productos
                $producto = ProductosControlador::ctrMostrarProducto(null);
               
                foreach ($producto as $key => $value) :
                ?>
                 <tr>
                     <td>

                         <a class="btn btn-default " href="editar-productos/<?php echo $value[0] ?>" idCategoria="<?php echo $value['id'] ?>"><i class="fas fa-eye"></i> <?php echo $value['codigo'] ?> </a>

                     </td>
                     <td><?php echo $value['producto'] ?></td>
                     <td><?php echo $value['categoria'] ?></td>
                     <td><?php echo $value['caracteristicas_producto'] ?></td>
                     <td><?php echo $value['existencia'] ?></td>
                     <td> <strong class="text-success"><?php echo $value['precio_publico'] ?> </strong> </td>
                     <td>
                     <button class="btn btn-danger btn-elimina-producto" id="<?= $value[0] ?>">
                     <i class="fas fa-trash"></i>
                     </button>
                     </td>


                 </tr>
             <?php endforeach; ?>


         </tbody>
     </table>








 </div>
 <!-- /.container-fluid -->


 <script>
     $(function() {
         $('#AgregarProducto').on('shown.bs.modal', function(e) {
             $('#GDcodigo').focus();
         })
     });
 </script>
 <!-- Agregar Modal -->
 <div class="modal fade" id="AgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-gray-900 text-white">
                 <h5 class="modal-title" id="exampleModalLabel">Agregar Productos</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="#" method="post" enctype="multipart/form-data">
                 <div class="modal-body">


                     <div class="row">
                         <div class="col-12">
                             <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                         </div>
                         <div class="col-12">
                             <nav aria-label="breadcrumb">
                                 <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Información general</li>


                                 </ol>

                             </nav>

                         </div>

                         <div class="col-12 col-md-6">
                             <label class="" for="GDcodigo">Código</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-barcode"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDcodigo" class="form-control" id="GDcodigo" placeholder="Código" required autofocus>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDnombre">Nombre</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fab fa-product-hunt"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDnombre" class="form-control" id="GDnombre" placeholder="Nombre" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDcategoria">Categoría</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <select name="GDcategoria" class="form-control " id="GDcategoria" required>
                                     <option value="">Seleccione una categoría</option>
                                     <?php
                                        //Categorias 
                                        $id = null;
                                        $categoria = CategoriasControlador::ctrMostrarcategoria($id);

                                        foreach ($categoria as $key => $value) :
                                        ?>

                                         <option value="<?php echo $value['id'] ?>"><?php echo $value['categoria'] ?></option>

                                     <?php endforeach; ?>


                                 </select>







                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDmarca">Marca</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-copyright"></i></div>
                                 </div>
                                 <input type="text" name="GDmarca" class="form-control" id="GDmarca" placeholder="Marca">
                             </div>

                         </div>
                         <div class="col-12 col-md-12">
                             <label class="" for="GDdescripcion">Descripción</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-align-right"></i></div>
                                 </div>
                                 <textarea name="GDdescripcion" class="form-control" id="" cols="30" rows="3" placeholder="Descripción"></textarea>
                             </div>

                         </div>
                         <div class="col-12 col-md-6 mt-2">
                             <label class="" for="GDdescripcion">Características</label>
                             <input type="text" class="form-control" data-role="tagsinput" name="GDcaracteristicas" value="" id="GDcaracteristicas">



                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDstok">Cantidad de piezas</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-sort-amount-up"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="number" name="GDstok" class="form-control" id="GDstok" placeholder="Cantidad de piezas" required>
                             </div>

                         </div>
                         <div class="col-12 mt-4">
                             <nav aria-label="breadcrumb">
                                 <ol class="breadcrumb">
                                     <li class="breadcrumb-item active" aria-current="page">Precios</li>


                                 </ol>

                             </nav>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDporcentaje">Porcentaje </label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                                 </div>
                                 <input type="text" name="GDporcentaje" class="form-control" id="GDporcentaje" placeholder="Porcentaje" value="30">
                             </div>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDprecio_compra">Precio compra</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                 </div>
                                 <input type="text" name="GDprecio_compra" class="form-control" id="GDprecio_compra" placeholder="Precio compra">
                             </div>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDprecio_publico">Precio publico</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-hand-holding-usd"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDprecio_publico" class="form-control" id="GDprecio_publico" placeholder="Precio publico" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDprecio_mayoreo">Precio mayoreo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
                                 </div>
                                 <input type="text" name="GDprecio_mayoreo" class="form-control" id="GDprecio_mayoreo" placeholder="Precio mayoreo">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDprecio_especial">Precio especial</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-award"></i></div>
                                 </div>
                                 <input type="text" name="GDprecio_especial" class="form-control" id="GDprecio_especial" placeholder="Precio especial">
                             </div>

                         </div>

                         <!--<div class="col-12">




                           <div class="custom-file">

                                 <label for="GDimagen">Elija una imágen</label>
                                 <input type="file" name="GDimagen"lass="form-control nuevaImagen" id="GDimagen">
                             </div>

                             <p class="help-block">Peso máximo de la imagen 4MB</p>

                             <img src="vista/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="250px">

                         </div>-->

                     </div>









                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                         <input type="submit" class="btn btn-primary" value="Guardar" name="btnGuardarProducto">
                     </div>
                 </div>
                 <?php
                    $agregar = new ProductosControlador();
                    $agregar->ctrAgregarProducto();
                    ?>
             </form>
         </div>
     </div>
 </div>

 <!-- Editar Modal -->
 <div class="modal fade" id="EditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-gray-900 text-white">
                 <h5 class="modal-title" id="exampleModalLabel">Editar Productos</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="#" method="post" enctype="multipart/form-data">
                 <div class="modal-body">


                     <div class="row">
                         <div class="col-12">
                             <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                         </div>
                         <div class="col-12">
                             <h5>Información general:</h5>

                         </div>

                         <div class="col-12 col-md-6">
                             <label class="" for="EDcodigo">Código</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-barcode"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="EDcodigo" class="form-control" id="EDcodigo" placeholder="Código" required readonly>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDnombre">Nombre</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fab fa-product-hunt"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="EDnombre" class="form-control" id="EDnombre" placeholder="Nombre" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDcategoria">Categoría</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <select name="EDcategoria" class="form-control js-example-basic-single" id="EDcategoria" required>
                                     <option value="">Seleccione una categorías</option>
                                     <?php
                                        //Categorias 

                                        $id = null;
                                        $categoria = CategoriasControlador::ctrMostrarcategoria($id);

                                        foreach ($categoria as $key => $value) :
                                        ?>

                                         <option value="<?php echo $value['id'] ?>"><?php echo $value['categoria'] ?></option>

                                     <?php endforeach; ?>


                                 </select>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDmarca">Marca</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-copyright"></i></div>
                                 </div>
                                 <input type="text" name="EDmarca" class="form-control" id="EDmarca" placeholder="Marca">
                             </div>

                         </div>
                         <div class="col-12 col-md-12">
                             <label class="" for="EDdescripcion">Descripción</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-align-right"></i></div>
                                 </div>
                                 <textarea name="EDdescripcion" class="form-control" id="EDdescripcion" cols="30" rows="3" placeholder="Descripción"></textarea>
                             </div>

                         </div>
                         <div class="col-12 col-md-6 mt-2">
                             <label class="" for="EDcaracteristicas">Características</label>
                             <input type="text" class="form-control" data-role="" name="EDcaracteristicas" value="" id="EDcaracteristicas">



                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDstok">Cantidad de piezas</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-sort-amount-up"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="number" name="EDstok" class="form-control" id="EDstok" placeholder="Cantidad de piezas" required>
                             </div>

                         </div>
                         <div class="col-12">
                             <h5>Precios:</h5> <input type="text" name="EDporcentaje" class="form-control" id="EDporcentaje" placeholder="Porcentaje" value="">

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDprecio_compra">Precio compra</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                 </div>
                                 <input type="number" name="EDprecio_compra" class="form-control" id="EDprecio_compra" placeholder="Precio compra">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDprecio_publico">Precio publico</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-hand-holding-usd"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="number" name="EDprecio_publico" class="form-control" id="EDprecio_publico" placeholder="Precio publico" required>
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDprecio_mayoreo">Precio mayoreo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
                                 </div>
                                 <input type="number" name="EDprecio_mayoreo" class="form-control" id="EDprecio_mayoreo" placeholder="Precio mayoreo">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="EDprecio_especial">Precio especial</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-award"></i></div>
                                 </div>
                                 <input type="number" name="EDprecio_especial" class="form-control" id="EDprecio_especial" placeholder="Precio especial">
                             </div>

                         </div>

                         <!--<div class="col-12">




                           <div class="custom-file">

                                 <label for="EDimagen">Elija una imágen</label>
                                 <input type="file" name="EDimagen"lass="form-control nuevaImagen" id="EDimagen">
                             </div>

                             <p class="help-block">Peso máximo de la imagen 4MB</p>

                             <img src="vista/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="250px">

                         </div>-->

                     </div>









                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <input type="submit" class="btn btn-primary" value="Guardar" name="btnGuardarProducto">
                     </div>
                 </div>
                 <?php

                    ?>
             </form>
         </div>
     </div>
 </div>