<!-- Begin Page Content -->

<?php



?>
<audio id="audio" controls style="display: none">
    <source type="audio/wav" src="vista/audio/scanner-beep-checkout.mp3">
</audio>
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
                                <input type="text" class="form-control" id="box-search" placeholder="CODIGO DE BARRAS" autofocus>
                            </div>




                        </div>



                    </form>
                    <div class="col-12 form-group  mb-2">
                        <label for="box-searchAll" class="sr-only">SEARCH ALL</label>
                        <input type="text" class="form-control" id="box-searchAll" style="border: none;" placeholder="BUSQUEDA FILTRADA">
                    </div>
                    <div class="col-6 form-group mb-2">
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
                    </div>
                </div>
                <div class="card-body" style="height: 500px; overflow-y: scroll;">
                    <div class="row justify-content-center" id="datos">
                        <div class="col-auto">
                            <img src="vista/img/load-1.gif" alt="">
                        </div>
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
                            <form id="formularioVentaPOS" method="post" class="formularioVenta">
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
                                            <select name="GDcliente" class="form-control js-example-basic-single" id="GDcliente" required>
                                                <option value="">Seleccionar cliente</option>
                                                <option value="1" selected>General</option>
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

                                                            <th>Total</th>
                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <tr>

                                                            <td style="width: 35%">

                                                                <div class="input-group">

                                                                    <input type="hidden" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" value="0">

                                                                    <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                                                                    <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                                                                    <!-- <span class="input-group-text"><i class="fa fa-percent"></i></span> -->

                                                                </div>


                                                            </td>

                                                            <td style="width: 65%">
                                                                <input type="hidden" class="form-control" id="nuevoTotalVentaSin" name="nuevoTotalVentaSin" total="" placeholder="00000" readonly required>
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

                                            <!-- <div class="col-md-6" style="padding-right:0px">

                                                <div class="input-group">

                                                    <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                        <option value="">Seleccione método de pago</option>
                                                        <option value="Efectivo" selected>EFECTIVO</option>
                                                        <option value="Tarjeta">TARJETA CREDITO / DEBITO</option>


                                                    </select>

                                                </div>

                                            </div> -->




                                        </div>
                                        <div class="row cajasMetodoPago">
                                            <!-- <div class="col-md-6">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                    <input type="text" class="form-control" id="nuevoValorEfectivo" name="nuevoValorEfectivo" placeholder="000000" required>

                                                </div>

                                            </div> -->

                                            <!-- <div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                    <input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>

                                                </div>

                                            </div> -->
                                        </div>
                                        <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">




                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">METODO DE PAGO</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p><strong>EFECTIVO</strong></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_cantidad_efectivo">Introduce la cantidad a cobrar</label>
                                                                    <input type="text" name="lkg_cantidad_efectivo" id="lkg_cantidad_efectivo" class="form-control inputN" value="0.00" placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_monto_efectivo">Cantidad recibda</label>
                                                                    <input type="text" name="lkg_monto_efectivo" id="lkg_monto_efectivo" class="form-control inputN" value="0.00" placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_cambio_efectivo">Cambio</label>
                                                                    <input type="text" name="lkg_cambio_efectivo" id="lkg_cambio_efectivo" class="form-control inputN" value="0.00" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p><strong>TARJETA</strong></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_cantidad_tarjeta">Introduce la cantidad a cobrar</label>
                                                                    <input type="text" name="lkg_cantidad_tarjeta" id="lkg_cantidad_tarjeta" class="form-control inputN" value="0.00">
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Referancia</label>
                                                                    <input type="text" name="" id="" class="form-control" placeholder="">
                                                                </div>
                                                            </div> -->
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_total_venta_usr">TOTAL USUARIO</label>
                                                                    <input type="text" name="lkg_total_venta_usr" id="lkg_total_venta_usr" class="form-control inputN" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_total_venta_faltante">FALTANTE</label>
                                                                    <input type="text" name="lkg_total_venta_faltante" id="lkg_total_venta_faltante" class="form-control inputN" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lkg_total_venta">TOTAL</label>
                                                                    <input type="text" name="lkg_total_venta" id="lkg_total_venta" class="form-control inputN" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                                                        <button type="submit" class="btn btn-primary">REGISTRAR VENTA</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <!-- <div class="box-footer mt-3">

                                        <button type="submit" class="btn btn-primary float-right" name="btnVender">VENDER</button>

                                    </div> -->

                                    <button type="button" class="btn btn-primary btn-block btnDivCobro" data-toggle="modal" data-target="#exampleModal">
                                        COBRAR
                                    </button>

                                    <script>
                                        $(".btnDivCobro").on("click", function() {

                                            var nuevoTotalVenta = $("#nuevoTotalVenta").val();

                                            $("#lkg_total_venta").val(nuevoTotalVenta)

                                        })

                                        $("#lkg_cantidad_efectivo").on("keyup", function(e) {

                                            var nuevoTotalVenta = $("#nuevoTotalVenta").val();

                                            var lkg_cantidad_efectivo = $("#lkg_cantidad_efectivo").val()
                                            var lkg_cantidad_tarjeta = $("#lkg_cantidad_tarjeta").val();

                                            $("#lkg_monto_efectivo").val(lkg_cantidad_efectivo);

                                            var lkg_monto_efectivo = $("#lkg_monto_efectivo").val()

                                            var lkg_cambio_efectivo = Number(lkg_monto_efectivo) - Number(lkg_cantidad_efectivo)

                                            $("#lkg_cambio_efectivo").val(lkg_cambio_efectivo)


                                            var lkg_total_venta_usr = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta);
                                            $("#lkg_total_venta_usr").val(lkg_total_venta_usr)


                                            var lkg_total_venta_faltante = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta) - Number(nuevoTotalVenta)

                                            $("#lkg_total_venta_faltante").val(lkg_total_venta_faltante)

                                        })

                                        $("#lkg_monto_efectivo").on("keyup", function(e) {

                                            var lkg_cantidad_efectivo = $("#lkg_cantidad_efectivo").val()

                                            // $("#lkg_monto_efectivo").val(lkg_cantidad_efectivo);

                                            var lkg_monto_efectivo = $("#lkg_monto_efectivo").val()

                                            var lkg_cambio_efectivo = Number(lkg_monto_efectivo) - Number(lkg_cantidad_efectivo)

                                            $("#lkg_cambio_efectivo").val(lkg_cambio_efectivo)

                                        })

                                        $("#lkg_cantidad_tarjeta").on("keyup", function() {

                                            var nuevoTotalVenta = $("#nuevoTotalVenta").val();
                                            var lkg_cantidad_tarjeta = $("#lkg_cantidad_tarjeta").val();
                                            var lkg_cantidad_efectivo = $("#lkg_cantidad_efectivo").val();
                                            var lkg_total_venta_usr = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta);
                                            $("#lkg_total_venta_usr").val(lkg_total_venta_usr);

                                            var lkg_total_venta_faltante = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta) - Number(nuevoTotalVenta)
                                            $("#lkg_total_venta_faltante").val(lkg_total_venta_faltante)

                                        })
                                    </script>





                                </div>
                                <?php
                                // $crearVenta = new VentasControlador();
                                // $crearVenta->ctrCrearVenta();
                                ?>
                            </form>

                            <script>
                                $("#formularioVentaPOS").on("submit", function(e) {

                                    e.preventDefault();

                                    swal({
                                            title: "¿Estás seguro de contunuar?",
                                            text: "EFECTIVO: " + $("#lkg_cantidad_efectivo").val() + " \n TARJETA: " + $("#lkg_cantidad_tarjeta").val(),
                                            icon: "warning",
                                            buttons: ["Cancelar", "Si, continuar"],
                                            dangerMode: true,
                                        })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                var lkg_total_venta_faltante = $("#lkg_total_venta_faltante").val()

                                                if (lkg_total_venta_faltante != 0) {
                                                    swal("Error", "Completa el monto correcto de la venta", "warning");
                                                    return;
                                                }
                                                var datos = new FormData(this);
                                                datos.append("btnRegistrarVentasPos", true)
                                                $.ajax({
                                                    url: "ajax/ventas.ajax.php",
                                                    method: "POST",
                                                    data: datos,
                                                    cache: false,
                                                    contentType: false,
                                                    processData: false,
                                                    dataType: "json",
                                                    success: function(res) {
                                                        if (res.status) {
                                                            var ruta = "extensiones/tcpdf/pdf/ticket.php?codigo=" + res.codigo;
                                                            window.location = res.pagina;
                                                            window.open(ruta, "_blank");

                                                        } else {
                                                            swal("Error", res.mensaje, "error");
                                                        }
                                                    }
                                                })
                                            }
                                        });


                                })
                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>














</div>