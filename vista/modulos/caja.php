<!-- Begin Page Content -->

<div class="container-fluid">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Caja</li>


        </ol>


    </nav>

    <!-- Button trigger modal -->
    <div class="row">
        <div class="col-7 ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <form class="formularioBusqueda" method="post" action="#" id="formularioBusqueda">
                        <div class="row">

                            <div class="col-12 form-group  mb-2">
                                <label for="txtCode" class="sr-only">SCAN CODE</label>
                                <input type="text" class="form-control" id="box-search" placeholder="CODIGO DE BARRAS">
                            </div>

                            <!--<div class="col-6 form-group mb-2">
                                <select name="GDcategoriaSearch" class="form-control js-example-basic-single" id="GDcategoriaSearch">
                                    <option value="">Todas las categorias</option>
                                    <?php
                                    //Categorias 
                                    $id = null;
                                    $categoria = CategoriasControlador::ctrMostrarcategoria($id);

                                    foreach ($categoria as $key => $value) :
                                        ?>

                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['categoria'] ?></option>

                                    <?php endforeach; ?>


                                </select>
                            </div>-->


                        </div>



                    </form>
                    <div class="col-12 form-group  mb-2">
                        <label for="box-searchAll" class="sr-only">SEARCH ALL</label>
                        <input type="text" class="form-control" id="box-searchAll" style="border: none;" placeholder="BUSQUEDA FILTRADA">
                    </div>
                </div>
                <div class="card-body" style="height: 500px; overflow-y: scroll;">
                    <div class="row" id="datos">



                    </div>
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Producto</h6>
                </div>
                <div class="card-body" id="caja_venta">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <form action="#" method="post" class="formularioVenta">
                                <div class="box-body">


                                    <div class="box">

                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="GDvendedor" name="GDvendedor" value="<?php echo $_SESSION['nombre'] ?>" readonly>
                                            <input type="hidden" id="GDvendedorid" name="GDvendedorid" value="<?php echo $_SESSION['id'] ?>" required>
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-key"></i></div>
                                            </div>
                                            <?php
                                            $ventas = VentasControlador::ctrMostrarUltimaVenta();

                                            if (!$ventas) : ?>
                                                <input type="text" class="form-control" id="GDcodigo_venta" name="GDcodigo_venta" value="1000" readonly>
                                            <?php else : ?>
                                                <input type="text" class="form-control" id="GDcodigo_venta" name="GDcodigo_venta" value="<?php echo $ventas['id_venta'] + 1; ?>" readonly>
                                            <?php endif; ?>
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                                            </div>
                                            <select name="GDcliente" class="form-control" id="GDcliente" required>
                                                <option value="">Seleccionar cliente</option>
                                                <option value="0" selected>General</option>
                                                <?php $clientes = ClientesControlador::ctrMostrarCliente(null);


                                                foreach ($clientes as $key => $value) :

                                                    ?>
                                                    <option value="<?php echo $value['id_cliente'] ?>"><?php echo $value['nombre_cliente'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="GDcredito" name="GDcredito"  readonly>
                                            
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-shopping-basket"></i></div>
                                            </div>
                                            <input type="radio" class="form-control" id="check_normal" name="GDventa" value="venta_normal" checked > Venta normal
                                            <input type="radio" class="form-control" id="check_acomulada" name="GDventa" value="venta_acumulada"> Venta acomulada
                                           
                                        </div> -->


                                        <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                                        <div class="form-group row nuevoProducto">



                                        </div>
                                        <input type="hidden" id="listaProductos" name="listaProductos">
                                        <hr>
                                        <div class="row justify-content-center">

                                            <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                                            <div class="col-md-12 float-right">

                                                <table class="table">

                                                    <thead>

                                                        <tr>
                                                            <th>Descuento</th>
                                                            <th>Total</th>
                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <tr>

                                                            <td style="width: 35%">

                                                                <div class="input-group">

                                                                    <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" value="0">
                                                                    
                                                                    <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                                                                    <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                                                                    <span class="input-group-text"><i class="fa fa-percent"></i></span>

                                                                </div>


                                                            </td>

                                                            <td style="width: 65%">
                                                                <input type="text" class="form-control" id="nuevoTotalVentaSin" name="nuevoTotalVentaSin" total="" placeholder="00000" readonly required>
                                                                <br>

                                                                <div class="input-group">


                                                                    <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                                                    <input type="text" class="form-control" style="color:red;font-size:34px" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>


                                                                    <input type="hidden" name="totalVenta" id="totalVenta">

                                                                </div>

                                                            </td>

                                                        </tr>
                                                        <tr class="tr-acomulado">
                                                            <td>
                                                               
                                                            </td>
                                                        </tr>

                                                    </tbody>

                                                </table>

                                            </div>



                                        </div>
                                        <div class="form-group row">

                                            <div class="col-md-6" style="padding-right:0px">

                                                <div class="input-group">

                                                    <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                        <option value="">Seleccione método de pago</option>
                                                        <option value="Efectivo" selected>Efectivo</option>
                                                        <option value="TC">Tarjeta Crédito</option>
                                                        <option value="TD">Tarjeta Débito</option>
                                                        <option value="CC">Crédito Cliente</option>
                                                    </select>

                                                </div>

                                            </div>




                                        </div>
                                        <div class="row cajasMetodoPago">
                                            <div class="col-md-6">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                    <input type="text" class="form-control" id="nuevoValorEfectivo" name="nuevoValorEfectivo" placeholder="000000" required>

                                                </div>

                                            </div>

                                            <div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                    <input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>

                                                </div>

                                            </div>
                                        </div>
                                        <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">







                                    </div>
                                    <div class="box-footer mt-3">

                                        <button type="submit" class="btn btn-primary float-right" name="btnVender">VENDER</button>

                                    </div>


                                </div>
                                <?php
                                $crearVenta = new VentasControlador();
                                $crearVenta->ctrCrearVenta();
                                ?>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>














</div>