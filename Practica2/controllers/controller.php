<?php
	class MvcController{

		//Método para llamar a la plantilla template
		public function plantilla(){
			include "views/template.php";
		}
		//Método para mostrar los enlaces de la pagina
		public function enlacesPaginasController(){

			if (isset($_GET["action"]) ){
				$enlaces = $_GET["action"];
			}
			else{
				$enlaces = "index";
			}

			$respuesta = Paginas::enlacesPaginasModel($enlaces);
			include $respuesta;
		}

		//Método para registro de Alumnos
		public function registroAlumnoController(){

			if (isset($_POST['nombre'])){
				//Almaceno en un array los valores de la vista de registro
				$datosController = array(   "nombre" => $_POST["nombre"], 
											"carrera" => $_POST["carrera"], 
											"email" => $_POST["email"],
											"grado" => $_POST["grado"]);
				//Envíamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroAlumnoModel($datosController, "alumnos");

				

				//Recibir la respuesta del modelo para saber que sucedió (succes o error)
				if($respuesta == "success"){
					header("location:index.php?action=alumnos");
				}
				else{
					header("location:index.php");
				}
			}
			
		}

		public function getCarreras(){
			return Datos::getCarrerasModel();
		}

		//Método VISTA Alumno
		public function vistaAlumnosController(){
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaAlumnosModel("alumnos");


			foreach ($respuesta as $row => $item) {
				$materias = Datos::getMateriasAlumno($item["id_carrera"],$item["grado"]);

				echo '<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["email"].'</td>
					<td>'.$item["carrera"].'</td>
					<td>'.$item["grado"].'</td>
					<td>';

					foreach ($materias as $key => $value) {
						echo $value['nombre']."<br>";
					}

				echo '</td>
					<!--COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=alumno_editar&id='.$item["id"].'"><button> EDITAR </button></a></td>
					<!--COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=alumno_eliminar&id='.$item["id"].'"><button> ELIMINAR </button></a></td>

				</tr>';
			}
		}
		//MÉTODO EDITAR AlumnoS
		public function editarAlumnoController(){
			//Solicitar el id del Alumno a editar
			$datosController = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarAlumnosModel($datosController, "alumnos");

			$carreras = Datos::getCarrerasModel();

			//Recibimos respuesta del modelo e IMPRIMIMOS UN FORMA PARA EDITAR
			echo '<input type="hidden" value = "'.$respuesta["id"].'"name="id">
				<input type="text" value = "'.$respuesta["nombre"].'"name="nombre" required>
				<input type="text" value = "'.$respuesta["email"].'"name="email" required>
				<label>Carrera:</label>
				<select name="carrera">';
				foreach ($carreras as $key => $value) {
					echo "<option value='".$value['id']."'>".$value['nombre']."</option>";
				}
			echo '</select>
				<label>Grado:</label>
				<select name="grado">';
				for ($i=1; $i <=10 ; $i++) { 
					echo "<option>".$i."</option>";
				}
			echo '</select>
				<input type="submit" value="Actualizar">';
		}

		//MÉTODO PARA ACTUALIZAR Alumno
		public function actualizarAlumnoController(){
			if(isset($_POST["id"])){
				//Preparamos un array con los id de el form del controlador anterior para ejecutar la actualizacion en un modelo
				$datosController = array(	"id" => $_POST["id"],  
											"nombre" => $_POST["nombre"],
											"email" => $_POST["email"],
											"carrera" => $_POST["carrera"],
											"grado" => $_POST["grado"]);

				//Enviar el array a el modelo que generará el UPDATE
				$respuesta = Datos::actualizarAlumnosModel($datosController, "alumnos");

				

				//Recibimos respuesta del modelo para determinar si se llevo a cabo el UPDATE de manera correcta.
				if($respuesta == "success") {
					header("location:index.php?action=alumnos");
				}
				else{
					echo "error";
				}
			}
		}

		//Borrado de Alumno
		public function borrarAlumnoController(){
			if(isset($_GET["id"])){
				$datosController = $_GET["id"];

				//Mandar ID al controlador para que ejecute el DELETE.
				$respuesta = Datos::borrarAlumnosModel($datosController, "alumnos");

				//Recibimos la respuesta del modelo de eliminación
				if($respuesta == "success"){
					header("location:index.php?action=alumnos");
				}
			}
		}

		//---------------------CARRERAS----------------------

		//Método para registro de Alumnos
		public function registroCarreraController(){
			if (isset($_POST['nombre'])){
				//Almaceno en un array los valores de la vista de registro
				$datosController = array(   "nombre" => $_POST["nombre"]);
				//Envíamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroCarreraModel($datosController, "carreras");

				//Recibir la respuesta del modelo para saber que sucedió (succes o error)
				if($respuesta == "success"){
					header("location:index.php?action=carreras");
				}
				else{
					header("location:index.php");
				}
			}
		}

		//Método VISTA Alumno
		public function vistaCarrerasController(){
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaCarrerasModel("carreras");

			foreach ($respuesta as $row => $item) {
				echo '<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<!--COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=carrera_editar&id='.$item["id"].'"><button> EDITAR </button></a></td>
					<!--COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=carrera_eliminar&id='.$item["id"].'"><button> ELIMINAR </button></a></td>

				</tr>';
			}
		}
		//MÉTODO EDITAR AlumnoS
		public function editarCarreraController(){
			//Solicitar el id del Alumno a editar
			$datoscontroller = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarCarreraModel($datoscontroller, "carreras");

			//Recibimos respuesta del modelo e IMPRIMIMOS UN FORMA PARA EDITAR
			echo '<input type="hidden" value = "'.$respuesta["id"].'" name="id">
				<input type="text" value = "'.$respuesta["nombre"].'" name="nombre" required>
				<input type="submit" value="Actualizar">';
		}

		//MÉTODO PARA ACTUALIZAR Alumno
		public function actualizarCarreraController(){
			if(isset($_POST["id"])){
				//Preparamos un array con los id de el form del controlador anterior para ejecutar la actualizacion en un modelo
				
				$datosController = array(	"id" => $_POST["id"],  
											"nombre" => $_POST["nombre"]);

				

				//Enviar el array a el modelo que generará el UPDATE
				$respuesta = Datos::actualizarCarreraModel($datosController, "carreras");
				
				//Recibimos respuesta del modelo para determinar si se llevo a cabo el UPDATE de manera correcta.
				if($respuesta == "success") {
					header("location:index.php?action=cambio");
				}
				else{
					echo "error";
				}
			}
		}

		//Borrado de Alumno
		public function borrarCarreraController(){
			if(isset($_GET["id"])){
				$datosController = $_GET["id"];

				//Mandar ID al controlador para que ejecute el DELETE.
				$respuesta = Datos::borrarAlumnosModel($datosController, "carreras");

				//Recibimos la respuesta del modelo de eliminación
				if($respuesta == "success"){
					header("location:index.php?action=carreras");
				}
			}
		}

		//---------------------MATERIAS----------------------

		//Método para registro de Alumnos
		public function registroMateriaController(){
			if (isset($_POST['nombre'])){
				//Almaceno en un array los valores de la vista de registro
				$datosController = array(   "nombre" => $_POST["nombre"],
											"grado" => $_POST["grado"],
											"carrera" => $_POST["carrera"]);
				//Envíamos los parametros al modelo para que procese el registro
				$respuesta = Datos::registroMateriaModel($datosController, "materias");

				//Recibir la respuesta del modelo para saber que sucedió (succes o error)
				if($respuesta == "success"){
					header("location:index.php?action=materias");
				}
				else{
					header("location:index.php");
				}
			}
		}

		//Método VISTA Alumno
		public function vistaMateriasController(){
			//Envío al modelo la variable de control y la tabla a donde se hará la consulta
			$respuesta = Datos::vistaMateriasModel("materias");

			foreach ($respuesta as $row => $item) {
				echo '<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["carrera"].'</td>
					<td>'.$item["grado"].'</td>
					<!--COLUMNA PARA EDITAR -->
					<td><a href="index.php?action=materia_editar&id='.$item["id"].'"><button> EDITAR </button></a></td>
					<!--COLUMNA PARA BORRAR -->
					<td><a href="index.php?action=materia_eliminar&id='.$item["id"].'"><button> ELIMINAR </button></a></td>

				</tr>';
			}
		}
		//MÉTODO EDITAR AlumnoS
		public function editarMateriaController(){
			//Solicitar el id del Alumno a editar
			$datoscontroller = $_GET["id"];
			//Enviamos al modelo el id para hacer la consulta y obtener sus datos
			$respuesta = Datos::editarMateriaModel($datoscontroller, "materias");

			$carreras = Datos::getCarrerasModel();

			//Recibimos respuesta del modelo e IMPRIMIMOS UN FORMA PARA EDITAR
			echo '<input type="hidden" value = "'.$respuesta["id"].'" name="id">
				<input type="text" value = "'.$respuesta["nombre"].'" name="nombre" required>
				<label>Carrera:</label>
				<select name="carrera">';
				foreach ($carreras as $key => $value) {
					echo "<option value='".$value['id']."'>".$value['nombre']."</option>";
				}
			echo '</select>
				<label>Grado:</label>
				<select name="grado">';
				for ($i=1; $i <=10 ; $i++) { 
					echo "<option>".$i."</option>";
				}
			echo '</select>
				<input type="submit" value="Actualizar">';
		}

		//MÉTODO PARA ACTUALIZAR Alumno
		public function actualizarMateriaController(){
			if(isset($_POST["id"])){
				//Preparamos un array con los id de el form del controlador anterior para ejecutar la actualizacion en un modelo
				
				$datosController = array(	"id" => $_POST["id"],  
											"nombre" => $_POST["nombre"],
											"grado" => $_POST["grado"],
											"carrera" => $_POST["carrera"]);

				

				//Enviar el array a el modelo que generará el UPDATE
				$respuesta = Datos::actualizarMateriaModel($datosController, "materias");
				
				//Recibimos respuesta del modelo para determinar si se llevo a cabo el UPDATE de manera correcta.
				if($respuesta == "success") {
					header("location:index.php?action=materias");
				}
				else{
					echo "error";
				}
			}
		}

		//Borrado de Alumno
		public function borrarMateriaController(){
			if(isset($_GET["id"])){
				$datosController = $_GET["id"];

				//Mandar ID al controlador para que ejecute el DELETE.
				$respuesta = Datos::borrarMateriaModel($datosController, "materias");

				//Recibimos la respuesta del modelo de eliminación
				if($respuesta == "success"){
					header("location:index.php?action=materias");
				}
			}
		}


		
	}

?>