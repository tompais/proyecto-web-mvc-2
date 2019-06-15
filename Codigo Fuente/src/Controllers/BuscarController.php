<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 7/6/2019
 * Time: 17:39
 */

class BuscarController extends Controller
{
    function buscarProductoPorNombre($json)
    {
        header("Content-type: application/json");

        $producto = new Producto();

        $nombres = $producto->getNombresMejoresProductosPorFrase(json_decode(json_encode($json))->producto);

        $resultados = [];

        foreach ($nombres as $nombre) {
            $searchResponseDto = new SearchResponseDto();

            $searchResponseDto->name = $nombre;

            $resultados[] = $searchResponseDto;
        }

        echo json_encode($resultados);
    }

    function productos($param)
    {
        $d["title"] = Constantes::BUSQUEDATITLE;

        $producto = new Producto();
        $imagen = new Imagen();

        $d["palabra"] = $param[0];
        $d["productos"] = $producto->listaProdutosPorNombre($param[0]);

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