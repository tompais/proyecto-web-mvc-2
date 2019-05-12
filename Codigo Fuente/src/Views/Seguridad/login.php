<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/seguridad/login.css" ?>">
    <div class="container-fluid">
        <form action="login.php" method="post" class="border rounded shadow w-25 mx-auto p-4 mt-5">
            <h4 class="mb-4 text-center">Login de Usuario</h4>

            <div class="form-group">
                <label for="inputEmailOrNick">Nickname/Email</label>
                <input type="text" name="inputEmailOrNick" id="inputEmailOrNick" class="form-control">
                <div id="errorNick" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su nombre de usuario o Email</div>
                <div id="errorNick2" class="error"> <i class="fas fa-exclamation-triangle"></i> Escriba su nick o email de forma correcta</div>
            </div>

            <div class="form-group">
                <label for="inputPassword">Contraseña</label>
                <input type="password" class="form-control" name="inputPassword" id="inputPassword">
                <div id="errorPass" class="error"> <i class="fas fa-exclamation-triangle"></i> Por favor ingrese su contraseña</div>
                <div id="errorPass2" class="error"> <i class="fas fa-exclamation-triangle"></i> Su contraseña debe tener entre 6 a 15 digitos</div>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="checkboxRecordarme" id="checkboxRecordarme" value="1">
                    <small class="align-text-top">Recordarme</small>
                </label>
            </div>

            <div class="d-flex justify-content-center align-items-center my-3">
                <button type="submit" name="btnIngresar" id="btnIngresar" class="btn btn-primary">Ingresar</button>
            </div>

            <div>
                <small>¿Olvidaste tu contraseña? <a href="forgotPassword.php">Click aquí</a></small>
                <small>¿Primera vez aquí? <a href="registrar.php">Regístrate</a></small>
            </div>

            <?php

            require_once "..\..\Helpers\Constantes.php";
            require_once "../../Utils/FuncionesUtiles.php";
            require_once "..\..\Helpers\Conexion.php";
            require_once "..\..\Enums\Roles.php";
            require_once "../../Models/Usuario.php";

            if ($_POST && count($_POST) && isset($_POST[Constantes::BTNINGRESAR])) {

                $usuarioLogin = new Usuario();

                $userNameOrEmail = isset($_POST[Constantes::INPUTEMAILORNICK]) ? strtolower($_POST[Constantes::INPUTEMAILORNICK]) : null;
                $password = isset($_POST[Constantes::INPUTPASSWORD]) ? $_POST[Constantes::INPUTPASSWORD] : null;

                if (FuncionesUtiles::esPalabraConNumeros($userNameOrEmail)) {
                    $usuarioLogin->setUsername($userNameOrEmail);
                    $usuarioLogin->setEmail(null);
                } else if (FuncionesUtiles::validarEmail($userNameOrEmail)) {
                    $usuarioLogin->setEmail($userNameOrEmail);
                    $usuarioLogin->setUsername(null);
                } else {
                    header("location: ../NoCompletado/noCompletado.php");
                    exit();
                }

                if (FuncionesUtiles::esPalabraConNumeros($password)) {
                    $usuarioLogin->setUpassword(strtoupper(sha1($password)));
                } else {
                    header("location: ../NoCompletado/noCompletado.php");
                    exit();
                }



                $conn = new Conexion();

                $query = "SELECT 1 FROM Usuario  where (Username LIKE ? OR Email LIKE ?) AND UPassword LIKE ?";


                if (
                    !$conn->setPreparedStmt($query)
                    || !$conn->vincularParametrosPreparedStatement("sss", $usuarioLogin->getUsername(), $usuarioLogin->getEmail(), $usuarioLogin->getUpassword())
                    || !$conn->ejecutarPreparedStatement()
                    || !$conn->almacenarResultadoPreparedStatementEnMemoria()
                    || !$conn->getCantFilasSeleccionadasPreparedStatement()
                ) {
                    header("location: ../NoCompletado/noCompletado.php");
                    exit();
                }

                header("location: ../Home/main.php");

                $conn->desconectar();
            }
            ?>
        </form>
    </div>

<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/validacionLogin.js" ?>"></script>
