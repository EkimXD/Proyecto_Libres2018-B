<?php
require '../../aplicacion/clases_negocio/clase_conexion.php';

$usuario = filter_input(INPUT_POST, 'user');
$contrasenia = filter_input(INPUT_POST, 'pass');
$cambio = 'F';
$conexion = new Conexion();
$statement = 'UPDATE usuario SET contrasenia=\''.$contrasenia.'\'WHERE usuario=\''.$usuario.'\'';

$consulta = $conexion->prepare($statement);
$consulta->execute();

$conexion = new Conexion();
$statement = 'UPDATE usuario SET cambio_de_clave=\''.$cambio.'\'WHERE usuario=\''.$usuario.'\'';

$consulta = $conexion->prepare($statement);
$consulta->execute();

//$conexion = new Conexion();

     echo '<script>alert("Usuario modificado correctamente!")</script> ';
     echo "<script>location.href='../formularios_registro/Login.html'</script>";


?>