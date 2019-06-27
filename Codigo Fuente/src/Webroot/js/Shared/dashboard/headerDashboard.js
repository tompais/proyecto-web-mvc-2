var btnBuscarUsuario = $("#buscarUsuario");
var inputUsuarioBuscado = $("#inputUsuarioBuscado");

btnBuscarUsuario.click(function () {
    window.location.href = pathHome + "DashBoard/buscar/" + inputUsuarioBuscado.val();
});