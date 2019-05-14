$(document).ready(function() {

    $("#btnIngresar").click(function() {

        var nick = $('#inputEmailOrNick').val();
        var pass = $('#inputPassword').val();

        /* Nombre */

        if (nick.length === 0){
            $("#errorNick").fadeIn("slow");
            return false;
        }
        else{
            $("#errorNick").fadeOut();
        }

        /* Password */

        if (pass.length === 0){
            $("#errorPass").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPass").fadeOut();
        }

        if (pass.length < 6 && pass.length < 15) {
            $("#errorPass2").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPass2").fadeOut();
        }

    });

});

function ErrorFormulario () {
    $("#errorForm").fadeIn("slow");
}