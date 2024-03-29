// VARIABLE LOCAL STORAGE 

$(document).ready(function () {
    var vts_fecha_inicio = $("#vts_fecha_inicio").val();
    var vts_fecha_fin = $("#vts_fecha_fin").val();
    var vts_mp = $("#vts_mp").val();

    var vts_vendedor = $("#vts_vendedor").val();
    buscarVentasFiltro(
        [
            vts_fecha_inicio,
            vts_fecha_fin,
            vts_mp,
            vts_vendedor
        ]);
})

if (localStorage.getItem("capturarRango") != null) {
    $("#daterange-btn span").html(localStorage.getItem("capturarRango"))

} else {
    $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}
if (localStorage.getItem("capturarRangoHome") != null) {
    $("#daterange-btn-home span").html(localStorage.getItem("capturarRangoHome"))

} else {
    $("#daterange-btn-home span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$(buscar_datos(""));

var porcentaje = 0;

$("#GDcliente").on("change", function () {


    var datos = new FormData();
    datos.append("idCliente", $(this).val());

    $.ajax({
        url: 'ajax/clientes.ajax.php',
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",

    })
        .done(function (respuesta) {

            console.log(respuesta);

            $("#nuevoImpuestoVenta").val(respuesta['porcentaje_cliente']);
            $("#GDcredito").val(respuesta['credito_cliente'])
            creditoTotal = respuesta['porcentaje_cliente'];
            agregarImpuesto()

        })
        .fail(function () {
            console.log('error');
        })

})


function buscar_datos(consulta, categoria = "") {

    var datos = new FormData();
    datos.append("consulta", consulta);
    datos.append("categoria", categoria);


    $.ajax({
        url: 'ajax/ventas.ajax.php',
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "html",

    })
        .done(function (respuesta) {
            // console.log(respuesta);
            $("#datos").html(respuesta);
        })
        .fail(function () {
            console.log('error');
        })
}

$(document).on('change', '#box-search', function () {
    var valor = $(this).val();
    if (valor != "") {
        buscar_datos(valor)
    } else {
        buscar_datos("");
    }



})
$(document).on('keyup', '#box-searchAll', function () {
    var valor = $(this).val();
    if (valor != "") {
        buscar_datos(valor)
    } else {
        buscar_datos("");
    }



})
$(document).on('change', '#GDcategoriaSearch', function () {
    var valor = $(this).val();

    if (valor != "") {
        buscar_datos("", valor)
    } else {
        buscar_datos("");
    }


})
$(document).on('submit', '#formularioBusqueda', function (e) {

    // var audio = document.getElementById("audio");

    // audio.play();


    e.preventDefault();

    var codigo_barra = $('#box-search').val();



    var datos = new FormData();
    datos.append("idBarras", codigo_barra);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var idProducto = respuesta[0];
            var descripcion = respuesta['caracteristicas_producto'];
            var stock = respuesta['existencia'];
            var precio = respuesta['precio_publico'];



            if (idProducto == undefined) {
                swal("¡Error!", "No existe el producto en el inventario", "error");
                $('#box-search').val("");
                return;

            }

            if (stock == 0) {

                swal("¡Error!", "No hay stock disponible", "error");

                $("button[idProducto='" + idProducto + "']").addClass("btn-info btnAgregarProducto");
                $('#box-search').val("");
                return;

            }

            //var Item = $(".hideID");


            var Item = $(".hideID");

            var arrayItem = [];

            for (var i = 0; i < Item.length; i++) {

                // console.log($(Item[i]).val());
                arrayItem.push($(Item[i]).val());


            }
            //25-2171-001
            //09-7004-010
            //20-5161-001
            //25-4094-001
            var coincidencia = false;

            // var cantidad = document.getElementById(idProducto).value;
            var cantidad = $('#' + idProducto).val();

            if (cantidad == stock) {
                swal("¡Error!", "No hay stock disponible", "error");
                $('#box-search').val("");
                return;
            }

            arrayItem.forEach(element => {
                if (element == idProducto) {
                    //console.log("Igual")
                    // Sumar cantidad
                    cantidad++;


                    // Cantidad actual del producto
                    var nuevoStock = Number($('#' + idProducto).attr("stock")) - cantidad;
                    console.log(nuevoStock);
                    $('#' + idProducto).attr("nuevoStock", nuevoStock);


                    // var precio = precio

                    //if()

                    // Calcular el precio total
                    var precioFinal = Number(precio) * Number(cantidad);
                    console.log(precioFinal)

                    // Agregar precio total
                    document.getElementById("C" + idProducto).value = precioFinal;
                    // $('#C' + idProducto).val(precioFinal)



                    // Agregar cantidad al componente
                    document.getElementById(idProducto).value = cantidad;
                    //$('#C' + idProducto).val(cantidad)
                    //var p = document.getElementById("C" + idProducto).value;






                    sumarTotalPrecios()

                    agregarImpuesto();

                    listarProductos();

                    $(".nuevoPrecioProducto").number(true, 2);
                    $("#nuevoTotalVenta").number(true, 2);
                    $('#box-search').val("");





                    coincidencia = true;

                }
            });

            if (coincidencia) {
                return;
            }

            /* var cantidad = $(".nuevaCantidadProducto");
 
             var precio = $(".nuevoPrecioProducto");
 
             for (var i = 0; i < descripcion.length; i++) {
                 $(descripcion[i]).attr("idProducto")
             }*/
            $(".nuevoProducto").append(`
            
            <!-- Descripción del producto -->
            <div class="row" style="padding:5px 10px">
            <div class="col-md-6" style="padding-right:0px">

                <div class="input-group">

                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="${idProducto}" ><i class="fa fa-times"></i></button></span>

                    <input type="text" class="form-control nuevaDescripcionProducto" idProducto="${idProducto}" id="agregarProducto" name="agregarProducto" readonly required value="${descripcion}">
                    <input type="hidden" class="form-control hideID"  readonly required value="${idProducto}">
                </div>

            </div>

            <!-- Cantidad del producto -->

            <div class="col-md-3">
 
                <input type="number" class="form-control nuevaCantidadProducto" id="${idProducto}" name="nuevaCantidadProducto" min="1"  stock="${stock}" value="1" nuevoStock="${Number(stock - 1)}" required>

            </div>

            <!-- Precio del producto -->

            <div class="col-md-3 ingresoPrecio" style="padding-left:0px">

                <div class="input-group">

                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                    <input type="text"  class="form-control nuevoPrecioProducto " id="C${idProducto}" name="nuevoPrecioProducto" precioReal="${precio}" readonly required value ="${precio}">

                </div>

            </div>
            </div>
         
            
            `);
            sumarTotalPrecios()

            agregarImpuesto();

            listarProductos();

            $(".nuevoPrecioProducto").number(true, 2);
            $("#nuevoTotalVenta").number(true, 2);
            $("#nuevoTotalVentaSin").number(true, 2);
            $('#box-search').val("");
        }

    })




})



