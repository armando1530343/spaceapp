<?php
	
?>

<h1>CARRERAS</h1>
<a href="index.php?action=carrera_registrar"><button>Agregar Carrera</button></a>
	<br><br>
	<table border="2">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$vistaUsuario = new MvcController();
				$vistaUsuario -> vistaCarrerasController();
				$vistaUsuario -> borrarCarreraController();
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