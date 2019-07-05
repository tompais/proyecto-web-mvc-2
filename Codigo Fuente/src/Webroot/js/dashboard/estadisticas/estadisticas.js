var divProductosBuscados = $('#productosMasBuscados');
var divCategoriasFavoritas = $('#categoriasFavoritas');
var buttonProductosMasBuscados = $('#botonProductos');
var buttonCategoriasMasBuscados = $('#botonCategorias');

$(document).ready(function ($) {
    divProductosBuscados.hide();
    divCategoriasFavoritas.hide();
});

function productosMasBuscados() {
    var obj ={};
    llamadaAjax(pathHome + 'Dashboard/productosMasBuscados', JSON.stringify(obj), true, "graficoProductosMasBuscados", "dummy");
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
                        max: cantidadMaxima + cantidadMaxima * 20 /100,
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


