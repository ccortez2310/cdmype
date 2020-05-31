<?php

require_once "../controllers/compras.controller.php";
require_once "../models/compras.model.php";

require_once "../controllers/insumos.controller.php";
require_once "../models/insumos.model.php";

class AjaxNuevaCompra{

    /*=============================================
    BUSCAR PROVEEDOR
    =============================================*/
    public $valorBusquedaInsumo;

    public function ajaxBuscarInsumo() {

        $valor = $this->valorBusquedaInsumo;

        $respuesta = ControladorCompras::ctrBuscarInsumo($valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    BUSCAR PROVEEDOR
    =============================================*/

    public $id_proveedor;
    public $id_usuario;
    public $tipo_compra;
    public $id_tipo_documento;
    public $fecha_compra;
    public $serie_documento;
    public $num_documento;
    public $iva;
    public $total_compra;
    public $descuento;
    public $observaciones;
    public $detalle;

    public function ajaxGuardarCompra(){

        $datos = array(
            "id_proveedor" => $this->id_proveedor,
            "id_usuario" => $this->id_usuario,
            "tipo_compra" => $this->tipo_compra,
            "id_tipo_documento" => $this->id_tipo_documento,
            "fecha_compra" => $this->fecha_compra,
            "serie_documento" => $this->serie_documento,
            "num_documento" => $this->num_documento,
            "iva" => $this->iva,
            "total_compra" => $this->total_compra,
            "descuento" => $this->descuento,
            "observaciones" => $this->observaciones,
            "detalleCompra" => $this->detalle
        );

        $respuesta = ControladorCompras::ctrGuardarCompra($datos);

        echo $respuesta;


    }


}


/*=============================================
BUSCAR INSUMO
=============================================*/
if (isset($_POST["valorBusquedaInsumo"])) {

    $buscarInsumo           = new AjaxNuevaCompra();
    $buscarInsumo->valorBusquedaInsumo = $_POST["valorBusquedaInsumo"];
    $buscarInsumo->ajaxBuscarInsumo();

}


/*=============================================
GUARDAR COMPRA
=============================================*/

if(isset($_POST["items"])) {

    $compra = new AjaxNuevaCompra();

    $compra->id_proveedor = $_POST["idProveedor"];
    $compra->id_usuario = $_POST["idUsuario"];
    $compra->tipo_compra = $_POST["tipoCompra"];
    $compra->id_tipo_documento = $_POST["tipoDocumento"];
    $compra->fecha_compra = $_POST["fechaCompra"];
    $compra->serie_documento = $_POST["serieDocumento"];
    $compra->num_documento = $_POST["numDocumento"];
    $compra->iva = $_POST["iva"];
    $compra->total_compra = $_POST["montoTotal"];
    $compra->descuento = $_POST["descuentoCompra"];
    $compra->observaciones = $_POST["observaciones"];
    $compra->detalle = $_POST["items"];

    $compra -> ajaxGuardarCompra();

}



