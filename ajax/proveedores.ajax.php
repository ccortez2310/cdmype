<?php

require_once "../controllers/proveedores.controller.php";
require_once "../models/proveedores.model.php";


class AjaxProveedores {

    /*=============================================
    OBTENER MUNICIPIOS POR DEPARTAMENTO
    =============================================*/

    public $idDepto;

    public function ajaxObtenerMunicipios() {

        $item = "id_departamento";
        $valor = $this->idDepto;

        $respuesta = ControladorProveedores::ctrMostrarMpios($item, $valor);

        echo json_encode($respuesta);

    }


    /*=============================================
   EDITAR PROVEEDOR
   =============================================*/

    public $idProveedor;

    public function ajaxEditarProveedor()
    {

        $item  = "id";
        $valor = $this->idProveedor;

        $respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

        echo json_encode($respuesta);

    }

}

/*=============================================
OBTENER MUNICIPIOS POR DEPTO
=============================================*/

if(isset( $_POST["idDepto"])){

    $getMpios = new AjaxProveedores();
    $getMpios->idDepto = $_POST["idDepto"];
    $getMpios->ajaxObtenerMunicipios();

}

/*=============================================
EDITAR PROVEEDOR
=============================================*/
if (isset($_POST["idProveedor"])) {

    $editar           = new AjaxProveedores();
    $editar->idProveedor = $_POST["idProveedor"];
    $editar->ajaxEditarProveedor();

}