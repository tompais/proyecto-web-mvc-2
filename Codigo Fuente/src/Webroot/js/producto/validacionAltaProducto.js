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

    const regexLetrasYNumerosYEspacios = /^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
    const regexSOLONumeros = /^[0-9]+$/;

    function validarNombreProducto() {

        var validacion = false;
        var nombreProducto = $('#inputNombreProducto').val();

        if(nombreProducto === null || nombreProducto === "" || nombreProducto.length === 0){
            $("#errorNombreProducto").find("span").text("Ingrese el nombre del producto");
            $("#errorNombreProducto").fadeIn("slow");
        }
        else if (nombreProducto.length < 5 || nombreProducto.length > 50 ) {
            $("#errorNombreProducto").find("span").text("El nombre del producto debe tener entre 5 y 50 caracteres");
            $("#errorNombreProducto").fadeIn("slow");
        }
        else if (!regexLetrasYNumerosYEspacios.test(nombreProducto)) {
            $("#errorNombreProducto").find("span").text("El nombre del producto solo puede contener letras y numeros");
            $("#errorNombreProducto").fadeIn("slow");
        }
        else{
            validacion = true;
        }
        return validacion;
    }

    function validarPrecioProducto() {

        var validacion = false;
        var precioProducto = $('#inputPrecioProducto').val();

        if(precioProducto === null || precioProducto.length === 0 ){
            $("#errorPrecioProducto").find("span").text("Ingrese el precio del producto");
            $("#errorPrecioProducto").fadeIn("slow");
        }
        else if (!regexSOLONumeros.test(precioProducto)){
            $("#errorPrecioProducto").find("span").text("Ingrese solo numeros en el precio");
            $("#errorPrecioProducto").fadeIn("slow");
        }
        else if (precioProducto.length > 8){
            $("#errorPrecioProducto").find("span").text("El Precio maximo de un producto es de 8 digitos");
            $("#errorPrecioProducto").fadeIn("slow");
        }
        else{
            validacion = true;
        }
        return validacion;
    }

    function validarCategoriaProducto() {

        var validacion = false;
        var categoriaProducto = $('#selectCategoriaProducto').val();

        if(categoriaProducto === null || categoriaProducto === 0){
            $("#errorCategoriaProducto").find("span").text("Elija una de las categorias disponibles");
            $("#errorCategoriaProducto").fadeIn("slow");
        }
        else{
            validacion = true;
        }
        return validacion;
    }

    function validaDescripcionProducto() {

        var validacion = false;
        var descripcionProducto = $('#textareaDescripcionProducto').val();

        if(descripcionProducto.length > 200){
            $("#errorDescripcionProducto").find("span").text("Su descripcion solo puede tener 200 caracteres");
            $("#errorDescripcionProducto").fadeIn("slow");
            return false;
        }
        else{
            validacion = true;
        }

        return validacion;
    }

    function validarImagenProducto() {

        var validacion = false;
        var imagenProducto = $('#inputImagenProducto')[0].files;

        if(imagenProducto === null || imagenProducto.length === 0 || imagenProducto === ""){
            $("#errorImagenProducto").find("span").text("Elija al menos una foto para su productos");
            $("#errorImagenProducto").fadeIn("slow");
            return false;
        }
        else{
            validacion = true;
        }

        return validacion;
    }

    function validarAltaProducto () {

        return  validarNombreProducto() &&
                validarPrecioProducto() &&
                validaDescripcionProducto() &&
                validarCategoriaProducto() &&
                validarImagenProducto();
    }


    $("#btnAgregar").click(function(){

        $(".error").fadeOut();
        return validarAltaProducto();
    });
