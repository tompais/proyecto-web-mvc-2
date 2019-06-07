<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/productos/altaProducto.css" ?>">
<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/lib/ImageUpload/css/main.2680b2521d08e92a174b.css" ?>">

<div class="container col-xl-7 col-sm-5 mt-3">

    <h2>Agregar Producto <i class="fas fa-1x fa-plus mr-1"></i></h2>

    <form action="<?php echo getBaseAddress() . "Productos/alta" ?>" method="post" class="mx-auto bg-white text-left"
          enctype="multipart/form-data">

        <div class="form-group mt-5">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="inputNombreProducto" class="form-control"
                   placeholder="Ej: Bicicleta">
            <div id="errorNombreProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" placeholder="Ej: 1300" id="inputPrecioProducto"
                   class="form-control">
            <div id="errorPrecioProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control">
                <option value="0" disabled selected>Categoria</option>

                <?php
                foreach ($categorias as $categoria)
                    echo "<option value='" . $categoria->getId() . "'>" . $categoria->getNombre() . "</option>";
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
                foreach ($estados as $estado)
                    echo "<option value='" . $estado->getId() . "'>" . $estado->getNombre() . "</option>";
                ?>

            </select>
            <div id="errorEstadoProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" placeholder="¿Que vendes?" id="textareaDescripcionProducto"
                      name="descripcionProducto"></textarea>
            <small class="form-text text-muted float-left">Opcional</small>
            <div class="mt-2 float-right"><span id='caracteres'>0</span>/200<span></div>
            <div id="errorDescripcionProducto" class="error"><i
                        class="fas fa-exclamation-triangle mr-2"></i><span></span></div>
        </div>


        <div class="custom-file-container mt-5" data-upload-id=myFirstImage>
            <label for="inputFileImages">Imagenes<a href=javascript:void(0) class=custom-file-container__image-clear
                                                    title="Clear Image"><i class="fas fa-times ml-2"></i></a></label>
            <label class="custom-file-container__custom-file">
                <input type=file class="custom-file-container__custom-file__custom-file-input" accept=".png,.jpg,.jpeg"
                       multiple=multiple aria-label="Seleccionar" name="imagenProducto[]" id="inputImagenProducto">
                <input type=hidden name=MAX_FILE_SIZE value=10485760> <span
                        class="custom-file-container__custom-file__custom-file-control"></span></label>
            <div class=custom-file-container__image-preview></div>
            <div id="errorImagenProducto" class="error"><i class="fas fa-exclamation-triangle mr-2"></i><span></span>
            </div>
        </div>


        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Agregar</button>
        </div>

    </form>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/producto/validacionAMProducto.js" ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/lib/ImageUpload/js/main.f7f7894738fb01e41d2e.js" ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/lib/ImageUpload/js/vendor.e990ab0e5e609130e9c2.js" ?>"></script>