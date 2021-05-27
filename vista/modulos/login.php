<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">

                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenido (a)</h1>
                                    <h6>Inicia sesión para poder acceder al panel</h6>
                                </div>
                                <form class="user" method="post" action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="SESIONval" name="SESIONval" aria-describedby="emailHelp" placeholder="Usuario / Correo / Telefono">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="SESIONpass" name="SESIONpass" placeholder="Contraseña">
                                    </div>


                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Entrar" name="btnIniciarSesion">
                                    <?php $sesion = new UsuariosControlador();
                                    $sesion->ctrIniciarSesion(); ?>
                                    
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>