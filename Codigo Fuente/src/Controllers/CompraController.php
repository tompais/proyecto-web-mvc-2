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

        $imagen = new Imagen();

        $metodo = new Metodo();

        $registrosComprasDto = [];

        foreach ($data as $fila) {
            if(!$producto->traerProducto($fila->id)) {
                throw new ProductoNoEncontradoException("No se ha encontrado un producto con id " . $fila->id, CodigoError::ProductoNoEncontrado);
            }

            $total += $producto->getPrecio() * $fila->cantidad;

            if(($producto->getCantidad() - $fila->cantidad) < 0) {
                throw new CantidadProductoNegativaException("La cantidad pedida del producto con id " . $fila->id . " supera al stock disponible", CodigoError::CantidadProductoNegativa);
            }

            $producto->setCantidad($producto->getCantidad() - $fila->cantidad);

            $registroCompraDto = new RegistroCompraDto();

            $registroCompraDto->cantidad = $fila->cantidad;

            $registroCompraDto->nombreProducto = $producto->getNombre();

            $registroCompraDto->precioUnitario = $producto->getPrecio();

            if(!$imagen->traerImagenPrincipal($fila->id)) {
                throw new ImagenPrincipalNoEncontradaException("No se ha la imagen principal para el producto con id " . $fila->id, CodigoError::ImagenPrincipalNoEncontrada);
            }

            $registroCompraDto->nombreImagenPrincipal = $imagen->getNombre();

            $registroCompraDto->detalleEntrega = $producto->getDetalleEntrega();

            if(!$metodo->traerMetodo($producto->getMetodoId())) {
                throw new MetodoNoEncontradoException("No se ha podido encontrar el método con el id " . $producto->getMetodoId(), CodigoError::MetodoNoEncontrado);
            }

            $registroCompraDto->tipoMetodoEntrega = $metodo->getTipo();

            $registrosComprasDto[] = $registroCompraDto;

            if(!$producto->actualizarProducto())
                throw new SQLUpdateException("No se ha podido actualizar el stock del producto con id " . $producto->getId(), CodigoError::ErrorUpdateSQL);
        }

        $compra->setCompradorId(unserialize($_SESSION["session"])->getId());
        $compra->setTotal($total);

        if(!$compra->realizarCompra())
            throw new SQLInsertException("No se ha podido realizar su compra debido a un error interno del sistema", CodigoError::ErrorInsertSQL);

        $registroCompra = new RegistroCompra();

        foreach ($registrosComprasDto as $registroCompraDto) {
            $registroCompra->setNombreProducto($registroCompraDto->nombreProducto);
            $registroCompra->setNombreImagenPrincipal($registroCompraDto->nombreImagenPrincipal);
            $registroCompra->setPrecioUnitario($registroCompraDto->precioUnitario);
            $registroCompra->setCantidad($registroCompraDto->cantidad);
            $registroCompra->setCompraId($compra->getId());
            $registroCompra->setTipoMetodoEntrega($registroCompraDto->tipoMetodoEntrega);
            $registroCompra->setDetalleEntrega($registroCompraDto->detalleEntrega);

            if(!$registroCompra->insertarRegistroCompra())
                throw new SQLInsertException(CodigoError::ErrorInsertSQL, "No se ha podido registrar el producto de id " . $registroCompra->getProductoId() . " comprado");
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
        $registroCompra = new RegistroCompra();
        $usuario = new Usuario();

        $sesion = unserialize($_SESSION["session"]);

        $compras = $compra->traerUltimasCompras($sesion->getId());

        $registrosCompras = array();

        foreach($compras as $comp)
            $registrosCompras = array_merge($registrosCompras, $registroCompra->traerComprasProductos($comp->getId()));

        $metodo = new Metodo();

        $publicaciones = array();
        $comprasProductosDto = array();
        $usuariosDto = array();
        $metodosDto = array();
        
        foreach($registrosCompras as $rc)
        {
            $metodoDto = new MetodoDto();

            $metodo->traerMetodo($producto->getMetodoId());

            $metodoDto->tipo = $metodo->getTipo();

            $metodosDto[] = $metodoDto;

            $registroCompraDto = new RegistroCompraDto();

            $registroCompraDto->compraId = $rc->getCompraId();

            $registroCompraDto->cantidad = $rc->getCantidad();

            $comprasProductosDto[] = $registroCompraDto;

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