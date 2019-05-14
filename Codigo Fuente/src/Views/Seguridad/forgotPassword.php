<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="es">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Olvidé Contraseña</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="..\..\wwwroot\lib\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="..\..\wwwroot\lib\daterangepicker\daterangepicker.css">
    <link rel="stylesheet" href="..\..\wwwroot\lib\alertifyjs\css\alertify.min.css">
    <link rel="stylesheet" href="..\..\wwwroot\lib\fontawesome\css\all.min.css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="container-fluid">
        <form action="forgotPassword.php" method="post" class="w-25 shadow border rounded mx-auto p-4 mt-5">
            <div class="form-group">
                <label for="inputEmailOrNick">Nickname/Email</label>
                <input type="text" name="inputEmailOrNick" id="inputEmailOrNick" class="form-control" required>
            </div>
            <div class="d-flex justify-content-center align-items-center my-3">
                <button type="submit" name="btnRecuperarPassword" id="btnRecuperarPassword" class="btn btn-primary">Recuperar Contraseña</button>
            </div>
        </form>
        <?php
        require_once "..\..\Helpers\Constantes.php";
        require_once "..\..\Helpers\Conexion.php";

        if ($_POST && count($_POST) && isset($_POST[Constantes::BTNRECUPERARPASSWORD])) {
            $usuario = isset($_POST[Constantes::BTNRECUPERARPASSWORD]) ? strtolower($_POST[Constantes::INPUTEMAILORNICK]) : null;
            if ($usuario == null || !strcmp($usuario, "") || !preg_match(Constantes::REGEXLETRASYNUMEROS, $_POST[Constantes::INPUTEMAILORNICK]) || !preg_match(Constantes::REGEXEMAIL, $_POST[Constantes::INPUTEMAILORNICK])) {
                header("location: ../NoCompletado/noCompletado.php");
                exit();
            }

            $conn = new Conexion();
            $query = "SELECT Email FROM usuario where Username LIKE '$usuario' OR Email LIKE '$usuario'";
            $resultado = $conn->ejecutarQuery($query);

            if (!$resultado)
                header("location: ../NoCompletado/noCompletado.php");

            $conn->desconectar();
        }


        ?>

    </div>
    <script src="..\..\wwwroot\lib\jquery\jquery-3.4.0.min.js"></script>
    <script src="..\..\wwwroot\lib\bootstrap\js\bootstrap.min.js"></script>
    <script src="..\..\wwwroot\lib\fontawesome\js\all.min.js"></script>
    <script src="..\..\wwwroot\lib\popper\popper.min.js"></script>
    <script src="..\..\wwwroot\lib\tooltip\tooltip.min.js"></script>
    <script src="..\..\wwwroot\lib\moment\moment-with-locales.min.js"></script>
    <script src="..\..\wwwroot\lib\JQuery-Mask-Plugin\dist\jquery.mask.min.js"></script>
    <script src="..\..\wwwroot\lib\daterangepicker\daterangepicker.js"></script>
    <script src="..\..\wwwroot\lib\alertifyjs\alertify.min.js"></script>
    <script src="..\..\wwwroot\lib\validate\validate.min.js"></script>
</body>

</html>