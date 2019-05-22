<?php

class ProductosController extends Controller
{
    function misProductos()
    {
        $d["title"] = Constantes::PRODUTOSTITLE;
        $this->set($d);
        $this->render(Constantes::PRODUCTOSVIEW);
    }

    function alta($publicacion)
    {
        $producto = new Producto();
        $imagen = new Imagen();
        $usuario = new Usuario();
        $categoria = new Categoria();

        $sesion = unserialize($_SESSION["session"]);

        $usuario->obtenerRegistro($sesion->getId());

        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $categoria->obtenerIdByNombre($publicacion["categoriaProducto"]);
        $producto->setCategoriaId($categoria->getId());
        $producto->setUsuarioId($sesion->getId());
        $producto->setUsuario($usuario);
        $producto->setDescripcion($publicacion["descripcionProducto"]);
        $producto->setFechaAlta(date("Y-m-d"));

        $idProducto = $producto->insertarProducto();

        if(isset($_FILES["imagenProducto"]["name"]))
        {
            
            $total = count($_FILES["imagenProducto"]["name"]);
            
            for($id = 0; $id < $total; $id++)
            {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["imagenProducto"]["name"][$id];
                $ruta .= basename($nombreImg);
                $tmp = $_FILES["imagenProducto"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($nombreImg);
                $imagen->setProductoId($idProducto);
                $imagen->setProducto($producto);
                $imagen->insertarImagen();
            }
        }

        header("location: " . getBaseAddress() . "Productos/misProductos");

    }

    function modificar($publicacion)
    {

    }

    function baja($publicacion)
    {

    }
}