<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 12:11
 */

class CompraProducto extends Model
{
    private $id;
    private $productoId;
    private $producto;
    private $compraId;
    private $compra;
    private $cantidad;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * @param mixed $productoId
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param mixed $producto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    /**
     * @return mixed
     */
    public function getCompraId()
    {
        return $this->compraId;
    }

    /**
     * @param mixed $compraId
     */
    public function setCompraId($compraId)
    {
        $this->compraId = $compraId;
    }

    /**
     * @return mixed
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * @param mixed $compra
     */
    public function setCompra($compra)
    {
        $this->compra = $compra;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function insertarComprarProducto()
    {
        $array = [
            "ProductoId" => $this->getProductoId(),
            "CompraId" => $this->getCompraId(),
            "Cantidad" => $this->getCantidad()
        ];

        $id = $this->insert($array);

        if($id)
            $this->setId($id);

        return $id;
    }
}