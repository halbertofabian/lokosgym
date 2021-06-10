

$("#btnImportarCliente").on("click", function (e) {
    e.preventDefault()

    var excel = $("#cts_excel").val()

    if (excel == "") {
        return swal("Error", "Seleccione un archivo excel", "error");
    }





    swal({
        title: "¿Estas seguro de querer importar la lista de clientes?",
        text: "Asegurate de tener el archivo con los requerimientos solicitados",
        icon: "info",
        buttons: ["Calcelar", "Si, importar lista"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                var datos = new FormData()

                var files = $("#cts_excel")[0].files[0];



                datos.append("btnImportarCliente", true);
                datos.append("archivoExcel", files);


                $.ajax({

                    url: 'ajax/clientes.ajax.php',
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {

                        $("#btnImportarCliente").attr("disabled", true)
                        $("#btnImportarCliente").removeClass("btn-success")
                        $("#btnImportarCliente").addClass("btn-secondary")
                        $("#btnImportarCliente").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span> 
                        Importando productos ...`);


                    },
                    success: function (res) {
                        $("#btnImportarCliente").attr("disabled", false)
                        $("#btnImportarCliente").addClass("btn-success")
                        $("#btnImportarCliente").removeClass("btn-secondary")
                        $("#btnImportarCliente").html(`<i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        Importar productos`);

                        if (res.status) {

                            swal({
                                title: "Importación exitosa",
                                text: res.mensaje + "\n Nuevos: " + res.insert + "\n Actualizar: " + res.update,
                                icon: "success",
                                buttons: [false, "Contunuar"],
                                dangerMode: false,
                                closeOnClickOutside: false,
                            })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        window.location.reload();
                                    }
                                })

                        } else {
                            swal({
                                title: "Error",
                                text: res.mensaje,
                                icon: "error",
                                buttons: [false, "Intentar de nuevo"],
                                dangerMode: false,
                                closeOnClickOutside: false,
                            })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        window.location.reload();
                                    }
                                })
                        }


                    }
                })
            }
        });
})



//FOTO DE CLIENTE
var localstream, canvas, video, cxt;

function turnOnCamera() {
    canvas = document.getElementById("canvas");
    cxt = canvas.getContext("2d");
    video = document.getElementById("video");

    if (!navigator.getUserMedia)
        navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;
    if (!window.URL)
        window.URL = window.webkitURL;

    if (navigator.getUserMedia) {
        navigator.getUserMedia({
            "video": true, "audio": false
        }, function (stream) {
            try {
                localstream = stream;
                video.srcObject = stream;
                video.play();
            } catch (error) {
                video.srcObject = null;
            }
        }, function (err) {
            swal("Error", err, "error");
        });
    } else {
        swal("Mensaje", "User Media No Disponible", "error");
        return;
    }
}

function turnOffCamera() {
    video.pause();
    video.srcObject = null;
    localstream.getTracks()[0].stop();
}

$("#tfoto").click(function () {
    //$("#img-default").addClass("d-none");
    $("#video").removeClass("d-none");
    $("#tfoto").addClass("d-none");
    $("#cancelarfoto").removeClass("d-none");
    $("#actualizarft").removeClass("d-none");
    turnOnCamera();
});

$("#cancelarfoto").click(function () {
    $("#img-default").removeClass("d-none");
    $("#video").addClass("d-none");
    $("#cancelarfoto").addClass("d-none");
    $("#tfoto").removeClass("d-none");
    $("#actualizarft").addClass("d-none");
    turnOffCamera();
    var data = canvas.toDataURL("image/jpeg");
    var info = data.split(",", 2);
    if (data != "") {
        $("#img-default").addClass("d-none");
    } else {
        $("#canvas").addClass("d-none");
    }

});

/**GUardar foto */
$("#actualizarft").on("click", function () {

    //$("#canvas").removeClass("d-none");

    usrid = $("#id_cliente").text();

    cxt.drawImage(video, 0, 0, 490, 370);
    var data = canvas.toDataURL("image/jpeg");
    var info = data.split(",", 2);

    var datos = new FormData();
    datos.append("id", usrid);
    datos.append("foto", info[1]);
    datos.append("btnactulizarfoto", true);
    $.ajax({
        url: 'ajax/clientes.ajax.php',
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        beforeSend: function () {
        },
        success: function (res) {
            if (res == 'act') {
                swal({
                    title: "Muy bien",
                    text: "Se actualizo foto del cliente",
                    icon: "success",
                    buttons: [false, "OK"],
                    dangerMode: false,
                    closeOnClickOutside: false,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.reload();
                        }
                    })
            } else {

            }
        }
    })

})

$(".table tbody").on("click", ".btn-elimina-cliente", function () {
    var clicked = this;
    var id = $(this).attr("id");

    swal({
        title: "Esta seguro de eliminar cliente?",
        text: "Esta accion no es reversible",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append("id_cliente", id)
                datos.append("btn-elimina-cliente", true)

                $.ajax({
                    url: "ajax/clientes.ajax.php",
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
                            swal("¡Bien!", "Se elimino el cliente :)", "success");

                        } else {
                            swal("¡Error!", "No se puedo eliminar el cliente", "error");
                        }
                    }
                })
            } else {

            }
        });

})