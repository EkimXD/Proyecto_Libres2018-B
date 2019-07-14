<?php
require '../clases_negocio/funciones_Registro.php';
require '../envio-phpmailer/mail.php';

$cedula = filter_input(INPUT_POST, 'cedula');
$nombres = filter_input(INPUT_POST, 'nombres');
$apellidos = filter_input(INPUT_POST, 'apellidos');
$email = filter_input(INPUT_POST, 'email');
$TipoUsuario = filter_input(INPUT_POST, 'tipo_usuario');
//print($TipoUsuario);

$usuario= generar_usuario_profesor($nombres, $apellidos);
$contrasenia= generar_cadena_aleatoria();
echo filter_input(INPUT_POST, 'email').$usuario.$contrasenia.filter_input(INPUT_POST, 'nombres').filter_input(INPUT_POST, 'apellidos');

$id_usuario= recuperar_id_usuario_por_nombre($usuario);
if(insertar_usuario($usuario, $contrasenia,$TipoUsuario, 'V', 'T')){
     enviarCorreo($email,$usuario,$contrasenia,$nombres,$apellidos);
	 echo '<script>alert("Usuario registrado correctamente! Revise su mail para obtener las credenciales")</script> ';
	echo "<script>location.href='../formularios_registro/Login.html'</script>";
}else{
    echo '<script>alert("No se ha podido registrar el usuario. Contacte a un administrador")</script> ';
    echo "<script>location.href='../formularios_registro/Login.html'</script>";
}

?>