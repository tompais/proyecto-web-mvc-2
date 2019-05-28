<?php

class ProductosController extends Controller
{
    function misProductos()
    {
        $categoria = new Categoria();

        $d["categorias"] = $categoria->traerListaCategorias();

        $sesion = unserialize($_SESSION["session"]);

        $producto = new Producto();

        $productos = "";

        if ($productos = $producto->traerListaProductos($sesion->getId())) {
            $imagen = new Imagen();

            $imagenes = [];

            foreach ($productos as $producto) {
                $imgProduc = $imagen->traerListaImagenes($producto->getId());

                foreach ($imgProduc as $imgP)
                    array_push($imagenes, $imgP);
            }

            $d["productos"] = $productos;
            $d["imagenes"] = $imagenes;
        }

        $d["title"] = Constantes::PRODUTOSTITLE;
        $this->set($d);
        $this->render(Constantes::PRODUCTOSVIEW);
    }

    function alta($publicacion)
    {
        $producto = new Producto();

        $producto->setFechaAlta(date("Y-m-d H:i:s"));
        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $producto->setCategoriaId($publicacion["categoriaProducto"]);

        $producto->setUsuarioId(unserialize($_SESSION["session"])->getId());

        $producto->setDescripcion($publicacion["descripcionProducto"]);

        if(!$producto->validarProducto())
            throw new ProductoInvalidoException("Los datos del producto no son válidos", CodigoError::ProductoInvalido);

        if(!$producto->insertarProducto())
            throw new SQLInsertException("Error al insertar el producto", CodigoError::ErrorInsertSQL);

        $imagen = new Imagen();

        if (isset($_FILES["imagenProducto"]["name"])) {

            $total = count($_FILES["imagenProducto"]["name"]);

            for ($id = 0; $id < $total; $id++) {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["imagenProducto"]["name"][$id];

                $temp = explode(".", $nombreImg);
                $newNombre = microtime(true) . '.' . end($temp);

                $ruta .= basename($newNombre);
                $tmp = $_FILES["imagenProducto"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($newNombre);
                $imagen->setProductoId($producto->getId());
                $imagen->insertarImagen();
            }
        } else {
            throw new ImagenNoInsertadaException("No se ha ingresado ninguna imagen para el producto", CodigoError::ImagenNoInsertada);
        }

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }

    function modificar($publicacion)
    {

    }

    function eliminar($publicacion)
    {

    }
}
