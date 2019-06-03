var espaciador = $("#espaciador");
var layoutHeader = $("#layoutHeader");

espaciador.height(layoutHeader.height());
$(window).resize(function () {
    espaciador.height(layoutHeader.height());
});