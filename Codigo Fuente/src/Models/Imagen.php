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

    public function traerListaImagenes($pk)
    {
        $imagenes = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "ProductoId = $pk");

        foreach($rows as $row)
        {
            $imagen = new Imagen();
            $imagen->setId($row["Id"]);
            $imagen->setNombre($row["Nombre"]);
            $imagen->setProductoId($row["ProductoId"]);
            $imagenes[] = $imagen;
        }

        return $imagenes;
    }

    public function cambiarImagen($pk)
    {
        $imagen = $this->selectByPk($pk);

        $imagen["Nombre"] = $this->getNombre();

        return $this->update($imagen);
    }

    public function eliminarImagen()
    {
        return $this->delete($this->getId());
    }

    public function traerImagenPrincipal($productoId)
    {
        $row = $this->pageRows(0, 1, "ProductoId = $productoId");

        if($row) {
            $this->setId($row[0]["Id"]);
            $this->setNombre($row[0]["Nombre"]);
            $this->setProductoId($row[0]["ProductoId"]);
        }

        return $row;
    }
}

?>