<?php
if (isset($rutas[1]) && $rutas[1] == 'new') :
    cargarComponente('breadcrumb', '', 'Nueva compra');
    cargarview2('compras/nueva_compra', $rutas);
?>

<?php else :
    cargarComponente('breadcrumb', '', 'Listar compras');
    cargarview2('compras/listar_compras', $rutas);
?>

<?php endif; ?>




<div class="modal fade" id="mdlProveedor" tabindex="-1" aria-labelledby="mdlProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlProveedorLabel">Nuevo proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formAddProveedor">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="pvs_nombre">Nombre del proveedor</label>
                        <input type="text" name="pvs_nombre" id="pvs_nombre" class="form-control" placeholder="Introduzca el nombre del proveedor / empresa " required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Agregar proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>