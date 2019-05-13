<?php

class SeguridadController extends Controller
{
    function registrar()
    {
        require_once ROOT . "Models/Sexo.php";
        require_once ROOT . "Models/Provincia.php";
        require_once ROOT . "Models/Partido.php";
        require_once ROOT . "Models/Localidad.php";

        $this->layout = "layoutSeguridad";

        $sexo = new Sexo();
        $provincia = new Provincia();
        $partido = new Partido();
        $localidad = new Localidad();

        $d['sexos'] = $sexo->getAllSexos();
        $d['provincias'] = $provincia->getAllProvincias();

        usort($d['sexos'], Constantes::CMPBYID);
        usort($d['provincias'], Constantes::CMPBYNOMBRE);

        $d['partidos'] = $partido->getPartidosByProvinciaId($d['provincias'][0]->getId());

        usort($d['partidos'], Constantes::CMPBYNOMBRE);

        $d['localidades'] = $localidad->getLocalidadesByPartidoId($d['partidos'][0]->getId());

        usort($d['localidades'], Constantes::CMPBYNOMBRE);

        $d['title'] = Constantes::REGISTRARTITLE;

        $this->set($d);
        $this->render(Constantes::REGISTRARVIEW);
    }

    function getPartidosByProvinciaId($json)
    {
        require_once ROOT . "Models/Partido.php";
        require_once ROOT . "Dto/PartidoDto.php";
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));
        $partido = new Partido();

        $partidos = $partido->getPartidosByProvinciaId($data->provinciaId);

        usort($partidos, Constantes::CMPBYNOMBRE);

        $partidosDto = array();

        foreach ($partidos as $partido)
        {
            $partidoDto = new PartidoDto();
            $partidoDto->id = $partido->getId();
            $partidoDto->nombre = mb_convert_encoding($partido->getNombre(), 'UTF-8', 'UTF-8');
            $partidoDto->provinciaId = $partido->getProvinciaId();
            $partidosDto[] = $partidoDto;
        }

        echo json_encode($partidosDto);
    }

    function getLocalidadesByPartidoId($json)
    {
        require_once ROOT . "Models/Localidad.php";
        require_once ROOT . "Dto/LocalidadDto.php";
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $localidad = new Localidad();

        $localidades = $localidad->getLocalidadesByPartidoId($data->partidoId);

        usort($localidades, Constantes::CMPBYNOMBRE);

        $localidadesDto = array();

        foreach ($localidades as $localidad)
        {
            $localidadDto = new LocalidadDto();

            $localidadDto->id = $localidad->getId();
            $localidadDto->nombre = mb_convert_encoding($localidad->getNombre(), 'UTF-8', 'UTF-8');
            $localidadDto->partidoId = $localidad->getPartidoId();

            $localidadesDto[] = $localidadDto;
        }

        echo json_encode($localidadesDto);
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
        require_once ROOT . "Models/Session.php";

        $user = new Usuario();
        $session = new Session();

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

        $arrayUsurio = $user->existeUsuarioDB();


       if ($arrayUsurio){
            $session->setId($arrayUsurio[0]["Id"]);
            $session->setUserName($arrayUsurio[0]["Username"]);
            $_SESSION["session"] = serialize($session);
            header("location: " . getBaseAddress() . "Home/inicio");
        }
        else{
            header("location: " . getBaseAddress() . "Seguridad/login");
            echo "<script> alert('Usuario incorrecto'); </script>";
        }



    }

    function cerrarSession()
    {
        session_destroy();
        header("location: " . getBaseAddress() . "Home/inicio");
    }

}

?>
