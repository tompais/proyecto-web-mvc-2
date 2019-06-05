<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 10:55
 */

class PublicacionController extends Controller
{
    function publicacion($publicacion)
    {
        $d["title"] = Constantes::PUBLICACIONTITLE;

        $producto = new Producto();
        $categoria = new Categoria();
        $usuario = new Usuario();
        $direccion = new Direccion();

        $producto->traerProducto($publicacion["producto"]);
        $categoria->traerCategoria($producto->getCategoriaId());
        $usuario->traerUsuario($producto->getUsuarioId());
        //$direccion->traerDireccion($usuario->getDireccionId());

        $d["producto"] = $producto;
        $d["categoria"] = $categoria;
        $d["usuario"] = $usuario;
        //$d["direccion"] = $direccion;

        $this->set($d);
        $this->render(Constantes::PUBLICACIONVIEW);
    }
}