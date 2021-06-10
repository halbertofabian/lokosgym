

var usr_rol =  $("#usr_rol").attr("usr_rol")



$(".nuevaImagen").change(function () {

	var imagen = this.files[0];

	/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaImagen").val("");


		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagen["size"] > 4000000) {

		$(".nuevaImagen").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function (event) {

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);
			$(".lbl-img").val("dhgdgdy");

		})

	}
})

var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();
if (month < 10) {
	month = "0" + month;
}
if (day < 10) {
	day = "0" + day;
}
var toDay = year + "-" + month + "-" + day;
$(".today").val(toDay);
$(".todayTimeStart").val(toDay + "T00:00");
$(".todayTimeEnd").val(toDay + "T23:59");


function startLoadButton() {
    $(".btn-load").attr("disabled", true);
    $(".btn-load").html(` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Por favor espere...`)
}

function stopLoadButton(label) {
    $(".btn-load").attr("disabled", false);
    $(".btn-load").html(`${label}`)
}



$('.js-example-basic-single').select2();


var elem = document.documentElement;
function openFullscreen() {

	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.mozRequestFullScreen) { /* Firefox */
		elem.mozRequestFullScreen();
	} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) { /* IE/Edge */
		elem.msRequestFullscreen();
	}
}
function closeFullscreen() {
	if (document.exitFullscreen) {
		document.exitFullscreen();
	} else if (document.mozCancelFullScreen) {
		document.mozCancelFullScreen();
	} else if (document.webkitExitFullscreen) {
		document.webkitExitFullscreen();
	} else if (document.msExitFullscreen) {
		document.msExitFullscreen();
	}
}


$(".inputN").number(true, 2);



// $(document).ready(function () {
// 	$(".dataTable").DataTable({


// 	  "ordering": false,

// 	  "language": {

// 		"sProcessing": "Procesando...",
// 		"sLengthMenu": "Mostrar _MENU_ registros",
// 		"sZeroRecords": "No se encontraron resultados",
// 		"sEmptyTable": "Ningún dato disponible en esta tabla",
// 		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
// 		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
// 		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
// 		"sInfoPostFix": "",
// 		"sSearch": "Buscar:",

// 		"sUrl": "",
// 		"sInfoThousands": ",",
// 		"sLoadingRecords": "Cargando...",
// 		"oPaginate": {
// 		  "sFirst": "Primero",
// 		  "sLast": "Último",
// 		  "sNext": "Siguiente",
// 		  "sPrevious": "Anterior"
// 		},
// 		"oAria": {
// 		  "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
// 		  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
// 		}

// 	  }

// 	});
//   });
