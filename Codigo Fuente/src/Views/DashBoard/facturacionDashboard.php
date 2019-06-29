<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Facturaciones</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Facturaciones de mes Mayo</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nº de Compra</th>
                            <th>Fecha</th>
                            <th>Total de compra</th>
                            <th>Total a facturar</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $totalFacturacion = 0;
                        foreach ($compra as $facturacion){
                                echo '<tr>
                                        <td>' . $facturacion->getId() . '</td>                                    
                                        <td>' . $facturacion->getFechaCompra() . '</td>                                        
                                        <td>$ ' . $facturacion->getTotal() . '</td>
                                        <td>$ ' . (($facturacion->getTotal() * 4) / 100) . '</td>
                                    </tr>';

                                $totalFacturacion += (($facturacion->getTotal()*4)/100);
                        }

                        ?>

                        </tbody>
                    </table>

                    <form method="post" action="<?php echo getBaseAddress() . "DashBoard/generarFacturacion" ?>">
                        <input type="hidden" id="inputUsuarioId" name="usuarioId" value="<?php echo $compra[0]->getCompradorId() ?>">
                        <input type="hidden" id="inputTotalFacut" name="totalFacturacion" value="<?php echo $totalFacturacion ?>">
                        <button class="btn btn-primary float-right">Generar Facturacion</button>
                    </form>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>


    </div>
