var dzUpload = $('#dzUpload');
var btnAgregarEditar = $('#btnAgregarEditar');
var inputNombreProducto = $('#inputNombreProducto');
var inputPrecioProducto = $('#inputPrecioProducto');
var selectCategoriaProducto = $('#selectCategoriaProducto');
var selectEstadoProducto = $('#selectEstadoProducto');
var textareaDescripcionProducto = $('#textareaDescripcionProducto');
var cantidadDeImagenes = 0;
Dropzone.autoDiscover = false;

function inicializarDropzoneJs() {
    dzUpload.dropzone({
        url: pathHome + 'Productos/editar',
        addRemoveLinks: true,
        success: function (file, response) {
            var imgName = response;
            file.previewElement.classList.add('dz-success');
            window.location.href = pathHome + "Productos/misProductos";
        },
        error: function (file, response) {
            file.previewElement.classList.add('dz-error');
        },
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        acceptedFiles: '.png, .jpg, .jpeg',
        init: function () {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            btnAgregarEditar.click(function (e) {
                // Make sure that the form isn't actually being sent.
                $(".error").fadeOut();
                e.preventDefault();
                e.stopPropagation();
                if(validarAltaModificarProducto()) {
                    dzClosure.processQueue();
                }
            });

            //send all the form data along with the files:
            this.on("sendingmultiple", function (data, xhr, formData) {
                formData.append("nombreProducto", inputNombreProducto.val());
                formData.append("precioProducto", inputPrecioProducto.val());
                formData.append("categoriaProducto", selectCategoriaProducto.val());
                formData.append("estadoProducto", selectEstadoProducto.val());
                formData.append("descripcionProducto", textareaDescripcionProducto.val());
                btnAgregarEditar.submit();
            });
        }
    });
}
inicializarDropzoneJs();


$(document).ready(function () {
    function eliminarImagen(id) {
        var elementoPadreButton = $(id).parent();
        var elementoPadreDiv = elementoPadreButton.parent();
        cantidadDeImagenes++;
        elementoPadreDiv.remove();
        //dzUpload.dropzone.options.maxFiles = cantidadDeImagenes;
    }

    $('body .botonEliminar').on('click', 'span', function () {
        var obj = {};
        var idImagen = $(this).attr('id');
        var idSpan = '#'+idImagen;
        obj.idImagen = idImagen;
        llamadaAjax(pathAccionProducto, JSON.stringify(obj), true, eliminarImagen(idSpan), "eliminacionFallido");
    })

})

