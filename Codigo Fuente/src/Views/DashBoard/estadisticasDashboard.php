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
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="50"></canvas>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>
                <div>
                    <button onclick="exportarGraficoProductosPdf()">Exportar pdf</button>
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
                    <div class="card-body">
                        <canvas id="myPieChart" width="100%" height="100"></canvas>
                    </div>
                    <div class="card-footer small text-muted"></div>
                </div>
                <div>
                    <button onclick="exportarGraficoCategoriasPdf()">Exportar pdf</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>

<script src="<?php echo getBaseAddress() . "Webroot/lib/jsPDF/dist/jspdf.min.js"; ?>"></script>
<script src="<?php echo getBaseAddress() . "Webroot/js/dashboard/estadisticas/estadisticas.js"; ?>"></script>