$("#datos").on("click", "button.btnAgregarProducto", function () {


    var idProducto = $(this).attr("idProducto");
    //console.log(idProducto);

    $(this).removeClass("btn-info btnAgregarProducto");
    $(this).addClass("btn-default");


    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {


            var descripcion = respuesta['producto'];
            var stock = respuesta['existencia'];
            var precio = respuesta['precio_publico'];




            /*=============================================
                EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
                =============================================*/

            if (stock == 0) {

                swal("¡Error!", "No hay stock disponible", "error");

                $("button[idProducto='" + idProducto + "']").addClass("btn-info btnAgregarProducto");

                return;

            }

            $(".nuevoProducto").append(`
            
            <!-- Descripción del producto -->
            <div class="row" style="padding:5px 10px">
            <div class="col-md-6" style="padding-right:0px">

                <div class="input-group">

                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="${idProducto}" ><i class="fa fa-times"></i></button></span>

                    <input type="text" class="form-control nuevaDescripcionProducto" idProducto="${idProducto}" id="agregarProducto" name="agregarProducto" readonly required value="${descripcion}">

                </div>

            </div>

            <!-- Cantidad del producto -->

            <div class="col-md-3">
 
                <input type="number" class="form-control nuevaCantidadProducto" id="${idProducto}" name="nuevaCantidadProducto" min="1"  stock="${stock}" value="1" nuevoStock="${Number(stock - 1)}" required>

            </div>

            <!-- Precio del producto -->

            <div class="col-md-3 ingresoPrecio" style="padding-left:0px">

                <div class="input-group">

                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                    <input type="text"  class="form-control nuevoPrecioProducto " id="C${idProducto}" name="nuevoPrecioProducto" precioReal="${precio}" readonly required value ="${precio}">

                </div>

            </div>
            </div>
         
            
            `);
            sumarTotalPrecios()

            agregarImpuesto();

            listarProductos();

            $(".nuevoPrecioProducto").number(true, 2);
            $("#nuevoTotalVenta").number(true, 2);
            $("#nuevoTotalVentaSin").number(true, 2);

            var audio = document.getElementById("audio");
            audio.play();

        }
    })

})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function () {

    console.log()
    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');

    $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-info btnAgregarProducto');


    /* $(this).parent().parent().parent().parent().remove();
 
    
 
     /*=============================================
     ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
     =============================================*/

    /* if (localStorage.getItem("quitarProducto") == null) {
 
         idQuitarProducto = [];
 
     } else {
 
         idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
 
     }
 
     idQuitarProducto.push({ "idProducto": idProducto });
 
     localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
 
     $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-default');
 
     $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-primary agregarProducto');
 */
    if ($(".nuevoProducto").children().length == 0) {

        $("#nuevoImpuestoVenta").val(0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);
        $("#nuevoTotalVentaSin").val(0);
        //$("#GDcliente > option[value='General']").attr("selected", true)

        $("#GDcredito").val("")
        $("#nuevoCambioEfectivo").val(0)
        $("#nuevoValorEfectivo").val(0)
        $("#nuevoMetodoPago").val("Efectivo")
    } else {

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

    }

})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {


    var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);

    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if (Number($(this).val()) > Number($(this).attr("stock"))) {

        /*=============================================
        SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
        =============================================*/

        $(this).val(1);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        var precioFinal = $(this).val() * precio.attr("precioReal");

        precio.val(precioFinal);

        sumarTotalPrecios();


        swal("La cantidad supera al stock", "sólo hay" + $(this).attr("stock") + " unidades!", "error");

        return;

    }

    // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios()

    // AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})


