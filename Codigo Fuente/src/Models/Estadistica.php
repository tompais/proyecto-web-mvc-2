<?php


class Estadistica extends Model
{
    private $id;
    private $productoId;
    private $cantidad;
    private $tipoEstadistica;

    /**
     * @return mixed
     */
    public function getTipoEstadistica()
    {
        return $this->tipoEstadistica;
    }

    /**
     * @param mixed $tipoEstadistica
     */
    public function setTipoEstadistica($tipoEstadistica)
    {
        $this->tipoEstadistica = $tipoEstadistica;
    }

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
}