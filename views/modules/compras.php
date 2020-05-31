<?php

$compras = ControladorCompras::ctrMostrarCompras(null, null);

?>

<div class="content-wrapper">

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0 text-dark">Compras</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

                        <li class="breadcrumb-item active">Compras</li>

                    </ol>

                </div>

            </div>

        </div>

    </div>

    <div class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card card-primary card-outline">

                        <div class="card-header align-items-center">

                            <h5 class="mt-1 float-left">
                                <i class="fa fa-cart-arrow-down text-info"></i> Listado de Compras
                            </h5>

                            <a href="nueva-compra" class="btn btn-info float-right" >
                                <i class="fas fa-plus-circle"></i> Nueva Compra
                            </a>

                        </div>

                        <div class="card-body">

                            <table class="table table-sm table-hover dtes dt-responsive nowrap tablaCompras" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Documento</th>
                                    <th>Serie - No.</th>
                                    <th>Proveedor</th>
                                    <th>Total Compra</th>
                                    <th>Tipo Compra</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($compras as $key => $value) :

                                    $d = date('d-m-Y', strtotime($value["fecha_compra"]));

                                    $fecha = '<i class="fa fa-calendar-alt"></i> '.$d;

                                    if ($value["tipo_compra"] == "Contado"){

                                        $tipoCompra = '<span class="badge badge-info">'.$value["tipo_compra"].'</span>';

                                    } else {

                                        $tipoCompra = '<span class="badge badge-warning text-white">'.$value["tipo_compra"].'</span>';

                                    }

                                    /*=============================================
                                    TIPO DOCUMENTO
                                    =============================================*/

                                    if($value["tipo_documento"] != "") {

                                        $tipoDocumento = $value["tipo_documento"];
                                        $valoresDocumento = $value["serie_documento"].' - '.$value["num_documento"];

                                    } else {

                                        $tipoDocumento = "Sin Documento";
                                        $valoresDocumento = "Desconocido";

                                    }


                                    /*=============================================
                                    PROVEEDOR
                                    =============================================*/

                                    if($value["proveedor"] != "") {

                                        $proveedor = $value["proveedor"];

                                    } else {

                                        $proveedor = "Desconocido";

                                    }

                                    /*=============================================
                                    REVISAR ESTADO
                                    =============================================*/

                                    if ($value["estado"] == 0) {

                                        $colorEstado = "btn-danger";
                                        $textoEstado = "Anulada";
                                        $estadoCompra = 1;
                                        $acciones = "<div class='btn-group'><button class='btn btn-info disabled' ><i class='fas fa-eye'></i></button></div>";
                                        $estado = "<button class='btn ".$colorEstado." btn-xs disabled' estadoCompra='".$estadoCompra."' >".$textoEstado."</button>";


                                    } else {

                                        $colorEstado = "btn-success";
                                        $textoEstado = "Activa";
                                        $estadoCompra = 0;
                                        $acciones = "<div class='btn-group'><button class='btn btn-info btnVerDetalleCompra' idCompra='".$value["id"]."' data-toggle='modal' data-target='#modalVerDetalleCompra' title='Ver Detalle de la Compra'><i class='fas fa-eye'></i></button></div>";

                                        $estado = "<button class='btn ".$colorEstado." btn-xs btnAnularCompra' estadoCompra='".$estadoCompra."' idCompra='".$value["id"]."' title='Haga clic para cambiar el estado'>".$textoEstado."</button>";
                                    }




                                    ?>

                                    <tr>
                                        <td><?php echo ($key + 1); ?></td>
                                        <td><?php echo $fecha; ?></td>
                                        <td><?php echo $tipoDocumento; ?></td>
                                        <td><?php echo $valoresDocumento; ?></td>
                                        <td><?php echo $proveedor; ?></td>
                                        <td><?php echo '$'.$value["total_compra"]; ?></td>
                                        <td><?php echo $tipoCompra; ?></td>
                                        <td><?php echo $value["observaciones"]; ?></td>
                                        <td><?php echo $estado; ?></td>
                                        <td><?php echo $acciones; ?></td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!--=====================================
MODAL VER DETALLE COMPRA
======================================-->

<div class="modal fade" id="modalVerDetalleCompra">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <!-- cabeza del modal -->

            <div class="modal-header">

                <h4 class="modal-title">
                    <i class="fas fa-list"></i> Detalle de Compra
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <div class="card">

                    <div class="card-body">

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total Importe</th>
                            </tr>
                            </thead>

                            <tbody id="detalleCompra">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>

        </div>

    </div>

</div>


<?php

#Para anular la compra
$compra = new ControladorCompras();
$compra->ctrAnularCompra();

?>




