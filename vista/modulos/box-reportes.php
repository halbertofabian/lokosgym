
<?php 
    $ventas = VentasControlador::ctrMostrarSumVentas(); 
    $productos = ProductosControlador::ctrMostrarSumProductos();

?>
<!-- Content Row -->
<div class="row">



<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ingreso (Corte)</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php  echo $ventas['total']; ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
  <div class="card border-left-danger shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Productos (Existencias)</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php  echo $productos['total']; ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-dolly-flatbed fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


</div>