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
        $d['title'] = Constantes::LOGINTITLE;
        $this->set($d);
        $this->render(Constantes::LOGINVIEW);
    }

}

?>
