
//$(document).ready(function() {

    $("#btnAgregar").click(function(){

        var nombreProducto = $('#inputNombreProducto').val();
        var precioProducto = $('#inputPrecioProducto').val();
        
        var categoriaProducto = $('#selectCategoriaProducto').val();
        var descripcionProducto = $('#textareaDescripcionProducto').val();
        
        //var imagenProducto = $('#inputImagenProducto')[0].val();
        var imagenProducto = $('#inputImagenProducto').files[0];

        //nombre de producto
        if(nombreProducto == null || nombreProducto.length < 5 || nombreProducto === ""){
            $("#errorNombreProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorNombreProducto").fadeOut();
        }
      
        //precio
        if(precioProducto == null || precioProducto.length === 0 || precioProducto === "" || !regexSoloNumeros.test(precioProducto) ){
            $("#errorPrecioProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorPrecioProducto").fadeOut();
        }
        
        //categoria
        if(categoriaProducto == null || categoriaProducto.length === 0 || categoriaProducto === ""){
            $("#errorCategoriaProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorCategoriaProducto").fadeOut();
        }
    
        //descripcion
        if(descripcionProducto == null || descripcionProducto.length === 0 || descripcionProducto === ""){
            $("#errorDescripcionProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorDescripcionProducto").fadeOut();
        }
        
        //archjivos
        if(imagenProducto == null || imagenProducto.length === 0 || imagenProducto === ""){
            $("#errorImagenProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorImagenProducto").fadeOut();
        }    
        return true; 
    
    });                    

    
//});

/*
function ErrorFormulario () {
    $("#errorForm").fadeIn("slow");
}

*/