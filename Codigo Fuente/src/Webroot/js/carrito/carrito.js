function actualizarCantidad(producto) {
    var divCard = $('#' + producto.id);
    var divCantidad = divCard.find('.product_quantity');
    var botonAgregarCarrito = divCard.find('.botonCarrito');
    var cantidadProductos = Number(producto.cantidad);
    cambiarEstadoDelBotonComprar(botonAgregarCarrito, cantidadProductos);
    divCantidad.text('Disponibles:'+producto.cantidad);
}

function cambiarEstadoDelBotonComprar(botonCarrito, cantidad) {
    if(cantidad < 1){
        botonCarrito.prop('onclick',null).off('click');
        botonCarrito.text('Agotado');
    }else {
        botonCarrito.text('Agregado');
    }
}

function subirSubTotal(idProducto, cantidadTotal) {
    var tr = $('#'+idProducto);
    var divSubtotal = tr.find('.subtotal');
    var tdCantidad = tr.find('#quantity_value');
    var tdPrecio = tr.find('.precioProducto');
    var cantidad = parseInt(tdCantidad.text());
    if(cantidad <= cantidadTotal){
        tdCantidad.text(cantidad+1);
        var precio = parseInt(tdPrecio.text());
        var subTotalParcial = (cantidad+1) * precio;
        divSubtotal.text(subTotalParcial);
        actualizarTotal();
    }

}

function bajarSubTotal(idProducto) {
    var tr = $('#'+idProducto);
    var divSubtotal = tr.find('.subtotal');
    var tdCantidad = tr.find('#quantity_value');
    var tdPrecio = tr.find('.precioProducto');
    var cantidad = parseInt(tdCantidad.text());
    if(cantidad > 1){
        var precio = parseInt(tdPrecio.text());
        var subTotalParcial = (cantidad-1) * precio;
        tdCantidad.text(cantidad-1);
        divSubtotal.text(subTotalParcial);
        actualizarTotal();
    }
}

function actualizarTotal(){
    var total=0;
    var tdTotal = $('.total');
    $('.subtotal').each( function() {
        total += parseInt($(this).text());
    });
    tdTotal.text(total);
}

$(document).ready(function($) {
    function subtTotalInicial(cantidad) {
        $('.productosEnCarrito').each(function() {
            var tdPrecioProducto = $(this).find('.precioProducto');
            var precioProducto = Number(tdPrecioProducto.text());
            var subTotal = $(this).find('.subtotal');
            var subTotalParcial = cantidad * precioProducto;

            subTotal.text(subTotalParcial);
        });
    }
    var cantidadInicial = 1;
    subtTotalInicial(cantidadInicial);
    actualizarTotal();
});

function eliminarProducto(id) {
    var obj = {};
    obj.idProducto = id;
    llamadaAjax(pathHome + 'Carrito/eliminarDelCarrito', JSON.stringify(obj), true, "actualizarPaginaCarrito", "dummy");
}

function actualizarPaginaCarrito(idProducto) {
    var fila = $('#' + idProducto);
    fila.remove();
    var carritoCompras = $('#checkout_items');
    var cantidaEnCarrito = parseInt(carritoCompras.text())-1;
    actualizarTotal();
    actualizarCarritoCompras(cantidaEnCarrito);
    if(cantidaEnCarrito == 0){
        ocultarTabla();
        mostrarMensaje();
        ocultarBotonComprar();
    }

}

function ocultarTabla() {
    var tabla = $('#tablaCarrito');
    tabla.hide();
}

function mostrarMensaje() {
    var element =
    $(document.createElement('p'))
        .attr('class','text-center')
        .html('No hay productos agregados al carrito')
        .appendTo('#contenedorCarrito');
}

function ocultarBotonComprar() {
    var botonComprar = $('#botonComprarCarrito');
    botonComprar.hide();
}
