 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

   <!-- Sidebar Toggle (Topbar) -->
   <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
     <i class="fa fa-bars"></i>
   </button>

   <!-- Topbar Search -->
   <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
     <div class="input-group">
       <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar producto" aria-label="Search" aria-describedby="basic-addon2">
       <div class="input-group-append">
         <button class="btn btn-primary" type="button">
           <i class="fas fa-search fa-sm"></i>
         </button>
       </div>
     </div>
   </form>
   <div class="btn-group">
   <a class="d-none d-sm-inline-block btn  btn-primary shadow-sm " href="<? $url ?>caja">
     <i class="fas fa-cash-register"></i>

   </a>

   <button  class="d-none d-sm-inline-block btn    btn-secondary shadow-sm" onclick="openFullscreen();">
   <i class="fas fa-expand"></i>

   </button>
   <button  class=" d-none d-sm-inline-block btn   btn-danger shadow-sm"  onclick="closeFullscreen();">
   <i class="fas fa-sign-out-alt"></i>

   </button>

   </div>
   

   <!-- Topbar Navbar -->
   <ul class="navbar-nav ml-auto">

     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
     <li class="nav-item dropdown no-arrow d-sm-none">
       <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-search fa-fw"></i>
       </a>
       <!-- Dropdown - Messages -->
       <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
         <form class="form-inline mr-auto w-100 navbar-search">
           <div class="input-group">
             <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar producto" aria-label="Search" aria-describedby="basic-addon2">
             <div class="input-group-append">
               <button class="btn btn-primary" type="button">
                 <i class="fas fa-search fa-sm"></i>
               </button>
             </div>
           </div>
         </form>
       </div>
     </li>

     <!-- Nav Item - Alerts -->








     <div class="topbar-divider d-none d-sm-block"></div>

     <!-- Nav Item - User Information -->
     <li class="nav-item dropdown no-arrow">
       <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></span>
         <img class="img-profile rounded-circle" src="https://scontent.fmex10-1.fna.fbcdn.net/v/t1.0-9/66502409_334518250764473_6286267005196566528_n.jpg?_nc_cat=111&_nc_oc=AQmRNYPfwUl_7gttY9-ZZFO0719r3O3Yq3nM3OPEnNfw1JMyDgOAviKjZb5CXIdS_Kg&_nc_ht=scontent.fmex10-1.fna&oh=cf5e3d6700d64eb0b02d93b123fc4aa8&oe=5DDD4B2A">
       </a>
       <!-- Dropdown - User Information -->
       <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
         <a class="dropdown-item" href="#">
           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
           Profile
         </a>
         <a class="dropdown-item" href="#">
           <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
           Settings
         </a>
         <a class="dropdown-item" href="#">
           <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
           Activity Log
         </a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
           Logout
         </a>
       </div>
     </li>

   </ul>

 </nav>
 <!-- End of Topbar -->

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de salir?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Seleccione "salir" si usted esta seguro de suspender la sesión.</div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
         <a class="btn btn-primary" href="<?php echo $url ?>salir">Salir</a>
       </div>
     </div>
   </div>
 </div>