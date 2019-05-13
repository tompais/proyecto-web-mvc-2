var inputNombre = $('#inputNombre');
var inputApellido = $('#inputApellido');
var inputNickname = $('#inputNickname');
var inputPassword = $('#inputPassword');
var inputRePassword = $('#inputRePassword');
var inputEmail = $('#inputEmail');
var inputFechaNacimiento = $('#inputFechaNacimiento');
var inputTelefono = $("#inputTelefono");
var inputCalle = $("#inputCalle");
var inputAltura = $("#inputAltura");
var inputPiso = $("#inputPiso");
var inputDepartamento = $("#inputDepartamento");

const regexEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
const regexSoloLetras = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
const regexLetrasYNumeros = /^[0-9a-zA-Z]+$/;
const regexSoloNumeros = /^[0-9]+$/;
const regexLetrasYEspacio = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;

function validarNombre() {
    var nombre = inputNombre.val();

    var validacion = false;

    if(nombre == null || nombre.length === 0 || nombre === "") {
        $("#errorNombre").fadeIn("slow");
    } else if(nombre.length < 3) {
        $("#errorNombre2").fadeIn("slow");
    } else if(nombre.length > 15) {
        $("#errorNombre3").fadeIn("slow");
    } else if(!regexSoloLetras.test(nombre)) {
        $("#errorNombre4").fadeIn("slow");
    } else {
        $("#errorNombre").fadeOut();
        $("#errorNombre2").fadeOut();
        $("#errorNombre3").fadeOut();
        $("#errorNombre4").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarApellido() {
    var apellido = inputApellido.val();

    var validacion = false;

    if(apellido == null || apellido.length === 0 || apellido === "") {
        $("#errorApellido").fadeIn("slow");
    } else if(apellido.length < 3) {
        $("#errorApellido2").fadeIn("slow");
    } else if(apellido.length > 15) {
        $("#errorApellido3").fadeIn("slow");
    } else if(!regexSoloLetras.test(apellido)) {
        $("#errorApellido4").fadeIn("slow");
    } else {
        $("#errorApellido").fadeOut();
        $("#errorApellido2").fadeOut();
        $("#errorApellido3").fadeOut();
        $("#errorApellido4").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarNickname() {
    var nickname = inputNickname.val();

    var validacion = false;

    if(nickname == null || nickname.length === 0 || nickname === "") {
        $("#errorNickname").fadeIn("slow");
    } else if(nickname.length < 5) {
        $("#errorNickname2").fadeIn("slow");
    } else if(nickname.length > 15) {
        $("#errorNickname3").fadeIn("slow");
    } else if(!regexLetrasYNumeros.test(nickname)) {
        $("#errorNickname4").fadeIn("slow");
    } else {
        $("#errorNickname").fadeOut();
        $("#errorNickname2").fadeOut();
        $("#errorNickname3").fadeOut();
        $("#errorNickname4").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarPassword() {
    var password = inputPassword.val();
    var rePassword = inputRePassword.val();

    var validacion = false;

    if(password == null || password.length === 0 || password === "") {
        $("#errorPassword").fadeIn("slow");
    } else if(password.length < 6 || password.length > 15) {
        $("#errorPassword2").fadeIn("slow");
    } else if(!regexLetrasYNumeros.test(password)) {
        $("#errorPassword3").fadeIn("slow");
    }

    if(rePassword == null || rePassword.length === 0 || rePassword === "") {
        $("#errorRePassword").fadeIn("slow");
    } else if(password !== rePassword) {
        $("#errorRePassword2").fadeIn("slow");
    } else {
        $("#errorPassword").fadeOut();
        $("#errorPassword2").fadeOut();
        $("#errorPassword3").fadeOut();
        $("#errorRePassword").fadeOut();
        $("#errorRePassword2").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarEmail() {
    var email = inputEmail.val();

    var validacion = false;

    if(email == null || email.length === 0 || email === "") {
        $("#errorEmail").fadeIn("slow");
    } else if(!regexEmail.test(email)) {
        $("#errorEmail2").fadeIn("slow");
    } else {
        $("#errorEmail").fadeOut();
        $("#errorEmail2").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarFechaNacimiento() {
    var fechaNacimiento = inputFechaNacimiento.val();

    var validacion = false;

    if(!moment(fechaNacimiento, "DD/MM/YYYY").isValid()) {
        $("#errorFechaNacimiento").fadeIn("slow");
    } else if(Math.round(moment.duration(moment().diff(moment(fechaNacimiento, "DD/MM/YYYY"))).asYears()) < 18) {
        $("#errorFechaNacimiento2").fadeIn("slow");
    } else {
        $("#errorFechaNacimiento").fadeOut();
        $("#errorFechaNacimiento2").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarTelefono() {
    var telefono = inputTelefono.val();

    var validacion = false;

    if(telefono == null || telefono.length === 0 || telefono === "") {
        $("#errorTelfono").fadeIn("slow");
    } else if(telefono.length !== 10 || !regexSoloNumeros.test(telefono)) {
        $("#errorTelfono2").fadeIn("slow");
    } else {
        $("#errorTelfono").fadeOut();
        $("#errorTelfono2").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarCalle() {
    var calle = inputCalle.val();

    var validacion = false;

    if(calle == null || calle.length === 0 || calle === "") {
        $("#errorCalle").fadeIn("slow");
    } else if(!regexLetrasYEspacio.test(calle)) {
        $("#errorCalle2").fadeIn("slow");
    } else {
        $("#errorCalle").fadeOut();
        $("#errorCalle2").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarAltura() {
    var altura = inputAltura.val();

    var validacion = false;

    if(altura == null || altura.length === 0 || altura === "") {
        $("#errorAltura").fadeIn("slow");
    } else if(altura.length > 5 || !regexSoloNumeros.test(altura)) {
        $("#errorAltura2").fadeIn("slow");
    } else {
        $("#errorAltura").fadeOut();
        $("#errorAltura2").fadeOut();
        validacion = true;
    }

    return validacion;
}

function validarPisoYDepto() {
    var piso = inputPiso.val();
    var departamento = inputDepartamento.val();

    var validacion = false;

    if((piso == null || piso.length === 0 || piso === "") && (departamento != null && departamento.length > 0 && departamento !== "")) {
        $("#errorPiso").fadeIn("slow");
    } else if ((piso != null && piso.length > 0 && piso !== "") && (departamento == null || departamento.length === 0 || departamento === "")) {
        $("#errorDepartamento").fadeIn("slow");
    } else if(
        (piso != null && piso.length > 0 && piso !== "")
        && (departamento != null && departamento.length > 0 && departamento !== "")
        && !regexSoloNumeros.test(piso)
    ) {
        $("#errorPiso2").fadeIn("slow");
    } else if(
        (piso != null && piso.length > 0 && piso !== "")
        && (departamento != null && departamento.length > 0 && departamento !== "")
        && !regexSoloLetras.test(departamento)
    ) {
        $("#errorDepartamento2").fadeIn("slow");
    } else {
        $("#errorPiso").fadeOut();
        $("#errorDepartamento").fadeOut();
        $("#errorPiso2").fadeOut();
        $("#errorDepartamento2").fadeOut();
        validacion = true;
    }

    return validacion;
}

$("#btnRegistrar").click(function () {

    $(".error").fadeOut();

    return validarNombre()
        && validarApellido()
        && validarNickname()
        && validarEmail()
        && validarPassword()
        && validarFechaNacimiento()
        && validarTelefono()
        && validarCalle()
        && validarAltura()
        && validarPisoYDepto();
});
