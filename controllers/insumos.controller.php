<?php 

class ControladorInsumos{

	/*=============================================
	MOSTRAR INSUMOS
	=============================================*/

	static public function ctrMostrarInsumos($item, $valor) {

		$respuesta = ModeloInsumos::mdlMostrarInsumos($item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR CATEGORIA INSUMOS
	=============================================*/

	static public function ctrMostrarCategoriaInsumos($item, $valor) {

		$respuesta = ModeloInsumos::mdlMostrarCategoriaInsumos($item, $valor);

		return $respuesta;
	}


    /*=============================================
    REGISTRO DE INSUMOS
    =============================================*/

    public static function ctrAgregarInsumo() {

        if (isset($_POST["agregarInsumo"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionInsumo"])) {


                $datos = array("codigo" => $_POST["codigoInsumo"],
                                "descripcion"   => $_POST["descripcionInsumo"],
                                "id_categoria"   => $_POST["categoriaInsumo"],
                                "unidad_medida"    => $_POST["umInsumo"],
                                "stock"       => $_POST["stockInsumo"],
                                "estado"      => 1);

                $respuesta = ModeloInsumos::mdlAgregarInsumo($datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡Insumo Almacenado Correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "insumos";

                        }

                    });


                    </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡Error al guardar el insumo!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "insumos";

                        }

                    });


                </script>';

            }

        }

    }

    /*=============================================
    EDICION DE INSUMOS
    =============================================*/

    public static function ctrEditarInsumo() {

        if (isset($_POST["editarInsumo"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionInsumo"])) {

                $datos = array("descripcion" => $_POST["editarDescripcionInsumo"],
                    "id_categoria"   => $_POST["editarCategoriaInsumo"],
                    "unidad_medida"       => $_POST["editarUmInsumo"],
                    "stock"      => $_POST["editarStockInsumo"],
                    "id"      => $_POST["idInsumo"]);

                $respuesta = ModeloInsumos::mdlEditarInsumo($datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡El insumo ha sido actualizado!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "insumos";

                        }

                    });


                    </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡Error al actualizar el insumo!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "insumos";

                        }

                    });


                </script>';

            }

        }

    }


    /*=============================================
	ELIMINAR INSUMO
	=============================================*/

    static public function ctrEliminarInsumo(){

        if(isset($_GET["idInsumo"])){

            $datos = $_GET["idInsumo"];

            $respuesta = ModeloInsumos::mdlEliminarInsumo($datos);

            if($respuesta == "ok"){

                echo'<script>

				swal({
					  type: "success",
					  title: "¡El insumo ha sido eliminado!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "insumos";

								}
							})

				</script>';

            }

        }

    }


    /*=============================================
    REGISTRO DE CATEGORIA DE INSUMOS
    =============================================*/

    public static function ctrCrearCategoriaInsumo() {

        if (isset($_POST["crearCategoriaInsumo"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["catInsumo"])) {


                $datos = array("descripcion" => $_POST["catInsumo"]);

                $respuesta = ModeloInsumos::mdlCrearCategoriaInsumo($datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡Categoria Almacenada Correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "insumos";

                        }

                    });


                    </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡Error al guardar la categoria!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "insumos";

                        }

                    });


                </script>';

            }

        }

    }


}