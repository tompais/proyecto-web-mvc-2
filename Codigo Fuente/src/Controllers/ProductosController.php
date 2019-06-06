<?php

class ProductosController extends Controller
{
    function misProductos()
    {

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

    function agregarProducto()
    {
        $d['title'] = Constantes::AGREGARPRODUCTOTITLE;

        $categoria = new Categoria();
        $estado = new Estado();

        $d["categorias"] = $categoria->traerListaCategorias();
        $d["estados"] = $estado->getAllEstados();

        $this->set($d);
        $this->render(Constantes::ALTAPRODUCTO);
    }

    function alta($publicacion)
    {
        $producto = new Producto();

        $producto->setFechaAlta(date("Y-m-d H:i:s"));
        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $producto->setEstadoId($publicacion["estadoProducto"]);
        $producto->setCategoriaId($publicacion["categoriaProducto"]);

        $producto->setUsuarioId(unserialize($_SESSION["session"])->getId());

        $producto->setDescripcion($publicacion["descripcionProducto"]);

        if(!$producto->validarProducto())
            throw new ProductoInvalidoException("Los datos del producto no son válidos", CodigoError::ProductoInvalido);

        if(!$producto->insertarProducto())
            throw new SQLInsertException("Error al insertar el producto", CodigoError::ErrorInsertSQL);

        $imagen = new Imagen();

        if(!is_dir(ROOT . "Webroot/img/productos")) {
            mkdir(ROOT . "Webroot/img/productos", 0777, true);
        }

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

    function editarProducto($publicacion)
    {
        $d['title'] = Constantes::EDITARPRODUCTOTITLE;

        $categoria = new Categoria();
        $estado = new Estado();
        $producto = new Producto();

        $producto->traerProducto($publicacion["producto"]);

        $d["categorias"] = $categoria->traerListaCategorias();
        $d["estados"] = $estado->getAllEstados();
        $d["producto"] = $producto;

        $this->set($d);
        $this->render(Constantes::EDITARPRODUCTO);
    }

    function editar($publicacion)
    {
        $producto = new Producto();
        
        $producto->actualizarProducto($publicacion);

        if (isset($_FILES["imagenProducto"]["name"])) {
            
            $imagen = new Imagen();

            $imagenes = $imagen->traerListaImagenes($publicacion["idProducto"]);
            
            foreach($imagenes as $img)
                unlink(ROOT . "Webroot/img/productos/" . $img->getNombre());

            $total = count($_FILES["imagenProducto"]["name"]);
    
            for ($id = 0; $id < $total; $id++) {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["imagenProducto"]["name"][$id];
    
                $temp = explode(".", $nombreImg);
                $newNombre = microtime(true) . '.' . end($temp);
    
                $ruta .= basename($newNombre);
                $tmp = $_FILES["imagenProducto"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);

                if($id < count($imagenes))
                {
                    $imagen->setNombre($newNombre);
                    $imagen->cambiarImagen($imagenes[$id]->getId());
                }
                else
                {
                    $imagen->setNombre($newNombre);
                    $imagen->setProductoId($publicacion["idProducto"]);
                    $imagen->insertarImagen();
                }
            }

            if(count($imagenes) > $total)
            {
                for($i = $total; $i < count($imagenes); $i++)
                    $imagenes[$i]->eliminarImagen();
            }

        }

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }

    function eliminar($publicacion)
    {
        $imagen = new Imagen();
        $producto = new Producto();

        $imagenes = $imagen->traerListaImagenes($publicacion["idProducto"]);

        foreach($imagenes as $img)
        {
            unlink(ROOT . "Webroot/img/productos/" . $img->getNombre());
            $img->eliminarImagen();
        }

        $producto->eliminarProducto($publicacion["idProducto"]);

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }
}
