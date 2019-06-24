<link rel="stylesheet" href="<?php echo getBaseAddress() . "Webroot/css/compra/misCompras.css" ?>">

<div class="container mt-3">

    <div class="panel-heading">
        <div class="panel-title pt-3">
            <div class="row">
                <div class="col-xl-5 col-sm-5">
                    <h2>Mis Compras <i class="fa fa-cash-register ml-2"></i></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="justify-content-center">

        <div class="col-lg-12 mt-4">

            <div class="row user-row bg-light w-100 rounded">

                <div class="col-11 col-md-5 col-lg-7 pt-1">
                    <strong>Nº de Compra:</strong><br>
                    <span class="text-muted">Fecha de Compra</span>
                </div>

                <div class="col-1 col-sm-1 col-md-1 col-lg-5 dropdown-user" data-for="#producto">
                    <i class="fas fa-chevron-down float-right mr-3"></i>
                </div>

            </div>

            <div class="row user-infos" id="producto"> <!-- aca eze va a tener com hacer que se abra esto dinamicamnete -->
                <div class="col">
                    <div class="row">
                        <div class="col-md-6 img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvzOpl3-kqfNbPcA_u_qEZcSuvu5Je4Ce_FkTMMjxhB-J1wWin-Q"
                                 alt="" class="img-rounded">
                        </div>
                        <div class="col-md-6 details">
                            <blockquote>
                                <h5>Nombre del producto</h5>
                                <small><cite title="Source Title">Vendedor<i
                                                class="icon-map-marker"></i></cite></small>
                            </blockquote>
                            <p>
                                Email: <br>
                                Telefono: <br>
                                Metodo: <br>
                                Cantidad: <br>
                                Total:
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="<?php echo getBaseAddress() . "Webroot/js/compra/misCompras.js" ?>"></script>