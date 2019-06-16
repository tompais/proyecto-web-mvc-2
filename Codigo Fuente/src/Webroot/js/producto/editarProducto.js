var dzUpload = $('#dzUpload');
var btnAgregarEditar = $('#btnAgregarEditar');
var inputIdProducto = $('#idProducto');
var inputNombreProducto = $('#inputNombreProducto');
var inputPrecioProducto = $('#inputPrecioProducto');
var selectCategoriaProducto = $('#selectCategoriaProducto');
var selectEstadoProducto = $('#selectEstadoProducto');
var textareaDescripcionProducto = $('#textareaDescripcionProducto');
var cantidadDeImagenes = 5 - $('#totalPrecarga').val();
Dropzone.autoDiscover = false;

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
    maxFiles: cantidadDeImagenes,
    acceptedFiles: '.png, .jpg, .jpeg',
    init: function () {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        btnAgregarEditar.click(function (e) {
            // Make sure that the form isn't actually being sent.
            $(".error").fadeOut();
            //e.preventDefault();
            e.stopPropagation();

            if (validarAltaModificarProducto() && dzClosure.getQueuedFiles().length > 0) {
                e.preventDefault();
                dzClosure.processQueue();
            }
            else
                if (validarAltaModificarProducto()) {
                    dzClosure.processQueue();
                }
        });

        this.on("maxfilesexceeded", function(file) {
            dzClosure.removeFile(file);
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function (data, xhr, formData) {
            formData.append("idProducto", inputIdProducto.val());
            formData.append("nombreProducto", inputNombreProducto.val());
            formData.append("precioProducto", inputPrecioProducto.val());
            formData.append("categoriaProducto", selectCategoriaProducto.val());
            formData.append("estadoProducto", selectEstadoProducto.val());
            formData.append("descripcionProducto", textareaDescripcionProducto.val());
            btnAgregarEditar.submit();
        });
    }
});



function eliminar(id) {
    var obj = {};
    obj.idImagen = id;
    llamadaAjax(pathAccionProducto, JSON.stringify(obj), true, "eliminarImagen", "dummy");
}

function eliminarImagen(id) {
    var elementoPadreButton = $("#" + id).parent();
    var elementoPadreDiv = elementoPadreButton.parent();
    cantidadDeImagenes++;
    dzClosure.options.maxFiles = cantidadDeImagenes;
    elementoPadreDiv.remove();
}