/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios() {

    var precioItem = $(".nuevoPrecioProducto");

    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {

        arraySumaPrecio.push(Number($(precioItem[i]).val()));


    }

    // console.log("arraySumaPrecio",arraySumaPrecio);

    function sumaArrayPrecios(total, numero) {

        return total + numero;

    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    // console.log(sumaTotalPrecio);

    $("#nuevoTotalVenta").val(sumaTotalPrecio);
    $("#totalVenta").val(sumaTotalPrecio);
    $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);


}
/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto() {

    var impuesto = $("#nuevoImpuestoVenta").val();
    var precioTotal = $("#nuevoTotalVenta").attr("total");

    var precioImpuesto = Number(precioTotal * impuesto / 100);

    var totalConImpuesto = Number(precioTotal) - Number(precioImpuesto);

    $("#nuevoTotalVenta").val(totalConImpuesto);

    $("#totalVenta").val(totalConImpuesto);

    $("#nuevoPrecioImpuesto").val(precioImpuesto);

    $("#nuevoPrecioNeto").val(precioTotal);
    $("#nuevoTotalVentaSin").val(precioTotal);


}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").keyup(function () {

    agregarImpuesto();

});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

//$("#nuevoTotalVenta").number(true, 2);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function () {

    var metodo = $(this).val();
    console.log(metodo);
    if (metodo == "Efectivo") {

        $(this).parent().parent().removeClass("col-md-6");

        $(this).parent().parent().addClass("col-md-4");

        $(this).parent().parent().parent().parent().children(".cajasMetodoPago").html(

            '<div class="col-md-6">' +

            '<div class="input-group">' +

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

            '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" name="nuevoValorEfectivo" required>' +

            '</div>' +

            '</div>' +

            '<div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">' +

            '<div class="input-group">' +

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

            '<input type="text" class="form-control" id="nuevoCambioEfectivo"  placeholder="000000" readonly required>' +

            '</div>' +

            '</div>'

        )

        // Agregar formato al precio

        $('#nuevoValorEfectivo').number(true, 2);
        $('#nuevoCambioEfectivo').number(true, 2);


        // Listar método en la entrada
        listarMetodos()

    } else if (metodo == "CC") {

        var credito = $("#GDcredito").val()

        if (credito == "" || credito == 0) {
            swal("¡Error!", "El cliente seleccionado no tiene crédito", "error");
            $("#nuevoMetodoPago").val("Efectivo")

            $(this).parent().parent().removeClass("col-md-6");

            $(this).parent().parent().addClass("col-md-4");

            $(this).parent().parent().parent().parent().children(".cajasMetodoPago").html(

                '<div class="col-md-6">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" name="nuevoValorEfectivo"  required>' +

                '</div>' +

                '</div>' +

                '<div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '<input type="text" class="form-control" id="nuevoCambioEfectivo"  placeholder="000000" readonly  required>' +

                '</div>' +

                '</div>'

            )

            // Agregar formato al precio

            $('#nuevoValorEfectivo').number(true, 2);
            $('#nuevoCambioEfectivo').number(true, 2);


            // Listar método en la entrada
            listarMetodos()

            return;
        }

        $(this).parent().parent().removeClass("col-md-6");

        $(this).parent().parent().addClass("col-md-4");

        $(this).parent().parent().parent().parent().children(".cajasMetodoPago").html(

            '<div class="col-md-6">' +

            '<div class="input-group">' +

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

            '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" name="nuevoValorEfectivo" value="' + credito + '" readonly required>' +

            '</div>' +

            '</div>' +

            '<div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">' +

            '<div class="input-group">' +

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

            '<input type="text" class="form-control" id="nuevoCambioEfectivo"  placeholder="000000" readonly required>' +

            '</div>' +

            '</div>'

        )

        // Agregar formato al precio

        var cambio = Number(credito) - Number($('#nuevoTotalVenta').val());
        $('#nuevoCambioEfectivo').val(cambio);




        $('#nuevoValorEfectivo').number(true, 2);
        $('#nuevoCambioEfectivo').number(true, 2);


        // Listar método en la entrada
        listarMetodos()


    } else {

        $(this).parent().parent().removeClass('col-md-4');

        $(this).parent().parent().addClass('col-md-6');

        $(this).parent().parent().parent().parent().children('.cajasMetodoPago').html(

            '<div class="col-md-12" style="padding-left:0px">' +

            '<div class="input-group">' +

            '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>' +

            '<span class="input-group-text"><i class="fa fa-lock"></i></span>' +

            '</div>' +

            '</div>')

    }



})

