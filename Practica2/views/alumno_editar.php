
<h1>Editar Alumno</h1>
<form method="post">
	<?php
		$editarUsuario = new MvcController();
		$editarUsuario -> editarAlumnoController();
		$editarUsuario ->actualizarAlumnoController();
	?>
</form>