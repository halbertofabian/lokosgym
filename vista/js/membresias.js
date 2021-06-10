
/*=============================================
crear cliente
=============================================*/
$(document).ready(function () {
    var pmbs_fecha_inicio = $("#pmbs_fecha_inicio").val();
    var pmbs_fecha_fin = $("#pmbs_fecha_fin").val();
    var pmbs_mp = $("#pmbs_mp").val();

    var pmbs_vendedor = $("#pmbs_vendedor").val()
    buscarPagosFiltro(
        [
            pmbs_fecha_inicio,
            pmbs_fecha_fin,
            pmbs_mp,
            pmbs_vendedor
        ]);
})


$("#btn-crearCliente").on("click", function () {

    var datos = $('#form-ClienteNuevo').serialize();
    // alert(datos);
    //return false;

    $.ajax({
        type: "POST",
        url: "ajax/membresias.ajax.php",
        data: datos,

        dataType: "json",
        success: function (respuesta) {

            if (respuesta.status) {
                $("#cntn-membresia").removeClass("d-none");
                $("#cntn-cliente").addClass("d-none");
                buscarUltimoCliente();
                swal({
                    title: "Bien hecho",
                    text: respuesta.mensaje,
                    type: "success",
                    confirmButtonText: "¡Cerrar!"
                });



            } else {
                swal({
                    title: "Error",
                    text: respuesta.mensaje,
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });
            }



        }

    });
    return false;
});


$("#btn-addCliente").on('click', function () {
    $("#cntn-cliente").removeClass("d-none")
    $("#cntn-membresia").addClass("d-none");
})


$("#btn-cancelarCliente").on('click', function () {
    $("#cntn-cliente").addClass("d-none")
})


//***  */



function buscarUltimoCliente() {

    var datos = new FormData();
    datos.append("btnBuscarUltimoCliente", true)
    $.ajax({
        url: "ajax/membresias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (res) {
            $("#GDnombreCM").val(res.nombre_cliente);
            $("#GDidCliente").val(res.id_cliente);
        }
    })


}


$("#pmbs_mp").on("change", function () {
    if ($(this).val() != "EFECTIVO") {
        $("#pmbs_ref_ctn").removeClass("d-none")
    } else {
        $("#pmbs_ref_ctn").addClass("d-none")

    }
})

$("#pmbs_rmbs").on("change", function () {
    var rmbs_id = $(this).val();
    var datos = new FormData();
    datos.append("rmbs_id", rmbs_id)
    datos.append("btnConsultarMembresiaCliente", true);
    $.ajax({
        url: "ajax/membresias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (res) {
            $("#pmbs_monto").val(res.rmbs_costo_renovacion);
            $("#rmbs_fecha_termino").val(res.rmbs_fecha_termino);
        }
    })

})




$("#btnBuscarPagosFiltro").on("click", function () {




    var pmbs_fecha_inicio = $("#pmbs_fecha_inicio").val();
    var pmbs_fecha_fin = $("#pmbs_fecha_fin").val();
    var pmbs_mp = $("#pmbs_mp").val();

    var pmbs_vendedor = $("#pmbs_vendedor").val()

    buscarPagosFiltro(
        [
            pmbs_fecha_inicio,
            pmbs_fecha_fin,
            pmbs_mp,
            pmbs_vendedor
        ]);

})


