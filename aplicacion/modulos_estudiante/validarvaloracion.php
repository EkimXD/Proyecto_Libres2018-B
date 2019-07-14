<?php

session_start();
require '../clases_negocio/clase_conexion.php';
$idObjeto = filter_input(INPUT_POST, 'idObjeto');


$id_usuario= $_SESSION['id'];
$conexion = new Conexion();
$statement = 'select * from valoracion where idobjeto_aprendizaje = ? and idusuario = ?';
$consulta = $conexion->prepare($statement);
$consulta->setFetchMode(PDO::FETCH_ASSOC);
$consulta->execute(array($idObjeto,$id_usuario));
if ($consulta->rowCount() != 0) {
	echo 1;
    }
   else {
   	echo 2;
   }

?>
 
