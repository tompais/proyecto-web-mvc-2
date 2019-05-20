<div class="container-fluid">
    <form action="../Shared/Index.php" method="post" class="mx-auto p-4 bg-white text-left" enctype="multipart/form-data">

        <div class="form-group">
            <label for="inputNombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="inputNombreProducto" class="form-control" placeholder="Ej: Bicicleta">
        </div>
        <div class="form-group">
            <label for="inputPrecioProducto">Precio</label>
            <input type="number" name="precioProducto" id="inputPrecioProducto" class="form-control">
        </div>

        <div class="form-group">
            <label for="selectCategoriaPokemon">Categoria</label>
            <select name="categoriaProducto" id="selectCategoriaPokemon" class="form-control">
                <option>Categoria 1</option>
                <option>Categoria 2</option>
                <option>Categoria 3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="textareaDescripcionProducto">Descripcion</label>
            <textarea class="form-control" rows="5" id="textareaDescripcionProducto" name="descripcionProducto"></textarea>
        </div>

        <div class="form-group">
            <label for="inputImagenProducto">Imagen</label>
            <input type="file" class="form-control-file" name="imagenProducto" id="inputImagenProducto">
        </div>

        <br>

        <div class="d-flex justify-content-center align-items-center my-3">
            <button type="submit" name="btnAgregar" id="btnAgregar" class="btn btn-primary">Agregar</button>
        </div>

    </form>
</div>