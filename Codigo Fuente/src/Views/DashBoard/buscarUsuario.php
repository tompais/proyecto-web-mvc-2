<script>
    const pathAccionBanearUsuario = "<?php echo getBaseAddress() . "DashBoard/banear"; ?>";
    const palabraBuscada = "<?php echo $palabraBuscada ?>"
</script>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Usuario Buscado</li>
        </ol>

        <?php

        if ($usuario->getUsername() == ""){
            echo '<h5 class="text-center text-black-50">No se ha encontrado el usuario buscado</h5>';
        }
        else {
            echo ' <div class="panel panel-default mt-3 border">
                <table class="table table-hover mb-0">
                    <tr>
                        <td>
                            <input type="hidden" id="inputUsuarioId" value="'. $usuario->getId() .'">
                            <span><strong>Username:</strong> ' . $usuario->getUsername() . '</span><br>';

                            if ($usuario->getFechaBaneo() != null){
                                echo '<span><strong>Estado:</strong> Baneado</span><br>';
                                echo '<span><strong>Fecha de Baneo:</strong> '. $usuario->getFechaBaneo() .'</span>';
                            }
                            else{
                                echo '<span><strong>Estado:</strong> No baneado</span>';
                            }

         echo '         </td>
                        <td class="text-right text-nowrap">';
                           if ($usuario->getFechaBaneo() != null){
                               echo '<button class="btn btn-xs btn-success"><i class="fas fa-user-check"></i></button>';
                           }
                           else {
                               echo '<button class="btn btn-xs btn-danger"><i class="fas fa-user-times" data-toggle="modal" data-target="#modalBaneo"></i></button>';
                           }
            echo        '</td>
                    </tr>
                </table>
            </div>';
        }

        ?>

        <!-- Modal -->
        <div class="modal fade" id="modalBaneo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ingrese la fecha de Baneo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputFechaNacimiento">Fecha de Baneo</label>
                                <div class="input-group">
                                    <input type="text" name="fechaBaneo" id="inputFechaBaneo" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="btnInputFechaBaneo" type="button"><i class="fas fa-calendar-alt"></i></button>
                                    </div>
                                </div>
                                <div id="errorFechaNacimiento" class="error"><i class="fas fa-exclamation-triangle"></i> Formato de Fecha Inválido
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" id="btnBanear">Banear</button>
                        </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?php echo getBaseAddress() . "Webroot/js/dashboard/buscarUsuario.js"; ?>"></script>