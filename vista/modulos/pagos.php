<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="pmbs_vendedor">Usuario</label>
                <select class="form-control" name="pmbs_vendedor" id="pmbs_vendedor">
                    <option value="">Seleccione un usuario</option>
                    <?php

                    $usuarios = UsuariosModelo::mdlMostrarUsuarios(null);
                    foreach ($usuarios as $key => $usr) :

                    ?>

                        <option value="<?php echo $usr['id'] ?>"><?php echo $usr['nombre'] ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="pmbs_fecha_inicio">Fecha inicio</label>
                <input type="datetime-local" name="pmbs_fecha_inicio" id="pmbs_fecha_inicio" class="form-control todayTimeStart">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="pmbs_fecha_fin">Fecha fin</label>
                <input type="datetime-local" name="pmbs_fecha_fin" id="pmbs_fecha_fin" class="form-control todayTimeEnd">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="pmbs_mp">Tipo de pago</label>
                <select class="form-control" name="pmbs_mp" id="pmbs_mp">
                    <option value="">Seleccione un metodo de pago</option>
                    <option>EFECTIVO</option>
                    <option>BANCO</option>
                </select>
            </div>
        </div>

        <div class="col-12">

            <button id="btnBuscarPagosFiltro" class="btn btn-primary float-right btn-load  mb-3">Buscar</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table" id="">
                <thead>
                    <tr>
                        <th># Pago</th>
                        <th>Vendedor</th>
                        <th>MP</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Ticket</th>
                    </tr>
                </thead>
                <tbody id="PagosBody">

                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Total</h4>
                    <p class="card-text"><strong id="pmbs_total"></strong></p>
                    <a id="btnExportarPagos" href="<?php echo $url . 'export/exportar-pagos.php'; ?>" class="btn btn-success float-right ml-1"><i class="fas fa-file-excel"></i> Descargar Excel</a>

                </div>
            </div>
        </div>

    </div>
</div>