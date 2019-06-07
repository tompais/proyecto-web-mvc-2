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

        $productos = $producto->traerProductosPorNombre($param[0]);

        $productosDto = [];

        foreach ($productos as $p) {
            $productoDto = new ProductoDto();

            $productoDto->nombre = $p->getNombre();

            $productosDto[] = $productoDto;
        }

        echo json_encode($productosDto);
    }
}