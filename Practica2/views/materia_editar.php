<?php
	
?>
<h1>Editar Materia</h1>
<form method="post">
	<?php
		$editarUsuario = new MvcController();
		$editarUsuario -> editarMateriaController();
		$editarUsuario ->actualizarMateriaController();
	?>
</form>