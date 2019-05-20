<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/seguridad/login.css" ?>">

    <div class="d-flex mt-4" id="login">
        <div class="col-md-5 col-sm-7 mx-auto">
            <form action="<?php echo getBaseAddress() . "Seguridad/validarLogin" ?>" method="post" class="border rounded shadow p-4 my-5 bg-white">

                <h4 class="mb-4 text-center">Login de Usuario</h4>

                <div class="form-group">
                    <label for="inputEmailOrNick">Nickname/Email</label>
                    <input type="text" name="emailOrNick" id="inputEmailOrNick" class="form-control">
                    <div id="errorNick" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese su nombre de usuario o Email</div>
                    <div id="errorNick2" class="error"> <i class="fas fa-exclamation-triangle"></i> Escriba su nick o email de forma correcta</div>
                </div>

                <div class="form-group">
                    <label for="inputPassword">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="inputPassword">
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
                    <button type="submit" id="btnIngresar" class="btn btn-primary">Ingresar</button>
                </div>

                <div class="d-flex flex-column">
                    <small>¿Olvidaste tu contraseña? <a href="forgotPassword.php">Click aquí</a></small>
                    <small>¿Primera vez aquí? <a href="registrar.php">Regístrate</a></small>
                </div>

            </form>
        </div>
    </div>

<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/validacionLogin.js" ?>"></script>
