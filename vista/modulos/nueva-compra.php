<?php //var_dump($_SESSION); 
?>
<div class="container">
    <form id="form_compra" method="POST">

        <div class="row">


            <div class="form-group col-md-4 col-12">
                <label for="cps_ams_id">Almacen</label>
                <input type="text" name="cps_ams_id" id="cps_ams_id" class="form-control" value="LOKOS GYM" readonly>
            </div>



            <input type="hidden" name="cps_proveedor" id="cps_proveedor" value="1">


            <div class="form-group col-md-4 col-12">
                <label for="cps_folio">Folio</label>
                <input type="text" name="cps_folio" id="cps_folio" class="form-control" required>
            </div>
            <div class="form-group col-md-4 col-12">
                <label for="cps_fecha">Fecha de compra</label>
                <input type="date" class="form-control today" name="cps_fecha" id="cps_fecha">
            </div>
            
            
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="autocomplete_pts">Seleccionar producto</label>
                    <div class="d-flex">
                        <!-- <button class="btn btn-secondary btn-sm"><i class="fa fa-barcode"></i></button> -->
                        <input type="text" class="form-control" name="autocomplete_pts" id="autocomplete_pts" placeholder="Escriba el nombre del producto y seleccione...">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Cantidad</th>
                            <th>Precio compra</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbodyNuevaCompra">
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="cps_num_articulos" id="cps_num_articulos">
            <input type="hidden" name="cps_total" id="cps_total">
            

            <input type="hidden" name="cps_productos" id="cps_productos">

            <div class="alert alert-dark col-12 p-1" role="alert">
                <strong>TOTAL DE ARTICULOS: </strong><strong id="sumArticulos"></strong>
            </div>
            <input type="hidden" name="cps_nota" id="cps_nota">
            <!-- <div class="form-group col-12 col-md-8">
                <label for="cps_nota">Nota</label>
                <textarea class="form-control" name="cps_nota" id="cps_nota" cols="30" rows="5"></textarea>
            </div> -->
        </div>

        <div class="row">
        <div class="form-group col-md-4 col-12">
                <label for="cps_fecha">Total de la compra</label>
                <input type="text" name="cps_gran_total" id="cps_gran_total" class="form-control inputN" readonly >
            </div>

            <!-- <div class="alert alert-dark col-12 p-1" role="alert">
                <strong>Tipo de pago </strong>
            </div>

            <div class="form-group col-md-4 col-12">
                <label for="cps_tipop">Tipo de pago</label>
                <select name="cps_tipop" id="cps_tipop" class="form-control select2" required>
                    <option value="">Elija tipo de pago</option>
                    <option>CONTADO</option>
                    <option>CREDITO</option>
                </select>
            </div> -->
            <input type="hidden" name="cps_tipop" value="-">
            <input type="hidden" name="cps_mtdpago" value="-">
            <input type="hidden" name="cps_monto" value="-">

            <!-- <div class="form-group col-md-4 col-12">
                <label for="cps_mtdpago">Metodo de pago</label>
                <select name="cps_mtdpago" id="cps_mtdpago" class="form-control select2">
                    <option>EFECTIVO</option>
                    <option>DEPOSITO</option>
                    <option>TRANSFERENCIA</option>
                    <option value="TARJETA">TARJETA DE CREDITO/DEBITO</option>
                </select>

            </div> -->
            <!-- <div class="form-group col-md-4 col-12">
                <label for="cps_monto">Monto</label>
                <input type="text" name="cps_monto" id="cps_monto" class="form-control inputN">
            </div> -->

            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary float-right  " name="btnGuardarCompra" id="btnGuardarCompra">Guardar Compra</button>
            </div>
        </div>
    </form>

    <?php
    // $crearCompra = new ComprasControlador();
    // $crearCompra->ctrGuardarCompra();
    ?>

</div>