<?php
$ingreso = new MvcController();

$carreras = $ingreso->getCarreras();	

?>
<h1>Registro Materia</h1>
<form method="post">

    <input type="text" placeholder="Nombre" name="nombre" required>
    <label>Carrera:</label>
    <select name="carrera">
		<?php

		foreach ($carreras as $key => $value) {
			echo "<option value='".$value['id']."'>".$value['nombre']."</option>";
		}

		?>
	</select>
	<label>Grado:</label>
	<select name="grado">
		<?php

		for ($i=1; $i <=10 ; $i++) { 
			echo "<option>".$i."</option>";
		}

		?>
	</select>
	
	<input type="submit" value="Enviar">
</form>

<?php
	$ingreso -> registroMateriaController();
	
	//Verificar la URL correcta
	if(isset($_GET["action"])){
		if($_GET["action"] == "ok"){
			echo "Registro exitoso";
		}
	}
?>