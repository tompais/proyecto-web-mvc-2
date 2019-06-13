<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 7/6/2019
 * Time: 17:39
 */

class BuscarController extends Controller
{
    function buscarProductoPorNombre($param)
    {
        header("Content-type: application/json");

        $producto = new Producto();

        $productos = $producto->buscarMejoresProductosPorNombre(str_replace("%20", " ", $param[0]));

        $productosDto = [];

        foreach ($productos as $p) {
            $productoDto = new ProductoDto();

            $productoDto->id = $p->getId();
            $productoDto->nombre = $p->getNombre();
            $productoDto->precio = $p->getPrecio();
            $productoDto->estado = new EstadoDto();
            $productoDto->estado->id = $p->getEstado()->getId();
            $productoDto->estado->nombre = $p->getEstado()->getNombre();

            $productosDto[] = $productoDto;
        }

        echo json_encode($productosDto);
    }

    function productos($param)
    {
        $d["title"] = Constantes::BUSQUEDATITLE;

        $producto = new Producto();
        $imagen = new Imagen();

        $d["palabra"] = base64_decode($param[0]);
        $d["productos"] = $producto->listaProdutosPorNombre(base64_decode($param[0]));

        $imagenes = [];
        $d["imagenes"] = [];

        foreach($d["productos"] as $p) {
            if(!$imagen->traerImagenPrincipal($p->getId()))
                throw new ImagenPrincipalNoEncontradaException("No se ha encontrado la Imagen Principal para el producto con Id " . $p->getId(), CodigoError::ImagenPrincipalNoEncontrada);

            $imagenDto = new ImagenDto();

            $imagenDto->id = $imagen->getId();
            $imagenDto->nombre = $imagen->getNombre();

            $imagenes[] = $imagenDto;
        }

        $d["imagenes"] = $imagenes;

        $this->set($d);
        $this->render(Constantes::BUSQUEDAVIEW);
    }
}