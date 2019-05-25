<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/seguridad/login.css" ?>">
    <form action="forgotPassword.php" method="post" class="w-25 shadow border rounded mx-auto p-4 my-5 bg-white">
        <div class="form-group">
            <label for="inputEmailOrNick">Nickname/Email</label>
            <input type="text" name="inputEmailOrNick" id="inputEmailOrNick" class="form-control" required>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-4">
            <button type="submit" name="btnRecuperarPassword" id="btnRecuperarPassword" class="btn btn-primary">
                Recuperar Contraseña
            </button>
        </div>
    </form>
