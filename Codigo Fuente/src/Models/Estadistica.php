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

    public function insertarProductosBuscados($productos){
        foreach ($productos as $producto){
            $row = $this->pageRows(0, 1, "ProductoId = " . $producto->getId(). " AND TipoEstadistica = 1");
            if(!$row){
                $array = [
                    "ProductoId" => $producto->getId(),
                    "CategoriaId" => $producto->getCategoriaId(),
                    "Cantidad" => 1,
                    "TipoEstadistica" => 1
                ];
                $this->insert($array);
            }else{
                $row[0]["Cantidad"] = $row[0]["Cantidad"] + 1;

                if (!$this->update($row[0])) {
                    $row = null;
                    break;
                }
            }
        }
    }

    public function traerLosProductosMasBuscados($cantidad){
        $rows = $this->pageRows(0, $cantidad, "TipoEstadistica = 1 ORDER by Cantidad DESC");
        $productos = array();
        foreach ($rows as $row) {
            $producto = new Producto();
            $producto->traerProducto($row["ProductoId"]);
            $producto->setCantidad($row["Cantidad"]);
            $productos[] = $producto;
        }

        return $productos;
    }

    public function insertarCategoriasBuscadas($productos){

        foreach ($productos as $producto){
            $row = $this->pageRows(0, 1, "CategoriaId = " . $producto->getCategoriaId(). " AND TipoEstadistica = 2");
            if(!$row){
                $array = [
                    "ProductoId" => $producto->getId(),
                    "Cantidad" => 1,
                    "CategoriaId" => $producto->getCategoriaId(),
                    "TipoEstadistica" => 2
                ];
                $this->insert($array);
            }else{
                $row[0]["Cantidad"] = $row[0]["Cantidad"] + 1;

                if (!$this->update($row[0])) {
                    $row = null;
                    break;
                }
            }
        }
    }

    public function traerLasCategoriasMasBuscados($cantidad){
        $rows = $this->pageRows(0, $cantidad, "TipoEstadistica = 2 ORDER by Cantidad DESC");
        $productos = array();
        foreach ($rows as $row) {
            $producto = new Producto();
            $producto->traerProducto($row["ProductoId"]);
            $producto->setCantidad($row["Cantidad"]);
            $productos[] = $producto;
        }

        return $productos;
    }

}