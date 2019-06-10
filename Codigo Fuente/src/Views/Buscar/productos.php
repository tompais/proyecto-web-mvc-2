<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/buscar/buscar.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/buscar/buscarResponsive.css"; ?>">

<div class="container product_section_container mt-5">
    <div class="row">
        <div class="col product_section">

            <!-- Main Content -->

            <div class="main_content">

                <!-- Products -->

                <div class="products_iso">
                    <div class="row">
                        <div class="col">

                            <!-- Product Grid -->

                            <div class="row">

                                <?php

                                $i = 0;

                                foreach ($productos as $producto) {
                                    echo '<div class="product-item men">
                                        <div class="product product_filter">
                                            <div class="product_image">
                                                <img src="' . getBaseAddress() . 'Webroot/img/productos/' . $imagenes[$i++]->nombre . '" alt="">
                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="' . getBaseAddress() . 'Productos/publicacion/' . $producto->getId() . '">' . $producto->getNombre() . '</a></h6>
                                                <div class="product_price">$' . $producto->getPrecio() . '</div>
                                            </div>
                                        </div>
                                        <div class="red_button add_to_cart_button"><a href="#"><i class="fab fa-opencart mr-2"></i>Agregar al Carrito</a></div>
                                    </div>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/buscar/buscar.js" ?>"></script>


