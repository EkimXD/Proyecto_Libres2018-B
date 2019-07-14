<?php

session_start();
require_once '../clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_oa_profesor.php';

$almacenamiento = '../../storage/';
$archivo=$_FILES['o_aprendizaje']['name'];
$nombre = filter_input(INPUT_POST, 'nombre');
$descripcion = filter_input(INPUT_POST, 'descripcion');
$institucion = filter_input(INPUT_POST, 'institucion');
$palabras_clave = filter_input(INPUT_POST, 'palabras_claves');

$seGuardo_db = 0;
$seGuardo_sto = 1;
$path = $_FILES['o_aprendizaje']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file = $almacenamiento .urlencode($nombre). '.' . $ext;

$id_usuario= $_SESSION['id'];

$conexion = new Conexion();
$statement = 'INSERT INTO objeto_aprendizaje (nombre,descripcion, id_usuario, institucion,palabras_clave,tamanio,ruta) VALUES (?, ?, ?, ?,?,?,?)';
$consulta = $conexion->prepare($statement);
if ($consulta->execute(array($nombre, $descripcion, $id_usuario, $institucion, $palabras_clave, $_FILES['o_aprendizaje']['size'], $target_file))) {
    $seGuardo_db = 1;
    echo "1";

} else {
    echo "0";
    $seGuardo_db = 0;
}
$conexion = null;

if ($seGuardo_db == 1) {
    if (file_exists($target_file)) {
        echo "Lo sentimos el archivo ya existe";
        $seGuardo_sto = 0;
    }

    if ($seGuardo_sto == 0) {
        echo "Lo sentimos su archivo no ha sido cargado.";
    } else {
        if (move_uploaded_file($_FILES['o_aprendizaje']['tmp_name'],$target_file)) {
            $seGuardo_sto = 1;
            $conexion = new Conexion();

            $statement = "SELECT * FROM colaborador WHERE idUsuario=".$id_usuario;
            $statement = $conexion->prepare($statement);
	        $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            if ($statement->rowCount() != 0) {
                $statement="UPDATE colaborador SET activo='V' WHERE idUsuario=".$id_usuario;
            }else{
            $statement = "INSERT INTO colaborador (idUsuario,activo) VALUES (".$id_usuario.",'V')";
            }
            $statement = $conexion->prepare($statement);
            $statement->execute();
        } else {
            $seGuardo_sto = 0;
        }
    }
} else {

}
?>
