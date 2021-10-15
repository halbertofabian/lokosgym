
/**
 *  Desarrollador: ifixitmor
 *  Fecha de creación: 11/02/2021 21:19
 *  Desarrollado por: Softmor
 *  Software de Morelos SA.DE.CV 
 *  Sitio web: https://softmor.com
 *  Facebook:  https://www.facebook.com/softmor/
 *  Instagram: http://instagram.com/softmormx
 *  Twitter: https://twitter.com/softmormx
 */
$(document).ready(function () {
    $("#form_compra").keypress(function (e) {//Para deshabilitar el uso de la tecla "Enter"
        if (e.which == 13) {
            return false;
        }
    });
    $("#formAddProveedor").on("submit", function (e) {
        e.preventDefault()

        var datos = new FormData(this)

        datos.append("btnCrearProveedor", true)

        $.ajax({
            type: "POST",
            url: 'ajax/compras.ajax.php',
            data: datos,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (res) {

                if (res.status) {
                    toastr.success(res.mensaje, 'Correcto')
                    $("#pvs_nombre").val("")
                    $('#mdlProveedor').modal('hide')

                    $('#cps_proveedor option').remove();
                    listarProveedores();
                    $("#cps_proveedor option:selected").last().val()

                } else {
                    toastr.error(res.mensaje, 'Error')

                }

            }
        });
    })







    $(".tablaCompras tbody").on("click", "button.btnLiquidarCompra", function () {

        var cps_folio = $(this).attr("cps_folio")
        swal({
            title: "¿Seguro de querer liquidar esta compra?",
            text: "La compra con folio " + cps_folio + " será liquidada. ¿Deseas continuar?",
            icon: "warning",
            buttons: ["No, cancelar", "Si, liquidar la compra con folio " + cps_folio],
            dangerMode: false,
            closeOnClickOutside: false,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var datos = new FormData()
                    datos.append("btnLiquidarCompra", true)
                    datos.append("cps_folio", cps_folio)

                    $.ajax({
                        type: "POST",
                        url: 'ajax/compras.ajax.php',
                        data: datos,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        beforeSend: function () {

                        },
                        success: function (res) {

                            if (res.status) {
                                swal({
                                    title: "Muy bien",
                                    text: res.mensaje,
                                    icon: "success",
                                    buttons: [false, "Continuar"],
                                    dangerMode: true,
                                    closeOnClickOutside: false,

                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.href = res.pagina
                                        } else {
                                            location.href = res.pagina
                                        }
                                    });
                            } else {
                                swal({
                                    title: "Error",
                                    text: res.mensaje,
                                    icon: "error",
                                    buttons: [false, "Continuar"],
                                    dangerMode: true,
                                    closeOnClickOutside: false,

                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.href = res.pagina
                                        } else {
                                            location.href = res.pagina
                                        }
                                    });

                            }

                        }
                    })

                }
            })



    })

    $(".tablaCompras tbody").on("click", "button.btnEliminarCompra", function () {
        var cps_folio = $(this).attr("cps_folio");
        swal({
            title: "¿Seguro de querer eliminar esta compra?",
            text: "La compra con número " + cps_folio + " será eliminada y todo lo relacionado, es decir también los abonos realizados a esta compra. ¿Deseas continuar?",
            icon: "warning",
            buttons: ["No, cancelar", "Si, eliminar la compra con número " + cps_folio],
            dangerMode: true,
            closeOnClickOutside: false,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var datos = new FormData();
                    datos.append("cps_folio", cps_folio);
                    datos.append("btnEliminarCompra", true);

                    $.ajax({
                        type: "POST",
                        url: 'ajax/compras.ajax.php',
                        data: datos,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        beforeSend: function () {

                        },
                        success: function (res) {

                            if (res.status) {
                                swal({
                                    title: "Muy bien",
                                    text: res.mensaje,
                                    icon: "success",
                                    buttons: [false, "Continuar"],
                                    dangerMode: true,
                                    closeOnClickOutside: false,

                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.href = res.pagina
                                        } else {
                                            location.href = res.pagina
                                        }
                                    });
                            } else {
                                swal({
                                    title: "Error",
                                    text: res.mensaje,
                                    icon: "error",
                                    buttons: [false, "Continuar"],
                                    dangerMode: true,
                                    closeOnClickOutside: false,

                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            location.href = res.pagina
                                        } else {
                                            location.href = res.pagina
                                        }
                                    });
                            }
                        }
                    });
                }
            });
    })

    //cargar excel
    $(".btnImportarProductosExcel").on("click", function (e) {
        e.preventDefault()

        var excel = $("#cps_excel").val()

        if (excel == "") {
            return swal("Error", "Seleccione un archivo excel", "error");
        }

        var cps_ams_id = $("#cps_ams_id").val();

        if (cps_ams_id == "") {
            toastr.warning('Necesitas seleccionar un almacen', 'Advertencia')
            return;
        }

        swal({
            title: "¿Estas seguro de querer importar la lista de compras?",
            text: "Asegurate de tener el archivo con los requerimientos solicitados",
            icon: "info",
            buttons: ["Calcelar", "Si, importar lista"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    var datos = new FormData()

                    var files = $("#cps_excel")[0].files[0];



                    datos.append("btnImportarProductosExcel", true);
                    datos.append("archivoExcel", files);
                    datos.append("cps_ams_id", cps_ams_id);


                    $.ajax({

                        url: 'ajax/compras.ajax.php',
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {

                            $(".btnImportarProductosExcel").attr("disabled", true)
                            $(".btnImportarProductosExcel").removeClass("btn-success")
                            $(".btnImportarProductosExcel").addClass("btn-secondary")
                            $(".btnImportarProductosExcel").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span> 
                        Importando productos ...`);


                        },
                        success: function (respuesta) {
                            $(".btnImportarProductosExcel").attr("disabled", false)
                            $(".btnImportarProductosExcel").addClass("btn-success")
                            $(".btnImportarProductosExcel").removeClass("btn-secondary")
                            $(".btnImportarProductosExcel").html(`<i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        Importar productos`);

                            if (respuesta.status) {

                                swal({
                                    title: "!Muy bien¡",
                                    text: respuesta.mensaje,
                                    icon: "success",
                                    buttons: [false, "Ver lista"],
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            console.log(respuesta);
                                            var compras = respuesta.data;
                                            var tbodyCompra = "";
                                            var tbodycmpgeneral = "";
                                            $("#cps_productos").val(JSON.stringify(compras))
                                            compras.forEach(cmp => {

                                                tbodyCompra +=
                                                    `
                                            <tr>
                                                <td>${cmp.pds_nombre}</td>
                                                <td>${cmp.codigo}</td>
                                                <td>${cmp.stock}</td>
                                                <td>${cmp.pds_pu}</td>
                                                <td>${cmp.total}</td>
                                            </tr>
                                            `;
                                            });
                                            //alert(respuesta.sumaCompra)
                                            $("#tbodyNuevaCompra").html(tbodyCompra);
                                            $("#totaldecompra").text(respuesta.sumaCompra);
                                            tbodycmpgeneral =
                                                `
                                            <tr>
                                                
                                                <td>${respuesta.sumaArticulos}</td>
                                                <td><span id="span_sumacmp">${respuesta.sumaCompra}</span></td>
                                                <td><span id="span_constoenvio">0</span></td>
                                                <td><span id="span_gt">${respuesta.sumaCompra}</span></td>
                                            </tr>
                                            `;
                                            $("#tbodygeneral").html(tbodycmpgeneral);

                                            $("#cps_num_articulos").val(respuesta.sumaArticulos);
                                            $("#cps_total").val(respuesta.sumaCompra);
                                            $("#cps_gran_total").val(respuesta.sumaCompra);




                                            // window.location.href = "./compras"
                                        } else {
                                            //  window.location.href = "./compras"

                                        }
                                    })

                            } else {

                                swal({
                                    title: "Error",
                                    text: respuesta.mensaje,
                                    icon: "error",
                                    buttons: [false, "Intentar de nuevo"],
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            window.location.href = "./compras"
                                        } else {
                                            window.location.href = "./compras"

                                        }
                                    })

                            }

                        }
                    })
                }
            });
    })

    $("#form_compra").on("submit", function (e) {
        e.preventDefault()

        var datos = new FormData(this);
        datos.append("btnGuardarCompra", true);
        //alert($(this).serialize());
        // return
        $.ajax({
            type: "POST",
            url: 'ajax/compras.ajax.php',
            data: datos,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function () {
                //startLoadButton()
            },
            success: function (res) {
                0

                if (res.status) {

                    swal("Correcto", res.mensaje, "success");

                    setTimeout(function () {
                        location.href = res.pagina
                        //     window.open("app/report/reporte-compra.php?cps_id=" + res.cps_id, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=100,right=100,width=700,height=700");
                        window.open("extensiones/tcpdf/pdf/reporte-compra.php?cps_id=" + res.cps_id, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=100,right=100,width=700,height=700");

                    }, 1000);

                } else {
                    swal("Error", res.mensaje, "error");
                    // stopLoadButton('Intentar de nuevo....')

                }

            }
        });
    })




    function listarProveedores() {
        var datos = new FormData()

        datos.append("btnListarProveedores", true)

        $.ajax({
            type: "POST",
            url: 'app/modulos/proveedores/proveedores.ajax.php',
            data: datos,
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (res) {

                res.forEach(element => {

                    $('#cps_proveedor').prepend(`<option value='${element.pvs_id}' >${element.pvs_nombre}</option>`);

                });

            }
        });
    }
    ///////////////////////////////////
    var tbodyCompra = "";
    var tbodycmpgeneral = "";
    var sumaCompra = 0;
    var sumaArticulos = 0;
    var data = [];
    $("#autocomplete_pts").autocomplete({
        source: 'ajax/compras.ajax.php',
        select: function (event, ui) {
            var nomProducrto = "";
            $('#form_compra tr').each(function () {
                nomProducrto = $(this).find("td").eq(0).html();

            });

            if (nomProducrto == ui.item.label) {
                toastr.warning(`¡El producto <strong>${ui.item.label}</strong> ya fue agregado a la lista!`, 'ADVETENCIA')
                $(this).val("");
                return false;
            } else {

                tbodyCompra =
                    `
                <tr id="${ui.item.id}">
                    <td>${ui.item.label}</td>
                    <td>${ui.item.descripcion}</td>
                    <td>${ui.item.categoria}</td>
                    <td>${ui.item.codigo}</td>
                    <td class="d-flex">
                    <span class="input-group-btn">
                        <button class="btn btn-default menos" btn_menos="${ui.item.id}" type="button">-</button>
                     </span>
                    <input type="text" style="width:50px;text-align: center;" id="contador${ui.item.id}" cps_id="${ui.item.id}" class="form-control contador" value="1" min="1"/>
                  <span class="input-group-btn">
                    <button class="btn btn-default mas" btn_mas="${ui.item.id}" type="button">+</button>
                </span>
                    </td>
                    <td> <input type="text" class=" form-control precio_compra" precio_compra_id="${ui.item.id}" value="${ui.item.precio_compra}"  ></td>
                    <td> <input type="text" class=" form-control total_compra" id="totalCompra_${ui.item.id}" value="${ui.item.precio_compra}" readonly ></td>
                    <td>
                        <button type="button" class="btn btn-danger btnQuitarProducto" sku="${ui.item.id}"><i class="fa fa-trash-alt"></i></button>
                    </td>
                </tr>
                `;
                var datos = {
                    "pds_id": ui.item.id,
                    "pds_nombre": ui.item.label,
                    "codigo": ui.item.codigo,
                    "stock": 1,
                    "pds_pu": ui.item.precio_compra,
                    "total": ui.item.precio_compra * 1

                };
                if (data == "") {
                    data.push(datos);
                    $("#cps_productos").val(JSON.stringify(data));
                } else {
                    var productos = $("#cps_productos").val();
                    data = JSON.parse(productos);
                    data.push(datos);
                    $("#cps_productos").val(JSON.stringify(data));
                }

               // sumarTotales()

                sumarProductos();
                // sumaArticulos += Number(cantidad_pts);
                // $("#sumArticulos").text("1");
                $("#tbodyNuevaCompra").append(tbodyCompra);


                // $("#cps_num_articulos").val(sumaArticulos);
                $("#cps_total").val(sumaCompra);
                $("#cps_gran_total").val(sumaCompra);

                $(this).val("");
                sumarTotales()
                return false;
            }
        },
    });
    $("#tbodyNuevaCompra").on("click", ".btnQuitarProducto", function (e) {
        e.preventDefault()
        var sku = $(this).attr("sku");
        var products = $("#cps_productos").val();
        var productos = JSON.parse(products);
        for (var i = productos.length; i--;) {
            if (productos[i].pds_id === sku) {
                productos.splice(i, 1);
            }
        }

        $("#" + sku).remove();
        eliminarCantProductos(productos);

        // $("#cps_total").val(sumaCompra);
        // $("#cps_gran_total").val(sumaCompra);

        if (productos == "") {
            data = [];
        }

    })


    $("#tbodyNuevaCompra").on("keyup", ".precio_compra", function (e) {
        var id = $(this).attr("precio_compra_id");
        var precio_compra_actual = $(this).val();
        // $("#contador" + id).val(Number($("#contador" + id).val()) + 1);
        // sumarProductos2();
        
        var products = $("#cps_productos").val();
        var productos = JSON.parse(products);
        for (var i = productos.length; i--;) {
            if (productos[i].pds_id == id) {

                productos[i].stock = Number($("#contador" + id).val());
                productos[i].pds_pu = Number(precio_compra_actual);
                productos[i].total = Number($("#contador" + id).val()) * Number(precio_compra_actual);

                $("#totalCompra_"+ id).val(productos[i].total)
            }
        }
        $("#cps_productos").val(JSON.stringify(productos));
        sumarTotales()

    });

    $("#tbodyNuevaCompra").on("click", ".mas", function (e) {
        var id = $(this).attr("btn_mas");
        $("#contador" + id).val(Number($("#contador" + id).val()) + 1);
        sumarProductos2();
        
        var products = $("#cps_productos").val();
        var productos = JSON.parse(products);
        for (var i = productos.length; i--;) {
            if (productos[i].pds_id == id) {
                productos[i].stock = Number($("#contador" + id).val());
                productos[i].total = Number($("#contador" + id).val()) * productos[i].pds_pu ;

                $("#totalCompra_"+ id).val(productos[i].total)
            }
        }
        $("#cps_productos").val(JSON.stringify(productos));
        sumarTotales()

    });

    $("#tbodyNuevaCompra").on("click", ".menos", function (e) {
        var id = $(this).attr("btn_menos");
        $("#contador" + id).val(Number($("#contador" + id).val()) - 1);
        if ($("#contador" + id).val() == "0") {
            $("#contador" + id).val("1");
        }
        sumarProductos2();

        var products = $("#cps_productos").val();
        var productos = JSON.parse(products);
        for (var i = productos.length; i--;) {
            if (productos[i].pds_id == id) {
                productos[i].stock = Number($("#contador" + id).val());
                productos[i].total = Number($("#contador" + id).val()) * productos[i].pds_pu ;
                $("#totalCompra_"+ id).val(productos[i].total)
            }
        }
        $("#cps_productos").val(JSON.stringify(productos));
        sumarTotales()
    });

    $("#tbodyNuevaCompra").on("keyup", ".contador", function (e) {
        var contador = $(this).val();
        var id = $(this).attr("cps_id");
        if (contador === "") {
            return;
        } else {
            sumarProductos2();
            var products = $("#cps_productos").val();
            var productos = JSON.parse(products);
            for (var i = productos.length; i--;) {
                if (productos[i].pds_id == id) {
                    productos[i].stock = contador;
                    productos[i].total = contador * productos[i].pds_pu ;
                    $("#totalCompra_"+ id).val(productos[i].total)
                }
            }
            $("#cps_productos").val(JSON.stringify(productos));
            sumarTotales()
        }
    });


    function sumarProductos() {
        var add = 1;
        $('.contador').each(function () {
            if (!isNaN($(this).val())) {
                add += Number($(this).val());
            }
        });
        $('#sumArticulos').text(add);
        $("#cps_num_articulos").val(add);
    }
    function sumarProductos2() {
        var add = 0;
        $('.contador').each(function () {
            if (!isNaN($(this).val())) {
                add += Number($(this).val());
            }
        });
        $('#sumArticulos').text(add);
        $("#cps_num_articulos").val(add);
    }

    function sumarTotales() {
        var add = 0;
        $('.total_compra').each(function () {
            if (!isNaN($(this).val())) {
                add += Number($(this).val());
            }
        });
        // $('#sumArticulos').text(add);
        $("#cps_gran_total").val(add);
    }
    function eliminarCantProductos(productos) {
        var add = 0;
        $('.contador').each(function () {
            if (!isNaN($(this).val())) {
                add += Number($(this).val());
            }
        });
        var total = 0;
        $('.total_compra').each(function () {
            if (!isNaN($(this).val())) {
                total += Number($(this).val());
            }
        });
        // $('#sumArticulos').text(total);
        $("#cps_gran_total").val(total);

        $('#sumArticulos').text(add);
        $("#cps_num_articulos").val(add);
        $("#cps_productos").val(JSON.stringify(productos));

        

        // sumarTotales()
    }

    $("#tbodylistarcompras").on("click", "button.btnImprimirReporte", function () {
        var cps_id = $(this).attr("cps_id");
        window.open("extensiones/tcpdf/pdf/reporte-compra.php?cps_id=" + cps_id, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=100,right=100,width=700,height=700");

    });


});