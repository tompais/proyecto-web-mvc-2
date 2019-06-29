var btnBuscarUsuario = $("#buscarUsuario");
var inputUsuarioBuscado = $("#inputUsuarioBuscado");

btnBuscarUsuario.click(function () {
    window.location.href = pathHome + "DashBoard/buscar/" + inputUsuarioBuscado.val();
});

$("input").keypress(function (e) {
    if(e.keyCode === 13) {
        window.location.href = pathHome + "DashBoard/buscar/" + inputUsuarioBuscado.val();
    }
});