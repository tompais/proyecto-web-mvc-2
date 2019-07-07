<?php


class Estadistica extends Model
{
    private $id;
    private $Nombre;
    private $cantidad;
    private $tipoEstadistica;
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

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
            $nombre = $producto->getNombre();
            $row = $this->pageRows(0, 1, "Nombre = '$nombre' AND TipoEstadistica = 1");

            if(!$row){

                $array = [
                    "Nombre" => $nombre,
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
        $estadisticas = array();
        foreach ($rows as $row) {
            $estadistica = new Estadistica();
            $estadistica->setNombre($row["Nombre"]);
            $estadistica->setCantidad($row["Cantidad"]);
            $estadisticas[] = $estadistica;
        }

        return $estadisticas;
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