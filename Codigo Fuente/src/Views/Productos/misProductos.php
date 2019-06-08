<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/misProductos.css" ?>">

<div class="container mt-3">

    <div class="panel-heading">
        <div class="panel-title pt-3">
            <div class="row">
                <div class="col-xl-5 col-sm-5">
                    <h2>Mis Ventas</h2>
                </div>
                <div class="col-xl-7 col-sm-5">
                    <a href="<?php echo getBaseAddress() . 'Productos/agregarProducto' ?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-1"></i> Agregar un Producto</a>
                </div>
            </div>
        </div>
    </div>

    <ul class="cards">
        <?php
            $j = 0;

            if(isset($productos))
            {

                $editar = getBaseAddress() . "Productos/editarProducto";
                $pathAccionPublicacion = getBaseAddress() . "Productos/publicacion/";

                foreach($productos as $producto)
                {
                    $imagen = $imagenes[$j]->getNombre();
                    $id = $producto->getId();
    
                    $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen;
                    $precio = $producto->getPrecio();
    
                    echo "<li class='card mt-3'>
                            <div class='card__inner'>
                                <img class='img-fluid' src='$rutaImg'>
                            </div>
                            <h3 class='card__tagline mt-2'>". $producto->getNombre() ."</h3>
                            <ul class='card__icons mt-2'>
                                <li><a href='" . $pathAccionPublicacion . $id . "'><i class='fas fa-eye'></i></a></li>
                                <li><a href='#' onclick='irEditar($id)'><i class='fas fa-edit'></i></a></li>
                                <li><a href='#' onclick='insertarIdProducto($id)' data-toggle='modal' data-target='#eliminarModal'><i class='fas fa-times'></i></a></li>
                            </ul>
                            <p>$$precio.00</p>
                        </li>";
    
                    while($j < count($imagenes) && $id == $imagenes[$j]->getProductoId())
                        $j++;
                }

                echo "<form method='post', action='$editar' id='editar'>
                    <input type='hidden' id='idProducto' name='producto' />
                    </form>";


            }
            else
                echo "No tiene productos en venta";
        ?>

    </ul>


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
                    <form action="<?php echo getBaseAddress() . "Productos/eliminar" ?>" method="post" id="confirmarEliminar">
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
    
</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/producto/eliminarProducto.js" ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/editarProducto.js" ?>"></script>