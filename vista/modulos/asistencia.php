<div class="container-fluid">

    <div class="card">

        <div class="card-body">
            <h4 class="card-title"></h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="GDcliente">Buscar socio</label>
                        <select name="GDcliente" class="form-control js-example-basic-single" id="GDcliente" required>
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
                <div class="col-md-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-primary" id="id_cliente"></th>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <th class="text-primary" id="nombre_cliente"></th>
                            </tr>
                            <tr>
                                <th>Fecha inicio:</th>
                                <th class="text-primary" id="fecha_registro"></th>
                            </tr>
                            <tr>
                                <th>Fecha renovación:</th>
                                <th class="text-primary" id="vigencia"></th>
                            </tr>

                        </thead>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estado:</th>
                                <th class="text-primary" id="estado"></th>
                            </tr>
                            <tr>
                                <th>Tipo de membresia:</th>
                                <th class="text-primary" id="tipo"></th>
                            </tr>
                            <tr>
                                <th>Observaciones:</th>
                                <th class="text-primary" id="observaciones"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-3 text-center">

                    <p>FOTOGRAFIA DEL SOCIO</p>

                    <img width="250" src="https://images.vexels.com/media/users/3/137047/isolated/preview/5831a17a290077c646a48c4db78a81bb-icono-de-perfil-de-usuario-azul-by-vexels.png" alt="" srcset="">

                </div>
            </div>

        </div>
    </div>

    <div class="card mt-1">

        <div class="card-body">
            <h4 class="card-title">Asistencia</h4>
            <div class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        date_default_timezone_set('America/Mexico_City');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $fecha_registro = $fecha . 'T' . $hora;

                        ?>
                        Registrar asistencia <input type="datetime-local" id="ast_fecha_inicio" name="ast_fecha_inicio" class=" form-control todayTime" value="<?= $fecha_registro ?>">
                        <button class="btn btn-primary float-right mt-1 btnRegistrarAsistencia btn-load-i" type="submit">Registrar asistencia</button>
                    </div>
                    <div class="col-md-4" style="overflow-y: scroll; height:400px">
                        <h4 class="card-title">Registro</h4>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyRegistroAsistencia">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-1">

            </div>
        </div>
    </div>

</div>


<script>
    $("#GDcliente").on("change", function() {

        buscarSocio();

    })

    function buscarSocio() {
        var datos = new FormData();
        datos.append("GDcliente", $("#GDcliente").val());
        datos.append("btnBuscarClienteAsistencia", true);

        $.ajax({

            url: 'ajax/clientes.ajax.php',
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {


            },
            success: function(res) {


                var cliente = res.cliente;
                var asistencia = res.asistencia;

                $("#id_cliente").html(cliente.id_cliente)
                $("#nombre_cliente").html(cliente.nombre_cliente)
                $("#fecha_registro").html(cliente.fecha_registro)
                $("#vigencia").html(cliente.vigencia)
                $("#tipo").html(cliente.tipo)
                $("#observaciones").html(cliente.observaciones)

                var fecha_vigencia = cliente.vigencia;

                var estado = "";
                if (fecha_vigencia < toDay) {

                    estado = "<strong class='text-danger'>INACTIVO</strong>";

                } else if (fecha_vigencia == toDay) {
                    estado = "<strong class='text-warning'>VENCE HOY</strong>";

                } else {
                    estado = "<strong class='text-success'>ACTIVO</strong>";

                }

                $("#estado").html(estado)

                var tbodyAsistencia = "";
                asistencia.forEach(ast => {

                    tbodyAsistencia += ` 

                    <tr>

                        <td>${ast.ast_id}</td>
                        <td>${ast.ast_fecha_inicio}</td>

                    </tr>

                    
                    `

                });

                $("#tbodyRegistroAsistencia").html(tbodyAsistencia)


            }
        })
    }

    $(".btnRegistrarAsistencia").on("click", function() {
        var GDcliente = $("#GDcliente").val();
        if (GDcliente == "") {
            swal("¡Error!", "Debe de seleccionar un socio", "warning");
            return;
        }

        var datos = new FormData();
        datos.append('btnRegistrarAsistencia', true);
        datos.append('ast_socio', $("#GDcliente").val());
        datos.append('ast_fecha_inicio', $("#ast_fecha_inicio").val());

        $.ajax({

            url: 'ajax/clientes.ajax.php',
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $(".btn-load-i").attr("disabled", true);
                $(".btn-load-i").html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Por favor espere...`)

            },
            success: function(res) {
                $(".btn-load-i").attr("disabled", false);
                $(".btn-load-i").html('Registrar asistencia')

                if (res) {
                    swal("¡Muy bien!", "Asistencia registrada", "success");
                    buscarSocio();
                } else {
                    swal("¡Error!", "No se pudo registrar la asistencia, intente de nuevo", "error");

                }

            }
        })



    })
</script>