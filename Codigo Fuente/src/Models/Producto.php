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
    private $estado;
    private $estadoId;
    private $descripcion;
    private $fechaBaja;
    private $fechaAlta;

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getEstadoId()
    {
        return $this->estadoId;
    }

    public function setEstadoId($estadoId)
    {
        $this->estadoId = $estadoId;
    }

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
            "FechaAlta" => $this->getFechaAlta(),
            "EstadoId" => $this->getEstadoId()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function traerListaProductos($pk)
    {
        $productos = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "UsuarioId = $pk AND FechaBaja IS NULL");

        foreach($rows as $row)
        {
            $producto = new Producto();
            $producto->setId($row["Id"]);
            $producto->setNombre($row["Nombre"]);
            $producto->setPrecio($row["Precio"]);
            $producto->setCategoriaId($row["CategoriaId"]);
            $producto->setUsuarioId($row["UsuarioId"]);
            $producto->setDescripcion($row["Descripcion"]);
            $producto->setFechaAlta($row["FechaAlta"]);
            $productos[] = $producto;
        }

        return $productos;
    }

    public function traerProducto($pk)
    {
        $producto = $this->selectByPk($pk);

        $this->setId($producto["Id"]);
        $this->setNombre($producto["Nombre"]);
        $this->setPrecio($producto["Precio"]);
        $this->setCategoriaId($producto["CategoriaId"]);
        $this->setUsuarioId($producto["UsuarioId"]);
        $this->setDescripcion($producto["Descripcion"]);
        $this->setFechaAlta($producto["FechaAlta"]);
    }

    public function traerProductosPorNombre($nombre)
    {
        $rows = $this->pageRows(0, 5, "Nombre like '%$nombre%' ORDER BY Precio AND EstadoId");

        $productos = [];

        foreach ($rows as $row) {
            $producto = new Producto();
            $producto->db->disconnect();

            $producto->setNombre($row["Nombre"]);

            $productos[] = $producto;
        }

        return $productos;
    }
    public function actualizarProducto($publicacion)
    {
        $array = [
            "Id" => $publicacion["idProducto"],
            "Nombre" => $publicacion["nombreProducto"],
            "Precio" => $publicacion["precioProducto"],
            "CategoriaId" => $publicacion["categoriaProducto"],
            "Descripcion" => $publicacion["descripcionProducto"]
        ];

        return $this->update($array);
    }

    public function eliminarProducto($pk)
    {
        $producto = $this->selectByPk($pk);

        $producto["FechaBaja"] = date("Y-m-d H:i:s");

        return $this->update($producto);
    }

    public function validarNombre()
    {
        return FuncionesUtiles::esOracionCompuesta($this->nombre)
            && ($cantLetras = strlen($this->nombre)) <= 50
            && $cantLetras >= 5;
    }

    public function validarPrecio()
    {
        return (FuncionesUtiles::esEntero($this->precio) || FuncionesUtiles::esCadenaNumerica($this->precio))
                && FuncionesUtiles::esMayorACero($this->precio);
    }

    public function validarCategoria()
    {
        $this->categoria = new Categoria();

        $validacion = (FuncionesUtiles::esEntero($this->categoriaId) || FuncionesUtiles::esCadenaNumerica($this->categoriaId))
            && FuncionesUtiles::esMayorACero($this->categoriaId);

        if($validacion)
        {
            $this->categoria->setId($this->getCategoriaId());

            $validacion = $this->categoria->existeCategoriaDB();
        }

        return $validacion;
    }

    public function validarDescripcion()
    {
        return ($cantLetras = strlen($this->descripcion)) <= 200
            && $cantLetras >= 0;
    }

    public function validarEstado()
    {
        return FuncionesUtiles::esMayorACero($this->getEstadoId()) &&
            ($this->getEstadoId() == Estados::Nuevo || $this->getEstadoId() == Estados::Usado || $this->getEstadoId() == Estados::Reformado);
    }

    public function validarUsuario()
    {
        $this->setUsuario(new Usuario());
        return $this->getUsuario()->getUsuarioById($this->getUsuarioId());
    }

    public function validarProducto()
    {
        return $this->validarNombre() && $this->validarDescripcion() && $this->validarPrecio() && $this->validarCategoria() && $this->validarEstado() && $this->validarUsuario();
    }
}

?>