<?php

require_once "conexion.php";

class ModeloCompras {

    /*=============================================
	MOSTRAR COMPRAS
	=============================================*/

    static public function mdlMostrarCompras($item, $valor){

        if($item != null){

            $sql = "SELECT compras.id, compras.id_proveedor, proveedores.proveedor, compras.tipo_compra, compras.id_tipo_documento, tipo_documento.tipo_documento, compras.id_usuario, usuarios.nombre, compras.serie_documento, compras.num_documento, compras.total_compra, compras.iva, compras.fecha_compra, compras.descuento, compras.observaciones, compras.estado FROM compras LEFT JOIN proveedores ON compras.id_proveedor = proveedores.id LEFT JOIN tipo_documento ON compras.id_tipo_documento = tipo_documento.id LEFT JOIN usuarios ON compras.id_usuario = usuarios.id WHERE compras.$item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $sql = "SELECT compras.id, compras.id_proveedor, proveedores.proveedor, compras.tipo_compra, compras.id_tipo_documento, tipo_documento.tipo_documento, compras.id_usuario, usuarios.nombre, compras.serie_documento, compras.num_documento, compras.total_compra, compras.iva, compras.fecha_compra, compras.descuento, compras.observaciones, compras.estado FROM compras LEFT JOIN proveedores ON compras.id_proveedor = proveedores.id LEFT JOIN tipo_documento ON compras.id_tipo_documento = tipo_documento.id LEFT JOIN usuarios ON compras.id_usuario = usuarios.id";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

    }

    /*=============================================
	MOSTRAR DETALLE COMPRA
	=============================================*/

    static public function mdlMostrarDetalleCompra($item, $valor){

        if($item != null){

            $sql = "SELECT detalle_compra.id_compra, detalle_compra.id_insumo, insumos.codigo, insumos.descripcion as insumo, insumos.unidad_medida, detalle_compra.cantidad, detalle_compra.precio, compras.fecha_compra FROM detalle_compra 
INNER JOIN compras ON detalle_compra.id_compra = compras.id
INNER JOIN insumos ON detalle_compra.id_insumo = insumos.id WHERE detalle_compra.$item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }else{

            $sql = "SELECT detalle_compra.id_compra, detalle_compra.id_insumo, insumos.codigo, insumos.descripcion as insumo, insumos.unidad_medida, detalle_compra.cantidad, detalle_compra.precio, compras.fecha_compra FROM detalle_compra
INNER JOIN compras ON detalle_compra.id_compra = compras.id
INNER JOIN insumos ON detalle_compra.id_insumo = insumos.id";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

    }

    /*=============================================
	BUSCAR PROVEEDOR
	=============================================*/

    static public function mdlBuscarProveedor($valor) {

        $sql = "SELECT proveedores.id, proveedores.proveedor, proveedores.contacto, proveedores.direccion, proveedores.id_municipio, municipios.municipio, municipios.id_departamento, departamentos.departamento, proveedores.telefono, proveedores.email FROM proveedores LEFT JOIN municipios ON proveedores.id_municipio = municipios.id LEFT JOIN departamentos ON municipios.id_departamento = departamentos.id WHERE proveedores.proveedor LIKE '%".$valor."%'";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt -> execute();

        return $stmt -> fetchAll();


    }


    /*=============================================
	BUSCAR INSUMO
	=============================================*/

    static public function mdlBuscarInsumo($valor) {

        $sql = "SELECT insumos.id, insumos.codigo,insumos.descripcion, insumos.id_categoria, categoria_insumo.descripcion as categoria, insumos.unidad_medida, insumos.stock, insumos.estado FROM insumos LEFT JOIN categoria_insumo ON insumos.id_categoria = categoria_insumo.id WHERE insumos.codigo LIKE '%".$valor."%' AND insumos.estado != 0 OR insumos.descripcion LIKE '%".$valor."%' AND insumos.estado != 0";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt -> execute();

        return $stmt -> fetchAll();


    }

    /*=============================================
	MOSTRAR TIPO DOCUMENTO
	=============================================*/

    static public function mdlMostrarTipoDocumentos() {

        $sql = "SELECT * FROM tipo_documento";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt -> execute();

        return $stmt -> fetchAll();


    }

    /*=============================================
	OBTENER ULTIMO ID
	=============================================*/

    static public function mdlObtenerUltimoId() {

        $sql = "SELECT * FROM compras ORDER BY id DESC Limit 1";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt -> execute();

        return $stmt -> fetch();

    }

    /*=============================================
	GUARDAR COMPRA
	=============================================*/

    static public function mdlGuardarCompra($datos) {

        $sql = "INSERT INTO compras(id_proveedor, tipo_compra, id_tipo_documento, id_usuario, fecha_compra, serie_documento, num_documento, iva, total_compra, descuento, observaciones, estado) VALUES (:id_proveedor, :tipo_compra, :id_tipo_documento, :id_usuario, :fecha_compra, :serie_documento, :num_documento, :iva, :total_compra, :descuento, :observaciones, :estado)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_compra", $datos["tipo_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_documento", $datos["id_tipo_documento"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_compra", $datos["fecha_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_documento", $datos["serie_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":num_documento", $datos["num_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
        $stmt->bindParam(":total_compra", $datos["total_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }

    /*=============================================
	GUARDAR DETALLE COMPRA
	=============================================*/

    static public function mdlGuardarDetalleCompra($datos) {

        $sql = "INSERT INTO detalle_compra(id_compra, id_insumo, cantidad, precio) VALUES (:id_compra, :id_insumo, :cantidad, :precio)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id_compra", $datos["id_compra"], PDO::PARAM_INT);
        $stmt->bindParam(":id_insumo", $datos["id_insumo"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }




    /*=============================================
	ANULAR COMPRA
	=============================================*/

    static public function mdlAnularCompra($item1, $valor1, $item2, $valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE compras SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

    }

    /*=============================================
	ACTUALIZAR STOCK
	=============================================*/

    static public function mdlUpdateStock($datos) {

        $sql = "UPDATE insumos SET stock = :stock WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datos["idInsumo"], PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";

        }

    }






}