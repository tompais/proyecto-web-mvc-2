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
            $request->controller = "Index";
            $request->action = "index";
            $request->params = [];
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
}
?>