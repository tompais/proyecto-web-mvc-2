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

        $productos = $producto->buscarMejoresProductosPorNombre($param[0]);

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

        $this->render(Constantes::BUSQUEDAVIEW);
    }
}