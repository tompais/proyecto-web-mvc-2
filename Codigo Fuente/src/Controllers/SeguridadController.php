<?php

class SeguridadController extends Controller
{
    function registrar()
    {
        $this->layout = "layoutSeguridad";

        $genero = new Genero();
        $provincia = new Provincia();
        $partido = new Partido();
        $localidad = new Localidad();

        $d['generos'] = $genero->getAllGeneros();
        $d['provincias'] = $provincia->getAllProvincias();

        usort($d['generos'], Constantes::CMPBYID);
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
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));
        $partido = new Partido();

        $partidos = $partido->getPartidosByProvinciaId($data->provinciaId);

        usort($partidos, Constantes::CMPBYNOMBRE);

        $partidosDto = array();

        foreach ($partidos as $partido) {
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
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $localidad = new Localidad();

        $localidades = $localidad->getLocalidadesByPartidoId($data->partidoId);

        usort($localidades, Constantes::CMPBYNOMBRE);

        $localidadesDto = array();

        foreach ($localidades as $localidad) {
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

    function validarLogin($usuario)
    {
        $this->layout = "layoutSeguridad";

        $user = new Usuario();
        $session = new Session();

        $user->setCUIT(0);
        if (FuncionesUtiles::esPalabraConNumeros($usuario["emailOrNick"])) {
            $user->setUsername($usuario["emailOrNick"]);
            $user->setEmail(null);
        } else if (FuncionesUtiles::esEmailValido($usuario["emailOrNick"])) {
            $user->setEmail($usuario["emailOrNick"]);
            $user->setUsername(null);
        } else {
            throwError404();
        }

        if (FuncionesUtiles::esPalabraConNumeros($usuario["password"])) {
            $user->setUpassword(strtoupper(sha1($usuario["password"])));
        } else {
            throwError404();
        }

        $arrayUsurio = $user->loguearUsuarioDB();


        if ($arrayUsurio) {
            $session->setId($arrayUsurio[0]["Id"]);
            $session->setUserName($arrayUsurio[0]["Username"]);
            $session->setRolId($arrayUsurio[0]["RolId"]);
            $_SESSION["session"] = serialize($session);
            header("location: " . getBaseAddress() . "Home/inicio");
        } else {
            header("location: " . getBaseAddress() . "Seguridad/login");
            echo "<script> alert('Usuario incorrecto'); </script>";
        }
    }

    function validarRegistrar($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $usuario = new Usuario();
        $direccion = new Direccion();
        $geolocalizacion = new Geolocalizacion();

        $direccion->setCalle($data->calle);
        $direccion->setAltura($data->altura);
        $direccion->setPiso($data->piso);
        $direccion->setDepartamento($data->departamento);
        $direccion->setProvinciaId($data->provinciaId);
        $direccion->setPartidoId($data->partidoId);
        $direccion->setLocalidadId($data->localidadId);

        if (!$direccion->validarDireccion())
            throw new DireccionInvalidaException("La dirección insertada es inválida", CodigoError::DireccionInvalida);

        if (!$direccion->existeDireccion()) {
            if (!$direccion->insertarDireccion())
                throw new SQLInsertException("Error al Insertar la Dirección", CodigoError::ErrorInsertSQL);
        }

        $geolocalizacion->setLatitud($data->geolocalizacion->latitud);
        $geolocalizacion->setLongitud($data->geolocalizacion->longitud);

        if (!$geolocalizacion->validarGeolocalizacion())
            throw new GeolocalizacionInvalidaException("Ubicación geográfica inválida", CodigoError::GeolocalizacionInvalida);

        if (!$geolocalizacion->existeGeolocalizacion()) {
            if (!$geolocalizacion->insertarGeolocalizacion())
                throw new SQLInsertException("Error al Insertar la Geolocalización", CodigoError::ErrorInsertSQL);
        }

        if (!FuncionesUtiles::validarPassword($data->password))
            throw new PasswordInvalidaException("El formato de la contraseña no es válido", CodigoError::PasswordInvalida);

        $usuario->setNombre($data->nombre);
        $usuario->setApellido($data->apellido);
        $usuario->setCUIT($data->CUIT);
        $usuario->setUsername($data->nickname);
        $usuario->setUpassword(strtoupper(sha1($data->password)));
        $usuario->setEmail($data->email);
        $usuario->setTelefonoFijo($data->telefonoFijo);
        $usuario->setTelefonoCelular($data->telefonoCelular);
        $usuario->setDireccionId($direccion->getId());
        $usuario->setGeneroId($data->generoId);
        $usuario->setRolId(Roles::USUARIO);
        $usuario->setFechaNacimiento($data->fechaNacimiento);
        $usuario->setGeolocalizacionId($geolocalizacion->getId());

        if (!$usuario->validarUsuario())
            throw new UsuarioInvalidoException("Los datos de Usuario son inválidos", CodigoError::UsuarioInvalido);

        if ($usuario->existeUsuarioDB())
            throw new EntidadDuplicadaException("Usuario Duplicado", CodigoError::EntidadDuplicada);

        if (!$usuario->insertarUsuario())
            throw new SQLInsertException("Error al insertar al usuario", CodigoError::ErrorInsertSQL);

        $session = new Session();

        $session->setId($usuario->getId());
        $session->setUserName(mb_convert_encoding($usuario->getUsername(), 'UTF-8', 'UTF-8'));
        $session->setRolId($usuario->getRolId());

        $_SESSION['session'] = serialize($session);

        echo json_encode($_SESSION['session']);
    }

    function cerrarSession()
    {
        session_destroy();
        header("location: " . getBaseAddress() . "Home/inicio");
    }


    function olvidePassword()
    {
        $this->layout = "layoutSeguridad";

        $d['title'] = Constantes::OLVIDEPASSWORDTITLE;

        $this->set($d);
        $this->render(Constantes::OLVIDEPASSWORDVIEW);
    }

    function renovarPassword($json)
    {
        header("Content-type: application/json");

        $data = json_decode($json['data']);

        $user = new Usuario();

        $user->setCUIT(0);
        if (FuncionesUtiles::esPalabraConNumeros($data->emailOrNick)) {
            $user->setUsername($data->emailOrNick);
            $user->setEmail(null);
        } else if (FuncionesUtiles::esEmailValido($data->emailOrNick)) {
            $user->setEmail($data->emailOrNick);
            $user->setUsername(null);
        } else {
            throw new EmailOrNickInvalidoException("El Email o Nickname insertado no son válidos", CodigoError::EmailOrNickInvalido);
        }

        if (!$user->existeUsuarioDB()) {
            throw new UsuarioInvalidoException("El usuario que intenta renovar la contraseña no existe");
        }

        function inicio()
        {
            $d["title"] = Constantes::MAINTITLE;
            $this->set($d);
            $this->render(Constantes::INICIOVIEW);
        }
    }
    
}

?>
