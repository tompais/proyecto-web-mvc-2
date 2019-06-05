<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/publicacion/publicacionProducto.css" ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/publicacion/publicacionProductoResponsive.css" ?>">

<div class="container single_product_container">
    <div class="row">
        <div class="col">
            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="·">Inicio</a></li>
                    <li><a href="#"><i class="fa fa-angle-right mr-3" aria-hidden="true"></i><?php echo $categoria->getNombre() ?></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row">
        <?php
        if(isset($productos))
        {

            foreach ($productos as $producto)
            {
                $imagen = $imagenes[0]->getNombre();
                $rutaImgPrincipal = getBaseAddress() . 'Webroot/img/productos/' . $imagen;

                echo "<div class='col-lg-7'>
                            <div class='single_product_pics'>
                                <div class='row'>
                                    <div class='col-lg-3 thumbnails_col order-lg-1 order-2'>
                                        <div class='single_product_thumbnails mx-1' id='barraImagenes' style='overflow: auto'>
                                            <ul>";

                                            for ($j=0;$j<count($imagenes);$j++){

                                                $imagen = $imagenes[$j]->getNombre();
                                                $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen;

                                                echo "<li><img src='$rutaImg' alt='' data-image='$rutaImg'></li>";
                                            }

                echo                     "</ul>
                                        </div>
                                    </div>
                                    <div class='col-lg-9 image_col order-lg-2 order-1'>
                                        <div class='single_product_image'>
                                            <div class='single_product_image_background' style='background-image:url($rutaImgPrincipal)'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
        }
        ?>
        <div class="col-lg-5">
            <div class="product_details">
                <div class="product_details_title">
                    <h2><?php echo $producto->getNombre() ?></h2>
                    <?php
                    if ($producto->getDescripcion() == "") {
                        echo '<p>Ninguna Descripcion</p>';
                    }
                    else{
                        echo '<p>'. $producto->getDescripcion() .'</p>';
                    }
                    ?>
                </div>
                <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                    <span class="ti-truck"></span><span>Caracteristicas</span>
                </div>

                <div class="product_price mt-5">$ <?php echo $producto->getPrecio() ?></div>

                <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                    <span>Cantidad:</span>
                    <div class="quantity_selector">
                        <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                        <span id="quantity_value">1</span>
                        <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                    </div>
                </div>
                <br>
                <br>
                <button type="button" class="btn btn-light ml-4"><i class="fas fa-cart-plus mr-1" style="color: #0099df"></i>Añadir al Carrito</button>
            </div>
        </div>
    </div>

</div>

<!-- Tabs -->

<div class="tabs_section_container">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabs_container">
                    <ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                        <li class="tab active" data-active-tab="tab_1"><h2 style="color: #049be0;">Vendedor</h2></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        <img src="<?php echo getBaseAddress() . "Webroot/img/publicacion/user.png" ?>" alt="stack photo" class="img">
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" id="iconUser">
                        <div class="container" style="border-bottom:1px solid black">
                            <h2> <?php echo $usuario->getNombre() ." ". $usuario->getApellido() ?> </h2>
                        </div>
                        <hr>
                        <ul class="container details">
                            <li><p><i class="fas fa-mobile-alt" style="width: 30px; color: #0099df"></i><?php echo $usuario->getTelefonoCelular() ?></p></li>
                            <li><p><i class="fas fa-envelope" style="width: 30px; color: #0099df"></i><?php echo $usuario->getEmail() ?></p></li>
                            <li><p><i class="fas fa-calendar-alt" style="width: 30px; color: #0099df"></i><?php echo $usuario->getFechaNacimiento() ?></p></li>
                            <li><p><i class="fas fa-user-tag" style="width: 30px; color: #0099df"></i><?php echo $usuario->getUsername() ?></p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="benefit">
    <div class="container">
        <div class="row benefit_row">
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-2x  fa-truck" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>Envio Gratis</h6>
                        <p>Puede ser alterado por el producto</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="far fa-2x fa-money-bill-alt"></i></div>
                    <div class="benefit_content">
                        <h6>Metodos de pago</h6>
                        <p>Efectivo, Credito y Debito</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-2x fa-undo" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>Regreso en 45 dias</h6>
                        <p>Asegurarnos la calidad de tu producto</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fas fa-2x fa-user-clock"></i></div>
                    <div class="benefit_content">
                        <h6>Atencion al Cliente</h6>
                        <p>8AM - 09PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Neovedades -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
                    <h4>Novedades</h4>
                    <p>Subcribete para obtener todad nuestras novedades</p>
                </div>
            </div>
            <div class="col-lg-6">
                <form action="post">
                    <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                        <input id="newsletter_email" type="email" placeholder="pupe893@gmail.com" required="required" data-error="Valid email is required.">
                        <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">Subcribite</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo getBaseAddress() . "Webroot/js/publicacion/publicacionProducto.js" ?>"></script>