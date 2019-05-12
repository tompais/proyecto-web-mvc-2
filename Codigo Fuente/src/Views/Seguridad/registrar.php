<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrar</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="..\..\wwwroot\lib\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="..\..\wwwroot\lib\daterangepicker\daterangepicker.css">
    <link rel="stylesheet" href="..\..\wwwroot\lib\alertifyjs\css\alertify.min.css">
    <link rel="stylesheet" href="..\..\wwwroot\lib\fontawesome\css\all.min.css">
    <link rel="stylesheet" href="..\..\wwwroot\css\seguridad\registrar.css">
</head>

<body>

    <!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
    <?php
    require_once "..\..\Helpers\Constantes.php";
    require_once "../../Utils/FuncionesUtiles.php";
    require_once "..\..\Helpers\Conexion.php";
    require_once "..\..\Enums\Roles.php";
    require_once "../../Enums/Sexos.php";
    require_once "../../Models/Usuario.php";

    if ($_POST && count($_POST) && isset($_POST[Constantes::BTNREGISTRAR])) {
        $pass = isset($_POST[Constantes::INPUTPASSWORD]) ? $_POST[Constantes::INPUTPASSWORD] : null;
        $rePass = isset($_POST[Constantes::INPUTREPASSWORD]) ? $_POST[Constantes::INPUTREPASSWORD] : null;

        $usuario = new Usuario();

        $usuario->setNombre(isset($_POST[Constantes::INPUTNOMBRE]) ? $_POST[Constantes::INPUTNOMBRE] : null);
        $usuario->setApellido(isset($_POST[Constantes::INPUTAPELLIDO]) ? $_POST[Constantes::INPUTAPELLIDO] : null);
        $usuario->setUsername(isset($_POST[Constantes::INPUTNICKNAME]) ? $_POST[Constantes::INPUTNICKNAME] : null);
        $usuario->setEmail(isset($_POST[Constantes::INPUTEMAIL]) ? $_POST[Constantes::INPUTEMAIL] : null);
        $usuario->setFechaNacimiento(isset($_POST[Constantes::INPUTFECHANACIMIENTO]) ? date("Y-m-d", strtotime($_POST[Constantes::INPUTFECHANACIMIENTO])) : null);
        $usuario->setTelefono(isset($_POST[Constantes::INPUTTELEFONO]) ? $_POST[Constantes::INPUTTELEFONO] : null);
        $usuario->setSexoId(isset($_POST[Constantes::SELECTSEXO]) ? $_POST[Constantes::SELECTSEXO] : null);
        $usuario->setRolId(Roles::USUARIO);

        if (
            !$usuario->validarNombre()
            || !$usuario->validarApellido()
            || !$usuario->validarUsername()
            || !$usuario->validarEmail()
            || !$usuario->validarTelefono()
            || !FuncionesUtiles::confirmarPassword($pass, $rePass)
            || !$usuario->validarSexo()
        ) {
            header("location: ../NoCompletado/noCompletado.php");
            exit();
        }

        $usuario->setUpassword(strtoupper(sha1($pass)));


        $conn = new Conexion();
        $query = "INSERT INTO Usuario (Nombre, Apellido, FechaNac, Username, UPassword, Email, Telefono, RolId, SexoId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if (
            !$conn->setPreparedStmt($query)
            || !$conn->vincularParametrosPreparedStatement("ssssssiii", $usuario->getNombre(), $usuario->getApellido(), $usuario->getFechaNacimiento(), $usuario->getUsername(), $usuario->getUpassword(), $usuario->getEmail(), $usuario->getTelefono(), $usuario->getRolId(), $usuario->getSexoId())
            || !$conn->ejecutarPreparedStatement()
            || !$conn->getCantFilasAfectadasPreparedStatement()
        ) {
            header("location: ../NoCompletado/noCompletado.php");
            $conn->desconectar();
            exit();
        }

        $conn->cerrarPreparedStatement();

        $query = "SELECT 1 FROM Usuario WHERE Username LIKE ?";

        if (
            !$conn->setPreparedStmt($query)
            || !$conn->vincularParametrosPreparedStatement("s", $usuario->getUsername())
            || !$conn->ejecutarPreparedStatement()
            || !$conn->almacenarResultadoPreparedStatementEnMemoria()
            || !$conn->getCantFilasSeleccionadasPreparedStatement()
        ) {
            header("location: ../NoCompletado/noCompletado.php");
            $conn->desconectar();
            exit();
        }
        header("location: registracionExitosa.php");

        $conn->desconectar();
    }
    ?>
    <div class="container-fluid">
        <form action="registrar.php" method="post" class="border shadow rounded mx-auto w-50 p-4 my-5">
            <h4 class="mb-4 text-center">Regístrese</h4>

            <div class="form-row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" name="inputNombre" id="inputNombre" class="form-control" placeholder="Ej: Pepe">
                        <div id="errorNombre" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su nombre</div>
                        <div id="errorNombre2" class="error"> <i class="fas fa-exclamation-triangle"></i> Su nombre no debe tener mas de 15 caracteres</div>
                        <div id="errorNombre3" class="error"> <i class="fas fa-exclamation-triangle"></i> Solo letras por favor</div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputApellido">Apellido</label>
                        <input type="text" name="inputApellido" id="inputApellido" class="form-control" placeholder="Ej: González">
                        <div id="errorApellido" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su apellido</div>
                        <div id="errorApellido2" class="error"> <i class="fas fa-exclamation-triangle"></i> Su apellido no debe tener mas de 15 caracteres</div>
                        <div id="errorApellido3" class="error"> <i class="fas fa-exclamation-triangle"></i> Solo letras por favor</div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputNickname">Nickname</label>
                        <input type="text" name="inputNickname" id="inputNickname" class="form-control" placeholder="Ej: pgonzalez">
                        <div id="errorNickname" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su Nickname</div>
                        <div id="errorNickname2" class="error"> <i class="fas fa-exclamation-triangle"></i> Su NickName no debe tener mas de 15 caracteres</div>
                        <div id="errorNickname3" class="error"> <i class="fas fa-exclamation-triangle"></i> Solo letras y numero por favor</div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="ejemplo@correo.com">
                        <div id="errorEmail" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su E-Mail</div>
                        <div id="errorEmail2" class="error"> <i class="fas fa-exclamation-triangle"></i> Escriba su E-Mail de forma correcta</div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="inputPassword" id="inputPassword" class="form-control pwd" placeholder="Ej: juan1234">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showPassword(this)"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div id="errorPassword" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su contraseña</div>
                        <div id="errorPassword2" class="error"> <i class="fas fa-exclamation-triangle"></i> Su contraseña debe tener entre 6 a 15 digitos</div>
                        <div id="errorPassword3" class="error"> <i class="fas fa-exclamation-triangle"></i> Solo letras y numero por favor</div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputRePassword">Confirme su Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="inputRePassword" id="inputRePassword" class="form-control pwd" placeholder="Ej: juan1234" aria-describedby="helpIdInputRePassword">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showPassword(this)"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <small id="helpIdInputRePassword" class="text-muted">Asegúrese de que coincidan</small>
                        <div id="errorRePassword" class="error"> <i class="fas fa-exclamation-triangle"></i> Confirme su contraseña</div>
                        <div id="errorRePassword2" class="error"> <i class="fas fa-exclamation-triangle"></i> Sus contraseñas no coinciden</div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="selectSexo">Sexo</label>
                        <select class="form-control" name="selectSexo" id="selectSexo">
                            <?php

                            $query = "SELECT * FROM Sexo";

                            $conn = new Conexion();

                            if (
                                !$conn->setPreparedStmt($query)
                                || !$conn->ejecutarPreparedStatement()
                                || !$conn->almacenarResultadoPreparedStatementEnMemoria()
                                || !$conn->getCantFilasSeleccionadasPreparedStatement()
                                || !($sexos = $conn->getArrayAsociativoPreparedStatement())
                            ) {
                                header("location: ../NoCompletado/noCompletado.php");
                                $conn->desconectar();
                                exit();
                            }

                            while ($conn->recuperarResultadoPreparedStatement()) {
                                echo "<option value='" . $sexos["Id"] . "'>" . $sexos["Nombre"] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputFechaNacimiento">Fecha de Nacimiento</label>
                        <div class="input-group">
                            <input type="text" name="inputFechaNacimiento" id="inputFechaNacimiento" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="btnInputFechaNacimiento" type="button"><i class="fas fa-calendar-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="inputTelefono">Teléfono</label>
                        <input type="number" class="form-control" name="inputTelefono" id="inputTelefono" aria-describedby="helpIdInputTelefono" placeholder="111234567">
                        <small id="helpIdInputTelefono" class="form-text text-muted">Sin código de área</small>
                    </div>
                </div>
                <div class="col-md">
                    
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center my-3">
                <button type="submit" name="btnRegistrar" id="btnRegistrar" class="btn btn-primary">Registrar</button>
            </div>
        </form>
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
    <script src="..\..\wwwroot\js\seguridad\registrar.js"></script>
    <script src="..\..\wwwroot\js\seguridad\validacionRegistrar.js"></script>
</body>

</html>