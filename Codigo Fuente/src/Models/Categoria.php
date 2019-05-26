<?php

class Categoria extends Model
{
    private $id;
    private $nombre;

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

    public function obtenerIdByNombre($nombre)
    {
        $resultado = $this->pageRows(0, 1, "Nombre LIKE '$nombre'");
        $this->setId($resultado[0]["Id"]);
    }

    public function traerListaCategorias()
    {
        return $this->pageRows(0, PHP_INT_MAX);
    }
}

?>