<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 10:55
 */

class HomeController extends Controller
{
    function home()
    {
        $d["title"] = Constantes::MAINTITLE;
        $this->set($d);
        $this->render(Constantes::HOMEVIEW);
    }
}