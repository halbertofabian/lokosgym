
/*=============================================
crear cliente
=============================================*/
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



var select = document.getElementById('GDclienteNM');
select.addEventListener('change',
    function () {
        var selectedOption = this.options[select.selectedIndex];
        //alert(selectedOption.value + ': ' + selectedOption.text);
        if (selectedOption.value > 0) {
            $("#cntn-membresia").removeClass("d-none");
            $("#GDnombreCM").val(selectedOption.text);
            $("#GDidCliente").val(selectedOption.value);
        }
    });