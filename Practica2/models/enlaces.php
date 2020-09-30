<?php
	class Paginas{
		public function enlacesPaginasModel($enlaces){
			if($enlaces == "alumnos" || $enlaces == "alumno_editar" || $enlaces == "alumno_eliminar" || $enlaces == "alumno_registrar" ||
			   $enlaces == "materias" || $enlaces == "materia_editar" || $enlaces == "materia_eliminar" || $enlaces == "materia_registrar" ||
				$enlaces == "carreras" || $enlaces == "carrera_editar" || $enlaces == "carrera_eliminar" || $enlaces == "carrera_registrar"){

				$module = "views/".$enlaces.".php";
			}
			else if($enlaces == "index"){
				$module = "views/alumnos.php";
			}
			else if($enlaces == "ok"){
				$module = "views/alumnos.php";
			}
			else if($enlaces == "fallo"){
				$module =  "views/alumnos.php";
			}
			else if($enlaces == "cambio"){
				$module =  "views/alumnos.php";
			}
			else{
				$module =  "views/modules/registro.php";
			}
			
			return $module;
		}
	}
?>