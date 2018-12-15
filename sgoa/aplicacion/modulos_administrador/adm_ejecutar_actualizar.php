<?php
session_start();
require '../clases_negocio/funciones_oa_profesor.php';

$idobjeto_aprendizaje = filter_input(INPUT_POST, 'id_objeto_aprendizaje');
$nombre = filter_input(INPUT_POST, 'nombre');
$descripcion = filter_input(INPUT_POST, 'descripcion');
$institucion = filter_input(INPUT_POST, 'institucion');
$palabras_clave = filter_input(INPUT_POST, 'palabras_claves');

actualizar_oa($idobjeto_aprendizaje, $nombre, $descripcion, $institucion, $palabras_clave);

echo '<script charset="UTF-8">alert("El objeto se ha actualizado completamente")</script> ';
echo "<script>location.href='adm_buscar.php'</script>";
?>