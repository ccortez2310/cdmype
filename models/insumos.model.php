<?php 

require_once "conexion.php";

class ModeloInsumos {

	/*=============================================
	MOSTRAR INSUMOS
	=============================================*/

	static public function mdlMostrarInsumos($item, $valor){

		if($item != null){

			$sql = "SELECT insumos.id, insumos.codigo,insumos.descripcion, insumos.id_categoria, categoria_insumo.descripcion as categoria, insumos.unidad_medida, insumos.stock, insumos.estado FROM insumos LEFT JOIN categoria_insumo ON insumos.id_categoria = categoria_insumo.id WHERE insumos.$item = :$item";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$sql = "SELECT insumos.id, insumos.codigo, insumos.descripcion, insumos.id_categoria, categoria_insumo.descripcion as categoria, insumos.unidad_medida, insumos.stock, insumos.estado FROM insumos LEFT JOIN categoria_insumo ON insumos.id_categoria = categoria_insumo.id";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	MOSTRAR CATEGORIA INSUMOS
	=============================================*/

	static public function mdlMostrarCategoriaInsumos($item, $valor) {

		if($item != null){

			$sql = "SELECT * FROM categoria_insumo WHERE $item = :$item";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$sql = "SELECT * FROM categoria_insumo";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


	}

    /*=============================================
    AGREGAR INSUMO
    =============================================*/

    public static function mdlAgregarInsumo($datos) {

        $sql = "INSERT INTO insumos(codigo, id_categoria, descripcion, unidad_medida, estado, stock) VALUES (:codigo, :id_categoria, :descripcion, :unidad_medida, :estado, :stock)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":unidad_medida", $datos["unidad_medida"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }

    /*=============================================
    AGREGAR CATEGORIA INSUMO
    =============================================*/

    public static function mdlCrearCategoriaInsumo($datos) {

        $sql = "INSERT INTO categoria_insumo(descripcion) VALUES (:descripcion)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }

    /*=============================================
    ACTUALIZAR INSUMO
    =============================================*/

    public static function mdlActualizarEstadoInsumo($item1, $valor1, $item2, $valor2) {

        $stmt = Conexion::conectar()->prepare("UPDATE insumos SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }


    /*=============================================
    EDITAR INSUMO
    =============================================*/

    public static function mdlEditarInsumo($datos) {

        $sql = "UPDATE insumos SET descripcion = :descripcion, id_categoria = :id_categoria, unidad_medida = :unidad_medida, stock = :stock WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":unidad_medida", $datos["unidad_medida"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

    }


    /*=============================================
    ELIMINAR INSUMO
    =============================================*/

    static public function mdlEliminarInsumo($datos) {

        $stmt = Conexion::conectar()->prepare("DELETE FROM insumos WHERE id = :id");

        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        } else {

            return "error";

        }

    }








}
