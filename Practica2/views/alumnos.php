<?php
	
?>

<h1>ALUMNOS</h1>
	
	<a href="index.php?action=alumno_registrar"><button>Agregar Alumno</button></a>
	<br><br>
	<table border="1">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Carrera</th>
				<th>Grado</th>
				<th>Materias</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$vistaAlumno = new MvcController();
				$vistaAlumno -> vistaAlumnosController();
				$vistaAlumno -> borrarAlumnoController();
			?>
		</tbody>
	</table>
	
	<?php
		if(isset($_GET["action"])){
			if($_GET["action"] == "cambio"){
				echo "Cambio exitoso";
			}
		}
	?>