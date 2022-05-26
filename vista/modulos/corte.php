<?php
if ($_SESSION['perfil'] != 'Cajero') :
?>

    <?php if (isset($_GET['ver'])) :
        $cajas = CajasModelo::mdlMostrarCajasById($_GET['ver']);
        // echo  '<pre>', print_r($cajas), '</pre>';
    ?>

        <div class="container">

            <div class="row">
                <div class="col-md-3">
                    <h5>Usuario Responsable</h5>
                    <p><?php echo $cajas['nombre'] ?></p>
                </div>
                <div class="col-md-3">
                    <h5>Caja</h5>
                    <p><?php echo $cajas['cja_nombre'] ?></p>
                </div>
                <div class="col-md-3">
                    <h5>Fecha de apertura</h5>
                    <p><?php echo $cajas['copn_fecha_abrio'] ?></p>
                </div>
                <div class="col-md-3">
                    <h5>Fecha de cierre</h5>
                    <p><?php echo $cajas['copn_fecha_cierre'] ?></p>
                </div>

            </div>
            <div class="row">

                <div class="col-12 mt-1">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">Ventas</h4>

                            <div class="row">
                                <div class="col-12">
                                    <?php $ventas = VentasModelo::mdlMostrarVentasByCorte($cajas['copn_id']); ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Vendedor</th>
                                                <th>Metodo de pago</th>
                                                <th>Fecha</th>
                                                <th>Efectivo</th>
                                                <th>Banco</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($ventas as $key => $vts) :

                                            ?>
                                                <tr>
                                                    <td><?php echo $vts['id_venta'] ?></td>
                                                    <td><?php echo $vts['nombre'] ?></td>
                                                    <td><?php echo $vts['venta_mp'] ?></td>
                                                    <td><?php echo $vts['fecha'] ?></td>
                                                    <td><?php echo $vts['vts_efectivo'] ?></td>
                                                    <td><?php echo $vts['vts_tarjeta'] ?></td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-1">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">Pagos de membresias</h4>

                            <div class="row">
                                <div class="col-12">
                                    <?php $pagos = MembresiasModelo::mdlMostrarPagosMembresiaCaja($cajas['copn_id']); ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Vendedor</th>
                                                <th>Metodo de pago</th>
                                                <th>Fecha</th>
                                                <th>Efectivo</th>
                                                <th>Banco</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($pagos as $key => $pgos) :

                                            ?>
                                                <tr>
                                                    <td><?php echo $pgos['pmbs_id'] ?></td>
                                                    <td><?php echo $pgos['nombre'] ?></td>
                                                    <td><?php echo $pgos['pmbs_mp'] ?></td>
                                                    <td><?php echo $pgos['pmbs_fecha_pago'] ?></td>
                                                    <td><?php echo $pgos['pmbs_efectivo'] ?></td>
                                                    <td><?php echo $pgos['pmbs_tarjeta'] ?></td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <?php

                $totales = CajasControlador::ctrTotales($_GET['ver']);
                // var_dump($totales);

                ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">$ <strong><?= number_format($totales['total_efectivo'], 2) ?></strong> </h4>
                            <p class="card-text">EFECTIVO</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">$ <strong><?= number_format($totales['total_banco'], 2) ?></strong> </h4>
                            <p class="card-text">BANCO</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <?php else :




    ?>
        <div class="container">
            <form method="post">
                <div class="row">
                    <div class="col-md-3">
                        <label for="copn_fecha_cierre_inicio">Fecha inicio</label>
                        <input type="date" class="form-control" placeholder="" name="copn_fecha_cierre_inicio" id="copn_fecha_cierre_inicio" value="<?= $_GET['copn_fecha_cierre_inicio'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="copn_fecha_cierre_fin">Fecha fin</label>
                        <input type="date" class="form-control" placeholder="" name="copn_fecha_cierre_fin" id="copn_fecha_cierre_fin" value="<?= $_GET['copn_fecha_cierre_fin'] ?>">
                        <button class="btn btn-primary float-right mt-1" id="">Buscar</button>

                    </div>

                </div>
                <?php

                $corte_fecha = new CajasControlador();
                $corte_fecha->ctrObtenerCorteFechas();

                ?>
            </form>
            <?php

            $copn_fecha_cierre_inicio = "";
            $copn_fecha_cierre_fin = "";
            $dataTable = "dataTable";
            $efectivo = 0;
            $banco = 0;
            if (isset($_GET['copn_fecha_cierre_inicio'])) {
                $dataTable = "";
                $cajas = CajasModelo::mdlMostrarCajasById('', $_GET['copn_fecha_cierre_inicio'], $_GET['copn_fecha_cierre_fin']);
            } else {
                $dataTable = "dataTable";

                $cajas = CajasModelo::mdlMostrarCajasById();
            }

            ?>

            <div class="row">

                <div class="col-12">
                    <table class="table " id="<?= $dataTable ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Caja</th>
                                <th>Usuario responsable</th>
                                <th>Fecha abrio</th>
                                <th>Fecha cerro</th>
                                <th>Monto efectivo</th>
                                <th>Monto banco</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($cajas as $key => $cja) :
                                $efectivo += $cja['copn_efectivo_real'];
                                $banco += $cja['copn_banco_real'];
                            ?>
                                <tr>

                                    <td><?php echo $cja['copn_id'] ?></td>
                                    <td><?php echo $cja['cja_nombre'] ?></td>
                                    <td><?php echo $cja['nombre'] ?></td>
                                    <td><?php echo $cja['copn_fecha_abrio'] ?></td>
                                    <td><?php echo $cja['copn_fecha_cierre'] ?></td>
                                    <td><?php echo $cja['copn_efectivo_real'] ?></td>
                                    <td><?php echo $cja['copn_banco_real'] ?></td>
                                    <td><a class="btn btn-secondary" href="index.php?ruta=corte&ver=<?php echo $cja['copn_id'] ?>"><i class="fas fa-eye    "></i></a></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Efectivo</h4>
                            <p class="card-text">$ <strong> <?= number_format($efectivo, 2) ?></strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Banco</h4>
                            <p class="card-text">$ <strong><?= number_format($banco, 2) ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php endif;
endif; ?>