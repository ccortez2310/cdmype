<?php

class ControladorProveedores {

    /*=============================================
    MOSTRAR PROVEEDORES
    =============================================*/

    static public function ctrMostrarProveedores($item, $valor) {

        $respuesta = ModeloProveedores::mdlMostrarProveedores($item, $valor);

        return $respuesta;
    }

    /*=============================================
    MOSTRAR DEPTOS
    =============================================*/

    static public function ctrMostrarDeptos($item, $valor) {

        $respuesta = ModeloProveedores::mdlMostrarDeptos($item, $valor);

        return $respuesta;
    }

    /*=============================================
    MOSTRAR DEPTOS
    =============================================*/

    static public function ctrMostrarMpios($item, $valor) {

        $respuesta = ModeloProveedores::mdlMostrarMpios($item, $valor);

        return $respuesta;
    }

    /*=============================================
    REGISTRO DE PROVEEDORES
    =============================================*/

    public static function ctrAgregarProveedor() {

        if (isset($_POST["agregarProveedor"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["proveedor"])) {


                $datos = array("proveedor" => $_POST["proveedor"],
                    "contacto"   => $_POST["contacto"],
                    "direccion"   => $_POST["direccion"],
                    "id_municipio"    => $_POST["mpio"],
                    "telefono"       => $_POST["telefono"],
                    "email"      => $_POST["email"]);

                $respuesta = ModeloProveedores::mdlAgregarProveedor($datos);

                if ($respuesta == "ok") {

                    if (isset($_POST["guardarDesdeCompras"])){

                        $redirect = "nueva-compra";

                    } else {

                        $redirect = "proveedores";

                    }

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡Proveedor Registrado Correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "'.$redirect.'";

                        }

                    });


                    </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡Error al guardar el proveedor, favor no ingresar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "proveedores";

                        }

                    });


                </script>';

            }

        }

    }

    /*=============================================
    EDITAR PROVEEDOR
    =============================================*/

    public static function ctrEditarProveedor() {

        if (isset($_POST["editProveedor"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"])) {


                $datos = array("proveedor" => $_POST["editarProveedor"],
                    "contacto"   => $_POST["editarContacto"],
                    "direccion"   => $_POST["editarDireccion"],
                    "id_municipio"    => $_POST["editarMpio"],
                    "telefono"       => $_POST["editarTelefono"],
                    "email"      => $_POST["editarEmail"],
                    "id"      => $_POST["idProveedor"]);

                $respuesta = ModeloProveedores::mdlEditarProveedor($datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡Proveedor Actualizado Correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "proveedores";

                        }

                    });


                    </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡Error al actualizar el proveedor, favor no ingresar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "proveedores";

                        }

                    });


                </script>';

            }

        }

    }

    /*=============================================
	ELIMINAR PROVEEDOR
	=============================================*/

    static public function ctrEliminarProveedor(){

        if(isset($_GET["idProveedor"])){

            $datos = $_GET["idProveedor"];

            $respuesta = ModeloProveedores::mdlEliminarProveedor($datos);

            if($respuesta == "ok"){

                echo'<script>

				swal({
					  type: "success",
					  title: "¡El Proveedor ha sido eliminado!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';

            }

        }

    }


}