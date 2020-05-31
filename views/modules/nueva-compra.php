<?php

$proveedores = ControladorProveedores::ctrMostrarProveedores(null,null);
$deptos = ControladorProveedores::ctrMostrarDeptos(null,null);

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

                        <li class="breadcrumb-item"><a href="compras">Compras</a></li>

                        <li class="breadcrumb-item active">Nueva Compra</li>

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

                        <div class="card-header">

                            <h5 class="mt-1 float-left">
                                <i class="fa fa-list text-info"></i> Nueva Compra
                            </h5>

                            <a href="compras" class="btn btn-secondary float-right" >
                                <i class="fas fa-arrow-left"></i> Regresar
                            </a>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-group">

                                                <label for="txtBuscarProveedor" > Proveedor </label>

                                                <div class="row">

                                                    <div class="col-md-9">

                                                        <input type="hidden" id="idProveedor">
                                                        <input type="hidden" id="idUsuario" value="<?php echo $_SESSION["id_usuario"];?>">


                                                        <input type="text" id="txtBuscarProveedor" class="form-control" placeholder="Buscar Proveedor" autocomplete="off">

                                                    </div>

                                                    <div class="col-md-3 text-right">

                                                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalAgregarProveedorCompra">
                                                            <i class="fas fa-plus-square"> Nuevo </i>
                                                        </button>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <input type="text" class="form-control" disabled placeholder="Datos del Proveedor" id="txtProveedor">

                                                    <div class="input-group-append">

                                                        <button type="button" class="btn btn-danger" id="btnLimpiarProveedor" title="Haga clic para quitar el proveedor">
                                                            <i class="fas fa-times"></i>
                                                        </button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-group">

                                                <label for="fechaCompra">Fecha Compra:</label>

                                                <div class="input-group">
                                                    
                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text">

                                                            <i class="fas fa-calendar-alt"></i>

                                                        </span>

                                                    </div>

                                                    <input type="text" class="form-control datepicker" id="fechaCompra" placeholder="dd/mm/aaaa">
                                                    
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <select id="tipoDocumento" class="form-control" required >
                                                            <option value="">Seleccione Documento</option>
                                                            <option value="1">Factura</option>
                                                            <option value="2">Ticket</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="input-group d-flex">

                                                            <input type="text" class="form-control" id="serieDocumento" placeholder="Serie">

                                                            <span class="input-group-text"> - </span>

                                                            <input type="text" class="form-control" id="numDocumento" placeholder="Número">

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="card">

                                        <div class="card-body">

                                            <table class="table table-striped">

                                                <thead>
                                                <tr class="row">
                                                    <th class="col-md-5">Búsqueda de Insumos</th>
                                                    <th class="col-md-2">Unidad Medida</th>
                                                    <th class="col-md-2">Cantidad</th>
                                                    <th class="col-md-2">Precio</th>
                                                    <th class="col-md-1"> Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="row">

                                                    <td class="col-md-5">

                                                        <div class="input-group">

                                                            <div class="input-group-prepend">

                                                                <span class="input-group-text">

                                                                    <i class="fas fa-search"></i>

                                                                </span>

                                                            </div>
                                                            <input type="hidden" id="idInsumo">

                                                            <input type="text"  id="txtBusquedaInsumo" autocomplete="off" class="form-control" placeholder="Escriba el nombre del insumo">

                                                        </div>

                                                    </td>

                                                    <td class="col-md-2">
                                                        <div id="umInsumo">Unidad Medida</div>
                                                    </td>

                                                    <td class="col-md-2 dec">

                                                        <input type="number" class="form-control" id="cantidadInsumo" placeholder="Cantidad">

                                                    </td>

                                                    <td class="col-md-2">

                                                        <div class="input-group dec">

                                                            <div class="input-group-prepend">

                                                                <span class="input-group-text">
                                                                    <i class="fas fa-dollar-sign"></i>
                                                                </span>

                                                            </div>

                                                            <input type="number" class="form-control" id="precioInsumo" placeholder="Precio">

                                                        </div>

                                                    </td>

                                                    <td class="col-md-1">

                                                        <button type="button" class="btn btn-info" id="btnAgregar" title="Haga clic para agregar insumo al detalle de compra">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </button>

                                                    </td>

                                                </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="row justify-content-center" id="detalleVacio" >

                                                <div class="col-md-4 text-center text-warning">

                                                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                                                    <h4 class="mt-2">Aun no hay detalles de compra</h4>

                                                </div>

                                            </div>

                                            <ul class="sortable-list agile-list" id="detalleCompra">



                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="card">

                                        <div class="card-body">

