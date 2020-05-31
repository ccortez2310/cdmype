 
  <?php 


    $insumos = ControladorInsumos::ctrMostrarInsumos(null, null);
    $categorias = ControladorInsumos::ctrMostrarCategoriaInsumos(null, null);

   ?>

  <div class="content-wrapper">
    
    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Insumos</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

              <li class="breadcrumb-item active">Insumos</li>

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

                    <div class="card-body">

                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-insumos-tab" data-toggle="pill" href="#custom-content-below-insumos" role="tab" aria-controls="custom-content-below-insumos" aria-selected="true">Insumos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-categorias-tab" data-toggle="pill" href="#custom-content-below-categorias" role="tab" aria-controls="custom-content-below-categorias" aria-selected="false">Categorías</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-insumos" role="tabpanel" aria-labelledby="custom-content-below-insumos-tab">

                                <div class="col-lg-12">

                                    <div class="card my-3">

                                        <div class="card-header align-items-center">

                                            <h5 class="mt-1 float-left">
                                                <i class="fa fa-cart-arrow-down text-info"></i> Listado de Insumos
                                            </h5>

                                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modalNuevoInsumo">
                                                <i class="fas fa-plus"></i> Nuevo
                                            </button>

                                        </div>

                                        <div class="card-body">

                                            <table class="table table-hover dtes dt-responsive nowrap tablaInsumos" style="width: 100%">

                                                <thead>

                                                <tr>
                                                    <th>Código</th>
                                                    <th>Insumo</th>
                                                    <th>Categoria</th>
                                                    <th>Stock Actual</th>
                                                    <th>Unidad Medida</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>

                                                </thead>

                                                <tbody>

                                                <?php

                                                foreach ($insumos as $key => $value) {

                                                    /*=============================================
                                                    REVISAR ESTADO
                                                    =============================================*/

                                                    if($value["estado"] == 0){

                                                        $colorEstado = "btn-danger";
                                                        $textoEstado = "Desactivado";
                                                        $estadoInsumo = 1;

                                                    }else{

                                                        $colorEstado = "btn-success";
                                                        $textoEstado = "Activado";
                                                        $estadoInsumo = 0;

                                                    }

                                                    if($value["stock"] < 5){
                                                        $colorStock = "bg-danger";
                                                    } else if($value["stock"] < 10){
                                                        $colorStock = "bg-warning";
                                                    } else {
                                                        $colorStock = "bg-success";
                                                    }

                                                    $unidadMedida = '<span class="badge badge-info">'.$value["unidad_medida"].'</span>';

                                                    $estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoInsumo='".$estadoInsumo."' idInsumo='".$value["id"]."'>".$textoEstado."</button>";

                                                    $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarInsumo' idInsumo='".$value["id"]."' data-toggle='modal' data-target='#modalEditarInsumo'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btnEliminarInsumo' idInsumo='".$value["id"]."'><i class='fas fa-trash'></i></button></div>";

                                                    ?>
                                                    <tr>

                                                        <td><?php echo $value["codigo"]; ?></td>
                                                        <td><?php echo $value["descripcion"]; ?></td>
                                                        <td><?php echo $value["categoria"]; ?></td>
                                                        <td class="<?php echo $colorStock; ?>"><?php echo $value["stock"]; ?></td>
                                                        <td><?php echo $unidadMedida; ?></td>
                                                        <td><?php echo $estado; ?></td>
                                                        <td><?php echo $acciones; ?></td>

                                                    </tr>

                                                <?php } ?>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane fade" id="custom-content-below-categorias" role="tabpanel" aria-labelledby="custom-content-below-categorias-tab">

                                <div class="col-lg-12">

                                    <div class="card my-3">

                                        <div class="card-header align-items-center">

                                            <h5 class="mt-1 float-left">
                                                <i class="fa fa-th-large text-info"></i> Listado de Categorias
                                            </h5>

                                            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modalAgregarCategoriaInsumo">
                                                <i class="fas fa-plus"></i> Nuevo
                                            </button>

                                        </div>

                                        <div class="card-body">

                                            <table class="table table-hover dtes dt-responsive tablaCategoriasInsumos" style="width: 100%">

                                                <thead>

                                                <tr>

                                                    <th>#</th>
                                                    <th>Categoria</th>
                                                    <th>Acciones</th>

                                                </tr>

                                                </thead>

                                                <tbody>

                                                <?php

                                                foreach ($categorias as $key => $value) {

                                                    $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoriaInsumo' idCategoriaInsumo='".$value["id"]."' data-toggle='modal' data-target='#modalEditarCategoriaInsumo'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btnEliminarCategoriaInsumo' idCategoriaInsumo='".$value["id"]."'><i class='fas fa-trash'></i></button></div>";

                                                    ?>

                                                    <tr>

                                                        <td><?php echo ($key + 1); ?></td>
                                                        <td><?php echo $value["descripcion"]; ?></td>
                                                        <td><?php echo $acciones; ?></td>

                                                    </tr>

                                                <?php } ?>

                                                </tbody>

                                            </table>

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

    </div>
    
  </div>
  

  <!--=====================================
  MODAL AGREGAR INSUMO
  ======================================-->

  <div class="modal fade" id="modalNuevoInsumo">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post">

          <!-- cabeza del modal -->

          <div class="modal-header">

            <h4 class="modal-title">
              <i class="fas fa-edit"></i> Nuevo Insumo
            </h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>

          <!-- cuerpo del modal -->

          <div class="modal-body">

            <!-- entrada para el codigo -->
            
            <div class="form-group">

                <label for="codigoInsumo">Código:</label>

                <input type="text" id="codigoInsumo" name="codigoInsumo" class="form-control validarCodigo" placeholder="Ej: 1001" required>
              
            </div>

            <!-- entrada para la descripcion -->

              <div class="form-group">

                  <label for="descripcionInsumo">Descripción:</label>

                  <input type="text" id="descripcionInsumo" name="descripcionInsumo" class="form-control" placeholder="Ej: Arroz, Tomates, otros." required>

              </div>

            <!-- entrada para la categoria -->

            <div class="form-group">

                <label for="categoriaInsumo">Categoria del Insumo:</label>

                <select class="form-control" id="categoriaInsumo" name="categoriaInsumo" required>

                    <option value="">Seleccione</option>

                    <?php

                        foreach ($categorias as $key => $value) {

                    ?>

                        <option value="<?php echo $value["id"]; ?>"> <?php echo $value["descripcion"]; ?></option>

                    <?php } ?>

                </select>
              
            </div>

             <!-- entrada para la unidad de medida -->

            <div class="form-group">

                <label for="umInsumo">Unidad de medida:</label>

                <select class="form-control" id="umInsumo" name="umInsumo" >

                    <option value="">Seleccione</option>
                    <option value="Unidades">Unidades</option>
                    <option value="Libras">Libras</option>
                    <option value="Kilogramos">Kilogramos</option>
                    <option value="Onzas">Onzas</option>
                    <option value="Gramos">Gramos</option>
                    <option value="Miligramos">Miligramos</option>
                    <option value="Litros">Litros</option>
                    <option value="Mililitros">Mililitros</option>

                </select>
              
            </div>


              <!--entrada para el stock minimo-->

              <div class="form-group" >

                  <label for="stockInsumo"> Stock Minimo:</label>

                  <input type="number" class="form-control" id="stockInsumo" name="stockInsumo" min="0" value="0">

              </div>

          </div>

          <div class="modal-footer justify-content-between">

            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            <button type="submit" class="btn btn-primary" name="agregarInsumo">
              <i class="fas fa-save"></i> Guardar Insumo 
            </button>

          </div>

          <?php

          $agregarInsumo = new ControladorInsumos();
          $agregarInsumo->ctrAgregarInsumo();

          ?>
          
        </form>

      </div>
      
    </div>
    
  </div>


  <!--=====================================
    MODAL EDITAR INSUMO
   ======================================-->

  <div class="modal fade" id="modalEditarInsumo">

      <div class="modal-dialog">

          <div class="modal-content">

              <form role="form" method="post">

                  <!-- cabeza del modal -->

                  <div class="modal-header">

                      <h4 class="modal-title">
                          <i class="fas fa-edit"></i> Editar Insumo
                      </h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>

                  </div>

                  <!-- cuerpo del modal -->

                  <div class="modal-body">

                      <!-- entrada para el codigo -->

                      <div class="form-group">

                          <label for="editarCodigoInsumo">Código:</label>

                          <input type="text" id="editarCodigoInsumo" name="editarCodigoInsumo" class="form-control" readonly>
                          <input type="hidden" id="idInsumo" name="idInsumo">
                      </div>

                      <!-- entrada para la descripcion -->

                      <div class="form-group">

                          <label for="editarDescripcionInsumo">Descripción:</label>

                          <input type="text" id="editarDescripcionInsumo" name="editarDescripcionInsumo" class="form-control" placeholder="Ej: Arroz, Tomates, otros." required>

                      </div>

                      <!-- entrada para la categoria -->

                      <div class="form-group">

                          <label for="editarCategoriaInsumo">Categoria del Insumo:</label>

                          <select class="form-control" id="editarCategoriaInsumo" name="editarCategoriaInsumo" required>

                              <option value="">Seleccione</option>

                              <?php

                              foreach ($categorias as $key => $value) {

                              ?>
                                  <option value="<?php echo $value["id"]; ?>"> <?php echo $value["descripcion"]; ?></option>

                              <?php } ?>

                          </select>

                      </div>

                      <!-- entrada para la unidad de medida -->

                      <div class="form-group">

                          <label for="editarUmInsumo">Unidad de medida:</label>

                          <select class="form-control" id="editarUmInsumo" name="editarUmInsumo" required>

                              <option value="">Seleccione</option>
                              <option value="Unidades">Unidades</option>
                              <option value="Libras">Libras</option>
                              <option value="Kilogramos">Kilogramos</option>
                              <option value="Onzas">Onzas</option>
                              <option value="Gramos">Gramos</option>
                              <option value="Miligramos">Miligramos</option>
                              <option value="Litros">Litros</option>
                              <option value="Mililitros">Mililitros</option>

                          </select>

                      </div>


                      <!--entrada para el stock minimo-->

                      <div class="form-group mt-2" >

                          <label for="editarStockInsumo"> Stock Minimo:</label>

                          <input type="number" class="form-control" id="editarStockInsumo" name="editarStockInsumo" min="0" >

                      </div>

                  </div>

                  <div class="modal-footer justify-content-between">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                      <button type="submit" class="btn btn-warning text-white" name="editarInsumo">
                          <i class="fas fa-save"></i> Guardar Cambios
                      </button>

                  </div>

                  <?php

                  $editarInsumo = new ControladorInsumos();
                  $editarInsumo->ctrEditarInsumo();

                  ?>

              </form>

          </div>

      </div>

  </div>

  <?php

  $eliminarInsumo = new ControladorInsumos();
  $eliminarInsumo->ctrEliminarInsumo();

  ?>



  <!--=====================================
    MODAL AGREGAR CATEGORIA
   ======================================-->

  <div class="modal fade" id="modalAgregarCategoriaInsumo">

      <div class="modal-dialog">

          <div class="modal-content">

              <form role="form" method="post">

                  <!-- cabeza del modal -->

                  <div class="modal-header">

                      <h4 class="modal-title">
                          <i class="fas fa-edit"></i> Agregar Categoria Insumo
                      </h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>

                  </div>

                  <!-- cuerpo del modal -->

                  <div class="modal-body">

                      <!-- entrada para el codigo -->

                      <div class="form-group">

                          <label for="catInsumo">Categoria:</label>

                          <input type="text" id="catInsumo" name="catInsumo" class="form-control" placeholder="Ingrese la categoria del insumo">

                      </div>

                  </div>

                  <div class="modal-footer justify-content-between">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                      <button type="submit" class="btn btn-primary" name="crearCategoriaInsumo">
                          <i class="fas fa-save"></i> Guardar
                      </button>

                  </div>

                  <?php

                  $crearCategoriaInsumo = new ControladorInsumos();
                  $crearCategoriaInsumo->ctrCrearCategoriaInsumo();

                  ?>

              </form>

          </div>

      </div>

  </div>


  <!--=====================================
    MODAL EDITAR CATEGORIA
   ======================================-->

  <div class="modal fade" id="modalEditarCategoriaInsumo">

      <div class="modal-dialog">

          <div class="modal-content">

              <form role="form" method="post">

                  <!-- cabeza del modal -->

                  <div class="modal-header">

                      <h4 class="modal-title">
                          <i class="fas fa-edit"></i> Editar Categoria Insumo
                      </h4>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>

                  </div>

                  <!-- cuerpo del modal -->

                  <div class="modal-body">

                      <!-- entrada para el codigo -->

                      <div class="form-group">

                          <label for="catInsumo">Categoria:</label>

                          <input type="text" id="catInsumo" name="catInsumo" class="form-control" placeholder="Ingrese la categoria del insumo">

                      </div>

                  </div>

                  <div class="modal-footer justify-content-between">

                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                      <button type="submit" class="btn btn-primary" name="crearCategoriaInsumo">
                          <i class="fas fa-save"></i> Guardar
                      </button>

                  </div>

                  <?php

                  $crearCategoriaInsumo = new ControladorInsumos();
                  $crearCategoriaInsumo->ctrCrearCategoriaInsumo();

                  ?>

              </form>

          </div>

      </div>

  </div>







