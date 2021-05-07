<?php

if ($_SESSION['usr_caja'] <= 0) {
    PlantillaControlador::msj('warning', 'Error', 'Necesita abrir caja para realizar está operación', $url . 'abrir-caja');
    return;
}

?>
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="<?php echo $url ?>">Inicio</a>
        <a class="breadcrumb-item" href="<?php echo $url . 'renovar-membresia' ?>">Renovar membresia</a>
    </nav>

    <form method="post">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="pmbs_rmbs">Cliente</label>
                    <select class="form-control" name="pmbs_rmbs" id="pmbs_rmbs">
                        <option value="pmbs_rmbs">Seleecione cliente</option>
                        <?php
                        $membresiasClientes = MembresiasModelo::mdlMostrarTodasMembresiaCliente();
                        foreach ($membresiasClientes as $key => $rmbs) : ?>

                            <option value="<?php echo $rmbs['rmbs_id'] ?>"> <?php echo $rmbs['nombre_cliente'] . ' - ' . $rmbs['mbs_tipo'] ?> </option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pmbs_monto">Costo de renovación</label>
                    <input type="text" readonly name="pmbs_monto" id="pmbs_monto" class="form-control inputN" placeholder="">

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rmbs_fecha_termino">Fecha de renovación</label>
                    <input type="date" name="rmbs_fecha_termino" id="rmbs_fecha_termino" class="form-control" placeholder="">

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

            <div class="col-12">
                <button type="submit" name="btnRegistrarMembresiaPago" class="btn btn-primary float-right">Guardar pago</button>
            </div>
        </div>

        <?php

        $registrarPago = new MembresiasControlador();
        $registrarPago->ctrRegistrarMembresiaPago();

        ?>
    </form>

</div>