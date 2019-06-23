var paginador = $('#paginador');
var divProductosContainer = $('#divProductosContainer');

paginador.pagination({
    dataSource: pathHome + 'Buscar/getPublicaciones/' + palabra,
    autoHidePrevious: true,
    autoHideNext: true,
    pageSize: 6,
    locator: 'items',
    totalNumber: cantidadProductos,
    className: 'paginationjs-theme-blue paginationjs-big',
    callback: function (data, pagination) {
        if(cantidadProductos != 0) {
            divProductosContainer.empty();
            const cantPublicaciones = data.length;
            var i = 0;
            while(i < cantPublicaciones) {
                var cont = 0;

                var row = $('<div class="row my-3 w-100">');

                do {
                    var col = $('<div class="col-sm-4">');

                    var anchor = $('<a>');
                    anchor.attr('href', pathHome + 'Productos/publicacion/' + data[i].producto.id);

                    var productItem = $('<div class="product-item w-100">');

                    var productFilter = $('<div class="product product_filter">');

                    var productImage = $('<div class="product_image h-75 justify-content-center align-items-center">');

                    var img = $('<img class="h-100">');
                    img.attr('src', pathHome + 'Webroot/img/productos/' + data[i].imagen.nombre);

                    productImage.append(img);

                    var productInfo = $('<div class="product_info">');

                    var productName = $('<h6 class="product_name">');

                    var anchorProductName = $('<a>');
                    anchorProductName.attr('href', pathHome + 'Productos/publicacion/' + data[i].producto.id);
                    anchorProductName.text(data[i].producto.nombre);

                    productName.append(anchorProductName);

                    var productPrice = $('<div class="product_price">');
                    productPrice.text('$' + data[i].producto.precio);

                    productInfo.append(productName);
                    productInfo.append(productPrice);

                    var divButtonAddToCart = $('<div class="red_button add_to_cart_button">');

                    var anchorButtonAddToCart = $('<a>');
                    anchorButtonAddToCart.attr('href', '#'); //TODO hay que agregar atributo de acción a agregar a carrito
                    anchorButtonAddToCart.attr('onclick', 'agregarProductoCarrito(' + data[i].producto.id + ')');

                    var fabOpenCart = $('<i class="fab fa-opencart mr-2">');

                    var spanAddToCart = $('<span>');
                    spanAddToCart.text('Agregar al Carrito');

                    anchorButtonAddToCart.append(fabOpenCart);
                    anchorButtonAddToCart.append(spanAddToCart);

                    divButtonAddToCart.append(anchorButtonAddToCart);

                    productFilter.append(productImage);
                    productFilter.append(productInfo);

                    productItem.append(productFilter);
                    productItem.append(divButtonAddToCart);

                    anchor.append(productItem);

                    col.append(anchor);

                    row.append(col);

                    i++;
                    cont++;
                }while(i < cantPublicaciones && cont < 3);

                divProductosContainer.append(row);
            }
        }
    },
    ajax: {
        type: 'POST',
        dataType: 'json'
    }
});


function agregarProductoCarrito(id) {
    if(window.isSessionSetted) {
        var obj = {};
        obj.idProducto = id;
        llamadaAjax(pathHome + 'Carrito/agregar', JSON.stringify(obj), true, "actualizarCarritoCompras", "dummy");
    } else {
        window.location.href = pathHome + "Seguridad/login";
    }
}




