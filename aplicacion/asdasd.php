<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form onsubmit="return validar_formulario()" action="../aplicacion/modulos_profesor/pro_ejecutar_actualizar.php" method="post" enctype="multipart/form-data" >
		<div class="form-group" >
			<label for="file">Archivo que contine el recurso de aprendizaje:</label>
			<p id="error2" style="display:none; color:#FF0000;">
				El límite máximo de tamaño de archivo es 10MB.
			</p>
			<input type="file" class="form-control" id="o_aprendizaje" name="o_aprendizaje" required>
		</div>
		<button id="registrar" type="submit" class="btn btn-default">Actualizar</button>
	</form>
</body>
</html>