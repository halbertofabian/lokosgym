<div class="container">

    <div class="row">
        <div class="col-12 table-responsives">
            <table class="table tablas tablaCompras" id="dataTable">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Referencia</th>
                        <th>Almacen</th>

                        <th>Fecha compra</th>
                        <!-- <th>Costo envio</th>
                        <th>Gran total</th>-->

                        <th>Costo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbodylistarcompras">
                    <?php
                    $compras = ComprasModelo::mdlAllCompras();
                    foreach ($compras as $key => $pcps) :
                    ?>
                        <tr>
                            <th scope="row"><?php echo $pcps['cps_id'] ?></th>

                            <td><?php echo $pcps['cps_folio'] ?></td>
                            <td><?php echo $pcps['cps_suc_nombre'] ?></td>

                            <td><?php echo $pcps['cps_fecha_compra'] ?></td>
                            <!-- <td><?php echo number_format($pcps['cps_costo_envio'], 2) ?></td>
                            <td><?php echo number_format($pcps['cps_gran_total'], 2) ?></td> -->

                            <td><?php echo number_format($pcps['cps_monto'], 2) ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <div class="btn btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $pcps['cps_id'] ?>" value="12">
                                        <i class="fa fa-eye"></i> Ver
                                    </button>
                                    <button type="button" class="btn btn-ligh btn-sm btnImprimirReporte" cps_id="<?= $pcps['cps_id'] ?>">
                                        <i class="fa fa-file-pdf"></i> Reporte
                                    </button>
                                    <?php if ($_SESSION['perfil'] == 'Administrador') : ?>
                                        <!-- <button type="button" class="btn btn-danger btn-sm btnEliminarCompra" cps_folio="<?= $pcps['cps_folio'] ?>">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button> -->
                                    <?php endif; ?>

                                </div>
                                <!-- Modal -->
                                <div class="modal " id="exampleModal<?php echo $pcps['cps_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">COMPRA <strong><?php echo $pcps['cps_folio'] ?></strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="form-group col-md-3 col-12">
                                                            <label for="">Sucursal</label>
                                                            <input type="text" value="<?php echo $pcps['cps_suc_nombre'] ?>" class="form-control " disabled>
                                                        </div>

                                                        <div class="form-group col-md-3 col-12">
                                                            <!-- Content -->
                                                            <label for="">Folio</label>
                                                            <input type="text" value="<?php echo $pcps['cps_folio'] ?>" class="form-control " disabled>
                                                        </div>
                                                        <div class="form-group col-md-3 col-12">
                                                            <!-- Content -->
                                                            <label for="">Fecha de compra</label>
                                                            <input type="text" value="<?php echo $pcps['cps_fecha_compra'] ?>" class="form-control " disabled>
                                                        </div>
                                                        <div class="form-group col-md-3 col-12">
                                                            <!-- Content -->
                                                            <label for="">Articulos</label>
                                                            <input type="text" value="<?php echo $pcps['cps_num_articulos'] ?>" class="form-control " disabled>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <!-- <div class="form-group col-md-3 col-12">
                                                            
                                                            <label for="">Total</label>
                                                            <input type="text" value="<?php echo number_format($pcps['cps_total'], 2) ?>" class="form-control " disabled>
                                                        </div>
                                                        <div class="form-group col-md-3 col-12">
                                                            
                                                            <label for="">Costo de envio</label>
                                                            <input type="text" value="<?php echo number_format($pcps['cps_costo_envio'], 2) ?>" class="form-control " disabled>
                                                        </div>
                                                        <div class="form-group col-md-3 col-12">
                                                            
                                                            <label for="">Gran total</label>
                                                            <input type="text" value="<?php echo number_format($pcps['cps_gran_total'], 2) ?>" class="form-control " disabled>
                                                        </div> -->
                                                    </div>

                                                    <div class="row">
                                                        <!-- <div class="form-group col-md-4 col-12">
                                                            
                                                            <label for="">Tipo de pago</label>
                                                            <input type="text" value="<?php //echo $pcps['cps_tipo_pago'] 
                                                                                        ?>" class="form-control " disabled>
                                                        </div>
                                                        <div class="form-group col-md-4 col-12">
                                                           
                                                            <label for="">Metodo de pago</label>
                                                            <input type="text" value="<?php //echo $pcps['cps_metodo_pago'] 
                                                                                        ?>" class="form-control " disabled>
                                                        </div> -->
                                                        <!-- <div class="form-group col-md-4 col-12">
                                                            
                                                            <label for="">Monto</label>
                                                            <input type="text" value="<?php echo number_format($pcps['cps_monto'], 2) ?>" class="form-control " disabled>
                                                        </div> -->

                                                    </div>
                                                    <div class="row">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>SKU</th>
                                                                    <th>Precio unitario</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php $productos = json_decode($pcps['cps_productos'], true);
                                                                // preArray($productos);

                                                                foreach ($productos as $key => $p) :
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $p['pds_nombre'] ?></td>
                                                                        <td><?php echo $p['codigo']; ?></td>
                                                                        <td><?php echo number_format($p['pds_pu'], 2) ?></td>
                                                                        <td><?php echo $p['stock'] ?></td>
                                                                        <td><?php echo number_format($p['total'], 2) ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach;
                    ?>

                </tbody>
            </table>
        </div>

    </div>
</div>