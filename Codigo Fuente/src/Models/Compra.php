<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 12:10
 */

class Compra extends Model
{
    private $id;
    private $compradorId;
    private $comprador;
    private $fechaCompra;
    private $total;

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
    public function getCompradorId()
    {
        return $this->compradorId;
    }

    /**
     * @param mixed $compradorId
     */
    public function setCompradorId($compradorId)
    {
        $this->compradorId = $compradorId;
    }

    /**
     * @return mixed
     */
    public function getComprador()
    {
        return $this->comprador;
    }

    /**
     * @param mixed $comprador
     */
    public function setComprador($comprador)
    {
        $this->comprador = $comprador;
    }

    /**
     * @return mixed
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }

    /**
     * @param mixed $fechaCompra
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function realizarCompra()
    {
        $array = [
            "CompradorId" => $this->getCompradorId(),
            "Total" => $this->getTotal(),
            "FechaCompra" => $this->getFechaCompra()
        ];

        $id = $this->insert($array);

        if($id)
            $this->setId($id);

        return $id;
    }
}