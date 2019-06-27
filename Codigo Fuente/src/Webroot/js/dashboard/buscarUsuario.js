var inputFechaBaneo = $("#inputFechaBaneo");
var btnInputFechaBaneo = $("#btnInputFechaBaneo");
var inputUsuarioId = $("#inputUsuarioId");
var btnBanear = $("#btnBanear");

inicializarDatePicker();

btnInputFechaBaneo.click(function () {
    inputFechaBaneo.data("daterangepicker").toggle();
});

function inicializarDatePicker() {

    inputFechaBaneo.daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        opens: "left",
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10),
        startDate: moment().format("DD/MM/YYYY"),
        locale: {
            format: "DD/MM/YYYY",
            daysOfWeek: nombresDias,
            monthNames: nombresMeses
        }
    });

    inputFechaBaneo.mask("99/99/9999", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        },
        placeholder: "__/__/____",
        selectOnFocus: true
    });
}

btnBanear.click(function () {
    banearUsuario();
});

function banearUsuario() {
    $("input").prop("disabled", true);
    btnBanear.prop("disabled", true);
    var obj = {};
    obj.fechaBaneo = inputFechaBaneo.val();
    obj.usuarioId = inputUsuarioId.val();
    llamadaAjax(pathAccionBanearUsuario, JSON.stringify(obj), true, "baneoExitoso", "loginFallido");
}

function baneoExitoso (dummy) {
    window.location.href = pathHome + "DashBoard/buscar/" + palabraBuscada;
}