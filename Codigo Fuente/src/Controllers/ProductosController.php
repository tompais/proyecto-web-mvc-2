<?php

class ProductosController extends Controller
{
    function misProductos()
    {
        $sesion = unserialize($_SESSION["session"]);
    
        $producto = new Producto();
        $imagen = new Imagen();

        $productos = $producto->traerListaProductos($sesion->getId());
        $imagenes = $imagen->traerListaImagenes($sesion->getId());

        $_SESSION["productos"] = $productos;
        $_SESSION["imagenes"] = $imagenes;

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
        $producto->setFechaAlta(date("Y-m-d H:i:s"));

        $idProducto = $producto->insertarProducto();

        if(isset($_FILES["imagenProducto"]["name"]))
        {
            
            $total = count($_FILES["imagenProducto"]["name"]);
            
            for($id = 0; $id < $total; $id++)
            {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["imagenProducto"]["name"][$id];

                $temp = explode(".", $nombreImg);
                $newNombre = microtime(true) . '.' . end($temp);

                $ruta .= basename($newNombre);
                $tmp = $_FILES["imagenProducto"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($newNombre);
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
