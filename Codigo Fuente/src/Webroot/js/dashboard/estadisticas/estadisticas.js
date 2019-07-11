var divProductosBuscados = $('#productosMasBuscados');
var divCategoriasFavoritas = $('#categoriasFavoritas');
var buttonProductosMasBuscados = $('#botonProductos');
var divGraficoProductosMasBuscados = $('#graficoProductosBuscados');
var divGraficoCategoriasFavoritas = $('#graficoCategoriasFavoritas');
var buttonCategoriasMasBuscadas = $('#botonCategorias');
var divProductosVendidos = $('#masVendido');
var buttonProductosMasVendidos = $('#botonVendidos');
var divGraficoMasVendidos = $('#graficoMasVendidos');
var divMontosInvolucrados = $('#masAcumulado');
var divGraficoMasInvolucrados = $('#graficoMasAcumulados');
var buttonMontosInvolucrados = $('#botonAcumulados');

$(document).ready(function ($) {
    divProductosBuscados.hide();
    divCategoriasFavoritas.hide();
    divProductosVendidos.hide();
    divMontosInvolucrados.hide();
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
    resetCanvasProductos();
    var ctx = document.getElementById('myBarChart');

        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombresProductos,

                datasets: [{
                    label: "Cantidad",
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
                            max: cantidadMaxima + cantidadMaxima * 40 /100,
                            maxTicksLimit: cantidadMaxima * 3
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

function exportarGraficoProductosPdf() {
    var myBarChar = $('#myBarChart')[0];
    var barChartDataUrl = myBarChar.toDataURL("img/png");
    var doc = new jsPDF('l', 'mm', 'a4');
    doc.addImage(barChartDataUrl, 'JPEG', 50, 50, 200, 100);
    doc.save('Estadistica producto.pdf');
}

function exportarGraficoCategoriasPdf() {
    var myPieChar = $('#myPieChart')[0];
    var pieChartDataUrl = myPieChar.toDataURL("img/png");
    var doc = new jsPDF('l', 'mm', 'a4');
    doc.addImage(pieChartDataUrl, 'JPEG', 50, 50, 200, 100);
    doc.save('Estadistica categorias.pdf');
}

function resetCanvasProductos() {
    $('#myBarChart').remove(); // this is my <canvas> element
    $('#contenedorCanvasProductos').append('<canvas id="myBarChart" width="100%" height="50">');
}

function resetCanvasCategorias() {
    $('#myPieChart').remove(); // this is my <canvas> element
    $('#contenedorCanvasCategorias').append('<canvas id="myPieChart" width="100%" height="50">');
}

function resetCanvasProductosVendidos() {
    $('#myPieChartVendidos').remove(); // this is my <canvas> element
    $('#contenedorCanvasVendidos').append('<canvas id="myPieChartVendidos" width="100%" height="50">');
}
function productosMasVendidos() {
    var obj ={};
    llamadaAjax(pathHome + 'Dashboard/productosMasVendidos', JSON.stringify(obj), true, "graficoProductosMasVendidos", "mostrarMensajeProductoVendidoVacio");
}

function graficoProductosMasVendidos(productosDto) {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    var nombresProductos = obtenerNombres(productosDto);
    var cantidadesProductos = obtenerCantidades(productosDto);
    var cantidadMaxima = parseInt(cantidadesProductos[0]);
    // Bar Chart Example
    resetCanvasProductosVendidos();
    var ctx = document.getElementById('myPieChartVendidos');

    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresProductos,

            datasets: [{
                label: "Cantidad",
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
                        max: cantidadMaxima + cantidadMaxima * 40 /100,
                        maxTicksLimit: cantidadMaxima * 3
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
    divProductosVendidos.show();
    divGraficoMasVendidos.show();
    buttonProductosMasVendidos.text('Ocultar');
    buttonProductosMasVendidos.attr('onclick', 'ocultarGraficoProductosVendidos()');

}

function ocultarGraficoProductosVendidos() {
    divProductosVendidos.hide();
    buttonProductosMasVendidos.text('Mostrar');
    buttonProductosMasVendidos.attr('onclick', 'productosMasVendidos()');
}

function mostrarMensajeProductoVendidoVacio(err) {
    var elementoP = divProductosVendidos.find('.mensajeError');
    divProductosVendidos.show();
    divGraficoMasVendidos.hide();
    if(elementoP.attr('class') === undefined){
        var elementoParam = $('<p class="small text-center text-muted my-5 mensajeError">');
        var elementoEm = $('<em>');
        elementoEm.text(err);
        elementoParam.append(elementoEm);
        divProductosVendidos.append(elementoParam);
    }
    buttonProductosMasVendidos.text('Ocultar');
    buttonProductosMasVendidos.attr('onclick', 'ocultarGraficoProductos()');

}

function resetCanvasMontosInvolucrados() {
    $('#myPieChartAcumulados').remove(); // this is my <canvas> element
    $('#contenedorCanvasAcumulados').append('<canvas id="myPieChartAcumulados" width="100%" height="50">');
}

function montosMasAcumulados() {
    var obj ={};
    llamadaAjax(pathHome + 'Dashboard/montosInvolucrados', JSON.stringify(obj), true, "graficoMontosInvolucrados", "mostrarMensajeMontoAcumuladoVacio");
}

function graficoMontosInvolucrados(productosDto) {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    var nombresProductos = obtenerNombres(productosDto);
    var cantidadesProductos = obtenerCantidades(productosDto);
    var cantidadMaxima = parseInt(cantidadesProductos[0]);
    // Bar Chart Example
    resetCanvasMontosInvolucrados();
    var ctx = document.getElementById('myPieChartAcumulados');

    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresProductos,

            datasets: [{
                label: "Cantidad",
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
                        max: cantidadMaxima + cantidadMaxima * 40 /100,
                        maxTicksLimit: cantidadMaxima * 3
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
    divMontosInvolucrados.show();
    divGraficoMasInvolucrados.show();
    buttonMontosInvolucrados.text('Ocultar');
    buttonMontosInvolucrados.attr('onclick', 'ocultarGraficoMontosInvolucrados()');

}

function ocultarGraficoMontosInvolucrados() {
    divMontosInvolucrados.hide();
    buttonMontosInvolucrados.text('Mostrar');
    buttonMontosInvolucrados.attr('onclick', 'montosMasAcumulados()');
}

function mostrarMensajeMontoAcumuladoVacio(err) {
    var elementoP = divMontosInvolucrados.find('.mensajeError');
    divMontosInvolucrados.show();
    divGraficoMasInvolucrados.hide();
    if(elementoP.attr('class') === undefined){
        var elementoParam = $('<p class="small text-center text-muted my-5 mensajeError">');
        var elementoEm = $('<em>');
        elementoEm.text(err);
        elementoParam.append(elementoEm);
        divMontosInvolucrados.append(elementoParam);
    }
    buttonMontosInvolucrados.text('Ocultar');
    buttonMontosInvolucrados.attr('onclick', 'ocultarGraficoMontosInvolucrados()');

}