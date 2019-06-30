<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 29/6/2019
 * Time: 19:43
 */

class Review extends Model
{
    private $id;
    private $calificacion;
    private $detalle;
    private $productoId;
    private $producto;

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
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * @param mixed $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
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
}