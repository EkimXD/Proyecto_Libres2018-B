<?php

session_start();
require_once '../clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_oa_profesor.php';

$id_objeto = $_POST['objeto_id'];

echo '<script charset="UTF-8">alert("Id Objeto:"+'.$id_objeto.')</script> ';

actualizar_cant_descarga($id_objeto);
return 1;

?>
