<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 10:55
 */

class DashBoardController extends Controller
{
    function inicio()
    {
        $this->layout = "layoutDashBoard";
        $d["title"] = Constantes::DASHBOARDTITLE;
        $this->set($d);
        $this->render(Constantes::INICIODASHBOARDVIEW);
    }
}