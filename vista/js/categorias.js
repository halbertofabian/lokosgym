/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".table").on("click", ".btnEditarCategoria", function () {

  var idCategoria = $(this).attr("idCategoria");

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      $("#EDcategoria").val(respuesta["categoria"]);
      $("#EDdescripcion").val(respuesta["caracteristicas_categoria"]);
      $("#EDid").val(respuesta["id"]);

    }

  })


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".table").on("click", ".btnEliminarCategoria", function () {

  var idCategoria = $(this).attr("idCategoria");
  swal({
    title: "¿Está seguro de borrar la categoría?",
    text: "¡Si no lo está puede cancelar la acción!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "index.php?ruta=categorias&deleteCategoria=" + idCategoria;
      }
    });

})