<?php

class Producto extends Model
{
    private $id;
    private $nombre;
    private $precio;
    private $categoriaId;
    private $categoria;
    private $usuarioId;
    private $usuario;
    private $descripcion;
    private $fechaBaja;
    private $fechaAlta;

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

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }

    public function insertarProducto()
    {
        $array = [
            "Nombre" => $this->getNombre(),
            "Precio" => $this->getPrecio(),
            "CategoriaId" => $this->getCategoriaId(),
            "UsuarioId" => $this->getUsuarioId(),
            "Descripcion" => $this->getDescripcion(),
            "FechaAlta" => $this->getFechaAlta()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function traerListaProductos($pk)
    {
        return $this->pageRows(0, PHP_INT_MAX, "UsuarioId = $pk");
    }

    public function validarNombre()
    {
        return FuncionesUtiles::esOracion($this->nombre)
            && ($cantLetras = strlen($this->nombre)) <= 15
            && $cantLetras >= 3;
    }

    public function validarPrecio()
    {
        return (FuncionesUtiles::esEntero($this->precio)
                || FuncionesUtiles::esDecimal($this->precio))
            && strlen($this->precio) > 0;
    }

    public function validaDescripcion()
    {
        return FuncionesUtiles::esOracion($this->descripcion)
            && FuncionesUtiles::esCadenaNoNulaOVacia($this->descripcion);
    }

}

?>