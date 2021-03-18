 <!-- Begin Page Content -->
 <div class="container-fluid">

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
             <li class="breadcrumb-item active" aria-current="page">Ediar Producto</li>


         </ol>

     </nav>
     <!-- Button trigger modal -->
     <?php if (isset($rutas[1]) && $rutas[1] != "") :

            $producto = ProductosControlador::ctrMstraorProducto($rutas[1]);

            if (!$producto) :

                echo '
                <script>
                location.href = "' . $url . 'productos"
                </script>
                '

        ?>


         <?php return;
            else :

                $precio_publico = $producto['precio_publico'];
                $precio_compra = $producto['precio_compra'];

                $valor = $precio_publico - $precio_compra;

                $formula = $valor * 100 / $precio_compra;

                //echo $formula .'<br>';

            ?>

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
                                 <input type="hidden" name="GDid" class="form-control" id="GDid" required value="<?php echo $producto[0] ?>" readonly>
                                 <input type="text" name="GDcodigo" class="form-control" id="GDcodigo" placeholder="Código" required value="<?php echo $producto['codigo'] ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDnombre">Nombre</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fab fa-product-hunt"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDnombre" class="form-control" id="GDnombre" placeholder="Nombre" required value="<?php echo $producto['producto'] ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDcategoria">Categoría</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-project-diagram"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <select name="GDcategoria" class="form-control" id="GDcategoria" required>
                                     <option value="<?php echo $producto[4] ?>"><?php echo $producto['categoria'] ?></option>
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
                                 <input type="text" name="GDmarca" class="form-control" id="GDmarca" placeholder="Marca" value="<?php echo $producto['marca'] ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-12">
                             <label class="" for="GDdescripcion">Descripción</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-align-right"></i></div>
                                 </div>
                                 <textarea name="GDdescripcion" class="form-control" id="" cols="30" rows="3" placeholder="Descripción"><?php echo $producto['descripcion'] ?></textarea>
                             </div>

                         </div>
                         <div class="col-12 col-md-6 mt-2">
                             <label class="" for="GDdescripcion">Características</label>
                             <input type="text" class="form-control" data-role="tagsinput" name="GDcaracteristicas" value="<?php echo $producto['caracteristicas_producto'] ?>" id="GDcaracteristicas">



                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDstok">Cantidad de piezas</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-sort-amount-up"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="number" name="GDstok" class="form-control" id="GDstok" placeholder="Cantidad de piezas" required value="<?php echo $producto['existencia'] ?>">
                             </div>

                         </div>
                         <br>
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
                                 <input type="text" name="GDporcentaje" class="form-control" id="GDporcentaje" placeholder="Porcentaje" value="<?php echo $formula ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDprecio_compra">Precio compra</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                 </div>
                                 <input type="text" name="GDprecio_compra" class="form-control" id="GDprecio_compra" placeholder="Precio compra" value="<?php echo $producto['precio_compra'] ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDprecio_publico">Precio publico</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-hand-holding-usd"></i><strong class="text-danger"> * </strong></div>
                                 </div>
                                 <input type="text" name="GDprecio_publico" class="form-control" id="GDprecio_publico" placeholder="Precio publico" required value="<?php echo $producto['precio_publico'] ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-3">
                             <label class="" for="GDprecio_mayoreo">Precio mayoreo</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-money-check-alt"></i></div>
                                 </div>
                                 <input type="text" name="GDprecio_mayoreo" class="form-control" id="GDprecio_mayoreo" placeholder="Precio mayoreo" value="<?php echo $producto['precio_mayoreo'] ?>">
                             </div>

                         </div>
                         <div class="col-12 col-md-6">
                             <label class="" for="GDprecio_especial">Precio especial</label>
                             <div class="input-group mb-2">
                                 <div class="input-group-prepend">
                                     <div class="input-group-text"><i class="fas fa-award"></i></div>
                                 </div>
                                 <input type="text" name="GDprecio_especial" class="form-control" id="GDprecio_especial" placeholder="Precio especial" value="<?php echo $producto['precio_especial'] ?>">
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

                         <a class="btn btn-secondary" href="<?php echo $url ?>productos">Cancelar</a>
                         <input type="submit" class="btn btn-primary" value="Actualizar" name="btnActualizarProducto">
                     </div>
                 </div>
                 <?php
                    $actualizar = new ProductosControlador();
                    $actualizar->ctrActualizarProducto();
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