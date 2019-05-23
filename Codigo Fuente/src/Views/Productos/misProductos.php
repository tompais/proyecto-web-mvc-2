<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/misProductos.css" ?>">

<div class="container mt-5">

    <div class="panel-heading mt-5">
        <div class="panel-title">
            <div class="row">
                <div class="col">
                    <h2>Mis Ventas</h2>
                </div>
                <div class="col-sm-">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#altaModal" ><i class="fas fa-plus mr-1"></i> Agregar un Producto</button>
                </div>
            </div>
        </div>
    </div>

    <ul class="cards">
        <li class="card mt-3">
            <div class="card__inner">
                <img class="img-fluid" src="<?php echo getBaseAddress() .'Webroot/img/home/product_3.png' ?>">
            </div>
            <h3 class="card__tagline mt-2">Nike Airmax 97</h3>
            <ul class="card__icons mt-2">
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <li><a href="#"><i class="fas fa-edit"></i></a></li>
                <li><a href="#"><i class="fas fa-times"></i></a></li>
            </ul>
            <p>$2500.00</p>
        </li>
        <li class="card mt-3">
            <div class="card__inner">
                <img class="img-fluid" src="<?php echo getBaseAddress() .'Webroot/img/home/product_2.png' ?>">
            </div>
            <h3 class="card__tagline mt-2">Samsung S8 Plus</h3>
            <ul class="card__icons mt-2">
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <li><a href="#"><i class="fas fa-edit"></i></a></li>
                <li><a href="#"><i class="fas fa-times"></i></a></li>
            </ul>
            <p>$50000.00</p>
        </li>
        <li class="card mt-3">
            <div class="card__inner">
                <img class="img-fluid" src="<?php echo getBaseAddress() .'Webroot/img/home/product_4.png' ?>">
            </div>
            <h3 class="card__tagline mt-2">Moto G5 Plus</h3>
            <ul class="card__icons mt-2">
                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                <li><a href="#"><i class="fas fa-edit"></i></a></li>
                <li><a href="#"><i class="fas fa-times"></i></a></li>
            </ul>
            <p>$60000.00</p>
        </li>
        
        

    </ul>
</div>

<div class="modal" id="altaModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Producto</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?php
                    include_once "altaProducto.php";
                ?>
            </div>

        </div>
    </div>
</div>