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
        $sesion = unserialize($_SESSION["session"]);


        $producto->traerProducto($publicacion["producto"]);
        $categoria->traerCategoria($producto->getCategoriaId());
        $usuario->traerUsuario($producto->getUsuarioId());

        $productos = "";

        if ($productos = $producto->traerListaProductos($sesion->getId())) {
            $imagen = new Imagen();

            $imagenes = [];

            foreach ($productos as $producto) {
                $imgProduc = $imagen->traerListaImagenes($producto->getId());

                foreach ($imgProduc as $imgP)
                    array_push($imagenes, $imgP);
            }

            $d["productos"] = $productos;
            $d["imagenes"] = $imagenes;
        }

        $d["productos"] = $productos;
        $d["imagenes"] = $imagenes;

        $d["producto"] = $producto;
        $d["categoria"] = $categoria;
        $d["usuario"] = $usuario;


        $this->set($d);
        $this->render(Constantes::PUBLICACIONVIEW);
    }
}