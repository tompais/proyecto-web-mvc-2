<div class="container-fluid">
    <form action="<?php echo getBaseAddress() . "Productos/alta" ?>" method="post" class="mx-auto p-4 bg-white text-left" enctype="multipart/form-data">

        <div class="form-group">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta">
        </div>
        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" id="inputPrecioProducto" class="form-control">
        </div>

        <div class="form-group">
            <label for="selectCategoriaProducto">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaProducto" class="form-control">
                <option>Tecnologia</option>
                <option>Hogar</option>
                <option>Ropa</option>
                <option>Libreria</option>
                <option>Iluminacion</option>
                <option>Comestibles</option>
            </select>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" id="textareaDescripcionProducto" name="descripcionProducto"></textarea>
        </div>

        <div class="form-group">
            <label for="inputImagenProducto">Imagen</label>
            <input type="file" class="form-control-file" name="imagenProducto[]" id="inputImagenProducto" multiple>
        </div>

        <br>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Agregar</button>
        </div>

    </form>
</div>