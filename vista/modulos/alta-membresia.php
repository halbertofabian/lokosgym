
<?php

if ($_SESSION['usr_caja'] <= 0) {
    PlantillaControlador::msj('warning', 'Error', 'Necesita abrir caja para realizar está operación', $url . 'abrir-caja');
    die();
}

?>
<div class="container">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="<?php echo $url ?>">Inicio</a>
        <a class="breadcrumb-item" href="<?php echo $url . 'alta-membresia' ?>">Alta de membresia</a>
       
    </nav>
    <div class="row">
        <div class="col">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-users"></i></div>
                </div>
                <select name="GDclienteNM" class="form-control " id="GDclienteNM" required>
                    <option value="">Seleccionar cliente</option>
                    <?php $clientes = ClientesControlador::ctrMostrarCliente(null);


                    foreach ($clientes as $key => $value) :

                    ?>
                        <option value="<?php echo $value['id_cliente'] ?>"><?php echo $value['nombre_cliente'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col">
            <button id="btn-addCliente" class="btn btn-primary" name="btnaddCliente">Nuevo cliente</button>
        </div>
    </div>

    <div class="row d-none" id="cntn-cliente">
        <div class="col">
            <form id="form-ClienteNuevo" method="post">
                <div class="row">
                    <div class="col-12">
                        <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                    </div>



                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Información general
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDnombre">Nombre</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i><strong class="text-danger"> * </strong></div>
                                                </div>
                                                <input type="text" name="GDnombre" class="form-control" id="GDnombre" placeholder="Nombre" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDcorreo">Correo</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDcorreo" class="form-control" id="GDcorreo" placeholder="Correo">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <label class="" for="GDtelefono">Teléfono</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="number" name="GDtelefono" class="form-control" id="GDtelefono" placeholder="Teléfono">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="" for="GDcodigo_wsp">Código</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><strong class="text-dark"> + </strong></div>
                                                </div>
                                                <input type="number" name="GDcodigo_wsp" class="form-control" id="GDcodigo_wsp" placeholder="Código" value="52">
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="" for="GDwsp">Whatsapp</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="number" name="GDwsp" class="form-control" id="GDwsp" placeholder="Whatsapp">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Dirección
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDcalle">Calle</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDcalle" class="form-control" id="GDcalle" placeholder="Calle">
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="" for="GDnumero">Número</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDnumero" class="form-control" id="GDnumero" placeholder="Número">
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="" for="GDcp">Código postal</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDcp" class="form-control" id="GDcp" placeholder="Código postal">
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="" for="GDcolonia">Colonia</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDcolonia" class="form-control" id="GDcolonia" placeholder="Colonia">
                                            </div>

                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label class="" for="GDciudad">Ciudad</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDciudad" class="form-control" id="GDciudad" placeholder="Ciudad">
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="" for="GDestado">Estado</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDestado" class="form-control" id="GDestado" placeholder="Estado">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseT" aria-expanded="false" aria-controls="collapseTwo">
                                        Tienda
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDcredito">Crédito</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDcredito" class="form-control" id="GDcredito" placeholder="Crédito" value="0" required>
                                            </div>

                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDporcentaje">Porcentaje de descuento</label>

                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="text" name="GDporcentaje" class="form-control" id="GDporcentaje" placeholder="Porcentaje de descuento" value="0" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelarCliente" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn-crearCliente" class="btn btn-primary" name="btnGuardarCliente">Guardar cliente</button>
                </div>
                <?php
                // $cliente = new ClientesControlador();
                //$cliente->ctrAgregarCliente();
                ?>
            </form>
        </div>
    </div>

    <div class="row " id="cntn-membresia">
        <div class="col">
            <form name="form-NuevaMembresia" id="form-NuevaMembresia" method="post">
                <div class="row">
                    <div class="col-12">
                        <p>Campos obligatorios <strong class="text-danger">(*)</strong> </p>
                    </div>


                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Registro de membresia
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">

                                        <input type="hidden" name="cliente_id" id="GDidCliente">
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDnombreCM">Cliente</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i><strong class="text-danger"> * </strong></div>
                                                </div>
                                                <input type="text" name="GDnombreCM" class="form-control" id="GDnombreCM" placeholder="Nombre" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDateInicio">Fecha de Inicio</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="date" name="rmbs_fecha_inicio" class="form-control today" id="rmbs_fecha_inicio" placeholder="Inicio Membresia">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="" for="GDateTermino">Fecha de Termino</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>
                                                <input type="date" name="rmbs_fecha_termino" class="form-control" id="rmbs_fecha_termino" placeholder="Termino Membresia">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="" for="mbs_id">Tipo de Membresia</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                                                </div>

                                                <select name="mbs_id" class="form-control" id="mbs_id" required>
                                                    <option value="">Seleccione tipo de Membresia</option>
                                                    <?php $membresias = MembresiasModelo::mdlTiposMembresias();

                                                    foreach ($membresias as $key => $mbs) :

                                                    ?>
                                                        <option value="<?php echo $mbs['mbs_id'] ?>"><?php echo $mbs['mbs_tipo'] . " $ " . $mbs['mbs_costo'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancelarCliente" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn-CrearMembresia" class="btn btn-primary" name="btnRegistrarMenbresiasCliente">Guardar Membresia</button>
                </div>
                <?php
                $crearM = new MembresiasControlador();
                $crearM->ctrRegistrarMembresiaCliente();
                ?>
            </form>
        </div>
    </div>
</div>