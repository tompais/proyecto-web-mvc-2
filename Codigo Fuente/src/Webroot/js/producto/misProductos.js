var paginador = $('#paginador');
var divProductosContainer = $('#divProductosContainer');

paginador.pagination({
    dataSource: pathHome + 'Productos/getPublicaciones',
    autoHidePrevious: true,
    autoHideNext: true,
    pageSize: 6,
    locator: 'items',
    totalNumber: cantidadProductos,
    className: 'paginationjs-theme-blue paginationjs-big',
    callback: function (data, pagination) {
        if(cantidadProductos != 0) {
            divProductosContainer.empty();

            var ulCards = $('<ul class="cards justify-content-start">');

            $.each(data, function (i, item) {
                var liCard = $('<li class="card mt-3">');

                var divCardInner = $("<div class='card__inner h-75 w-100'>");

                var imgCardInner = $("<img class='img-fluid h-100 w-100'>");
                imgCardInner.attr('src', pathHome + 'Webroot/img/productos/' + item.imagen.nombre);

                divCardInner.append(imgCardInner);

                var h3CardTagLine = $("<h3 class='card__tagline mt-2'>");
                h3CardTagLine.text(item.producto.nombre);

                var ulCardIcons = $("<ul class='card__icons mt-2'>");

                var liAccionVerPublicacion = $("<li>");

                var anchorAccionVerPublicacion = $("<a>");
                anchorAccionVerPublicacion.attr('href', pathHome + 'Productos/publicacion/' + item.producto.id);

                var iFasFaEye = $("<i class='fas fa-eye'>");

                anchorAccionVerPublicacion.append(iFasFaEye);

                liAccionVerPublicacion.append(anchorAccionVerPublicacion);

                var liAccionEditarPublicacion = $("<li>");

                var anchorAccionEditarPublicacion = $("<a>");
                anchorAccionEditarPublicacion.attr('href', pathHome + 'Productos/editarProducto/' + item.producto.id);

                var iFasFaEdit = $("<li class='fas fa-edit'>");

                anchorAccionEditarPublicacion.append(iFasFaEdit);

                liAccionEditarPublicacion.append(anchorAccionEditarPublicacion);

                var liAccionEliminarPublicacion = $("<li>");

                var anchorAccionEliminarPublicacion = $("<a href='#' onclick='insertarIdProducto(" + item.producto.id + ")' data-toggle='modal' data-target='#eliminarModal'>");

                var iFasFaTimes = $("<li class='fas fa-times'>");

                anchorAccionEliminarPublicacion.append(iFasFaTimes);

                liAccionEliminarPublicacion.append(anchorAccionEliminarPublicacion);

                ulCardIcons.append(liAccionVerPublicacion);
                ulCardIcons.append(liAccionEditarPublicacion);
                ulCardIcons.append(liAccionEliminarPublicacion);

                var pPrecio = $("<p class='font-weight-bold' style='color: #0099df;'>");
                pPrecio.text("$ " + item.producto.precio);

                liCard.append(divCardInner);
                liCard.append(h3CardTagLine);
                liCard.append(ulCardIcons);
                liCard.append(pPrecio);

                ulCards.append(liCard);
            });

            divProductosContainer.append(ulCards);
        }
    },
    ajax: {
        type: 'POST',
        dataType: 'json'
    }
});