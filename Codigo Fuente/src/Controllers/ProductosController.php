<?php

class ProductosController extends Controller
{
    function misProductos()
    {
        $d["title"] = Constantes::PRODUTOSTITLE;
        $this->set($d);
        $this->render(Constantes::PRODUCTOSVIEW);
    }
}
