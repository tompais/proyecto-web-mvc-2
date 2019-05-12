<?php

class SeguridadController extends Controller
{
    function registrar()
    {
        $d['title'] = Constantes::REGISTRARTITLE;
        $this->set($d);
        $this->render(Constantes::REGISTRARVIEW);
    }
}

?>
