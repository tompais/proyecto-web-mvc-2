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
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Total de compra</th>
                            <th>Total a facturar</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php

                        foreach ($compra as $facturacion){
                                echo '<tr>
                                    <td>' . $facturacion->getId() . '</td>';
                                foreach ($registroCompras as $registroCompra) {
                                  echo '     <td>' . $registroCompra->getNombreProducto() . '</td>
                                        <td>' . $registroCompra->getCantidad() . '</td>';
                                }
                                echo'    <td>' . $facturacion->getFechaCompra() . '</td>
                                    <td>$ ' . $facturacion->getTotal() . '</td>
                                    <td>$ ' . (($facturacion->getTotal() * 4) / 100) . '</td>
                                </tr>';
                            }

                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
        </div>


    </div>
