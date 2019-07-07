var divProductosBuscados = $('#productosMasBuscados');
var divCategoriasFavoritas = $('#categoriasFavoritas');
var buttonProductosMasBuscados = $('#botonProductos');
var divGraficoProductosMasBuscados = $('#graficoProductosBuscados');
var divGraficoCategoriasFavoritas = $('#graficoCategoriasFavoritas');
var buttonCategoriasMasBuscadas = $('#botonCategorias');

$(document).ready(function ($) {
    divProductosBuscados.hide();
    divCategoriasFavoritas.hide();
});

function productosMasBuscados() {
    var obj ={};
    llamadaAjax(pathHome + 'Dashboard/productosMasBuscados', JSON.stringify(obj), true, "graficoProductosMasBuscados", "mostrarMensajeProductoVacio");
}

function obtenerNombres(productosDto) {
    var nombres = [];
    $.each(productosDto, function(i, producto) {
        nombres[i] = producto.nombre;
    });
    return nombres;
}

function obtenerCantidades(productosDto) {
    var cantidades = [];
    $.each(productosDto, function(i, producto) {
        cantidades[i] = producto.cantidad;
    });
    return cantidades;
}

function graficoProductosMasBuscados(productosDto) {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    var nombresProductos = obtenerNombres(productosDto);
    var cantidadesProductos = obtenerCantidades(productosDto);
    var cantidadMaxima = parseInt(cantidadesProductos[0]);
        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");

        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombresProductos,

                datasets: [{
                    label: "Revenue",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: cantidadesProductos,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: cantidadMaxima + cantidadMaxima * 30 /100,
                            maxTicksLimit: cantidadMaxima * 2
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
        divProductosBuscados.show();
        buttonProductosMasBuscados.text('Ocultar');
        buttonProductosMasBuscados.attr('onclick', 'ocultarGraficoProductos()');
}

function ocultarGraficoProductos() {
    divProductosBuscados.hide();
    buttonProductosMasBuscados.text('Mostrar');
    buttonProductosMasBuscados.attr('onclick', 'productosMasBuscados()');
}

function mostrarMensajeProductoVacio(err) {
    var elementoP = divProductosBuscados.find('.mensajeError');
    divProductosBuscados.show();
    divGraficoProductosMasBuscados.hide();
    if(elementoP.attr('class') === undefined){
        var elementoParam = $('<p class="small text-center text-muted my-5 mensajeError">');
        var elementoEm = $('<em>');
        elementoEm.text(err);
        elementoParam.append(elementoEm);
        divProductosBuscados.append(elementoParam);
    }
    buttonProductosMasBuscados.text('Ocultar');
    buttonProductosMasBuscados.attr('onclick', 'ocultarGraficoProductos()');

}

function categoriasMasBuscadas() {
    var obj ={};
    llamadaAjax(pathHome + 'Dashboard/categoriasFavoritas', JSON.stringify(obj), true, "graficoCategoriasFavoritas", "mostrarMensajeCategoriaVacia");
}

function graficoCategoriasFavoritas(productosDto) {
    var nombresCategorias = obtenerNombres(productosDto);
    var cantidadesCategorias = obtenerCantidades(productosDto);
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: nombresCategorias,
            datasets: [{
                data: cantidadesCategorias,
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#A716A3', '#A74811',],
            }],
        },
    });
    divCategoriasFavoritas.show();
    divGraficoCategoriasFavoritas.show();
    buttonCategoriasMasBuscadas.text('Ocultar');
    buttonCategoriasMasBuscadas.attr('onclick', 'ocultarGraficoCategorias()');
}

function mostrarMensajeCategoriaVacia() {
    var elementoP = divCategoriasFavoritas.find('.mensajeError');
    divCategoriasFavoritas.show();
    divGraficoCategoriasFavoritas.hide();
    if(elementoP.attr('class') === undefined){
        var elementoParam = $('<p class="small text-center text-muted my-5 mensajeError">');
        var elementoEm = $('<em>');
        elementoEm.text('No hay estadísticas para categorías favoritas');
        elementoParam.append(elementoEm);
        divCategoriasFavoritas.append(elementoParam);
    }
    buttonCategoriasMasBuscadas.text('Ocultar');
    buttonCategoriasMasBuscadas.attr('onclick', 'ocultarGraficoCategorias()');
}

function ocultarGraficoCategorias() {
    divCategoriasFavoritas.hide();
    buttonCategoriasMasBuscadas.text('Mostrar');
    buttonCategoriasMasBuscadas.attr('onclick', 'categoriasMasBuscadas()');
}




//console.log(dataURL);

function exportarGraficoPdf() {

    var doc = new jsPDF('p','mm','a4');
    doc.addHTML($('#myBarChart'), 15, 15, {
        'background': '#FF9030',
    }, function() {
        doc.save('dashboard.pdf');
    });
}