<div id="content-wrapper">

    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb justify-content-between">
            <li>Productos más buscados</li>
            <li class="breadcrumb-item text">
                <button class="btn btn-primary" onclick="productosMasBuscados()" id="botonProductos">Mostrar</button>
            </li>
        </ol>
        <div id="productosMasBuscados">
            <div class="col-lg-12" id="graficoProductosBuscados">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-bar"></i>
                        Gráfico más buscados</div>
                    <div class="card-body" id="contenedorCanvasProductos">
                        <canvas id="myBarChart" width="100%" height="50"></canvas>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <button class="btn btn-primary" onclick="exportarGraficoProductosPdf()">Exportar a pdf</button>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>
            </div>
        </div>

        <ol class="breadcrumb justify-content-between">
            <li>Categorías favoritas</li>
            <li class="breadcrumb-item text">
                <button class="btn btn-primary" onclick="categoriasMasBuscadas()" id="botonCategorias">Mostrar</button>
            </li>
        </ol>
        <div id="categoriasFavoritas" class="row justify-content-center">
            <div class="col-lg-8" id="graficoCategoriasFavoritas">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-pie"></i>
                        Gráfico categorías</div>
                    <div class="card-body" id="contenedorCanvasCategorias">
                        <canvas id="myPieChart" width="100%" height="100"></canvas>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <button class="btn btn-primary" onclick="exportarGraficoCategoriasPdf()">Exportar a pdf</button>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>

            </div>
        </div>

        <ol class="breadcrumb justify-content-between">
            <li>Productos más vendidos</li>
            <li class="breadcrumb-item text">
                <button class="btn btn-primary" onclick="productosMasVendidos()" id="botonVendidos">Mostrar</button>
            </li>
        </ol>
        <div id="masVendido" class="row justify-content-center">
            <div class="col-lg-8" id="graficoMasVendidos">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-pie"></i>
                        Gráfico más vendidos</div>
                    <div class="card-body" id="contenedorCanvasVendidos">
                        <canvas id="myPieChartVendidos" width="100%" height="100"></canvas>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <button class="btn btn-primary" onclick="exportarGraficoVendidosPdf()">Exportar a pdf</button>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>

            </div>
        </div>

        <ol class="breadcrumb justify-content-between">
            <li>Productos con mayor monto acumulado</li>
            <li class="breadcrumb-item text">
                <button class="btn btn-primary" onclick="montosMasAcumulados()" id="botonAcumulados">Mostrar</button>
            </li>
        </ol>
        <div id="masAcumulado" class="row justify-content-center">
            <div class="col-lg-8" id="graficoMasAcumulados">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-pie"></i>
                        Gráfico montos involucrados</div>
                    <div class="card-body" id="contenedorCanvasAcumulados">
                        <canvas id="myPieChartAcumulados" width="100%" height="100"></canvas>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <button class="btn btn-primary" onclick="exportarGraficoAcumuladosPdf()">Exportar a pdf</button>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/jsPDF/dist/jspdf.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/dashboard/estadisticas/estadisticas.js"; ?>"></script>



