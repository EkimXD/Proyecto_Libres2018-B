<?php
session_start();

require '../clases_negocio/funciones_oa_estudiante.php';
$id_objeto_aprendizaje = $_POST['id_objeto_aprendizaje'];
$puntaje= $_POST['estrellas'];

if (insertarValoracion($id_objeto_aprendizaje,$_SESSION['id'],$puntaje)) {

    echo '<script charset="UTF-8">alert("Gracias por valorar el OA.")</script> ';
    echo "<script>location.href='est_buscar.php'</script>";
} else {
    echo '<script charset="UTF-8">alert("No se pudo valorar el OA. ")</script> ';
    echo "<script>location.href='est_buscar.php'</script>";
}
?>
