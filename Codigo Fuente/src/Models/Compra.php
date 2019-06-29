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
    private $facturada;

    /**
     * @return mixed
     */
    public function getFacturada()
    {
        return $this->facturada;
    }

    /**
     * @param mixed $facturada
     */
    public function setFacturada($facturada)
    {
        $this->facturada = $facturada;
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
            "FechaCompra" => $this->getFechaCompra(),
            "Facturada" => "No Facturada"
        ];

        $id = $this->insert($array);

        if($id)
            $this->setId($id);

        return $id;
    }

    public function traerUltimasCompras($pk)
    {
        $compras = array();

        $rows = $this->pageRows(0, 5, "CompradorId = $pk ORDER BY FechaCompra DESC");

        foreach($rows as $row)
        {
            $compra = new Compra();
            $compra->db->disconnect();
            $compra->setId($row["Id"]);
            $compra->setCompradorId($row["CompradorId"]);
            $compra->setTotal($row["Total"]);
            $compra->setFechaCompra($row["FechaCompra"]);
            $compras[] = $compra;
        }

        return $compras;
    }

    public function traerCompra($pk)
    {
        $compra = $this->selectByPk($pk);

        $this->setId($compra["Id"]);
        $this->setCompradorId($compra["CompradorId"]);
        $this->setTotal($compra["Total"]);
        $this->setFechaCompra($compra["FechaCompra"]);
    }

    public function traerListaDeCompras ($pk){

        $compras = array();

        $mesActual = date("n");

        $rows = $this->pageRows(0, PHP_INT_MAX, "CompradorId = $pk and month(FechaCompra) like $mesActual and Facturada like 'No Facturada' ");

        foreach($rows as $row)
        {
            $compra = new Compra();
            $compra->db->disconnect();
            $compra->setId($row["Id"]);
            $compra->setCompradorId($row["CompradorId"]);
            $compra->setTotal($row["Total"]);
            $compra->setFechaCompra($row["FechaCompra"]);
            $compras[] = $compra;
        }

        return $compras;

    }

    public function actualizarFacturado($pk)
    {
        $mesActual = date("n");

        $rows = $this->pageRows(0, PHP_INT_MAX, "CompradorId = $pk and month(FechaCompra) like $mesActual and Facturada like 'No Facturada' ");

        if($rows) {
            foreach($rows as $row) {
                $row["Facturada"] = "Facturado";

                if(!$this->update($row)) {
                    $rows = null;
                    break;
                }
            }
        }

    }

}