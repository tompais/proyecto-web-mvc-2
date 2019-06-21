
<div class="container mt-3 mb-5">

    <div class="panel-heading">
        <div class="panel-title pt-3">
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

            echo '<table class="table">
			<tr>
                <td>Imagen</td>
                <td>Nombre</td>
                <td>Eliminar</td>
                <td>Cantidad</td>
                <td>Precio unitario</td>
                <td>Sub total</td>
		    </tr>';

            foreach ($publicaciones as $publicacion){
                $idProducto = $publicacion->producto->getId();
                $nombreProducto = $publicacion->producto->getNombre();
                $cantidadTotal = $publicacion->producto->getCantidad();
                $cantidadInicial = 1;
                $rutaImgPrincipal = getBaseAddress() . "Webroot/img/productos/" . $publicacion->imagen->getNombre();
                $precio = $publicacion->producto->getPrecio();
                echo "
                <tr class='productosEnCarrito' id='$idProducto'>
                        <td><img src='$rutaImgPrincipal' width='100px' height='100px'></td>
                        <td>$nombreProducto</td>
                        <td><button class='btn btn-danger' onclick='eliminarProducto($idProducto)'>Eliminar</button></td>
                        <td>
                            <div class='quantity d-flex flex-column flex-sm-row align-items-sm-center'>
                                <div class='quantity_selector'>
                                    <span class='minus' onclick='bajarSubTotal($idProducto,$cantidadTotal)'><i class='fa fa-minus mr-3' aria-hidden='true'></i></span>
                                    <span id='quantity_value'>$cantidadInicial</span>
                                    <span class='plus' onclick='subirSubTotal($idProducto, $cantidadTotal)'><i class='fa fa-plus ml-3' aria-hidden='true'></i></span>
                                </div>
                            </div>
                        </td>
                        <td class='precioProducto'>$precio</td>
                        <td class='subtotal'></td>
                        
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td class='total'></td>
                </tr>";
            }
            echo "</table>";
            echo '<button type="button" class="btn btn-light mr-5 float-right"><i class="fas fa-money-check-alt mr-1" style="color: #0099df"></i>Comprar</button>';
        }
        ?>

</div>
<script src="<?php echo getBaseAddress() . "Webroot/js/carrito/carrito.js" ?>"></script>