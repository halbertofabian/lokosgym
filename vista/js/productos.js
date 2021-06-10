/*=============================================
EDITAR producto
=============================================*/
$(".table").on("click", ".btnEditarProducto", function () {

  var idProducto = $(this).attr("idProducto");

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

      $("#EDcodigo").val(respuesta[1]);
      $("#EDnombre").val(respuesta['producto']);
      //$("#EDcategoria").val();
      var valor = respuesta[16];

      //$("#EDcategoria option[value="+  +"]").attr("selected",true);
      $("#EDcategoria > option[value=" + valor + "]").attr("selected", true)
      //$("#EDcategoria").val(valor)
      $("#EDmarca").val(respuesta['marca']);
      $("#EDdescripcion").val(respuesta['descripcion']);
      //$("#EDcaracteristicas").val(respuesta['caracteristicas_producto']);
      $("#EDstok").val(respuesta['existencia']);
      $("#EDprecio_compra").val(respuesta['precio_compra']);
      $("#EDprecio_publico").val(respuesta['precio_publico']);
      $("#EDprecio_mayoreo").val(respuesta['precio_mayoreo']);
      $("#EDprecio_especial").val(respuesta['precio_especial']);
      //$('#EDcaracteristicas').tagsinput('add', { "value": 1 , "text": "jQuery"});
      $("#EDcaracteristicas").val(respuesta['caracteristicas_producto'])

      // $("#EDnombre").val(respuesta['producto']);

    }

  })


})



$("#GDprecio_compra,#GDporcentaje").keyup(function () {
  var porcentaje = parseFloat($('#GDporcentaje').val());
  var precio_compra = parseFloat($("#GDprecio_compra").val());

  var total = (precio_compra * (porcentaje / 100)) + precio_compra

  $("#GDprecio_publico").val(Math.round(total));
});


$(".table tbody").on("click", ".btn-elimina-producto", function () {
  var clicked = this;
  var id = $(this).attr("id");

  swal({
    title: "Esta seguro de eliminar producto?",
    text: "Esta accion no es reversible",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        var datos = new FormData();
        datos.append("id", id)
        datos.append("btn-elimina-producto", true)

        $.ajax({
          url: "ajax/productos.ajax.php",
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
              swal("¡Bien!", "Se elimino producto :)", "success");

            } else {
              swal("¡Error!", "No se puedo eliminar producto", "error");
            }
          }
        })
      } else {

      }
    });

})

$("#btnImportarProductos").on("click", function (e) {
  e.preventDefault()

  var excel = $("#pds_excel").val()
  if (excel == "") {
      return swal("Error", "Seleccione un archivo excel", "error");
  }

  swal({
      title: "¿Estas seguro de querer importar la lista de productos?",
      text: "Asegurate de tener el archivo con los requerimientos solicitados",
      icon: "info",
      buttons: ["Calcelar", "Si, importar lista"],
      dangerMode: true,
  })
      .then((willDelete) => {
          if (willDelete) {
              var datos = new FormData()
              var files = $("#pds_excel")[0].files[0];
              datos.append("btnImportarProductos", true);
              datos.append("archivoExcel", files);
              $.ajax({

                  url: 'ajax/productos.ajax.php',
                  method: "POST",
                  data: datos,
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType: "json",
                  beforeSend: function () {

                      $("#btnImportarProductos").attr("disabled", true)
                      $("#btnImportarProductos").removeClass("btn-success")
                      $("#btnImportarProductos").addClass("btn-secondary")
                      $("#btnImportarProductos").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="sr-only">Loading...</span> 
                      Importando productos ...`);


                  },
                  success: function (res) {
                      $("#btnImportarProductos").attr("disabled", false)
                      $("#btnImportarProductos").addClass("btn-success")
                      $("#btnImportarProductos").removeClass("btn-secondary")
                      $("#btnImportarProductos").html(`<i class="fa fa-file-excel-o" aria-hidden="true"></i>
                      Importar productos`);

                      if (res.status) {

                          swal({
                              title: "Importación exitosa",
                              text: res.mensaje + "\n Nuevos: " + res.insert + "\n Actualizar: " + res.update,
                              icon: "success",
                              buttons: [false, "Continuar"],
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