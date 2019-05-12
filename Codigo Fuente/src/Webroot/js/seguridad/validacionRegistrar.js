$(document).ready(function() {

    $("#btnRegistrar").click(function() {

        const exprEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        const exprLet = /^[a-zA-Z]+$/;
        const exprLetAndNum = /^[0-9a-zA-Z]+$/;
        const exprNum = /^[0-9]+$/;
        const exprLetAndSpace = /^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/;

        var nombre = $('#inputNombre').val();
        var apellido = $('#inputApellido').val();
        var nickname = $('#inputNickname').val();
        var pass = $('#inputPassword').val();
        var rePass = $('#inputRePassword').val();
        var email = $('#inputEmail').val();
        var fecha = $('#inputFechaNacimiento').val();
        // var prov = $('#inputProvincia').val();
        // var localidad = $('#inputLocalidad').val();
        // var calle = $('#inputCalle').val();
        // var altura = $('#inputAltura').val();

        /* Nombre */

        if (nombre.length === 0){
            $("#errorNombre").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNombre").fadeOut();
        }

        if (nombre.length > 15){
            $("#errorNombre2").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNombre2").fadeOut();
        }

        if (!exprLet.test(nombre)){
            $("#errorNombre3").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNombre3").fadeOut();
        }

        /* Apellido */

        if (apellido.length === 0){
            $("#errorApellido").fadeIn("slow");
            return false;
        }
        else{
            $("#errorApellido").fadeOut();
        }

        if (nombre.length > 15){
            $("#errorApellido2").fadeIn("slow");
            return false;
        }
        else{
            $("#errorApellido2").fadeOut();
        }

        if (!exprLet.test(apellido)){
            $("#errorApellido3").fadeIn("slow");
            return false;
        }
        else{
            $("#errorApellido3").fadeOut();
        }

        /* NickName */

        if (nickname.length === 0){
            $("#errorNickname").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNickname").fadeOut();
        }

        if (nickname.length > 15){
            $("#errorNickname2").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNickname2").fadeOut();
        }

        if (!exprLetAndNum.test(nickname)){
            $("#errorNickname3").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNickname3").fadeOut();
        }

        /* Contraseña */

        if (pass.length === 0){
            $("#errorPassword").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPassword").fadeOut();
        }

        if (pass.length < 6 && pass.length < 15) {
            $("#errorPassword2").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPassword2").fadeOut();
        }

        if (!exprLetAndNum.test(pass)){
            $("#errorPassword3").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPassword3").fadeOut();
        }

        /* Confirmacion de Contraseña */

        if (rePass.length === 0){
            $("#errorRePassword").fadeIn("slow");
            return false;
        }
        else{
            $("#errorRePassword").fadeOut();
        }

        if ( rePass !== pass ){
            $("#errorRePassword2").fadeIn("slow");
            return false;
        }
        else {
            $("#errorRePassword2").fadeOut();
        }

        /* Email */

        if (email.length === 0){
            $("#errorEmail").fadeIn("slow");
            return false;
        }
        else{
            $("#errorEmail").fadeOut();
        }

        if (!exprEmail.test(email)){
            $("#errorEmail2").fadeIn("slow");
            return false;
        }
        else{
            $("#errorEmail2").fadeOut();
        }

        // /* Provincia */

        // if (prov.length === 0){
        //     $("#errorProv").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorProv").fadeOut();
        // }

        // if (!exprLetAndSpace.test(prov)){
        //     $("#errorProv2").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorProv2").fadeOut();
        // }

        // if (prov.length > 20 && prov.length < 8){
        //     $("#errorProv3").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorProv3").fadeOut();
        // }

        // /* Localidad */

        // if (localidad.length === 0){
        //     $("#errorLocalidad").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorLocalidad").fadeOut();
        // }

        // if (!exprLetAndSpace.test(localidad)){
        //     $("#errorLocalidad2").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorLocalidad2").fadeOut();
        // }

        // if (localidad.length > 20 && localidad.length < 4){
        //     $("#errorLocalidad3").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorLocalidad3").fadeOut();
        // }

        // /* Calle */

        // if (calle.length === 0){
        //     $("#errorCalle").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorCalle").fadeOut();
        // }

        // if (!exprLetAndSpace.test(calle)){
        //     $("#errorCalle2").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorCalle2").fadeOut();
        // }

        // if (calle.length > 20 && calle.length < 4){
        //     $("#errorCalle3").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorCalle3").fadeOut();
        // }

        // /* Altura */

        // if (altura.length === 0){
        //     $("#errorAltura").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorAltura").fadeOut();
        // }

        // if (!exprNum.test(altura)){
        //     $("#errorAltura2").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorAltura2").fadeOut();
        // }

        // if (altura.length >= 7 ){
        //     $("#errorAltura3").fadeIn("slow");
        //     return false;
        // }
        // else{
        //     $("#errorAltura3").fadeOut();
        // }


    });

});