/*CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("keyup", "input#nuevoValorEfectivo", function () {

    var efectivo = $(this).val();

    var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {

    // Listar método en la entrada
    listarMetodos()


})
function listarProductos() {

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");

    var precio = $(".nuevoPrecioProducto");

    for (var i = 0; i < descripcion.length; i++) {

        listaProductos.push(
            {
                "id": $(descripcion[i]).attr("idProducto"),
                "descripcion": $(descripcion[i]).val(),
                "cantidad": $(cantidad[i]).val(),
                "stock": $(cantidad[i]).attr("nuevoStock"),
                "precio": $(precio[i]).attr("precioReal"),
                "total": $(precio[i]).val()
            })

    }

    ///console.log(JSON.stringify(listaProductos));

    $("#listaProductos").val(JSON.stringify(listaProductos));
    $('#box-search').val("");

}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos() {

    var listaMetodos = "";

    if ($("#nuevoMetodoPago").val() == "Efectivo") {

        $("#listaMetodoPago").val("Efectivo");

    } else {

        $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val());

    }

}
$('#daterange-btn').daterangepicker(
    {
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()
    },
    function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var capturarRango = $("#daterange-btn span").html();

        localStorage.setItem("capturarRango", capturarRango);

        window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;



    }

)

$('#daterange-btn-home').daterangepicker(
    {
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()
    },
    function (start, end) {
        $('#daterange-btn-home span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var capturarRango = $("#daterange-btn-home span").html();

        localStorage.setItem("capturarRangoHome", capturarRango);

        window.location = "index.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;



    }

)
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function () {

    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "ventas";
})

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function () {

    localStorage.removeItem("capturarRangoHome");
    localStorage.clear();
    window.location = "ventas";
})


/*=============================================
CAPTURAR HOY
=============================================*/
$(".daterangepicker.opensright .ranges li").on("click", function () {

    var textoHoy = $(this).attr("data-range-key");

    if (textoHoy == "Hoy") {

        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();

        // if(mes < 10){

        // 	var fechaInicial = año+"-0"+mes+"-"+dia;
        // 	var fechaFinal = año+"-0"+mes+"-"+dia;

        // }else if(dia < 10){

        // 	var fechaInicial = año+"-"+mes+"-0"+dia;
        // 	var fechaFinal = año+"-"+mes+"-0"+dia;

        // }else if(mes < 10 && dia < 10){

        // 	var fechaInicial = año+"-0"+mes+"-0"+dia;
        // 	var fechaFinal = año+"-0"+mes+"-0"+dia;

        // }else{

        // 	var fechaInicial = año+"-"+mes+"-"+dia;
        //    	var fechaFinal = año+"-"+mes+"-"+dia;

        // }

        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);

        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;

        localStorage.setItem("capturarRango", "Hoy");

        window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;

    }

})


