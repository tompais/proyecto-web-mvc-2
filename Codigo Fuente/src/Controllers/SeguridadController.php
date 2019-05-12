<?php

class SeguridadController extends Controller
{
    function registrar()
    {
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
