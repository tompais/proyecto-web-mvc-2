<?php

class Imagen extends Model
{
    private $id;
    private $nombre;
    private $productoId;
    private $producto;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getProductoId()
    {
        return $this->productoId;
    }

    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    public function getProducto()
    {
        return $this->producto;
    }

    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    public function insertarImagen()
    {
        $array = [
            "Nombre" => $this->getNombre(),
            "ProductoId" => $this->getProductoId()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }
}

?>