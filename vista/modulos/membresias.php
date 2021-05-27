<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="<?php echo $url ?>">Inicio</a>
        <span class="breadcrumb-item active">Lista de membresias</span>
    </nav>

    <?php

    $listaM = MembresiasModelo::mdlConsultarClientesMembresias();
    date_default_timezone_set('America/Mexico_City');
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $fecha_hoy = $fecha;

    $listActive = [];
    $listInactive = [];
    $listEndDay = [];
    foreach ($listaM as $key => $mbs) {
        if ($mbs['vigencia'] > $fecha_hoy) {
            array_push($listActive, $mbs);
        } elseif ($mbs['vigencia'] == $fecha_hoy) {
            array_push($listEndDay, $mbs);
        } else {
            array_push($listInactive, $mbs);
        }
    }


    if (isset($_GET['estado'])) {
        $status = $_GET['estado'];

        if ($status == 'Active') {
            $listaM = $listActive;
        } elseif ($status == 'Inactive') {
            $listaM = $listInactive;
        } elseif ($status == 'EndDay') {
            $listaM = $listEndDay;
        }
    }


    // echo '<pre>', print_r($listaM), "</pre>";



    ?>

    <div class="row">
        <div class="col-12">

            <table class="table " id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Vigencia</th>
                        <th>Estado</th>
                        <th>Tipo de membresia</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($listaM as $key => $mbs) :


                        $estado =  $mbs['vigencia'] < $fecha_hoy ? '<strong class="text-danger"> Vencido </strong>' : ' <strong class="text-success"> Activo </strong>';
                        $estado =  $mbs['vigencia'] == $fecha_hoy ? '<strong class="text-warning"> Termina hoy </strong>' : $estado;

                    ?>

                        <tr>
                            <td><?php echo $mbs['id_cliente'] ?></td>
                            <td><?php echo $mbs['nombre_cliente'] ?></td>
                            <td><?php echo $mbs['vigencia'] ?></td>
                            <td><?php echo $estado ?></td>
                            <td><?php echo $mbs['tipo'] ?></td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>