<!--                                            <div class="row">-->
<!---->
<!--                                                <div class="col-md-8">-->
<!---->
<!--                                                    <div class="form-group">-->
<!---->
<!--                                                        <label> Tipo Compra </label>-->
<!---->
<!--                                                        <div class="row">-->
<!---->
<!--                                                            <div class="col-md-6">-->
<!---->
<!--                                                                <div class="custom-control custom-radio">-->
<!--                                                                    <input class="custom-control-input" type="radio" id="contado" name="tipoCompra" checked >-->
<!--                                                                    <label for="contado" class="custom-control-label" >Compra al Contado</label>-->
<!--                                                                </div>-->
<!---->
<!--                                                            </div>-->
<!---->
<!--                                                            <div class="col-md-6">-->
<!---->
<!--                                                                <div class="custom-control custom-radio">-->
<!--                                                                    <input class="custom-control-input" type="radio" id="credito" name="tipoCompra">-->
<!--                                                                    <label for="credito" class="custom-control-label">Compra al Crédito</label>-->
<!--                                                                </div>-->
<!---->
<!--                                                            </div>-->
<!---->
<!--                                                        </div>-->
<!---->
<!--                                                    </div>-->
<!---->
<!--                                                </div>-->
<!---->
<!--                                            </div>-->
<!---->
<!--                                            <hr>-->

                                            <div class="row">

                                                <div class="col-3">

                                                    <div class="form-group">

                                                        <label for="montoTotalContado">Monto Total</label>

                                                        <div class="input-group dec">

                                                            <div class="input-group-prepend">

                                                                <span class="input-group-text">

                                                                    <i class="fas fa-dollar-sign"></i>

                                                                </span>

                                                            </div>

                                                            <input type="number" class="form-control" id="montoTotalContado" value="0.00">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-1 text-center d-flex align-items-center">
                                                    <i class="fas fa-minus mt-3"></i>
                                                </div>

                                                <div class="col-3">

                                                    <div class="form-group">

                                                        <label for="totalDescuento">Total Descuento</label>

                                                        <div class="input-group dec">

                                                            <div class="input-group-prepend">

                                                                <span class="input-group-text">

                                                                    <i class="fas fa-dollar-sign"></i>

                                                                </span>

                                                            </div>

                                                            <input type="number" class="form-control" id="totalDescuento" value="0.00">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-5 text-right">

                                                    <div class="amountBig">

                                                        <span class="title">SubTotal: </span>

                                                        <span class="numberValue" id="subTotalCompra">
                                                            $0.00
                                                        </span>

                                                    </div>

                                                    <div class="amountBig">

                                                        <span class="title">IVA: </span>

                                                        <span class="numberValue" id="totalIva">
                                                            $0.00
                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="card">

                                        <div class="card-body">

                                            <div class="form-group">

                                                <label for="observaciones"> Observaciones: </label>

                                                <textarea  id="observaciones" rows="3" class="form-control">Ninguna</textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="text-right">

                                        <a href="compras" class="btn btn-secondary">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>

                                        <button type="button" class="btn btn-success" id="btnGuardarCompra" title="Haga clic para guardar la compra">
                                            <i class="fas fa-save"></i> Guardar Compra
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!--=====================================
MODAL AGREGAR PROVEEDOR
======================================-->

