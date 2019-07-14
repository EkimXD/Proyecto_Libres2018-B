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
$cbx_materia = filter_input(INPUT_POST, 'cbx_materia');
$seGuardo_db = 0;
$seGuardo_sto = 1;
$path = $_FILES['o_aprendizaje']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file =$almacenamiento . urlencode($nombre). '.' . $ext;
$id_usuario= $_SESSION['id'];

$conexion = new Conexion();
$statement = 'INSERT INTO objeto_aprendizaje (nombre,descripcion,id_usuario,institucion,palabras_clave,tamanio,ruta,materia, tipo_repo,descarga) VALUES (?, ?, ?, ?,?,?,?,?,?,?)';
$consulta = $conexion->prepare($statement);
if ($consulta->execute(array($nombre, $descripcion, $id_usuario, $institucion, $palabras_clave, $_FILES["o_aprendizaje"]["size"], $target_file, consultar_materiaxid($cbx_materia), 1,0))) {
    $seGuardo_db = 1;
    /*$mail = 'alexis.maldonado@epn.edu.ec';
    $user = 'alexis';

    enviar_mail3($mail, $user, $target_file);*/
    actualizar_cant_materia($cbx_materia);
    echo "1";
} else {
    $seGuardo_db = 0;
    echo "0";
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
        if (move_uploaded_file($_FILES["o_aprendizaje"]["tmp_name"], $target_file)) {
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
            $statement = $conexion->prepare($statement);
            if($statement->execute()){
                if($_SESSION['tipo_usuario']=='EST') $tabla = "estudiante";
                else $tabla = "profesor";

                $query = "SELECT mail FROM usuario as u JOIN ".$tabla." as a ON (a.id_usuario=u.idUsuario) WHERE idUsuario=".$id_usuario;
                $query = $conexion->prepare($query);
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();
                $row = $query->fetch();
                enviar_mail4($row['mail'],'GRACIAS POR SU APORTE!','Ahora forma parte de nuestro grupo de colaboradores');
                echo '<script type="text/javascript">alert("Objeto de aprendizaje subido correctamente");</script>';
                header("Location: pro_buscar.php");
            }
            }

           
        } else {

            $seGuardo_sto = 0;
        }
    }
} else {

}
?>
