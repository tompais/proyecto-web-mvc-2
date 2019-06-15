<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/basic.min.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/dropzone.min.css"; ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">
<script>
    const pathAccionProducto = "<?php echo getBaseAddress()."Productos/eliminarImagen";?>"
</script>
<div class="container my-5 w-75">
    <h2>Editar Producto <i class='fas fa-1x fa-edit'></i></h2>

    <form action="<?php echo getBaseAddress() . "Productos/editar" ?>" method="post" class="mx-auto bg-white text-left"
          enctype="multipart/form-data">

        <div class="form-group mt-5">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" value="<?php echo $producto->getNombre() ?>"
                   id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta">
            <div id="errorNombreProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" value="<?php echo $producto->getPrecio() ?>"
                   placeholder="Ej: 1300" id="inputPrecioProducto" class="form-control">
            <div id="errorPrecioProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control">
                <option value="0" disabled>Categoria</option>

                <?php
                foreach ($categorias as $categoria) {
                    if ($producto->getCategoriaId() == $categoria->getId())
                        echo "<option selected value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
                    else
                        echo "<option value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
                }
                ?>

            </select>
            <div id="errorCategoriaProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectEstadoProducto">Estado</label>
            <select name="estadoProducto" id="selectEstadoProducto" class="form-control">
                <option value="0" disabled selected>Estado</option>

                <?php
                foreach ($estados as $estado) {
                    if ($producto->getEstadoId() == $estado->getId())
                        echo "<option selected value='" . $estado->getId() . "'>" . $estado->getNombre() . "</option>";
                    else
                        echo "<option value='" . $estado->getId() . "'>" . $estado->getNombre() . "</option>";
                }
                ?>

            </select>
            <div id="errorEstadoProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" id="textareaDescripcionProducto"
                      name="descripcionProducto"> <?php echo $producto->getDescripcion() ?> </textarea>
            <small class="form-text text-muted float-left">Opcional</small>
            <div class="mt-2 float-right"><span id='caracteres'>0</span>/200<span></div>
            <div id="errorDescripcionProducto" class="error"><i
                        class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>
        <div id="precargarImagenes" class="row">
            <?php
                echo "<input type='hidden' id='totalPrecarga' value='". count($imagenes) ."'>";
                foreach ($imagenes as $imagen){
                    $rutaImg = getBaseAddress() . 'Webroot/img/productos/' . $imagen->getNombre();
                    $idImagen = $imagen->getId();
                    echo "<div class='col-md-4'>
                              <button type='button' class='close col botonEliminar' aria-label='Close'>
                                <span aria-hidden='true' onclick='eliminar($idImagen)' id='$idImagen'>&times;</span>
                              </button>
                              <img src='$rutaImg' alt='' data-image='$rutaImg' style='' class='col'>
                          </div>";
                }
            ?>
        </div>
        <div class="form-group mb-4">
            <label for="divImagenesProducto">Imagenes</label>
            <div id="dzUpload" class="dropzone mt-2"></div>
        </div>
        <input type="hidden" name="idProducto" value="<?php echo $producto->getId() ?>"/>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregarEditar" id="btnAgregarEditar" class="btn btn-primary">Guardar cambios</button>
        </div>

    </form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/dropzonejs/min/dropzone.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAMProducto.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/producto/editarProducto.js"; ?>"></script>