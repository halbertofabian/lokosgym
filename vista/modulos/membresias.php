<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="<?php echo $url ?>">Inicio</a>
        <span class="breadcrumb-item active">Lista de membresias</span>
    </nav>

    <?php

    $listaM = MembresiasModelo::mdlMostrarTodasMembresiaCliente();

    // echo '<pre>', print_r($listaM), "</pre>";



    ?>

    <div class="row">
        <div class="col-12">

            <table class="table " id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Fecha inicio</th>
                        <th>Fecha termino</th>
                        <th>Estado</th>
                        <th>Tipo de membresia</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($listaM as $key => $mbs) :
                        date_default_timezone_set('America/Mexico_City');
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $fecha_hoy = $fecha;

                        $estado =  $mbs['rmbs_fecha_termino'] < $fecha_hoy ? '<strong class="text-danger"> Inactivo </strong>' : ' <strong class="text-success"> Activo </strong>';
                        $estado =  $mbs['rmbs_fecha_termino'] == $fecha_hoy ? '<strong class="text-warning"> Termina hoy </strong>' : $estado;
                        
                    ?>

                        <tr>
                            <td><?php echo $mbs['rmbs_id'] ?></td>
                            <td><?php echo $mbs['nombre_cliente'] ?></td>
                            <td><?php echo $mbs['rmbs_fecha_inicio'] ?></td>
                            <td><?php echo $mbs['rmbs_fecha_termino'] ?></td>
                            <td><?php echo $estado ?></td>
                            <td><?php echo $mbs['mbs_tipo'] ?></td>
                            <td><?php echo $mbs['rmbs_costo_renovacion'] ?></td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>