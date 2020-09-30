<?php
	require_once "conexion.php";
	//Modelo que permite mostrar el enlace de las paginas con las vistas
	class Datos extends Conexion{
		//Método del modelo de registro de usuario (Recibe datos del controlador)
		public function registroAlumnoModel($datosModel, $tabla){
			//Preparar el modelo para hacer los INSERT a la BD
			$stmt = Conexion::conectar()-> prepare (
				"INSERT INTO $tabla (nombre,email,id_carrera,grado) VALUES (:nombre, :email, :id_carrera, :grado )");
			//Prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute.

			//binParan() Vincula el valor de una variable de PHP a un parámetro de sustitucion con nombre o signo de interrogacion correspondiente. Es la sentencia usada para preparar un query de SQL.
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_carrera", $datosModel["carrera"], PDO::PARAM_INT);
			$stmt -> bindParam(":grado", $datosModel["grado"], PDO::PARAM_INT);
		
			//Verificar ejecucion del query
			if($stmt -> execute()){
				return "success";
			}
			else{
				return "error";
			}

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}
		

		//MÉTODO PARA VISTA USUARIO (TABLA)
		public function vistaAlumnosModel($tabla){
			$stmt = Conexion::conectar() -> prepare (
				"SELECT a.id as id, 
						a.nombre as nombre,
						a.email as email,
						a.id_carrera as id_carrera,
						c.nombre as carrera,
						a.grado as grado
				FROM $tabla as a INNER JOIN carreras as c on a.id_carrera = c.id");
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt -> close();
		}

		//Método para SELECCIONAR usuarios (SELECT)
		public function editarAlumnosModel($datosModel, $tabla){
			$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id = :id");
			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt -> close();
		}

		//Método para ACTUALIZAR usuarios (UPDATE)
		public function actualizarAlumnosModel($datosModel, $tabla){
			//Preparar el QUERY
			$stmt = Conexion::conectar() -> prepare(
				"UPDATE $tabla SET nombre = :nombre, email = :email, id_carrera = :id_carrera, grado = :grado WHERE id = :id");

			//Ejecutar el query
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_carrera", $datosModel["carrera"], PDO::PARAM_STR);
			$stmt -> bindParam(":grado", $datosModel["grado"], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_STR);

			//Preparar respuesta
			if($stmt -> execute()){
				return "success";
			}else{
				return "error";
			}

			//Cerrar la conexion PDO
			$stmt -> close();
		}

		//Borrar USUARIOS
		public function borrarAlumnosModel($datosModel, $tabla){
			//Preparar el QUERY para eliminar
			$stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

			//Ejecutar
			if($stmt -> execute()){
				return "success";
			}else{
				return "error";
			}

			$stmt -> close();
		}


		//--------------CARRERAS-------------

		//Método del modelo de registro de usuario (Recibe datos del controlador)
		public function registroCarreraModel($datosModel, $tabla){
			//Preparar el modelo para hacer los INSERT a la BD
			$stmt = Conexion::conectar()-> prepare ("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			//Prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute.

			//binParan() Vincula el valor de una variable de PHP a un parámetro de sustitucion con nombre o signo de interrogacion correspondiente. Es la sentencia usada para preparar un query de SQL.
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		
			//Verificar ejecucion del query
			if($stmt -> execute()){
				return "success";
			}
			else{
				return "error";
			}

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}
		//MÉTODO PARA VISTA USUARIO (TABLA)
		public function vistaCarrerasModel($tabla){
			$stmt = Conexion::conectar() -> prepare ("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt -> close();
		}

		//Método para SELECCIONAR usuarios (SELECT)
		public function editarCarreraModel($datosModel, $tabla){
			$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id = :id");
			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt -> close();
		}

		//Método para ACTUALIZAR usuarios (UPDATE)
		public function actualizarCarreraModel($datosModel, $tabla){
			//Preparar el QUERY
			$stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id");

			//Ejecutar el query
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

			//Preparar respuesta
			if($stmt -> execute()){
				return "success";
			}else{
				return "error";
			}

			//Cerrar la conexion PDO
			$stmt -> close();
		}

		//Borrar USUARIOS
		public function borrarCarreraModel($datosModel, $tabla){
			//Preparar el QUERY para eliminar
			$stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

			//Ejecutar
			if($stmt -> execute()){
				return "success";
			}else{
				return "error";
			}

			$stmt -> close();
		}

		public function getCarrerasModel(){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM carreras");
			$stmt->execute();
			return $stmt->fetchAll();

		}

		//--------------MATERIAS-------------

		//Método del modelo de registro de usuario (Recibe datos del controlador)
		public function registroMateriaModel($datosModel, $tabla){
			//Preparar el modelo para hacer los INSERT a la BD
			$stmt = Conexion::conectar()-> prepare ("INSERT INTO $tabla(nombre,grado,id_carrera) VALUES (:nombre,:grado,:id_carrera)");
			//Prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute.

			//binParan() Vincula el valor de una variable de PHP a un parámetro de sustitucion con nombre o signo de interrogacion correspondiente. Es la sentencia usada para preparar un query de SQL.
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":grado", $datosModel["grado"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_carrera", $datosModel["carrera"], PDO::PARAM_STR);
		
			//Verificar ejecucion del query
			if($stmt -> execute()){
				return "success";
			}
			else{
				return "error";
			}

			//Cerrar las funciones de la sentencia de PDO
			$stmt -> close();
		}
		//MÉTODO PARA VISTA USUARIO (TABLA)
		public function vistaMateriasModel($tabla){
			$stmt = Conexion::conectar() -> prepare (
				"SELECT a.id as id, 
						a.nombre as nombre,
						a.id_carrera as id_carrera,
						c.nombre as carrera,
						a.grado as grado
				FROM $tabla as a INNER JOIN carreras as c on a.id_carrera = c.id");
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt -> close();
		}

		//Método para SELECCIONAR usuarios (SELECT)
		public function editarMateriaModel($datosModel, $tabla){
			$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id = :id");
			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt -> close();
		}

		//Método para ACTUALIZAR usuarios (UPDATE)
		public function actualizarMateriaModel($datosModel, $tabla){
			//Preparar el QUERY
			$stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre = :nombre, grado=:grado, id_carrera=:id_carrera WHERE id = :id");

			//Ejecutar el query
			$stmt -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":grado", $datosModel["grado"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_carrera", $datosModel["carrera"], PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

			//Preparar respuesta
			if($stmt -> execute()){
				return "success";
			}else{
				return "error";
			}

			//Cerrar la conexion PDO
			$stmt -> close();
		}

		//Borrar USUARIOS
		public function borrarMateriaModel($datosModel, $tabla){
			//Preparar el QUERY para eliminar
			$stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

			$stmt -> bindParam(":id", $datosModel, PDO::PARAM_STR);

			//Ejecutar
			if($stmt -> execute()){
				return "success";
			}else{
				return "error";
			}

			$stmt -> close();
		}

		public function getMateriasAlumno($carrera, $grado){
			$stmt = Conexion::conectar()->prepare(
				"SELECT * FROM materias WHERE id_carrera = :id_carrera and grado = :grado");

			$stmt -> bindParam(":id_carrera", $carrera, PDO::PARAM_INT);
			$stmt -> bindParam(":grado", $grado, PDO::PARAM_INT);

			$stmt->execute();
			return $stmt->fetchAll();

		}
	}
?>