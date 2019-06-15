<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/buscar/buscar.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/buscar/buscarResponsive.css"; ?>">

<div class="container product_section_container mt-5">
    <div class="row">
        <div class="col product_section">

            <!-- Main Content -->

            <div class="main_content">

                <h3 class="pb-3" style="border-bottom: solid 1px">Busquedas por : <?php echo $palabra ?> </h3>

                <!-- Products -->

                <div class="d-flex flex-column justify-content-center align-items-center">

                    <?php

                    $cantProductos = count($productos);

                    if (!$cantProductos) {
                        echo '<h4 class="text-center text-black-50">No se ha encontrado ninguna coincidencia con su búsqueda</h4>';
                    } else {
                        $i = 0;
                        while ($i < $cantProductos) {
                            echo '<div class="row my-3">';

                            do {
                                echo '<div class="col-sm-4">
                                            <a href="' . getBaseAddress() . 'Productos/publicacion/' . $productos[$i]->getId() . '">
                                                <div class="product-item w-100">
                                                    <div class="product product_filter">
                                                        <div class="product_image h-75 justify-content-center align-items-center">
                                                            <img class="h-100" src="' . getBaseAddress() . 'Webroot/img/productos/' . $imagenes[$i]->nombre . '">
                                                        </div>
                                                        <div class="product_info">
                                                            <h6 class="product_name"><a href="' . getBaseAddress() . 'Productos/publicacion/' . $productos[$i]->getId() . '">' . $productos[$i]->getNombre() . '</a></h6>
                                                            <div class="product_price">$' . $productos[$i]->getPrecio() . '</div>
                                                        </div>
                                                    </div>
                                                    <div class="red_button add_to_cart_button"><a href="#"><i class="fab fa-opencart mr-2"></i>Agregar al Carrito</a></div>
                                                </div>
                                            </a>
                                        </div>';

                                $i++;
                            } while ($i < $cantProductos && $i < 3);

                            echo '</div>';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/buscar/buscar.js" ?>"></script>


