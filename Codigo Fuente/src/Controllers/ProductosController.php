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
        
        if($productos = $producto->traerListaProductos($sesion->getId()))
        {
            $imagen = new Imagen();

            $imagenes = [];
            
            foreach($productos as $producto)
            {
                $imgProduc = $imagen->traerListaImagenes($producto->getId());

                foreach($imgProduc as $imgP)
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
        $imagen = new Imagen();
        $usuario = new Usuario();

        $sesion = unserialize($_SESSION["session"]);

        $usuario->getUsuarioById($sesion->getId());

        if ($producto->validarNombre($publicacion["nombreProducto"])){

            throw new NombreInvalidoException("El nombre del producto es incorrecto", CodigoError::NombreProductoInvalido);

        } else if ($producto->validarPrecio($publicacion["precioProducto"])){

            throw new PrecioInvalidoException("El precio del producto es incorrecto", CodigoError::PrecioProductoInvalido);

        } else if ($producto->validarCateoria($publicacion["categoriaProducto"])) {

            throw new CategoriasInvalidoException("La categoria del producto es incorrecto", CodigoError::CategoriaProductoInvalido);

        } else if ($producto->validarDescripcion($publicacion["descripcionProducto"])){

            throw new DescripcionInvalidoException("La descripcion del producto es incorrecto", CodigoError::DescripcionProductoInvalido);

        } else {
            $producto->setNombre($publicacion["nombreProducto"]);
            $producto->setPrecio($publicacion["precioProducto"]);
            $producto->setCategoriaId($publicacion["categoriaProducto"]);
            $producto->setUsuarioId($sesion->getId());
            $producto->setDescripcion($publicacion["descripcionProducto"]);
            $producto->setFechaAlta(date("Y-m-d H:i:s"));

            $idProducto = $producto->insertarProducto();

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
                    $imagen->setProductoId($idProducto);
                    $imagen->insertarImagen();
                }
            }

            header("location: " . getBaseAddress() . "Productos/misProductos");
        }
    }

    function modificar($publicacion)
    {

    }

    function eliminar($publicacion)
    {

    }
}
