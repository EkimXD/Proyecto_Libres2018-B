<?php

require '../../aplicacion/clases_negocio/funciones_oa_estudiante.php';
require '../../aplicacion/clases_negocio/funciones_oa_profesor.php';
error_reporting(E_ERROR);
$cedula = filter_input(INPUT_POST, 'cedula');
$nombres = filter_input(INPUT_POST, 'nombres');
$apellidos = filter_input(INPUT_POST, 'apellidos');
$email = filter_input(INPUT_POST, 'email');
$carrera = filter_input(INPUT_POST, 'carrera');
$facultad = filter_input(INPUT_POST, 'facultad');
$usuario = filter_input(INPUT_POST, 'usuario');
$contrasenia = filter_input(INPUT_POST, 'contrasenia');

$carpeta = "../../imagenes/";
opendir($carpeta);
$destino = $carpeta.$_FILES['file']['name'];

copy($_FILES['file']['tmp_name'], $destino);
$path = $_FILES['file']['name'];

$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file = $carpeta .urlencode($path);

insertar_usuario($usuario, $contrasenia,'EST', 'V');
$id_usuario= recuperar_id_usuario_por_nombre($usuario);
if(insertar_estudiante($cedula, $nombres, $apellidos, $carrera, $facultad, $email, $id_usuario,$target_file)){
     echo '<script>alert("Usuario registrado correctamente! Puede ingresar al sistema")</script> ';
        echo '<meta http-equiv="Refresh" content="0; ../../aplicacion/formularios_registro/Login.php">';
}else{
    echo '<script>alert("No se ha podido registrar el usuario. Contacte a un administrador")</script> ';
    echo "<script>location.href='est_buscar.php'</script>";
}


 
?>