/*=============================================
CAPTURAR HOY
=============================================*/
$(".daterangepicker.opensright .ranges li").on("click", function () {

    var textoHoy = $(this).attr("data-range-key");

    if (textoHoy == "Hoy") {

        var d = new Date();

        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();

        // if(mes < 10){

        // 	var fechaInicial = año+"-0"+mes+"-"+dia;
        // 	var fechaFinal = año+"-0"+mes+"-"+dia;

        // }else if(dia < 10){

        // 	var fechaInicial = año+"-"+mes+"-0"+dia;
        // 	var fechaFinal = año+"-"+mes+"-0"+dia;

        // }else if(mes < 10 && dia < 10){

        // 	var fechaInicial = año+"-0"+mes+"-0"+dia;
        // 	var fechaFinal = año+"-0"+mes+"-0"+dia;

        // }else{

        // 	var fechaInicial = año+"-"+mes+"-"+dia;
        //    	var fechaFinal = año+"-"+mes+"-"+dia;

        // }

        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);

        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;

        localStorage.setItem("capturarRangoHome", "Hoy");

        window.location = "index.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;

    }

})


$("#btnBuscarVentasFiltro").on("click", function () {




    var vts_fecha_inicio = $("#vts_fecha_inicio").val();
    var vts_fecha_fin = $("#vts_fecha_fin").val();
    var vts_mp = $("#vts_mp").val();

    var vts_vendedor = $("#vts_vendedor").val();

    buscarVentasFiltro(
        [
            vts_fecha_inicio,
            vts_fecha_fin,
            vts_mp,
            vts_vendedor
        ]);

})


function buscarVentasFiltro(arrayDatos) {
    var datos = new FormData();
    datos.append("vts_fecha_inicio", arrayDatos[0])
    datos.append("vts_fecha_fin", arrayDatos[1])
    datos.append("vts_mp", arrayDatos[2])
    datos.append("vts_vendedor", arrayDatos[3])
    datos.append("btnBuscarVentasFiltro", true)
    $.ajax({
        url: "ajax/ventas.ajax.php",
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
            var total = 0;

            res.forEach(vts => {

                if (arrayDatos[2] == "") {
                    total = vts.total;
                }

                if (arrayDatos[2] == "EFECTIVO") {
                    total = vts.vts_efectivo;
                }
                if (arrayDatos[2] == "BANCO") {
                    total = vts.vts_tarjeta;
                }


                ventastotal += Number(total);

                var acciones = "";
                if (usr_rol == "Administrador") {
                    acciones = `<button class="btn btn-danger btn-elimina-venta" id="${vts.id_venta}"><i class="fas fa-trash"></i></button>`;
                } else {
                    acciones = ``;
                }

                contenido +=
                    `  
                
                <tr>
                
                    <td>${vts.id_venta}</td>
                    <td>${vts.nombre}</td>
                    <td>${vts.venta_mp}</td>
                    <td>${total}</td>
                    <td>${vts.fecha}</td>
                    <td><a target="_blank" href="./extensiones/tcpdf/pdf/ticket.php?codigo=${vts.id_venta}" class="btn btn-secondary"><i class="fas fa-print"></i></td>
                    <td>${acciones}</td>
                
                </tr>
                
                `;

            });

            $("#ventasBody").html(contenido);
            $("#vts_total").html($.number(ventastotal, 2));

            $("#btnExpVts").attr("href", "export/exportar-ventas2.php?fechaInicial=" + arrayDatos[0] + "&fechaFinal=" + arrayDatos[1] + "&mp=" + arrayDatos[2] + "&user=" + arrayDatos[3])

        }
    })

}

$(".table tbody").on("click", ".btn-elimina-venta", function () {
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
                datos.append("id_venta", id)
                datos.append("btn-elimina-venta", true)

                $.ajax({
                    url: "ajax/ventas.ajax.php",
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