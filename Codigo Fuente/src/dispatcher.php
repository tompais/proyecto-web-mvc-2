<?php

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        if(call_user_func_array([$controller, $this->request->action], array($this->request->params)) === false)
            $this->throwError404();
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';
        require($file);
        $controller = new $name();
        return $controller;
    }

    public function throwError404()
    {
        http_response_code(404);
        include ROOT . "Views/NoCompletado/noCompletado.php";
        die();
    }

}
?>