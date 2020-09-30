<?php
?>

<h1>MATERIAS</h1>
<a href="index.php?action=materia_registrar"><button>Agregar Materia</button></a>
	<br><br>
	<table border="1">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Grado</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$vistaUsuario = new MvcController();
				$vistaUsuario -> vistaMateriasController();
				$vistaUsuario -> borrarMateriaController();
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