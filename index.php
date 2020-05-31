<?php 

//requerimos los controladores

require_once "controllers/plantilla.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/insumos.controller.php";
require_once "controllers/proveedores.controller.php";
require_once "controllers/compras.controller.php";



//requerimos los modelos
require_once "models/usuarios.model.php";
require_once "models/insumos.model.php";
require_once "models/proveedores.model.php";
require_once "models/compras.model.php";




//ejecutamos el método para cargar la plantilla

$plantilla = new ControladorPlantilla();
$plantilla->plantilla();