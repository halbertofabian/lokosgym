

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