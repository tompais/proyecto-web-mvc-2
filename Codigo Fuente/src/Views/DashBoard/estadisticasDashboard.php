<div id="content-wrapper">

    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <button class="btn btn-primary" onclick="productosMasBuscados()" id="botonProductos">Mostrar</button>
            </li>
            <li class="breadcrumb-item active">Productos más buscados</li>
        </ol>
        <div id="productosMasBuscados">


            <div class="col-lg-12" id="productosBuscados">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-bar"></i>
                        Bar Chart Example</div>
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="50"></canvas>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
        </div>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <button class="btn btn-primary" onclick="categoriasMasBuscadas()" id="botonCategorias">Mostrar</button>
            </li>
            <li class="breadcrumb-item active">Categorias favoritas</li>
        </ol>

        <div id="categoriasFavoritas">


            <div class="col-lg-8" id="categoriasFavoritas">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-pie"></i>
                        Pie Chart Example</div>
                    <div class="card-body">
                        <canvas id="myPieChart" width="100%" height="100"></canvas>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
        </div>

        <p class="small text-center text-muted my-5">
            <em>More chart examples coming soon...</em>
        </p>


    </div>
    <!-- /.container-fluid -->

</div>
<script src="<?php echo getBaseAddress() . "Webroot/js/dashboard/estadisticas/estadisticas.js"; ?>"></script>
