<?php

class ProductosController extends Controller
{

    function misProductos()
    {

        $producto = new Producto();

        $d["cantidadProductos"] = $producto->getCantProductosActivosPropios();

        $d["title"] = Constantes::PRODUTOSTITLE;
        $this->set($d);
        $this->render(Constantes::PRODUCTOSVIEW);
    }

    function agregarProducto()
    {
        $d['title'] = Constantes::AGREGARPRODUCTOTITLE;

        $categoria = new Categoria();
        $estado = new Estado();
        $metodo = new Metodo();

        $d["categorias"] = $categoria->traerListaCategorias();
        $d["estados"] = $estado->getAllEstados();
        $d["metodos"] = $metodo->getAllMetodos();

        $this->set($d);
        $this->render(Constantes::ALTAPRODUCTO);
    }

    function alta($publicacion)
    {
        $producto = new Producto();

        $producto->setFechaAlta(date("Y-m-d H:i:s"));
        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $producto->setCantidad($publicacion["cantidadProducto"]);
        $producto->setEstadoId($publicacion["estadoProducto"]);
        $producto->setCategoriaId($publicacion["categoriaProducto"]);

        $producto->setUsuarioId(unserialize($_SESSION["session"])->getId());

        $producto->setDescripcion($publicacion["descripcionProducto"]);
        $producto->setMetodoId($publicacion["metodoProducto"]);

       if ($publicacion["metodoProducto"] == 1 ){
            $producto->setDetalleEntrega($publicacion["detalleEntregaProducto"]);
        }
        else{
            $producto->setDetalleEntrega("En Espera");
        }

        if (!$producto->validarProducto())
            throw new ProductoInvalidoException("Los datos del producto no son válidos", CodigoError::ProductoInvalido);

        if (!$producto->insertarProducto())
            throw new SQLInsertException("Error al insertar el producto", CodigoError::ErrorInsertSQL);

        $imagen = new Imagen();

        if (!is_dir(ROOT . "Webroot/img/productos")) {
            mkdir(ROOT . "Webroot/img/productos", 0777, true);
        }

        if (isset($_FILES["file"]["name"])) {

            $total = count($_FILES["file"]["name"]);

            for ($id = 0; $id < $total; $id++) {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["file"]["name"][$id];

                $temp = explode(".", $nombreImg);
                $newNombre = TokenHelper::getToken() . '.' . end($temp);

                $ruta .= basename($newNombre);
                $tmp = $_FILES["file"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($newNombre);
                $imagen->setProductoId($producto->getId());
                $imagen->insertarImagen();
            }
        } else {
            throw new ImagenNoInsertadaException("No se ha ingresado ninguna imagen para el producto", CodigoError::ImagenNoInsertada);
        }

        echo json_encode(true);
    }

    function editarProducto($publicacion)
    {
        $d['title'] = Constantes::EDITARPRODUCTOTITLE;

        $categoria = new Categoria();
        $estado = new Estado();
        $metodo = new Metodo();
        $producto = new Producto();
        $imagen = new Imagen();

        $producto->traerProducto($publicacion[0]);
        $d["categorias"] = $categoria->traerListaCategorias();
        $d["estados"] = $estado->getAllEstados();
        $d["metodos"] = $metodo->getAllMetodos();

        $d["producto"] = $producto;


        $d["imagenes"] = $imagen->traerListaImagenes($publicacion[0]);

        $this->set($d);
        $this->render(Constantes::EDITARPRODUCTO);
    }

    function editar($publicacion)
    {
        $sesion = unserialize($_SESSION["session"]);

        $producto = new Producto();
        $producto->setId($publicacion["idProducto"]);
        $producto->setNombre($publicacion["nombreProducto"]);
        $producto->setPrecio($publicacion["precioProducto"]);
        $producto->setEstadoId($publicacion["estadoProducto"]);
        $producto->setCategoriaId($publicacion["categoriaProducto"]);
        $producto->setDescripcion($publicacion["descripcionProducto"]);
        $producto->setCantidad($publicacion["cantidadProducto"]);
        $producto->setMetodoId($publicacion["metodoProducto"]);
        $producto->setUsuarioId($sesion->getId());

        if ($publicacion["metodoProducto"] == 1 ){
            $producto->setDetalleEntrega($publicacion["detalleEntregaProducto"]);
        }
        else{
            $producto->setDetalleEntrega("En Espera");
        }

        if (!$producto->validarProducto())
            throw new ProductoInvalidoException("Los datos del producto no son válidos", CodigoError::ProductoInvalido);
        
        if (!$producto->actualizarProducto())
            throw new SQLUpdateException("Error al realizar la actualizacion del producto", CodigoError::ErrorUpdateSQL);

        if (isset($_FILES["file"]["name"])) {

            $imagen = new Imagen();

            $total = count($_FILES["file"]["name"]);

            for ($id = 0; $id < $total; $id++) {
                $ruta = ROOT . "Webroot/img/productos/";
                $nombreImg = $_FILES["file"]["name"][$id];

                $temp = explode(".", $nombreImg);
                $newNombre = TokenHelper::getToken() . '.' . end($temp);

                $ruta .= basename($newNombre);
                $tmp = $_FILES["file"]["tmp_name"][$id];
                move_uploaded_file($tmp, $ruta);
                $imagen->setNombre($newNombre);
                $imagen->setProductoId($producto->getId());
                $imagen->insertarImagen();
            }

        }

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }

    function eliminarImagen($json)
    {
        header("Content-type: application/json");
        $data = json_decode(utf8_decode($json['data']));
        $imagen = new Imagen();
        $idImagen = $data->idImagen;
        
        $imagen->traerImagen($idImagen);

        unlink(ROOT . "Webroot/img/productos/" . $imagen->getNombre());

        if(!$imagen->eliminarImagen($idImagen)){
            echo json_encode(false);
        }
        echo json_encode($idImagen);
    }

    function eliminar($publicacion)
    {
        $imagen = new Imagen();
        $producto = new Producto();
        
        $imagenes = $imagen->traerListaImagenes($publicacion["idProducto"]);
            
        foreach($imagenes as $img)
            unlink(ROOT . "Webroot/img/productos/" . $img->getNombre());

        if(!$imagen->eliminarImagenesProducto($publicacion["idProducto"])) {
            throw new EliminacionMasivaImagenException("Ocurrió un error al eliminar las imágenes del producto con id " . $publicacion["idProducto"], CodigoError::EliminacionMasivaImagen);
        }

        if(!$producto->eliminarProducto($publicacion["idProducto"])) {
            throw new EliminarProductoException("Ocurrió un error al eliminar el producto con id " . $publicacion["idProducto"], CodigoError::EliminarProducto);
        }

        header("location: " . getBaseAddress() . "Productos/misProductos");
    }

    function publicacion($publicacion)
    {
        $d["title"] = Constantes::PUBLICACIONTITLE;

        $producto = new Producto();
        $categoria = new Categoria();
        $usuario = new Usuario();

        $producto->traerProducto($publicacion[0]);
        $categoria->traerCategoria($producto->getCategoriaId());
        $usuario->traerUsuario($producto->getUsuarioId());

        $imagen = new Imagen();

        $imagenes = $imagen->traerListaImagenes($producto->getId());

        $d["imagenes"] = $imagenes;
        $d["producto"] = $producto;
        $d["categoria"] = $categoria;
        $d["usuario"] = $usuario;


        $this->set($d);
        $this->render(Constantes::PUBLICACIONVIEW);
    }

    function getPublicaciones($data)
    {
        header("Content-type: application/json");

        $producto = new Producto();

        $paginationDataSourceDto = new PaginationDataSourceDto();

        $paginationDataSourceDto->items = [];

        $productos = $producto->getListaProdutosActivosPropios($data["pageNumber"], $data["pageSize"]);

        $imagen = new Imagen();

        $publicaciones = [];

        foreach($productos as $p) {
            if(!$imagen->traerImagenPrincipal($p->getId()))
                throw new ImagenPrincipalNoEncontradaException("No se ha encontrado la Imagen Principal para el producto con Id " . $p->getId(), CodigoError::ImagenPrincipalNoEncontrada);

            $imagenDto = new ImagenDto();

            $imagenDto->id = $imagen->getId();
            $imagenDto->nombre = $imagen->getNombre();

            $productoDto = new ProductoDto();

            $productoDto->id = $p->getId();
            $productoDto->nombre = $p->getNombre();
            $productoDto->estadoId = $p->getEstadoId();
            $productoDto->metodoId = $p->getMetodoId();
            $productoDto->categoriaId = $p->getCategoriaId();
            $productoDto->precio = $p->getPrecio();
            $productoDto->fechaAlta = $p->getFechaAlta();
            $productoDto->cantidad = $p->getCantidad();

            $publicaciones[] = new PublicacionViewModel($productoDto, $imagenDto);
        }

        $paginationDataSourceDto->items = $publicaciones;

        echo json_encode($paginationDataSourceDto);
    }
}
