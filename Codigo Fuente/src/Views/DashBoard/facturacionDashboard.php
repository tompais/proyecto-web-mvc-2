<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo getBaseAddress(). "DashBoard/inicio"?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Facturaciones</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">

            <div class="card-header">
                <i class="fas fa-table"></i>
                Facturaciones de mes <?php echo date("m") ?>
            </div>

            <div class="card-body">

                <?php
                        if (!$compra) {
                            echo '<h5 class="text-center text-black-50">El usario no posee compras a facturar </h5>';
                        }
                        else{
                            echo "<div class='table-responsive'>
                                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                
                
                                        <thead>
                                        <tr class='text-center'>
                                            <th >Nº de Compra</th>
                                            <th>Fecha</th>
                                            <th>Total de compra</th>
                                            <th>Total a facturar</th>
                                        </tr>
                                        </thead>
                
                                        <tbody>";

                                        $totalFacturacion = 0;
                                        foreach ($compra as $facturacion){
                                                echo '<tr class=\"text-center\">
                                                        <td>' . $facturacion->getId() . '</td>                                    
                                                        <td>' . $facturacion->getFechaCompra() . '</td>                                        
                                                        <td>$ ' . $facturacion->getTotal() . '</td>
                                                        <td>$ ' . (($facturacion->getTotal() * 4) / 100) . '</td>
                                                    </tr>';
                
                                                $totalFacturacion += (($facturacion->getTotal()*4)/100);
                                        }
                

                         echo'         </tbody>
                
                                    </table>
                
                                    <form method="post" action="'. getBaseAddress() . "DashBoard/generarFacturacion" . '">
                                        <input type="hidden" id="inputUsuarioId" name="usuarioId" value="' . $compra[0]->getCompradorId() . '">
                                        <input type="hidden" id="inputTotalFacturacion" name="totalFacturacion" value="'. $totalFacturacion . '">
                                        <input type="hidden" id="inputPalabraBuscada" name="palabraBuscada" value="'.  $palabraBuscada . '">
                                        <button class="btn btn-primary float-right mr-5"><i class="fas fa-money-check mr-2"></i>Generar Facturacion</button>
                                    </form>
                
                                </div>';
                        }
                ?>

            </div>
            <div class="card-footer small text-muted"></div>
        </div>


    </div>
