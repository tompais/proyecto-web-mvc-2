const regexEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
const regexLetrasYNumeros = /^[0-9a-zA-Z]+$/;

var inputEmailOrNick = $("#inputEmailOrNick");
var btnRecuperarPassword = $("#btnRecuperarPassword");
var errorEmailOrNick = $("#errorEmailOrNick");

function validarEmailOrNick() {
    var validacion = false;
    var emailOrNick = inputEmailOrNick.val();

    if(emailOrNick === null || emailOrNick.length === 0 || emailOrNick === "") {
        errorEmailOrNick.val("Ingrese su Nickname o Email").fadeIn("slow");
    } else if(!regexEmail.test(emailOrNick) || !regexLetrasYNumeros.test(emailOrNick)) {
        errorEmailOrNick.val("Email o Nickname inválido").fadeIn("slow");
    } else {
        validacion = true;
    }

    return validacion;
}

btnRecuperarPassword.click(function () {
    $(".error").fadeOut().val("");

    if(validarEmailOrNick()) {
        var obj = {};
        obj.emailOrNick = inputEmailOrNick.val();
        llamadaAjax(pathRenovarPassword, JSON.stringify(obj), true, "mostrarModalRenovacionPasswordExitosa", "mostrarModalRenovacionPasswordFallida");
    }
});

function mostrarModalRenovacionPasswordExitosa(dummy) {
    alertify.defaults = {
        // language resources
        glossary:{
            // dialogs default title
            title:'¡Contraseña Renovada!'
        }
    };
    alertify.confirm("Para continuar, debe permitir al navegador acceder a su ubicación").setting('modal', false);
}

function mostrarModalRenovacionPasswordFallida(err) {
    alertify.defaults = {
        // language resources
        glossary:{
            // dialogs default title
            title:'Error en Renovación de Password'
        }
    };

    alertify.alert(err);
}