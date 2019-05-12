<?php

class SeguridadController extends Controller
{
    function registrar()
    {
        require_once ROOT . "Models/Sexo.php";

        $sexo = new Sexo();

        $d['sexos'] = $sexo->pageRows(0, PHP_INT_MAX);

        usort($d['sexos'], Constantes::CMPBYID);

        $d['title'] = Constantes::REGISTRARTITLE;

        $this->set($d);
        $this->render(Constantes::REGISTRARVIEW);
    }

    function login()
    {
        $this->layout = "layoutSeguridad";
        $d['title'] = Constantes::LOGINTITLE;
        $this->set($d);
        $this->render(Constantes::LOGINVIEW);
    }

    function validarLogin ($usuario) {
        $this->layout = "layoutSeguridad";
        require_once ROOT . "Models/Usuario.php";

        $user = new Usuario();

        if (FuncionesUtiles::esPalabraConNumeros($usuario["emailOrNick"])) {
            $user->setUsername($usuario["emailOrNick"]);
            $user->setEmail(null);
        }
        else if (FuncionesUtiles::validarEmail($usuario["emailOrNick"])) {
            $user->setEmail($usuario["emailOrNick"]);
            $user->setUsername(null);
        }
        else{
            throwError404();
        }

        if (FuncionesUtiles::esPalabraConNumeros($usuario["password"])) {
            $user->setUpassword(strtoupper(sha1($usuario["password"])));
        } else {
            throwError404();
        }

        if ($user->existeUsuarioDB()){
            header("location: " . getBaseAddress() . "Home/inicio");
        }
        else{
            header("location: " . getBaseAddress() . "Seguridad/login");
            echo "<script> alert('Usuario incorrecto'); </script>";
        }



    }

}

?>
