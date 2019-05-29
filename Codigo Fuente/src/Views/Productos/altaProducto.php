<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">

<div class="container mt-5 w-75">

<form action="<?php echo getBaseAddress() . "Productos/alta" ?>" method="post" class="mx-auto pt-5 bg-white text-left" enctype="multipart/form-data">

        <div class="form-group">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta" >
            <div id="errorNombreProducto" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese el nombre del producto</div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" id="inputPrecioProducto" class="form-control" >
            <div id="errorPrecioProducto" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese el precio del producto</div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control" >
                <option value="0">Categoria</option>

                <?php
                    foreach($categorias as $categoria)
                        echo "<option value='". $categoria->getId() ."'>" . $categoria->getNombre() . "</option>";
                ?>

            </select>
            <div id="errorCategoriaProducto" class="error"> <i class="fas fa-exclamation-triangle"></i> Elija una de las categorias disponibles </div>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" id="textareaDescripcionProducto" name="descripcionProducto" ></textarea>
            <div id="errorDescripcionProducto" class="error"> <i class="fas fa-exclamation-triangle"></i> Ingrese la descripción del producto</div>
        </div>

        <div class="form-group" style="margin:50px auto;">
            <label for="inputImagenProducto">Imagenes</label>
            <input type="file" class="form-control-file demo" name="imagenProducto[]" id="inputImagenProducto" multiple data-jpreview-container="#demo-1-container">
            <div id="errorImagenProducto" class="error"> <i class="fas fa-exclamation-triangle"></i> Elija las fotos del producto</div>
        </div>
        <div id="demo-1-container" class="jpreview-container"></div>

        <script>
            $('input[type="file"]').prettyFile();
            $('.demo').jPreview();
        </script>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Agregar</button>
        </div>

</form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAltaProducto.js" ?>"></script>
