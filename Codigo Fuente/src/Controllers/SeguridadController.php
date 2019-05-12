<?php

class SeguridadController extends Controller
{
    function registrar()
    {
        require_once ROOT . "Models/Sexo.php";
        require_once ROOT . "Models/Provincia.php";

        $sexo = new Sexo();
        $provincia = new Provincia();

        $d['sexos'] = $sexo->getAllSexos();
        $d['provincias'] = $provincia->getAllProvincias();

        usort($d['sexos'], Constantes::CMPBYID);
        usort($d['provincias'], Constantes::CMPBYID);

        $d['title'] = Constantes::REGISTRARTITLE;

        $this->set($d);
        $this->render(Constantes::REGISTRARVIEW);
    }
}

?>
