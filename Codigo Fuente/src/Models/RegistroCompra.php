<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 12:11
 */

class RegistroCompra extends Model
{
    private $id;
    private $compraId;
    private $compra;
    private $cantidad;
    private $nombreProducto;
    private $precioUnitario;
    private $nombreImagenPrincipal;
    private $tipoMetodoEntrega;
    private $detalleEntrega;

    /**
     * @return mixed
     */
    public function getTipoMetodoEntrega()
    {
        return $this->tipoMetodoEntrega;
    }

    /**
     * @param mixed $tipoMetodoEntrega
     */
    public function setTipoMetodoEntrega($tipoMetodoEntrega)
    {
        $this->tipoMetodoEntrega = $tipoMetodoEntrega;
    }

    /**
     * @return mixed
     */
    public function getDetalleEntrega()
    {
        return $this->detalleEntrega;
    }

    /**
     * @param mixed $detalleEntrega
     */
    public function setDetalleEntrega($detalleEntrega)
    {
        $this->detalleEntrega = $detalleEntrega;
    }

    /**
     * @return mixed
     */
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * @param mixed $nombreProducto
     */
    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }

    /**
     * @return mixed
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * @param mixed $precioUnitario
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    }

    /**
     * @return mixed
     */
    public function getNombreImagenPrincipal()
    {
        return $this->nombreImagenPrincipal;
    }

    /**
     * @param mixed $nombreImagenPrincipal
     */
    public function setNombreImagenPrincipal($nombreImagenPrincipal)
    {
        $this->nombreImagenPrincipal = $nombreImagenPrincipal;
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

    public function insertarRegistroCompra()
    {
        $array = [
            "CompraId" => $this->getCompraId(),
            "Cantidad" => $this->getCantidad(),
            "NombreProducto" => $this->getNombreProducto(),
            "PrecioUnitario" => $this->getPrecioUnitario(),
            "NombreImagenPrincipal" => $this->getNombreImagenPrincipal(),
            "TipoMetodoEntrega" => $this->getTipoMetodoEntrega(),
            "DetalleEntrega" => $this->getDetalleEntrega()
        ];

        $id = $this->insert($array);

        if($id)
            $this->setId($id);

        return $id;
    }

    public function traerComprasProductos($pk)
    {
        $comprasProductos = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "CompraId = $pk");

        foreach($rows as $row)
        {
            $compraProducto = new RegistroCompra();
            $compraProducto->db->disconnect();
            $compraProducto->setId($row["Id"]);
            $compraProducto->setCompraId($row["CompraId"]);
            $compraProducto->setCantidad($row["Cantidad"]);
            $compraProducto->setProductoId($row["ProductoId"]);
            $comprasProductos[] = $compraProducto;
        }

        return $comprasProductos;
    }
}