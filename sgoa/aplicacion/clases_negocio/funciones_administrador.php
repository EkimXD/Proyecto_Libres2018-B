<?php

require_once 'funciones_oa_profesor.php';

function act_des_usuario($id_usuario, $activo)
{
    $conexion = new Conexion();

    $statement = 'UPDATE  usuario SET activo ="' . $activo . '" WHERE idUsuario=' . $id_usuario;
    //echo $statement;
    $consulta = $conexion->prepare($statement);
    $consulta->execute();
}

function consultarCarreras(){
    $conexion = new Conexion();
    $statement = 'select * from facultad';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
    }
    if (isset($fila)) {
        return $fila;
    } else {
        return null;
    }  
}

function eliminar_usuario($id_usuario)
{
    $statement_del = "DELETE FROM usuario WHERE idUsuario=?";
    $conexion_del = new Conexion();
    $consulta_del = $conexion_del->prepare($statement_del);
    if ($consulta_del->execute(array($id_usuario))) {
        return true;
    } else {
        return false;
    }
}

function eliminar_objetos_aprendizaje_asociados_a_id($id_usuario)
{
    $conexion = new Conexion();
    $statement = 'select * from objeto_aprendizaje where id_usuario=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_usuario]);
    $ids_oas = [];
    if ($consulta->rowCount() != 0) {
        while ($row = $consulta->fetch()) {
            array_push($ids_oas, $row['idobjeto_aprendizaje']);
        }
    }
    if (sizeof($ids_oas) != 0) {
        foreach ($ids_oas as $id) {
            eliminar_objeto_aprendizaje($id);
        }
    }


}

function enviar_mail($mail, $usuario, $contrasenia)
{
    $to = ''. $mail . '';
    $subject = 'Hello from SGOA!';
    $message = 'Usuario:' . $usuario . '
    Password:' . $contrasenia . '
    Usuario activado correctamente';
    $headers = "From: objetosaprendizaje593@gmail.com\r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "SUCCESS";
    } else {
        echo "ERROR";
    }
}

function enviar_mail2($mail, $usuario)
{
    $to = ''. $mail . '';
    $subject = 'SGOA!';
    $message = 'Usuario:' . $usuario . ' Su usuario ha sido baneado del sistema';
    $headers = "From: objetosaprendizaje593@gmail.com\r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "SUCCESS";
    } else {
        echo "ERROR";
    }
}





?>