<?php
session_start();
require_once '../clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_oa_profesor.php';

if (isset($_POST['objeto_id'])) 
{ 
// Instructions if $_POST['value'] exist 
	$id_objeto = $_POST['objeto_id'];
	echo $id_objeto;
}
else echo "ya nada";

        //extract($_GET);
//$objeto_de_aprendizaje = obtener_oa_como_arreglo($id_objeto_aprendizaje);

//$nombre = $objeto_de_aprendizaje['nombre'];
//echo $id_objeto;
//publicarRA($nombre);

//echo '<script charset="UTF-8">alert("El recurso se ha publicado correctamente")</script> ';
//echo "<script>location.href='pro_buscar_privado.php'</script>";
?>