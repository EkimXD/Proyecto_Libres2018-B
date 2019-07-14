<?php 

session_start();
if (@!$_SESSION['usuario']) {

} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}
require '../../clases_negocio/clase_conexion.php';

$id_usuario=$_SESSION['id'];
$conexion = new Conexion();
    $statement = "SELECT count(*), colaborador.activo FROM colaborador JOIN usuario ON (colaborador.idUsuario=usuario.idUsuario) 
            WHERE usuario.idUsuario =".$_SESSION['id'];
    $consulta = $conexion->prepare($statement);
	$consulta->setFetchMode(PDO::FETCH_ASSOC);
	$consulta->execute();
	$row = $consulta->fetch();
    $activo = $row['activo'];
    $numero = $row['count(*)'];

    if($activo='F' and $numero!=0){
        
        $statement="UPDATE colaborador SET activo='V' WHERE idUsuario=".$id_usuario;
        $consulta = $conexion->prepare($statement);
	    $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        header("Location: perfil_colaborador.php");
        
    }else{
        header("Location: ../../modulos_profesor/pro_importar_catalogar.php?mensaje=0");

    }
?>