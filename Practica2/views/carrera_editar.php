<?php
	
?>
<h1>Editar Carrera</h1>
<form method="post">
	<?php
		$editarUsuario = new MvcController();
		$editarUsuario -> editarCarreraController();
		$editarUsuario ->actualizarCarreraController();
	?>
</form>