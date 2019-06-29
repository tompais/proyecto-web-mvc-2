<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 10:55
 */

class DashBoardController extends Controller
{

    function login()
{
    $this->layout = "layoutSeguridadDashboard";
    $d['title'] = Constantes::LOGINDASHBOARDTITLE;
    $this->set($d);
    $this->render(Constantes::LOGINDASHBOARVIEW);
}

    function loguearAdmin($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $user = new Usuario();
        $session = new Session();

        if (FuncionesUtiles::esPalabraConNumeros($data->emailOrNick)) {
            $user->setUsername($data->emailOrNick);
            $user->setEmail(null);
        } else if (FuncionesUtiles::esEmailValido($data->emailOrNick)) {
            $user->setEmail($data->emailOrNick);
            $user->setUsername(null);
        } else {
            throw new EmailOrNickInvalidoException("El Email o Nickname insertado no son válidos", CodigoError::EmailOrNickInvalido);
        }

        if (PasswordHelper::validarPassword($data->password)) {
            $user->setUpassword(strtoupper(sha1($data->password)));
        } else {
            throw new PasswordInvalidaException("Formato de password ingresado inválido", CodigoError::PasswordInvalida);
        }

        if(!$user->loguearAdminDB()) {
            throw new UsuarioNoEncontradoException("El usuario ingresado no tiene permiso de administrador. Revise sus datos y vuelva a intentarlo", CodigoError::UsuarioNoEncontrado);
        } else {
            $session->setId($user->getId());
            $session->setUserName($user->getUsername());
            $session->setRolId($user->getRolId());
            $_SESSION["sessionAdmin"] = serialize($session);
            if($data->recordarme)
                setcookie("sessionAdmin", $_SESSION["sessionAdmin"], time() + 60*2, "/", apache_request_headers()["Host"]); //60 segs = 1 min. Multiplicado por 2, son 2 minutos.
        }

        echo json_encode(true);
    }

    function inicio()
    {
        $this->layout = "layoutDashBoard";
        $d["title"] = Constantes::DASHBOARDTITLE;
        $this->set($d);
        $this->render(Constantes::INICIODASHBOARDVIEW);
    }

    function cerrarSession()
    {
        session_destroy();
        if(isset($_COOKIE["sessionAdmin"])) {
            unset($_COOKIE["sessionAdmin"]);
            setcookie("sessionAdmin", null, -1, "/", apache_request_headers()["Host"]);
        }
        header("location: " . getBaseAddress(). "DashBoard/login");
    }

    function buscar($param)
    {
        $this->layout = "layoutDashBoard";
        $d["title"] = Constantes::BUSCARUSUARIODASHBOARDTITLE;

        $usuario = new Usuario();
        $usuario->traerUsuarioPorUserName($param[0]);
        $d["palabraBuscada"] = $param[0];
        $d["usuario"] = $usuario;

        $this->set($d);
        $this->render(Constantes::BUSCARUSUARIODAHBOARDVIEW);
    }

    function banear($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $usuario =  new Usuario();

        $usuario->setId($data->usuarioId);
        $usuario->setFechaBaneo($data->fechaBaneo);

        $usuario->banear();

        echo json_encode(true);

    }

    function desbanear($json)
    {
        header("Content-type: application/json");

        $data = json_decode(utf8_decode($json['data']));

        $usuario = new Usuario();

        $usuario->setId($data->usuarioId);

        $usuario->desbanear();

        echo json_encode(true);

    }

    function facturar($param)
    {
        $this->layout = "layoutDashBoard";
        $d["title"] = Constantes::FACTURACIONDASHBOARDTITLE;

        $compra = new Compra();
        $compras = [];
        $compras = $compra->traerListaDeCompras($param["usuarioFacturarId"]);

        $registroCompras = [];

        foreach ($compras as $compra){
            $registroCompra = new RegistroCompra();
            $registroCompras = $registroCompra->traerRegistrosCompras($compra->getId());
        }

        $d["compra"] = $compras;
        $d["registroCompras"] = $registroCompras;

        $this->set($d);
        $this->render(Constantes::FACTURACIONDASHBOARDVIEW);
    }

}