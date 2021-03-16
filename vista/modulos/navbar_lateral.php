<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $url ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-toolbox"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Refaccionaria <sup>el güero</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo $url ?>">
            <i class="fas fa-home"></i>
            <span>Inicio</span></a>
    </li>
    <!-- Nav Item - Caja -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo $url ?>pos">
            <i class="fas fa-cash-register"></i>
            <span>POS</span></a>
    </li>
    <!-- Nav Item - Usuarios-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Usuarios" aria-expanded="true" aria-controls="Usuarios">
            <i class="fas fa-users"></i>
            <span>Usuarios</span>
        </a>
        <div id="Usuarios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo $url ?>usuarios"> <i class="fas fa-user"></i> Personal</a>
                <a class="collapse-item" href="<?php echo $url ?>clientes"><i class="fas fa-address-card"></i> Clientes</a>
                <a class="collapse-item" href="<?php echo $url ?>">
                    <i class="fas fa-user-tag"></i>
                    <span>Roles</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Inventario" aria-expanded="true" aria-controls="Inventario">
            <i class="fas fa-dolly-flatbed"></i>
            <span>Inventario</span>
        </a>
        <div id="Inventario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo $url ?>productos">
                    <i class="fab fa-product-hunt"></i>
                    <span>Productos</span></a>
                <a class="collapse-item" href="<?php echo $url ?>categorias">
                    <i class="fas fa-project-diagram"></i>
                    <span>Categorias</span></a>

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reportes" aria-expanded="true" aria-controls="Reportes">
            <i class="fas fa-file-alt"></i>
            <span>Reportes</span>
        </a>
        <div id="Reportes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo $url ?>ventas">
                    <i class="fas fa-cart-arrow-down"></i>
                    <span>Ventas</span></a>


            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Gestion" aria-expanded="true" aria-controls="Gestion">
            <i class="fas fa-tasks"></i>
            <span>Gestión</span>
        </a>
        <div id="Gestion" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo $url ?>corte">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Corte</span></a>


            </div>
        </div>
    </li>



    <!-- Nav Item - Productos -->
    <li class="nav-item">

    </li>
    <!-- Nav Item - Productos -->
    <li class="nav-item">

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->