<?php



?>
<div class="container-fluid">
    <!-- <div class="row">
        <div class="col-12">
            <div class="alert alert-primary" role="alert">
                <strong>Renovación de membresias</strong>
            </div>
        </div>
        <div class="col-12">
            <form id="formRenovar" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="mbs_cts_id">ID</label>
                            <input type="text" name="mbs_cts_id" id="mbs_cts_id" class="form-control" placeholder="Escribe el número del socio">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="mbs_cts_nombre">Nombre del socio</label>
                            <input type="text" name="mbs_cts_nombre" id="mbs_cts_nombre" class="form-control" placeholder="Escribe el nombre del socio">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="submit" name="btnBuscarCliente" id="" class="btn btn-block btn-primary mt-1" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> -->

    <script>
        $(document).ready(function() {
            $(".div-load").addClass("d-none")
            $(".row-data").removeClass("d-none")
        })
    </script>
    <div class="d-flex justify-content-center  div-load">
        <div class="spinner-grow text-primary div-load" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary div-load" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary div-load" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="row row-data d-none">

        <div class="col-12 table-responsive">
            <table class="table " id="dataTable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Observaciones</th>

                        <th>Estado</th>
                        <th>Vigencia</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $clientesMbs = MembresiasModelo::mdlConsultarClientesMembresias();
                    foreach ($clientesMbs as $cts) :

                    ?>

                        <tr>

                            <td><?= $cts['id_cliente'] ?></td>
                            <td><?= $cts['nombre_cliente'] ?></td>
                            <td><?= $cts['telefono_cliente'] ?></td>
                            <td><?= $cts['observaciones'] ?></td>
                            <td>

                                <?php
                                date_default_timezone_set('America/Mexico_City');
                                $fecha = date('Y-m-d');
                                $hora = date('H:i:s');
                                $fecha_hoy = $fecha;
                                if ($cts['vigencia'] > $fecha_hoy)
                                    echo "ACTIVO";
                                elseif ($cts['vigencia'] == $fecha_hoy)
                                    echo "TERMINA HOY";
                                else
                                    echo "DESACTIVADO";

                                ?>

                            </td>
                            <td><?= $cts['vigencia'] ?></td>
                            <td><?= $cts['tipo'] ?></td>
                            <td>
                                <button class="btn btn-primary btnModalM"  tipo="<?= $cts['tipo'] ?>" vigencia="<?= $cts['vigencia'] ?>" nombre_cliente="<?= $cts['nombre_cliente'] ?>" id_cliente="<?= $cts['id_cliente'] ?>" fecha_registro="<?= $cts['fecha_registro'] ?>" data-toggle="modal" data-target="#mdlMembresia"><i class="fas fa-dollar-sign"></i></button>
                            </td>

                        </tr>
                        <!-- Modal -->


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    $(".btnModalM").on("click", function() {

        $("#nombre_cliente_text").html("")
        $("#id_cliente").val("")
        $("#rmbs_fecha_termino").val("")
        $("#pmbs_tipo").val("")
        $("#fecha_registro").val("")


        var id_cliente = $(this).attr("id_cliente")
        var nombre_cliente = $(this).attr("nombre_cliente")
        var vigencia = $(this).attr("vigencia")
        var tipo = $(this).attr("tipo")
        var fecha_registro = $(this).attr("fecha_registro")

        $("#nombre_cliente_text").html(nombre_cliente)
        $("#id_cliente").val(id_cliente)
        $("#rmbs_fecha_termino").val(vigencia)
        $("#pmbs_tipo").val(tipo)

        if(fecha_registro == ""){
            
            $("#fecha_registro").val(toDay)
        }else{
            $("#fecha_registro").val(fecha_registro)
        }
        
    })
</script>
<div class="modal fade" id="mdlMembresia" tabindex="-1" role="dialog" aria-labelledby="mdlMembresiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlMembresiaLabel">RENOVACIÓN DE MEMBRESIA <br> <strong class="text-primary" id="nombre_cliente_text"></strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">



                    <div class="row">

                        <?php  ?>

                        <input type="hidden" name="id_cliente" id="id_cliente" value="">
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
                                <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" >

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
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" name="btnRegistrarMembresiaPago" class="btn btn-primary float-right">Guardar pago</button>
                </div>

                <?php

                $registrarPago = new MembresiasControlador();
                $registrarPago->ctrRegistrarMembresiaPago();

                ?>
            </form>
        </div>
    </div>
</div>