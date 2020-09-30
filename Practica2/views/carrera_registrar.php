<h1>Registro Carrera</h1>
<form method="post">

    <input type="text" placeholder="Nombre" name="nombre" required>
	<label>Carrera:</label>
	
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso = new MvcController();
	$ingreso -> registroCarreraController();
	
	//Verificar la URL correcta
	if(isset($_GET["action"])){
		if($_GET["action"] == "ok"){
			echo "Registro exitoso";
		}
	}
?>