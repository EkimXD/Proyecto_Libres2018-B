<?php

session_start();
require '../aplicacion/clases_negocio/funciones_oa_estudiante.php';

$contrasenia = filter_input(INPUT_POST, 'pass');
if(actualizarNuevaContrasena($_SESSION['id'],$contrasenia)){
    echo '<script>alert("CONTRASEÑA ACTUALIZADA CORRECTAMENTE, POR FAVOR INGRESE NUEVAMENTE AL SISTEMA")</script> ';
    
}else{
    echo '<script>alert("ERROR EN CONEXION, POR FAVOR INTENTE DENUEVO")</script> ';
}
echo "<script>location.href='../aplicacion/formularios_registro/Login.php'</script>";
?>
