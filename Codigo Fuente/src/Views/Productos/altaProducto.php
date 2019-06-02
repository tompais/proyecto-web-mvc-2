<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">

<div class="container col-xl-7 col-sm-5 mt-3">
    
        <h2>Agregar Producto <i class="fas fa-1x fa-plus mr-1"></i></h2>

<form action="<?php echo getBaseAddress() . "Productos/alta" ?>" method="post" class="mx-auto bg-white text-left" enctype="multipart/form-data">

        <div class="form-group mt-5">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta" >
            <div id="errorNombreProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" placeholder="Ej: 1300" id="inputPrecioProducto" class="form-control" >
            <div id="errorPrecioProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control" >
                <option value="0" disabled selected>Categoria</option>

                <?php
                    foreach($categorias as $categoria)
                        echo "<option value='". $categoria->getId() ."'>" . $categoria->getNombre() . "</option>";
                ?>

            </select>
            <div id="errorCategoriaProducto" class="error"> <i class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" placeholder="¿Que vendes?" id="textareaDescripcionProducto" name="descripcionProducto" ></textarea>
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

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Agregar</button>
        </div>

</form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAltaProducto.js"?>"></script>