function buscarPagosFiltro(arrayDatos) {
    var datos = new FormData();
    datos.append("pmbs_fecha_inicio", arrayDatos[0])
    datos.append("pmbs_fecha_fin", arrayDatos[1])
    datos.append("pmbs_mp", arrayDatos[2])
    datos.append("pmbs_vendedor", arrayDatos[3])
    datos.append("btnBuscarPagosFiltro", true)

    $.ajax({
        url: "ajax/membresias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            startLoadButton();
        },
        success: function (res) {

            stopLoadButton("Buscar");

            var contenido = "";
            var ventastotal = 0;

            res.forEach(pgs => {

                ventastotal += Number(pgs.pmbs_monto);

                contenido +=
                    `  
                
                <tr>
                
                    <td>${pgs.pmbs_id}</td>
                    <td>${pgs.nombre}</td>
                    <td>${pgs.pmbs_mp}</td>
                    <td>${pgs.pmbs_monto}</td>
                    <td>${pgs.pmbs_fecha_pago}</td>
                    <td>
                        <a target="_blank" href="./extensiones/tcpdf/pdf/pagos.php?pmbs_id=${pgs.pmbs_id}" class="btn btn-dafault"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <td><button class="btn btn-danger btn-elimina-pago" id="${pgs.pmbs_id}"><i class="fas fa-trash"></i></button></td>
                    </td>
                
                </tr>
                
                `;

            });

            $("#PagosBody").html(contenido);
            $("#pmbs_total").html($.number(ventastotal, 2));

            $("#btnExportarPagos").attr("href", "export/exportar-pagos.php?pmbs_fecha_inicio=" + arrayDatos[0] + "&pmbs_fecha_fin=" + arrayDatos[1] + "&pmbs_mp=" + arrayDatos[2] + "&pmbs_vendedor=" + arrayDatos[3])

        }
    })

}

$("#formRenovar").on("submit", function (e) {
    e.preventDefault();

    var data = new FormData();

    data.append("mbs_cts_nombre", $("#mbs_cts_nombre").val())
    data.append("mbs_cts_id", $("#mbs_cts_id").val())
    data.append("btnBuscarCliente", true)

    $.ajax({
        url: "ajax/membresias.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
            startLoadButton();
        },
        success: function (res) {

            console.log(res);

            var tbody = "";
            res.forEach(data => {

                console.log(data);

                data.data.forEach(cts => {
                    tbody +=

                        `
                    <tr>
                        <td>${cts.id_cliente}</td>
                        <td>${cts.nombre_cliente}</td>
                        <td>${cts.telefono_cliente}</td>
                        <td>${cts.observaciones}</td>
                        <td>${data.estado}</td>
                        <td>${cts.vigencia}</td>
                        <td>${cts.tipo}</td>
                
                    </tr>
                
                `;

                    $("#tbodyClientesM").html(tbody)
                });



            });
        }
    })

})

// var select = document.getElementById('GDclienteNM');
// select.addEventListener('change',
//     function () {
//         var selectedOption = this.options[select.selectedIndex];
//         //alert(selectedOption.value + ': ' + selectedOption.text);
//         if (selectedOption.value > 0) {
//             $("#cntn-membresia").removeClass("d-none");
//             $("#GDnombreCM").val(selectedOption.text);
//             $("#GDidCliente").val(selectedOption.value);
//         }
//     });
$(".table tbody").on("click", ".btn-elimina-pago", function () {
    var clicked = this;
    var id = $(this).attr("id");
    swal({
        title: "Esta seguro de hacer esta accion?",
        text: "Esta accion no es reversible",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append("pmbs_id", id)
                datos.append("btn-elimina-pago", true)

                $.ajax({
                    url: "ajax/membresias.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function (res) {
                        if (res) {
                            $(clicked).closest('tr').remove();
                            swal("¡Bien!", "Se elimino el registro :)", "success");

                        } else {
                            swal("¡Error!", "No se puedo eliminar el registro", "error");
                        }
                    }
                })

            } else {

            }
        });

})

$("#select-socio").on("change", function () {
    
    var id = $(this).val();
    var datos = new FormData();
    datos.append("id_cliente", id)
    datos.append("btn-inf-membresia", true);
    $.ajax({
        url: "ajax/membresias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (res) {
            if(res){
               $("#pmbs_tipo").val(res.tipo);
               $("#fecha_registro").val(res.fecha_registro);
               $("#rmbs_fecha_termino").val(res.vigencia);

            }
           
        }
    })

})