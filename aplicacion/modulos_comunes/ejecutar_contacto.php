<?php
require '../../aplicacion/clases_negocio/clase_conexion.php';

$usuario = filter_input(INPUT_POST, 'usuario');
$descripcion = filter_input(INPUT_POST, 'desc_problema');
$comentario = filter_input(INPUT_POST, 'comentario');

$conexion = new Conexion();
$statement = 'SELECT * FROM usuario WHERE usuario = \''.$usuario.'\'';
$consulta = $conexion->prepare($statement);
$consulta->execute();

//$conexion = new Conexion();
if ($consulta->rowCount() != 0) {
    $registro = $consulta->fetch();
    echo $descripcion." ".$registro['idUsuario']." ".$comentario."<br>";
    $statement = 'INSERT INTO experiencia (idUsuario, descripcion, comentario) 
                    VALUES ('.$registro['idUsuario'].',\''.$descripcion.'\',\''.$comentario.'\')';
    $consulta = $conexion->prepare($statement);
    $consulta->execute();
    echo '<script>alert("Comentario ingresado correctamente. Pronto le responderemos")</script> ';
} else {
    echo '<script>alert("El usuario ingresado no existe. Por favor regístrese.")</script> ';
}

echo "<script>location.href='../../aplicacion/formularios_registro/Login.php'</script>";

?>