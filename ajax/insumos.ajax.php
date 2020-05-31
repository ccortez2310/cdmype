<?php

require_once "../controllers/insumos.controller.php";
require_once "../models/insumos.model.php";

class AjaxInsumos {

    /*=============================================
    VALIDAR CODIGO INSUMO
    =============================================*/

    public $validarCodigo;

    public function ajaxValidarCodigo()
    {

        $item  = "codigo";
        $valor = $this->validarCodigo;

        $respuesta = ControladorInsumos::ctrMostrarInsumos($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    ACTIVAR INSUMO
    =============================================*/

    public $activarInsumo;
    public $activarId;

    public function ajaxActivarInsumo()
    {

        $item1  = "estado";
        $valor1 = $this->activarInsumo;

        $item2  = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloInsumos::mdlActualizarEstadoInsumo($item1, $valor1, $item2, $valor2);

        echo $respuesta;

    }


    /*=============================================
   EDITAR INSUMO
   =============================================*/

    public $idInsumo;

    public function ajaxEditarInsumo()
    {

        $item  = "id";
        $valor = $this->idInsumo;

        $respuesta = ControladorInsumos::ctrMostrarInsumos($item, $valor);

        echo json_encode($respuesta);

    }

}

/*=============================================
VALIDAR NO REPETIR CODIGO
=============================================*/

if(isset( $_POST["validarCodigo"])){

    $valCodigo = new AjaxInsumos();
    $valCodigo->validarCodigo = $_POST["validarCodigo"];
    $valCodigo->ajaxValidarCodigo();

}

/*=============================================
ACTIVAR INSUMO
=============================================*/

if (isset($_POST["activarInsumo"])) {

    $actInsumo                = new AjaxInsumos();
    $actInsumo->activarInsumo = $_POST["activarInsumo"];
    $actInsumo->activarId     = $_POST["activarId"];
    $actInsumo->ajaxActivarInsumo();

}

/*=============================================
EDITAR INSUMO
=============================================*/
if (isset($_POST["idInsumo"])) {

    $editar           = new AjaxInsumos();
    $editar->idInsumo = $_POST["idInsumo"];
    $editar->ajaxEditarInsumo();

}

