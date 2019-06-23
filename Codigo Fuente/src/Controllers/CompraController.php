<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 12:13
 */

class CompraController extends Controller
{
    function comprar($json)
    {
        $compra = new Compra();

        $compra->setFechaCompra(date("Y-m-d H:i:s"));

        $data = json_decode(utf8_decode($json['data']));

        $total = 0;

        $producto = new Producto();

        $compraProductosDto = [];

        foreach ($data as $fila) {
            $producto->traerProducto($fila->id);

            $total += $producto->getPrecio() * $fila->cantidad;

            if(($producto->getCantidad() - $fila->cantidad) < 0) {
                throw new CantidadProductoNegativaException("La cantidad pedida del producto con id " . $fila->id . " supera al stock disponible", CodigoError::CantidadProductoNegativa);
            }

            $producto->setCantidad($producto->getCantidad() - $fila->cantidad);

            $compraProductoDto = new CompraProductoDto();

            $compraProductoDto->cantidad = $fila->cantidad;

            $compraProductoDto->productoId = $fila->id;

            $compraProductosDto[] = $compraProductoDto;

            if(!$producto->actualizarProducto())
                throw new SQLUpdateException("No se ha podido actualizar el stock del producto con id " . $producto->getId(), CodigoError::ErrorUpdateSQL);
        }

        $compra->setCompradorId(unserialize($_SESSION["session"])->getId());
        $compra->setTotal($total);

        if(!$compra->realizarCompra())
            throw new SQLInsertException("No se ha podido realizar su compra debido a un error interno del sistema", CodigoError::ErrorInsertSQL);

        $compraProducto = new CompraProducto();

        foreach ($compraProductosDto as $compraProductoDto) {
            $compraProducto->setProductoId($compraProductoDto->productoId);
            $compraProducto->setCantidad($compraProductoDto->cantidad);
            $compraProducto->setCompraId($compra->getId());

            if(!$compraProducto->insertarComprarProducto())
                throw new SQLInsertException(CodigoError::ErrorInsertSQL, "No se ha podido registrar el producto de id " . $compraProducto->getProductoId() . " comprado");
        }

        unset($_SESSION['carrito']);

        echo json_encode(true);
    }
}