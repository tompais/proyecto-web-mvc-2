var dzUpload = $('#dzUpload');
var btnAgregar = $('#btnAgregar');
var inputNombreProducto = $('#inputNombreProducto');
var inputPrecioProducto = $('#inputPrecioProducto');
var selectCategoriaProducto = $('#selectCategoriaProducto');
var selectEstadoProducto = $('#selectEstadoProducto');
var textareaDescripcionProducto = $('#textareaDescripcionProducto');

Dropzone.autoDiscover = false;

function inicializarDropzoneJs() {
    dzUpload.dropzone({
        url: pathHome + 'Productos/alta',
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
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            btnAgregar.click( function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                dzClosure.processQueue();
            });

            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
                formData.append("nombreProducto", inputNombreProducto.val());
                formData.append("precioProducto", inputPrecioProducto.val());
                formData.append("categoriaProducto", selectCategoriaProducto.val());
                formData.append("estadoProducto", selectEstadoProducto.val());
                formData.append("descripcionProducto", textareaDescripcionProducto.val());
                btnAgregar.submit();
            });
        }
    });
}

inicializarDropzoneJs();
