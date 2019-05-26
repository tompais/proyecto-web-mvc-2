$(document).ready(function() {

    $("#btnAgregar").click(function(){

        var nombreProducto = $('#inputNombreProducto').val();
        var precioProducto = $('#inputPrecioProducto').val();
        
        var categoriaProducto = $('#selectCategoriaProducto').val();
        var descripcionProducto = $('#textareaDescripcionProducto').val();
        
        //var imagenProducto = $('#inputImagenProducto')[0].val();
        var imagenProducto = $('#inputImagenProducto')[0].files;

        //nombre de producto
        if(nombreProducto === null || nombreProducto.length <= 3 || nombreProducto.length >= 15  || nombreProducto === ""){
            $("#errorNombreProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorNombreProducto").fadeOut();
        }
      
        //precio
        if(precioProducto === null || precioProducto.length == 0 || precioProducto === ""){
            $("#errorPrecioProducto").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPrecioProducto").fadeOut();
        }

        //categoria
        if(categoriaProducto === null || categoriaProducto == 0){
            $("#errorCategoriaProducto").fadeIn("slow");
            return false;
        }
        else{
            $("#errorCategoriaProducto").fadeOut();
        }

        //descripcion
        if(descripcionProducto === null || descripcionProducto.length == 0 || descripcionProducto === ""){
            $("#errorDescripcionProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorDescripcionProducto").fadeOut();
        }
        
        //archivos
        if(imagenProducto === null || imagenProducto.length == 0 || imagenProducto === ""){
            $("#errorImagenProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorImagenProducto").fadeOut();
        }    

    });

});