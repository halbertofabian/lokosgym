<?php
cargarComponente('breadcrumb', '', 'Nueva compra');
?>
<div class="container">
    <form method="post">
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="cps_proveedor">Nombre del proveedor</label>
                <select name="cps_proveedor" id="cps_proveedor" class="form-control select2" required>
                    <option value="">Elija el proveedor</option>
                </select>
                <button type="button" class="btn btn-link float-right" data-toggle="modal" data-target="#mdlProveedor">
                    Agregar nuevo proveedor
                </button>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="cps_folio">Folio</label>
                <input type="text" name="cps_folio" id="cps_folio" class="form-control" placeholder="Introduce el folio de la compra">
            </div>

            <div class="form-group col-md-4 col-12">
                <label for="cps_fecha_compra">Fecha de compra</label>
                <input type="date" name="cps_fecha_compra" id="cps_fecha_compra" class="form-control theDate">
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="cps_fecha_pago">Fecha de pago</label>
                <input type="date" name="cps_fecha_pago" id="cps_fecha_pago" class="form-control theDate">
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="cps_cantidad">Cantidad</label>
                <input type="text" name="cps_cantidad" id="cps_cantidad" class="form-control inputN" placeholder="0.00">
            </div>

            <div class="alert alert-dark col-12" role="alert">
                <strong>Tipo de pago</strong>
            </div>

            <div class="form-group col-md-4">
                <label for="cps_tp">Tipo de pago</label>
                <select name="cps_tp" id="cps_tp" class="form-control">
                    <option value="Contado">Contado</option>
                    <option value="Credito">Crédito</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="cps_mp">Método de pago</label>
                <select name="cps_mp" id="cps_mp" class="form-control">
                    <option value="Transferencia">Transferencia</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Cheque">Cheque</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="abs_monto">Monto</label>
                <input type="text" name="abs_monto" id="abs_monto" class="form-control inputN" value="0.00" placeholder="0.00">
            </div>
            <div class="form-group col-12 col-md-8">
                <label for="cps_nota">Nota</label>
                <textarea class="form-control" name="cps_nota" id="cps_nota" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group col-md-4 col-12">
                <button type="submit" class="btn btn-primary float-right" name="btnGuardarCompra">Guardar Compra</button>
            </div>
        </div>
        <?php
        $crearCompra = new ComprasControlador();
        $crearCompra->ctrGuardarCompra();
        ?>
    </form>
</div>


<div class="modal fade" id="mdlProveedor" tabindex="-1" aria-labelledby="mdlProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlProveedorLabel">Nuevo proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formAddProveedor">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="pvs_nombre">Nombre del proveedor</label>
                        <input type="text" name="pvs_nombre" id="pvs_nombre" class="form-control" placeholder="Introduzca el nombre del proveedor / empresa ">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Agregar proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>