$(document).ready(function() {

    $("#inputImagen").fileinput({
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 10,
        mainClass: "input-group-lg"
    });

    $("#btnAgregar").click(function(){

        var nombreProducto = $('#inputNombreProducto').val();
        var precioProducto = $('#inputPrecioProducto').val();
        
        var categoriaProducto = $('#selectCategoriaProducto').val();
        var descripcionProducto = $('#textareaDescripcionProducto').val();
        
        //var imagenProducto = $('#inputImagenProducto')[0].val();
        var imagenProducto = $('#inputImagenProducto')[0].files;

        //nombre de producto
        if(nombreProducto === null || nombreProducto === "" || nombreProducto.length < 5 || nombreProducto.length > 50 ){
            $("#errorNombreProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorNombreProducto").fadeOut();
        }
      
        //precio
        if(precioProducto === null || precioProducto.length === 0 || precioProducto === ""){
            $("#errorPrecioProducto").fadeIn("slow");
            return false;
        }
        else{
            $("#errorPrecioProducto").fadeOut();
        }

        //categoria
        if(categoriaProducto === null || categoriaProducto === 0){
            $("#errorCategoriaProducto").fadeIn("slow");
            return false;
        }
        else{
            $("#errorCategoriaProducto").fadeOut();
        }

        //descripcion
        if(descripcionProducto === null || descripcionProducto.length < 0 || descripcionProducto.length > 200){
            $("#errorDescripcionProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorDescripcionProducto").fadeOut();
        }
        
        //archivos
        if(imagenProducto === null || imagenProducto.length === 0 || imagenProducto === ""){
            $("#errorImagenProducto").fadeIn("slow");
            return false;        
        }
        else{
            $("#errorImagenProducto").fadeOut();
        }    

    });

});

// Image Preview
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36251023-1']);
_gaq.push(['_setDomainName', 'jqueryscript.net']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
