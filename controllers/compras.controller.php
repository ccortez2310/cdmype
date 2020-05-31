<?php

class ControladorCompras {

    /*=============================================
    MOSTRAR COMPRAS
    =============================================*/

    static public function ctrMostrarCompras($item, $valor) {

        $respuesta = ModeloCompras::mdlMostrarCompras($item, $valor);

        return $respuesta;
    }

    /*=============================================
    MOSTRAR DETALLE COMPRA
    =============================================*/

    static public function ctrMostrarDetalleCompra($item, $valor) {

        $respuesta = ModeloCompras::mdlMostrarDetalleCompra($item, $valor);

        return $respuesta;
    }

    /*=============================================
    BUSCAR PROVEEDOR
    =============================================*/

    static public function ctrBuscarProveedor($valor) {

        $respuesta = ModeloCompras::mdlBuscarProveedor($valor);

        return $respuesta;
    }

    /*=============================================
    BUSCAR INSUMO
    =============================================*/

    static public function ctrBuscarInsumo($valor) {

        $respuesta = ModeloCompras::mdlBuscarInsumo($valor);

        return $respuesta;
    }


    /*=============================================
    GUARDAR COMPRA
    =============================================*/

    static public function ctrGuardarCompra($datos) {

        if(isset($datos["detalleCompra"])) {

            $fechaCompra = date('Y-m-d', strtotime($datos["fecha_compra"]));

            $datosCompra = array(
                "id_proveedor" => $datos["id_proveedor"],
                "tipo_compra" => $datos["tipo_compra"],
                "id_tipo_documento" => $datos["id_tipo_documento"],
                "id_usuario" => $datos["id_usuario"],
                "fecha_compra" => $fechaCompra,
                "serie_documento" => $datos["serie_documento"],
                "num_documento" => $datos["num_documento"],
                "iva" => $datos["iva"],
                "total_compra" => $datos["total_compra"],
                "descuento" => $datos["descuento"],
                "observaciones" => $datos["observaciones"],
                "estado" => 1
            );

            $respuesta = ModeloCompras::mdlGuardarCompra($datosCompra);



            $ultimaCompra = ModeloCompras::mdlObtenerUltimoId();
            $idCompra = $ultimaCompra["id"];

            /*=============================================
            GUARDAMOS EL DETALLE DE COMPRA Y ACTUALIZAMOS STOCK
            =============================================*/

            $detalle = $datos["detalleCompra"];

            foreach ($detalle as $det) {

                #Obtenemos la cantidad actual del insumo para sumarle el valor actual
                $insumo = ModeloInsumos::mdlMostrarInsumos("id",$det["codigoInsumo"]);
                $stockActual = $insumo["stock"];

                $nuevoStock = $stockActual + $det["cantidadInsumo"];

                $datosStock = array(
                    "idInsumo" => $det["codigoInsumo"],
                    "stock" => $nuevoStock
                );

                ModeloCompras::mdlUpdateStock($datosStock);

                $datosDetalle = array(
                    "id_compra" => $idCompra,
                    "id_insumo" => $det["codigoInsumo"],
                    "cantidad" => $det["cantidadInsumo"],
                    "precio" => $det["precioInsumo"]
                );

                ModeloCompras::mdlGuardarDetalleCompra($datosDetalle);


            }

            return $respuesta;

        }

    }


    /*=============================================
    ANULAR COMPRA
    =============================================*/

    static public function ctrAnularCompra() {

        if(isset($_GET["idCompra"])) {

            $idCompra = $_GET["idCompra"];

            #obtenemos el detalle de la compra segun el id
            $detalleCompra = ModeloCompras::mdlMostrarDetalleCompra("id_compra", $idCompra);

            foreach ($detalleCompra as $detalle) {

                #obtemos el insumo al que le vamos a descontar la cantidad
                $insumo = ModeloInsumos::mdlMostrarInsumos("id", $detalle["id_insumo"]);

                #restamos la cantidad de insumos menos la cantidad de detalle
                $nuevoStock =  $insumo["stock"] - $detalle["cantidad"];

                #ahora actualizamos el stock
                $datosStock = array(
                    "idInsumo" => $detalle["id_insumo"],
                    "stock" => $nuevoStock
                );

                ModeloCompras::mdlUpdateStock($datosStock);

            }

            $respuesta = ModeloCompras::mdlAnularCompra("estado",0, "id", $idCompra);

            if($respuesta == "ok") {

                echo'<script>

				swal({
					  type: "success",
					  title: "¡La Compra ha sido anulada!",
					  text: "La cantidad de insumos comprados han sido descontados del stock",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "compras";

								}
							})

				</script>';

            }



        }

    }


}
