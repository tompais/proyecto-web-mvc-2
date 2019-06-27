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
                            <span><strong>Username:</strong> ' . $usuario->getUsername() . '</span><br>
                            <span><strong>Estado:</strong> No baneado</span>
                        </td>
                        <td class="text-right text-nowrap">
                            <button class="btn btn-xs btn-danger"><i class="fas fa-user-times" data-toggle="modal" data-target="#modalBaneo"></i></button>
                            <button class="btn btn-xs btn-success"><i class="fas fa-user-check"></i></button>
                        </td>
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
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger">Banear</button>
                    </div>
                </div>
            </div>
        </div>

    </div>