<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 12:13
 */

class CompraController extends Controller
{
    function comprar($json)
    {
        $compra = new Compra();

        $compra->setFechaCompra(date("Y-m-d H:i:s"));

        $data = json_decode(utf8_decode($json['data']));

        $total = 0;

        $producto = new Producto();

        $compraProductosDto = [];

        foreach ($data as $fila) {
            $producto->traerProducto($fila->id);

            $total += $producto->getPrecio() * $fila->cantidad;

            if(($producto->getCantidad() - $fila->cantidad) < 0) {
                throw new CantidadProductoNegativaException("La cantidad pedida del producto con id " . $fila->id . " supera al stock disponible", CodigoError::CantidadProductoNegativa);
            }

            $producto->setCantidad($producto->getCantidad() - $fila->cantidad);

            $compraProductoDto = new CompraProductoDto();

            $compraProductoDto->cantidad = $fila->cantidad;

            $compraProductoDto->productoId = $fila->id;

            $compraProductosDto[] = $compraProductoDto;

            if(!$producto->actualizarProducto())
                throw new SQLUpdateException("No se ha podido actualizar el stock del producto con id " . $producto->getId(), CodigoError::ErrorUpdateSQL);
        }

        $compra->setCompradorId(unserialize($_SESSION["session"])->getId());
        $compra->setTotal($total);

        if(!$compra->realizarCompra())
            throw new SQLInsertException("No se ha podido realizar su compra debido a un error interno del sistema", CodigoError::ErrorInsertSQL);

        $compraProducto = new CompraProducto();

        foreach ($compraProductosDto as $compraProductoDto) {
            $compraProducto->setProductoId($compraProductoDto->productoId);
            $compraProducto->setCantidad($compraProductoDto->cantidad);
            $compraProducto->setCompraId($compra->getId());

            if(!$compraProducto->insertarComprarProducto())
                throw new SQLInsertException(CodigoError::ErrorInsertSQL, "No se ha podido registrar el producto de id " . $compraProducto->getProductoId() . " comprado");
        }

        unset($_SESSION['carrito']);

        echo json_encode(true);

    }

    function exito()
    {
        $d["title"] = Constantes::COMPRAEXITOSATITLE;
        $this->set($d);
        $this->render(Constantes::COMPRAEXITOSAVIEW);
    }

    function misCompras()
    {
        $compra = new Compra();
        $compraProducto = new CompraProducto();
        $usuario = new Usuario();

        $sesion = unserialize($_SESSION["session"]);

        $compras = $compra->traerUltimasCompras($sesion->getId());

        $comprasProductos = array();

        foreach($compras as $comp)
            $comprasProductos = array_merge($comprasProductos, $compraProducto->traerComprasProductos($comp->getId()));

        $producto = new Producto();
        $imagen = new Imagen();
        $metodo = new Metodo();

        $publicaciones = array();
        $comprasProductosDto = array();
        $usuariosDto = array();
        $metodosDto = array();
        
        foreach($comprasProductos as $cProducto)
        {
            $productoDto = new ProductoDto();

            $producto->traerProducto($cProducto->getProductoId());

            $productoDto->nombre = $producto->getNombre();

            $productoDto->precio = $producto->getPrecio();

            $metodoDto = new MetodoDto();

            $metodo->traerMetodo($producto->getMetodoId());

            $metodoDto->tipo = $metodo->getTipo();

            $metodosDto[] = $metodoDto;

            $imagenDto = new ImagenDto();

            $imagen->traerImagenCompra($producto->getId());

            $imagenDto->nombre = $imagen->getNombre();

            $compraProductoDto = new CompraProductoDto();

            $compraProductoDto->compraId = $cProducto->getCompraId();

            $compraProductoDto->cantidad = $cProducto->getCantidad();

            $comprasProductosDto[] = $compraProductoDto;

            $publicaciones[] = new PublicacionViewModel($productoDto, $imagenDto);

            $usuario->traerUsuario($producto->getUsuarioId());

            $usuarioDto = new UsuarioDto();

            $usuarioDto->nombre = $usuario->getNombre();
            $usuarioDto->apellido = $usuario->getApellido();
            $usuarioDto->email = $usuario->getEmail();
            $usuarioDto->telefono = $usuario->getTelefonoCelular();

            $usuariosDto[] = $usuarioDto;
        }

        $d["compras"] = $compras;
        $d["comprasProductos"] = $comprasProductosDto;
        $d["publicaciones"] = $publicaciones;
        $d["usuarios"] = $usuariosDto;
        $d["metodos"] = $metodosDto;

        $d["title"] = Constantes::COMPRASTITLE;
        $this->set($d);
        $this->render(Constantes::COMPRASVIEW);
    }
}