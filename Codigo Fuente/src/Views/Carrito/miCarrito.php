
<script>
    const pathComprar = "<?php echo getBaseAddress() . "Compra/comprar"; ?>";
</script>

<div class="container mt-3 mb-5" id="contenedorCarrito">

    <div class="panel-heading">
        <div class="panel-title py-3">
            <div class="row">
                <div class="col-xl-5 col-sm-5">
                    <h2>Mi Carrito<i class="fa fa-shopping-cart ml-2"></i></h2>
                </div>
            </div>
        </div>
    </div>
        <?php

        if(!isset($_SESSION["carrito"]) || !$publicaciones || !count($publicaciones)) {
            echo "<p class='text-center'>No hay productos agregados al carrito</p>";
        } else {
            echo '<table class="table" id="tablaCarrito">
                    <thead>
                        <tr>
                          <th scope="col">Imagen</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Eliminar</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Precio unitario</th>
                          <th scope="col">Sub total</th>
                        </tr>
                    </thead>';

            foreach ($publicaciones as $publicacion){
                $idProducto = $publicacion->producto->getId();
                $nombreProducto = $publicacion->producto->getNombre();
                $cantidadTotal = $publicacion->producto->getCantidad();
                $cantidadInicial = 1;
                $rutaImgPrincipal = getBaseAddress() . "Webroot/img/productos/" . $publicacion->imagen->getNombre();
                $precio = $publicacion->producto->getPrecio();
                echo "
                <tbody>
                    <tr class='fila-producto' id='$idProducto'>
                            <td><img src='$rutaImgPrincipal' width='100px' height='100px'></td>
                            <td class='align-middle'>$nombreProducto</td>
                            <td class='align-middle'><button class='btn btn-danger delete-producto-button' onclick='eliminarProducto($idProducto)'>Eliminar</button></td>
                            <td class='align-middle'>
                                <div class='quantity d-flex flex-column flex-sm-row align-items-sm-center'>
                                    <div class='quantity_selector'>
                                        <span class='minus' onclick='bajarSubTotal($idProducto,$cantidadTotal)'><i class='fa fa-minus mr-3' aria-hidden='true'></i></span>
                                        <span id='quantity_value'>$cantidadInicial</span>
                                        <span class='plus' onclick='subirSubTotal($idProducto, $cantidadTotal)'><i class='fa fa-plus ml-3' aria-hidden='true'></i></span>
                                    </div>
                                </div>
                            </td>
                            <td class='align-middle'>$ <span class='precioProducto'>$precio</span></td>
                            <td class='align-middle'>$ <span class='subtotal'></span></td>  
                    </tr>";
            }
            echo" <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total: &nbsp;&nbsp;&nbsp;$ <span class='total'></span></td>
                </tr>";
            echo "</tbody>
                  </table>";
            echo '<button type="button" class="btn btn-light mr-5 float-right" id="botonComprarCarrito"><i class="fas fa-money-check-alt mr-1" style="color: #0099df"></i>Comprar</button>';
        }
        ?>

</div>
<script src="<?php echo getBaseAddress() . "Webroot/js/carrito/carrito.js" ?>"></script>