<div class="modal fade" id="modalAgregarProveedorCompra">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <form role="form" method="post">

                <!-- cabeza del modal -->

                <div class="modal-header">

                    <h4 class="modal-title">
                        <i class="fas fa-edit"></i> Nuevo Proveedor
                    </h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!-- cuerpo del modal -->

                <div class="modal-body">

                    <!-- entrada para el proveedor -->

                    <div class="row">

                        <div class="col-6">

                            <div class="card">

                                <div class="card-body">

                                    <div class="form-group">

                                        <label for="proveedor">Proveedor:</label>
                                        <input type="hidden" name="guardarDesdeCompras">
                                        <input type="text" id="proveedor" name="proveedor" class="form-control" placeholder="Ej: Distribuidora Comercial Algo" required>

                                    </div>

                                    <!-- entrada para el contacto -->

                                    <div class="form-group">

                                        <label for="contacto">Contacto:</label>

                                        <input type="text" id="contacto" name="contacto" class="form-control" placeholder="Ej: Jhon Doe" required>

                                    </div>


                                    <!-- entrada para el departamento -->

                                    <div class="form-group">

                                        <label for="depto">Departamento:</label>

                                        <select class="form-control depto" id="depto" name="depto" required>

                                            <option value="">Seleccione</option>

                                            <?php

                                            foreach ($deptos as $key => $value) {

                                                ?>

                                                <option value="<?php echo $value["id"]; ?>"> <?php echo $value["departamento"]; ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>


                                    <!-- entrada para el municipio -->

                                    <div class="form-group">

                                        <label for="mpio">Municipio:</label>

                                        <select class="form-control mpio" id="mpio" name="mpio" disabled>

                                            <option value="">Seleccione</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-6">

                            <div class="card">

                                <div class="card-body">

                                    <!--entrada para la direccion-->

                                    <div class="form-group" >

                                        <label for="direccion"> Dirección:</label>

                                        <textarea name="direccion" id="direccion" class="form-control" rows="3" placeholder="Ej: 4ta Calle oriente, Bo San Cristobal..." ></textarea>

                                    </div>

                                    <!--entrada para el telefono-->

                                    <div class="form-group" >

                                        <label for="telefono"> Teléfono:</label>

                                        <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ej: 2200-0000">
                                    </div>

                                    <!--entrada para el email-->

                                    <div class="form-group" >

                                        <label for="email"> Email:</label>

                                        <input type="email" name="email" id="email" class="form-control" placeholder="Ej: proveedor@algo.com">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-primary" name="agregarProveedor">
                        <i class="fas fa-save"></i> Guardar Proveedor
                    </button>

                </div>

                <?php

                $agregarProveedor = new ControladorProveedores();
                $agregarProveedor->ctrAgregarProveedor();

                ?>

            </form>

        </div>

    </div>

</div>


<script id="detalleCompraTemplate" type="text/x-jsrender">

    <li class="list-group-item list-group-item-warning disabled bg-info">

        <div class="row">
            <div class="col-2 text-center">
                <label>Cantidad</label>
            </div>
            <div class="col-5">
                <label>Insumo</label>
            </div>
            <div class="col-2 text-center">
                <label>Precio Unit.</label>
            </div>
            <div class="col-2 text-center">
                <label>Importe</label>
            </div>
            <div class="col-1 text-center">
                <label>Acción</label>
            </div>
        </div>
    </li>
    {{for items}}
    <li class="warning-element">
        <div class="row">
          <div class="col-2">
                <input class="form-control text-center" name="cantidadInsumo" type="number" placeholder="Cantidad" value="{{:cantidadInsumo}}" autocomplete="off" onchange="compra.actualizar({{:id}}, this);"/>
          </div>
            <div class="col-5">
                <input type="hidden" name="codigoInsumo" value="{{:codigoInsumo}}" />
                <input type="hidden" name="umInsumo" value="{{:umInsumo}}" />
                <label name="insumo">{{:insumo}} </label>
                <span class="badge badge-info">{{:umInsumo}} </span>

            </div>
            <div class="col-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </div>
                  <input class="form-control" type="number" name="precioInsumo" placeholder="Precio" value="{{:precioInsumo}}" onchange="compra.actualizar({{:id}}, this);"/>
                </div>
            </div>
            <div class="col-2">
                <input type="text" name="importe" class="form-control" style="text-align:center;border-style: none;background: #fff;cursor: default;" value="{{:total}}" disabled="true" />
            </div>
            <div class="col-1 text-right">
                <button type="button" class="btn btn-danger" onclick="compra.retirar({{:id}});">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </li>
    {{else}}
    <li class="text-center list-group-item text-warning">
        <i class="fas fa-exclamation-triangle fa-3x"></i>
        <h4 class="mt-2">Aun no hay detalles de compra</h4>
    </li>
    {{/for}}
</script>

<script src="views/js/nuevaCompra.js"></script>