<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/publicacion/publicacionProducto.css" ?>">
<link rel="stylesheet"
      href="<?php echo getBaseAddress() . "Webroot/css/publicacion/publicacionProductoResponsive.css" ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.carousel.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.theme.default.css"; ?>">

<script>
    var latitud = <?php echo $geolocalizacion->getLatitud(); ?>;
    var longitud = <?php echo $geolocalizacion->getLongitud(); ?>
</script>
<?php
    $patHomePublicacion = getBaseAddress().'Productos/publicacion/';
?>
<div class="container single_product_container">
    <div class="row">
        <div class="col">
            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="·">Inicio</a></li>
                    <li><a href="#"><i class="fa fa-angle-right mr-3"
                                       aria-hidden="true"></i><?php echo $categoria->getNombre() ?></a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="row">
        <?php

        $imagen = $imagenes[0]->getNombre();
        $rutaImgPrincipal = getBaseAddress() . 'Webroot/img/productos/' . $imagen;

        echo "<div class='col-lg-7'>
                            <div class='single_product_pics'>
                                <div class='row'>
                                    <div class='col-lg-3 thumbnails_col order-lg-1 order-2'>
                                        <div class='single_product_thumbnails mx-1' id='barraImagenes' style='overflow: auto'>
                                            <ul>";

        for ($j = 0; $j < count($imagenes); $j++) {

            $imagen = $imagenes[$j]->getNombre();
            $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen;

            echo "<li><img src='$rutaImg' alt='' data-image='$rutaImg'></li>";
        }

        echo "</ul>
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

        ?>
        <div class="col-lg-5">
            <div class="product_details">
                <div class="product_details_title">
                    <h2><?php echo $producto->getNombre() ?></h2>
                    <?php
                    if ($producto->getDescripcion() == "") {
                        echo '<p>Ninguna Descripcion</p>';
                    } else {
                        echo '<p>' . $producto->getDescripcion() . '</p>';
                    }
                    ?>
                </div>
                <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                    <span class="ti-truck"></span><span>Caracteristicas</span>
                </div>

                <div class="product_price mt-5" style="font-size: 24px">Precio:
                    $<?php echo $producto->getPrecio() ?></div>
                <br>
                <div class="product_price mt-5" style="font-size: 24px">Cantidad: <?php echo $producto->getCantidad() ?>
                    (disponibles)
                </div>

                <br>
                <br>
                <div id="<?php echo $producto->getId();?>">

                <?php
                if (!isset($_SESSION["session"]) || unserialize($_SESSION["session"])->getId() != $producto->getUsuarioId()) {
                    if ($producto->getCantidad() == 0) {
                        echo '<button class="btn btn-primary btn-block"
                                  id="btnAddToCart" disabled=""><i
                                  class="fas fa-ban mr-2s"></i>
                                  <span>SIN STOCK</span>
                              </button>';
                    }elseif (isset($_SESSION["carrito"]) and in_array($producto->getId(), $_SESSION["carrito"])){
                        echo '<button class="btn btn-primary btn-block"
                                  id="btnAddToCart" 
                                  onclick="agregarProductoCarrito('.$producto->getId().')"
                                  disabled=""><i
                                  class="fas fa-check mr-2"></i>
                                  <span>EN CARRITO</span>
                              </button>';
                    }else{
                        echo '<button class="btn btn-primary btn-block"
                                  style="background: #0099df" id="btnAddToCart" onclick="agregarProductoCarrito('.$producto->getId().')"><i
                                  class="fab fa-opencart mr-2"></i>AGREGAR AL CARRITO
                              </button>';
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column mx-auto justify-content-center align-items-center w-100">
        <div class="col text-center my-5">
            <div class="section_title">
                <h2>Ubicación del Vendedor</h2>
            </div>
        </div>
        <div id="map" class="w-100"></div>
    </div>


    <div class="tabs_section_container">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabs_container">
                        <ul class="tabs d-flex flex-sm-row flex-column align-items-md-center justify-content-center">
                            <li class="tab active" data-active-tab="tab_1"><span>Relacionados</span></li>
                            <li class="tab" data-active-tab="tab_3"><span>Reseñas</span></li>
                            <li class="tab" data-active-tab="tab_5"><span>Comentarios</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <!-- Tab Description -->

                    <div id="tab_1" class="tab_container active">
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="section_title">
                                        <h2>Productos Relacionados</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <div id="carouselProductosRelacionados" class="owl-carousel owl-theme product_slider">
                                        <?php

                                            foreach ($productosRelacionados as $productoRelacionado){

                                                $imagen = $imagenesProductosRelacionados[$productoRelacionado->getId()]->getNombre();
                                                $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen;

                                                if (!isset($_SESSION["session"]) || unserialize($_SESSION["session"])->getId() != $productoRelacionado->getUsuarioId()) {
                                                    if ($productoRelacionado->getCantidad() == 0) {
                                                        $boton = '<button class="btn btn-primary"
                                                                    id="btnAddToCart" disabled><i
                                                                    class="fas fa-ban mr-2"></i>
                                                                    <span>SIN STOCK</span>
                                                                  </button>';
                                                    }else if (isset($_SESSION["carrito"]) and in_array($productoRelacionado->getId(), $_SESSION["carrito"])){
                                                        $boton = '<button class="btn btn-primary"
                                                                      id="btnAddToCart" onclick="agregarProductoCarrito('.$productoRelacionado->getId().')"
                                                                      disabled=""><i class="fas fa-check fa-1x mr-2"></i>
                                                                      <span>EN CARRITO</span>
                                                                  </button>';
                                                    }else{
                                                        $boton = '<button class="btn btn-primary"
                                                                      id="btnAddToCart" onclick="agregarProductoCarrito('.$productoRelacionado->getId().')"><i
                                                                      class="fab fa-opencart mr-2"></i>Agregar al carrito
                                                                  </button>';
                                                    }
                                                }
                                                echo '<div class="owl-item product_slider_item" id='.$productoRelacionado->getId().'>
                                                        <div class="product-item">
                                                            <div class="d-flex flex-column product discount justify-content-center align-items-center">
                                                                <a href="'.$patHomePublicacion.$productoRelacionado->getId().'">
                                                                <div class="product_image" style="height: 180px;">
                                                                    <img src='.$rutaImg.' class="img-fluid h-100" alt="">
                                                                </div>
                                                                </a>
                                                                <div class="product_info">
                                                                    <h6 class="product_name"><a href="#">'.$productoRelacionado->getNombre().'</a>
                                                                    </h6>
                                                                </div>
                                                                '.$boton.'
                                                            </div>
                                                        </div>
                                                      </div>';
                                            }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Reviews -->

                    <div id="tab_3" class="tab_container">
                        <div class="row">

                            <!-- User Reviews -->

                            <div class="col-lg-6 reviews_col">
                                <div class="tab_title reviews_title">
                                    <h4>Reseñas</h4>
                                </div>

                                <!-- User Review -->

                                <div class="user_review_container d-flex flex-column flex-sm-row">
                                    <div class="user">
                                        <div class="user_pic"></div>
                                        <div class="user_rating">
                                            <ul class="star_rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="review_date">27 Aug 2016</div>
                                        <div class="user_name">Brandon William</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>

                                <!-- User Review -->

                                <div class="user_review_container d-flex flex-column flex-sm-row">
                                    <div class="user">
                                        <div class="user_pic"></div>
                                        <div class="user_rating">
                                            <ul class="star_rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="review_date">27 Aug 2016</div>
                                        <div class="user_name">Brandon William</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Review -->

                            <div class="col-lg-6 add_review_col">

                                <div class="add_review">
                                    <form id="review_form" action="post">
                                        <div>
                                            <h1>Add Review</h1>
                                            <input id="review_name" class="form_input input_name" type="text"
                                                   name="name" placeholder="Name*" required="required"
                                                   data-error="Name is required.">
                                            <input id="review_email" class="form_input input_email" type="email"
                                                   name="email" placeholder="Email*" required="required"
                                                   data-error="Valid email is required.">
                                        </div>
                                        <div>
                                            <h1>Your Rating:</h1>
                                            <ul class="user_star_rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                            <textarea id="review_message" class="input_review" name="message"
                                                      placeholder="Your Review" rows="4" required
                                                      data-error="Please, leave us a review."></textarea>
                                        </div>
                                        <div class="text-left text-sm-right">
                                            <button id="review_submit" type="submit"
                                                    class="red_button review_submit_btn trans_300" value="Submit">submit
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Comentarios-->

                    <div id="tab_5" class="tab_container">
                        <div class="row">

                            <div class="col-lg-6 reviews_col">
                                <div class="tab_title reviews_title">
                                    <h4>Comentarios</h4>
                                </div>

                                <div class="user_review_container d-flex flex-column flex-sm-row">
                                    <div class="user">
                                        <div class="user_pic"></div>
                                        <div class="user_rating">
                                            <ul class="star_rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="review_date">27 Aug 2016</div>
                                        <div class="user_name">Brandon William</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>

                                <div class="user_review_container d-flex flex-column flex-sm-row">
                                    <div class="user">
                                        <div class="user_pic"></div>
                                        <div class="user_rating">
                                            <ul class="star_rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="review_date">27 Aug 2016</div>
                                        <div class="user_name">Brandon William</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 add_review_col">

                                <div class="add_review">
                                    <form id="review_form" action="post">
                                        <div>
                                            <h1>Add Review</h1>
                                            <input id="review_name" class="form_input input_name" type="text"
                                                   name="name" placeholder="Name*" required="required"
                                                   data-error="Name is required.">
                                            <input id="review_email" class="form_input input_email" type="email"
                                                   name="email" placeholder="Email*" required="required"
                                                   data-error="Valid email is required.">
                                        </div>
                                        <div>
                                            <h1>Your Rating:</h1>
                                            <ul class="user_star_rating">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                            </ul>
                                            <textarea id="review_message" class="input_review" name="message"
                                                      placeholder="Your Review" rows="4" required
                                                      data-error="Please, leave us a review."></textarea>
                                        </div>
                                        <div class="text-left text-sm-right">
                                            <button id="review_submit" type="submit"
                                                    class="red_button review_submit_btn trans_300" value="Submit">submit
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Fin comentarios -->

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
                        <input id="newsletter_email" type="email" placeholder="pupe893@gmail.com" required="required"
                               data-error="Valid email is required.">
                        <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300"
                                value="Submit">Subcribite
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo getBaseAddress() . "Webroot/lib/OwlCarousel2-2.2.1/owl.carousel.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/publicacion/publicacionProducto.js" ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcFcGF94xuFjqe9X4qNEbB9uA_awWv8Lg&callback=initMap"></script>
