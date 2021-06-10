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
                    <div class="col-12 col-md-6">
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
                    </div>
                    <div class="col-12 ">
                        <div class="form-group mt-4">
                            <button type="submit" name="btnRegistrarMembresiaPago" class="btn btn-primary float-right">Guardar pago</button>
                        </div>
                    </div>
                    <?php
                    $registrarPago = new MembresiasControlador();
                    $registrarPago->ctrRegistrarMembresiaPago();
                    ?>

                </div>

            </div>
        </div>
    </form>
</div>