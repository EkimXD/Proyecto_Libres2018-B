<?php
session_start();
require '../clases_negocio/funciones_oa_profesor.php';

$id_objeto_aprendizaje = filter_input(INPUT_POST, 'id_objeto_aprendizaje');
$contenido = filter_input(INPUT_POST, 'contenido');

$carpeta = "../../imagenes/";
opendir($carpeta);
$destino = $carpeta.$_FILES['file']['name'];
$destino2 = $carpeta.$_FILES['file']['name'];

copy($_FILES['file']['tmp_name'], $destino);
$path = $_FILES['file']['name'];

$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file = $carpeta .urlencode($path);
//$target_file = urlencode($destino2);

if (insertar_comentario($contenido, $_SESSION['id'], $id_objeto_aprendizaje, $target_file)) {

    echo '<script charset="UTF-8">alert("Su comentario se inserto correctamente")</script> ';
    echo '<script>location.href = "adm_comentarios.php?id=' . $id_objeto_aprendizaje . '"</script>';
} else {
    echo '<script charset="UTF-8">alert("No se pudo insertar su comentario. ")</script> ';
    echo '<script>"adm_comentarios.php?id=' . $id_objeto_aprendizaje . '"</script>';
}
?>
