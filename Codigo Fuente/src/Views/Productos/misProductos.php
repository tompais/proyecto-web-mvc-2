<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/misProductos.css" ?>">

<div class="container mt-5">

    <div class="panel-heading mt-5">
        <div class="panel-title pt-3">
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
        <?php
            $j = 0;

            if(isset($productos))
            {
                foreach($productos as $producto)
                {
                    $imagen = $imagenes[$j]->getNombre();
                    $id = $producto->getId();
    
                    $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen;
                    $precio = $producto->getPrecio();
    
                    echo "<li class='card mt-3'>
                            <input type='hidden' value='". $producto->getId() ."'>
                            <div class='card__inner'>
                                <img class='img-fluid' src='$rutaImg'>
                            </div>
                            <h3 class='card__tagline mt-2'>". $producto->getNombre() ."</h3>
                            <ul class='card__icons mt-2'>
                                <li><a href='#'><i class='fas fa-eye'></i></a></li>
                                <li><a href='#'><i class='fas fa-edit'></i></a></li>
                                <li><a href='#' data-toggle='modal' data-target='#eliminarModal'><i class='fas fa-times'></i></a></li>
                            </ul>
                            <p>$$precio.00</p>
                        </li>";
    
                    while($j < count($imagenes) && $id == $imagenes[$j]->getProductoId())
                        $j++;
                }
            }
            else
                echo "No tiene productos en venta";
        ?>

    </ul>

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

    <div class="modal" id="eliminarModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>¿Estas seguro de eliminar este producto?</p>
                </div>

                <div class="modal-footer">
                    <form action="<?php echo getBaseAddress() . "Productos/eliminar" ?>" method="post">
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
    
</div>