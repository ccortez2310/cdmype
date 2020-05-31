<?php

$proveedores = ControladorProveedores::ctrMostrarProveedores(null,null);
$deptos = ControladorProveedores::ctrMostrarDeptos(null,null);

?>

<div class="content-wrapper">

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0 text-dark">Proveedores</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

                        <li class="breadcrumb-item active">Proveedores</li>

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
                                <i class="fa fa-user-tag text-info"></i> Listado de Proveedores
                            </h5>

                            <button type="button" class="btn btn-info float-right" data-toggle="modal"
                                    data-target="#modalNuevoProveedor">
                                <i class="fas fa-plus"></i> Nuevo
                            </button>

                        </div>

                        <div class="card-body">

                            <table class="table table-hover dtes dt-responsive nowrap tablaProveedores"
                                   style="width: 100%">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Contacto</th>
                                    <th>Dirección </th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($proveedores as $key => $value ) :
                                    $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProveedor' idProveedor='".$value["id"]."' data-toggle='modal' data-target='#modalEditarProveedor'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btnEliminarProveedor' idProveedor='".$value["id"]."'><i class='fas fa-trash'></i></button></div>";
                                ?>

                                    <tr>
                                        <td><?php echo ($key + 1); ?></td>
                                        <td><?php echo $value["proveedor"]; ?></td>
                                        <td><?php echo $value["contacto"]; ?></td>
                                        <td><?php echo $value["direccion"].', '.$value["municipio"]; ?></td>
                                        <td><?php echo $value["telefono"]; ?></td>
                                        <td><?php echo $value["email"]; ?></td>
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
MODAL AGREGAR PROVEEDOR
======================================-->

<div class="modal fade" id="modalNuevoProveedor">

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

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div class="modal fade" id="modalEditarProveedor">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <form role="form" method="post">

                <!-- cabeza del modal -->

                <div class="modal-header">

                    <h4 class="modal-title">
                        <i class="fas fa-edit"></i> Editar Proveedor
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

                                        <label for="editarProveedor">Proveedor:</label>

                                        <input type="text" id="editarProveedor" name="editarProveedor" class="form-control" placeholder="Ej: Distribuidora Comercial Algo" required>
                                        <input type="hidden" id="idProveedor" name="idProveedor">

                                    </div>

                                    <!-- entrada para el contacto -->

                                    <div class="form-group">

                                        <label for="editarContacto">Contacto:</label>

                                        <input type="text" id="editarContacto" name="editarContacto" class="form-control" placeholder="Ej: Jhon Doe" required>

                                    </div>


                                    <!-- entrada para el departamento -->

                                    <div class="form-group">

                                        <label for="editarDepto">Departamento:</label>

                                        <select class="form-control depto" id="editarDepto" name="editarDepto" required>

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

                                        <label for="editarMpio">Municipio:</label>

                                        <select class="form-control mpio" id="editarMpio" name="editarMpio" >

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

                                        <label for="editarDireccion"> Dirección:</label>

                                        <textarea name="editarDireccion" id="editarDireccion" class="form-control" rows="3" placeholder="Ej: 4ta Calle oriente, Bo San Cristobal..." ></textarea>

                                    </div>

                                    <!--entrada para el telefono-->

                                    <div class="form-group" >

                                        <label for="editarTelefono"> Teléfono:</label>

                                        <input type="tel" name="editarTelefono" id="editarTelefono" class="form-control" placeholder="Ej: 2200-0000">
                                    </div>

                                    <!--entrada para el email-->

                                    <div class="form-group" >

                                        <label for="editarEmail"> Email:</label>

                                        <input type="email" name="editarEmail" id="editarEmail" class="form-control" placeholder="Ej: proveedor@algo.com">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-warning text-white" name="editProveedor">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>

                </div>

                <?php

                $editarProveedor = new ControladorProveedores();
                $editarProveedor->ctrEditarProveedor();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$eliminarProveedor = new ControladorProveedores();
$eliminarProveedor->ctrEliminarProveedor();

?>