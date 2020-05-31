<?php

require_once "../controllers/compras.controller.php";
require_once "../models/compras.model.php";

class AjaxCompras{

    /*=============================================
    OBTENER DETALLE DE COMPRA
    =============================================*/
    public $idCompra;

    public function ajaxMostrarDetalleCompra() {

        $item  = "id_compra";
        $valor = $this->idCompra;

        $respuesta = ControladorCompras::ctrMostrarDetalleCompra($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    BUSCAR PROVEEDOR
    =============================================*/
    public $valorBusquedaProveedor;

    public function ajaxBuscarProveedor() {

        $valor = $this->valorBusquedaProveedor;

        $respuesta = ControladorCompras::ctrBuscarProveedor($valor);

        echo json_encode($respuesta);

    }

}

/*=============================================
MOSTRAR DETALLE COMPRA
=============================================*/
if (isset($_POST["idCompraDetalle"])) {

    $mostrarDetalle           = new AjaxCompras();
    $mostrarDetalle->idCompra = $_POST["idCompraDetalle"];
    $mostrarDetalle->ajaxMostrarDetalleCompra();

}

/*=============================================
BUSCAR PROVEEDOR
=============================================*/
if (isset($_POST["valorBusquedaProveedor"])) {

    $buscarProveedor           = new AjaxCompras();
    $buscarProveedor->valorBusquedaProveedor = $_POST["valorBusquedaProveedor"];
    $buscarProveedor->ajaxBuscarProveedor();

}




