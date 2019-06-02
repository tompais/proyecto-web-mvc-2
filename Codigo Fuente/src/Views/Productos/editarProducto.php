<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">

<div class="container my-5 w-75">
    
        <h2>Editar Producto <i class='fas fa-1x fa-edit'></i></h2>

<form action="<?php echo getBaseAddress() . "Productos/editar" ?>" method="post" class="mx-auto bg-white text-left" enctype="multipart/form-data">

        <div class="form-group mt-5">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" value="<?php echo $producto->getNombre() ?>" id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta" >
            <div id="errorNombreProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" value="<?php echo $producto->getPrecio() ?>" placeholder="Ej: 1300" id="inputPrecioProducto" class="form-control" >
            <div id="errorPrecioProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control" >
                <option value="0" disabled>Categoria</option>

                <?php
                    foreach($categorias as $categoria)
                    {
                        if($producto->getCategoriaId() == $categoria->getId())
                            echo "<option selected value='". $categoria->getId() ."'>" . $categoria->getNombre() . "</option>";
                        else
                            echo "<option value='". $categoria->getId() ."'>" . $categoria->getNombre() . "</option>";
                    }
                ?>

            </select>
            <div id="errorCategoriaProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" id="textareaDescripcionProducto" name="descripcionProducto" > <?php echo $producto->getDescripcion() ?> </textarea>
            <div class="mt-2 float-right"><span id='caracteres'>0</span>/200<span></div>
            <div id="errorDescripcionProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group" style="margin:50px auto;">
            <label for="inputImagenProducto">Imagenes</label>
            <input type="file" class="form-control-file demo" name="imagenProducto[]" id="inputImagenProducto" multiple data-jpreview-container="#demo-1-container">
            <div id="errorImagenProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div id="demo-1-container" class="jpreview-container"></div>

        <script>
            $('input[type="file"]').prettyFile();
            $('.demo').jPreview();
        </script>

        <input type="hidden" name="idProducto" value="<?php echo $producto->getId() ?>"/>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Guardar cambios</button>
        </div>

</form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAltaProducto.js"?>"></script>