<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = substr(trim($url), strripos(trim($url), "/src/"));
        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 2);

        if (!strcmp($explode_url[0], ""))
        {
            $request->controller = "Home";
            $request->action = "inicio";
            $request->params = [];
        }
        else if(self::isSecurityController($explode_url[0]) && !self::isCloseSessionAction($explode_url[1]) && isset($_SESSION["session"]))
        {
            header("Location: " . getBaseAddress());
        }
        else if (self::isProductController($explode_url[0]) && !isset($_SESSION["session"]))
        {
            header("Location: " . getBaseAddress() . "Seguridad/login");
        }
        else
        {
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
            if($_POST)
                $request->params = array_merge($request->params, $_POST);
        }
    }

    private static function isProductController($controller)
    {
        return !strcasecmp($controller, 'Producto');
    }

    private static function isSecurityController($controller)
    {
        return !strcasecmp($controller, 'Seguridad');
    }

    private static function isCloseSessionAction($action)
    {
        return !strcasecmp($action, Constantes::CERRARSESIONACTION);
    }
}
?>