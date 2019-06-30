var vendedoresId = [];
var btnFacturar = $("#btnFacturar");
var totalFacturacion = $("#inputTotalFacturacion");

$('#dataTable tbody tr td:nth-child(4)').each( function(){
   vendedoresId.push($(this).text());
});

btnFacturar.click(function () {
   facturacionesMensuales();
});

function facturacionesMensuales() {
   btnFacturar.prop("disabled", true);
   var obj = {};
   obj.facturacionesTotal = totalFacturacion.val();
   obj.vendedoresId = vendedoresId;
   llamadaAjax(pathAccionFacturacionMensual, JSON.stringify(obj), true, "facturacionExitoso", "loginFallido");
}

function facturacionExitoso (dummy) {
   window.location.href = pathHome + "DashBoard/exito";
}