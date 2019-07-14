<?php
require '../../aplicacion/clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_administrador.php';
$correo = filter_input(INPUT_POST, 'correo');
$asunto = filter_input(INPUT_POST, 'asunto');
$respuesta = filter_input(INPUT_POST, 'respuesta');
$usuario = filter_input(INPUT_POST, 'usuario');

$conexion = new Conexion();
$statement = 'SELECT * FROM usuario join experiencia on (usuario.idUsuario = experiencia.idUsuario) WHERE usuario.usuario = \''.$usuario.'\'';
$consulta = $conexion->prepare($statement);
$consulta->execute();
$row = $consulta->fetch();
$idUsuario = $row['idUsuario'];

$statement = 'UPDATE experiencia SET respondido=\'SI\' WHERE idUsuario = \''.$idUsuario.'\'';
$consulta = $conexion->prepare($statement);
$consulta->execute();

if (enviar_mail_respuesta($correo, $asunto, $respuesta) == 1){
    echo '<script>alert("Respuesta enviada correctamente.")</script> ';
}else{
    echo '<script>alert("Ingrese los datos correctamente.")</script> ';
}
echo "<script>location.href='../../aplicacion/modulos_administrador/adm_comentarios_todos.php'</script>";


?>