<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/seguridad/registrar.css" ?>">

<div class="container-fluid">
    <form action="registrar.php" method="post" class="border shadow rounded mx-auto w-50 p-4 my-5">
        <h4 class="mb-4 text-center">Regístrese</h4>

        <div class="form-row">
            <div class="col-md">
                <div class="form-group">
                    <label for="inputNombre">Nombre</label>
                    <input type="text" name="inputNombre" id="inputNombre" class="form-control" placeholder="Ej: Pepe">
                    <div id="errorNombre" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su nombre
                    </div>
                    <div id="errorNombre2" class="error"><i class="fas fa-exclamation-triangle"></i> Su nombre no debe
                        tener mas de 15 caracteres
                    </div>
                    <div id="errorNombre3" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras por
                        favor
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="inputApellido">Apellido</label>
                    <input type="text" name="inputApellido" id="inputApellido" class="form-control"
                           placeholder="Ej: González">
                    <div id="errorApellido" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su
                        apellido
                    </div>
                    <div id="errorApellido2" class="error"><i class="fas fa-exclamation-triangle"></i> Su apellido no
                        debe tener mas de 15 caracteres
                    </div>
                    <div id="errorApellido3" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras por
                        favor
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md">
                <div class="form-group">
                    <label for="inputNickname">Nickname</label>
                    <input type="text" name="inputNickname" id="inputNickname" class="form-control"
                           placeholder="Ej: pgonzalez">
                    <div id="errorNickname" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su
                        Nickname
                    </div>
                    <div id="errorNickname2" class="error"><i class="fas fa-exclamation-triangle"></i> Su NickName no
                        debe tener mas de 15 caracteres
                    </div>
                    <div id="errorNickname3" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras y
                        numero por favor
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="inputEmail" id="inputEmail" class="form-control"
                           placeholder="ejemplo@correo.com">
                    <div id="errorEmail" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su E-Mail
                    </div>
                    <div id="errorEmail2" class="error"><i class="fas fa-exclamation-triangle"></i> Escriba su E-Mail de
                        forma correcta
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md">
                <div class="form-group">
                    <label for="inputPassword">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="inputPassword" id="inputPassword" class="form-control pwd"
                               placeholder="Ej: juan1234">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="showPassword(this)"><i
                                        class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div id="errorPassword" class="error"><i class="fas fa-exclamation-triangle"></i> Ingrese su
                        contraseña
                    </div>
                    <div id="errorPassword2" class="error"><i class="fas fa-exclamation-triangle"></i> Su contraseña
                        debe tener entre 6 a 15 digitos
                    </div>
                    <div id="errorPassword3" class="error"><i class="fas fa-exclamation-triangle"></i> Solo letras y
                        numero por favor
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="inputRePassword">Confirmar Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="inputRePassword" id="inputRePassword" class="form-control pwd"
                               placeholder="Ej: juan1234" aria-describedby="helpIdInputRePassword">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="showPassword(this)"><i
                                        class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <small id="helpIdInputRePassword" class="text-muted">Asegúrese de que coincidan</small>
                    <div id="errorRePassword" class="error"><i class="fas fa-exclamation-triangle"></i> Confirme su
                        contraseña
                    </div>
                    <div id="errorRePassword2" class="error"><i class="fas fa-exclamation-triangle"></i> Sus contraseñas
                        no coinciden
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md">
                <div class="form-group">
                    <label for="selectSexo">Sexo</label>
                    <select class="form-control" name="selectSexo" id="selectSexo">
                        <?php
                        foreach ($sexos as $sexo)
                        {
                            echo "<option value='" . $sexo['Id'] . "'>" . $sexo['Nombre'] . "</option>";
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
                            <button class="btn btn-outline-secondary" id="btnInputFechaNacimiento" type="button"><i
                                        class="fas fa-calendar-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md">
                <div class="form-group">
                    <label for="inputTelefono">Teléfono</label>
                    <input type="number" class="form-control" name="inputTelefono" id="inputTelefono"
                           aria-describedby="helpIdInputTelefono" placeholder="111234567">
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

<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/registrar.js" ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/seguridad/validacionRegistrar.js" ?>"></script>