<?php

require_once "conexion.php";

class ModeloProveedores{

    /*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

    static public function mdlMostrarProveedores($item, $valor) {

        if($item != null){

            $sql = "SELECT proveedores.id, proveedores.proveedor, proveedores.contacto, proveedores.direccion, proveedores.id_municipio, municipios.municipio, municipios.id_departamento, departamentos.departamento, proveedores.telefono, proveedores.email FROM proveedores LEFT JOIN municipios ON proveedores.id_municipio = municipios.id LEFT JOIN departamentos ON municipios.id_departamento = departamentos.id WHERE proveedores.$item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $sql = "SELECT proveedores.id, proveedores.proveedor, proveedores.contacto, proveedores.direccion, proveedores.id_municipio, municipios.municipio, municipios.id_departamento, departamentos.departamento, proveedores.telefono, proveedores.email FROM proveedores LEFT JOIN municipios ON proveedores.id_municipio = municipios.id LEFT JOIN departamentos ON municipios.id_departamento = departamentos.id";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

    }

    /*=============================================
	MOSTRAR DEPTOS
	=============================================*/

    static public function mdlMostrarDeptos($item, $valor) {

        if($item != null){

            $sql = "SELECT id, departamento FROM departamentos WHERE $item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $sql = "SELECT id, departamento FROM departamentos";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

    }

    /*=============================================
	MOSTRAR MPIOS
	=============================================*/

    static public function mdlMostrarMpios($item, $valor) {

        if($item != null){

            $sql = "SELECT municipios.id, municipios.municipio, municipios.id_departamento,  departamentos.departamento FROM municipios INNER JOIN departamentos ON municipios.id_departamento = departamentos.id WHERE municipios.$item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

            $sql = "SELECT municipios.id, municipios.municipio, municipios.id_departamento,  departamentos.departamento FROM municipios INNER JOIN departamentos ON municipios.id_departamento = departamentos.id";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

    }

    /*=============================================
    AGREGAR PROVEEDOR
    =============================================*/

    public static function mdlAgregarProveedor($datos) {

        $sql = "INSERT INTO proveedores(proveedor, contacto, direccion, id_municipio, telefono, email) VALUES (:proveedor, :contacto, :direccion, :id_municipio, :telefono, :email)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_municipio", $datos["id_municipio"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }

    /*=============================================
    EDITAR PROVEEDOR
    =============================================*/

    public static function mdlEditarProveedor($datos) {

        $sql = "UPDATE proveedores SET proveedor = :proveedor, id_municipio = :id_municipio, contacto = :contacto, direccion = :direccion, telefono = :telefono, email = :email WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id_municipio", $datos["id_municipio"], PDO::PARAM_INT);
        $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }


    /*=============================================
    ELIMINAR PROVEEDOR
    =============================================*/

    static public function mdlEliminarProveedor($datos) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM proveedores WHERE id = :id");

        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        } else {

            return "error";

        }

    }


}