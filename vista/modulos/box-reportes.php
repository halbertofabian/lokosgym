<?php
$ventas = VentasControlador::ctrMostrarSumVentas();
$productos = ProductosControlador::ctrMostrarSumProductos();

$detallesVenta = VentasModelo::mdlMostrarSumarCompras2();



// echo "<pre>", print_r($detallesVenta), "</pre>";
$totalInventario = 0;

foreach ($detallesVenta as  $val) {
  $totalInventario += $val['existencia'] * $val['precio_compra'];
}

echo number_format($totalInventario);
?>
<!-- Content Row -->
<div class="row">



  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TOTAL Ventas brutas</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo number_format($ventas['total'], 2); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total de compras (Activos)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo number_format($totalInventario, 2); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL Ventas netas (Ventas brutas - compras)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo number_format($ventas['total'] - $totalInventario, 2); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Productos (Existencias)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo $productos['total']; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dolly-flatbed fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-12">
    <button type="button" id="daterange-btn-home" class="d-none d-sm-inline-block btn btn-default   mr-sm-2 shadow-sm  float-right mb-4">
      <span>
        <i class="fa fa-calendar"></i> Rango de fecha
      </span>
      <i class="fa fa-caret-down"></i>
    </button>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio compra</th>
          <th>Precio venta - Descuento</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Descuento</th>

          <th>Ganancias (Total de ventas - Total de compra)</th>

          <th>Fecha</th>

        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Producto</th>
          <th>Precio compra</th>
          <th>Precio venta - Descuento</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Descuento</th>


          <th>Ganancias (Total de ventas - Total de compra)</th>
          <th>Fecha</th>


        </tr>
      </tfoot>
      <tbody>
        <?php
        //Productos

        $dateStart = null;
        $dateEnd = null;
        if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {
          $dateStart = $_GET['fechaInicial'];
          $dateEnd = $_GET['fechaFinal'];
        } else {
          date_default_timezone_set('America/Mexico_City');

          $fecha = date('Y-m-d');
          $dateStart = $fecha;
          $dateEnd = $fecha;
        }
        $ventas = VentasControlador::ctrMostrarVentasRangoFachasHome($dateStart, $dateEnd);

        // var_dump($ventas);

        $totalventas = 0;
        $totalCompraVentas = 0;

        foreach ($ventas as $key => $value) :
          $totalV = $value['precio'] - ($value['precio'] * $value['descuento'] / 100);

          $totalventas += $totalV * $value['cantidad'];
          $totalCompraVentas  +=   $totalV * $value['cantidad'] - $value['precio_compra'] * $value['cantidad'];

        ?>
          <tr>


            <td><?php echo $value['producto'] ?></td>
            <td><?php echo $value['precio_compra'] ?></td>
            <td><?php echo $value['precio'] . " -  " . $value['descuento'] . "% = ";
                echo $totalV = $value['precio'] - ($value['precio'] * $value['descuento'] / 100) ?></td>
            <td><?php echo $value['cantidad'] ?></td>
            <td><?php echo "<strong class='text-success'>" .  $totalV * $value['cantidad'] . "</strong>"  ?></td>
            <td><?php echo $value['descuento'] ?></td>


            <td><?php echo "<strong class='text-danger'>";
                echo  $totalV * $value['cantidad'] - $value['precio_compra'] * $value['cantidad'] . "</strong>"    ?></td>
            <td><?php echo $value['fecha'] ?></td>



          </tr>
        <?php endforeach; ?>



      </tbody>
    </table>



  </div>
</div>

<div class="row">

  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas brutas <?php echo "<strong class='text-dark'>";
                                                                                                  echo  !isset($_GET['fechaInicial']) ? "HOY </strong>" : $_GET['fechaInicial'] . " A " . $_GET['fechaFinal'] . "</strong>"  ?> </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo number_format($totalventas, 2); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ventas netas (Ganancia) <?php echo "<strong class='text-dark'>";
                                                                                                          echo  !isset($_GET['fechaInicial']) ? "HOY </strong>" : $_GET['fechaInicial'] . " A " . $_GET['fechaFinal'] . "</strong>"  ?> </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo number_format($totalCompraVentas, 2); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>