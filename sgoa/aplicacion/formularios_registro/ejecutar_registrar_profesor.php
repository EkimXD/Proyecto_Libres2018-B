<?php
require '../../aplicacion/clases_negocio/funciones_oa_profesor.php';
require '../../aplicacion/clases_negocio/funciones_oa_estudiante.php';
$cedula = filter_input(INPUT_POST, 'cedula');
$nombres = filter_input(INPUT_POST, 'nombres');
$apellidos = filter_input(INPUT_POST, 'apellidos');
$email = filter_input(INPUT_POST, 'email');
$departamento = filter_input(INPUT_POST, 'departamento');
$facultad = filter_input(INPUT_POST, 'facultad');
$usuario= generar_usuario_profesor($nombres, $apellidos);
$contrasenia= generar_cadena_aleatoria();

$carpeta = "../../imagenes/";
opendir($carpeta);
$destino = $carpeta.$_FILES['file']['name'];
echo $_FILES['file']['name']."puto";
copy($_FILES['file']['tmp_name'], $destino);
$path = $_FILES['file']['name'];

$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file = $carpeta .urlencode($path);

insertar_usuario($usuario, $contrasenia,'PRO', 'F');
$id_usuario= recuperar_id_usuario_por_nombre($usuario);

if(insertar_profesor($cedula, $nombres, $apellidos, $departamento, $facultad, $email, $id_usuario, $target_file)){
	envia_mail_credenciales($email,$usuario,$contrasenia);
     echo '<script>alert("Usuario registrado correctamente! Revise su mail para obtener las credenciales")</script> ';
            echo '<meta http-equiv="Refresh" content="5; ../../aplicacion/formularios_registro/Login.php">';
}else{
    echo '<script>alert("No se ha podido registrar el usuario. Contacte a un administrador")</script> ';
    echo "<script>location.href='Login.php'</script>";
}

?>