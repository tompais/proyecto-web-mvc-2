<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 18/6/2019
 * Time: 19:17
 */

class CarritoController extends Controller
{
    function agregar($json)
    {
        header("Content-type: application/json");
        $data = json_decode(utf8_decode($json['data']));

        if(!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }

        if(!in_array($data->idProducto, $_SESSION["carrito"])) {
            $_SESSION["carrito"][] = $data->idProducto;
        }

        echo json_encode(true);
    }

    function mostrar()
    {
        $d["title"] = Constantes::CARRITOCOMPRASTITLE;
        $d["publicaciones"] = [];

        if(isset($_SESSION["carrito"])) {
            foreach ($_SESSION["carrito"] as $item) {
                $producto = new Producto();
                $imagen = new Imagen();
                $producto->traerProducto($item);
                $imagen->traerImagenPrincipal($producto->getId());

                $d["publicaciones"][] = new PublicacionViewModel($producto, $imagen);
            }
        }
        $this->set($d);
        $this->render(Constantes::CARRITOCOMPRASVIEW);
    }

    function eliminarDelCarrito($json)
    {
        header("Content-type: application/json");
        $data = json_decode(utf8_decode($json['data']));

        array_splice($_SESSION["carrito"], array_search($data->idProducto, $_SESSION["carrito"]));

        echo json_encode($data->idProducto);
    }
}