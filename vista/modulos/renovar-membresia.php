<?php

?>

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Renovar membresía</li>


        </ol>

    </nav>
    <form action="" method="post">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select-socio">Buscar socio</label>
                            <select name="id_cliente" class="form-control js-example-basic-single" id="select-socio" required>
                                <option value="">Seleccione un socio</option>
                                <?php $clientes = ClientesControlador::ctrMostrarCliente(null);
                                foreach ($clientes as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_cliente'] ?>"><?= $value['nombre_cliente'] . '-' . $value['id_cliente'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">

            <div class="card-body">
                <h4 class="card-title">Datos</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pmbs_tipo">Tipo de membresia</label>
                            <input type="text" name="pmbs_tipo" id="pmbs_tipo" value="" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pmbs_monto">Costo de renovación</label>
                            <input type="text" name="pmbs_monto" id="pmbs_monto" class="form-control inputN" placeholder="" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_registro">Fecha de inicio</label>
                            <input type="date" name="fecha_registro" id="fecha_registro" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rmbs_fecha_termino">Fecha de renovación</label>
                            <input type="date" name="rmbs_fecha_termino" id="rmbs_fecha_termino" class="form-control" value="">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>METODO DE PAGO</strong>
                        </div>
                    </div>
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
                    <div class="col-12 ">
                        <div class="form-group mt-4">
                            <button type="submit" name="btnRegistrarMembresiaPago" class="btn btn-primary float-right">REGISTRAR COBRO</button>
                        </div>
                    </div>
                </div>


                <script>
                    $("#pmbs_monto").on("keyup", function() {

                        var pmbs_monto = $("#pmbs_monto").val();

                        $("#lkg_total_venta").val(pmbs_monto)

                    })

                    $("#lkg_cantidad_efectivo").on("keyup", function(e) {

                        var pmbs_monto = $("#pmbs_monto").val();

                        var lkg_cantidad_efectivo = $("#lkg_cantidad_efectivo").val()
                        var lkg_cantidad_tarjeta = $("#lkg_cantidad_tarjeta").val();

                        $("#lkg_monto_efectivo").val(lkg_cantidad_efectivo);

                        var lkg_monto_efectivo = $("#lkg_monto_efectivo").val()

                        var lkg_cambio_efectivo = Number(lkg_monto_efectivo) - Number(lkg_cantidad_efectivo)

                        $("#lkg_cambio_efectivo").val(lkg_cambio_efectivo)


                        var lkg_total_venta_usr = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta);
                        $("#lkg_total_venta_usr").val(lkg_total_venta_usr)


                        var lkg_total_venta_faltante = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta) - Number(pmbs_monto)

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

                        var pmbs_monto = $("#pmbs_monto").val();
                        var lkg_cantidad_tarjeta = $("#lkg_cantidad_tarjeta").val();
                        var lkg_cantidad_efectivo = $("#lkg_cantidad_efectivo").val();
                        var lkg_total_venta_usr = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta);
                        $("#lkg_total_venta_usr").val(lkg_total_venta_usr);

                        var lkg_total_venta_faltante = Number(lkg_cantidad_efectivo) + Number(lkg_cantidad_tarjeta) - Number(pmbs_monto)
                        $("#lkg_total_venta_faltante").val(lkg_total_venta_faltante)

                    })
                </script>


                <!-- <div class="col-12 col-md-6">
                        <label class="" for="pmbs_mp">Metodo de pago</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                            </div>
                            <select name="pmbs_mp" class="form-control" id="pmbs_mp" required>
                                <option value="EFECTIVO">EFECTIVO</option>
                                <option value="TARJETA CREDITO / DEBITO">TARJETA CREDITO / DEBITO</option>
                                <option value="DEPOSITO">DEPOSITO</option>
                                <option value="TRANSAFERENCIA">TRANSAFERENCIA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-none" id="pmbs_ref_ctn">
                        <div class="form-group">
                            <label for="pmbs_ref">Referencía de pago</label>
                            <input type="text" name="pmbs_ref" id="pmbs_ref" class="form-control" placeholder="Escriba aquí la referenica">
                        </div>
                    </div> -->


                <?php
                $registrarPago = new MembresiasControlador();
                $registrarPago->ctrRegistrarMembresiaPago();
                ?>



            </div>
        </div>
    </form>
</div>