<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">

<div class="container mt-5 w-50">

<form action="<?php echo getBaseAddress() . "Productos/alta" ?>" method="post" class="mx-auto pt-4 bg-white text-left" enctype="multipart/form-data">

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
        </div><br>

        <!--<div class="form-group">
            <label for="inputImagenProducto">Imagen</label>
            <input type="file" class="form-control-file" name="imagenProducto[]" id="inputImagenProducto" multiple >
            <div id="errorImagenProducto" class="error"> <i class="fas fa-exclamation-triangle"></i> Elija las fotos del producto</div>
        </div>

        <br>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Agregar</button>
        </div>-->

    <form enctype="multipart/form-data">
        <div class="file-loading">
            <input id="file" class="file" type="file" multiple data-min-file-count="3" data-theme="fa">
        </div>
    </form>


</form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAltaProducto.js" ?>"></script>