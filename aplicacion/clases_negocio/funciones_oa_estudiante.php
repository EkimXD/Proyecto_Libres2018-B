<?php

require_once 'clase_conexion.php';
function obtener_id_estudiante_con_id_usuario($id_usuario) {
    $conexion = new Conexion();
    $statement = 'select es.idestudiante from usuario as us, estudiante as es where us.idUsuario=es.id_usuario and us.idUsuario=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_usuario]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $id_estudiante = $fila['idestudiante'];
    }
    if (isset($id_estudiante)) {
        return $id_estudiante;
    } else {
        return null;
    }
}

function obtener_estudiante_como_arreglo($id_estud) {
    $conexion = new Conexion();
    $statement = 'select * from estudiante where idestudiante=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_estud]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
    }
    if (isset($fila)) {
        return $fila;
    } else {
        return null;
    }
}

function insertar_estudiante($ci, $nombres, $apellidos, $carrera, $facultad, $mail, $id_usuario) {
    $conexion = new Conexion();
    $statement = 'INSERT INTO estudiante (ci,nombres,apellidos, carrera, id_facultad, mail, id_usuario) VALUES (?,?,?,?,?,?,?)';
    $consulta = $conexion->prepare($statement);
    if ($consulta->execute(array($ci, $nombres, $apellidos, $carrera, $facultad, $mail, $id_usuario))) {
        return true;
    } else {
        return false;
    }
}

function insertarValoracion($id_objeto_aprendizaje,$idusuario,$puntaje){
    $conexion=new Conexion();
    $statement = 'INSERT INTO valoracion (idvaloracion,idobjeto_aprendizaje,idusuario,puntuacion) VALUES (?,?,?,?)';
    $consulta = $conexion ->prepare($statement);
     if ($consulta->execute(array(null,$id_objeto_aprendizaje,$idusuario,$puntaje))) {
        return true;
    } else {
        return false;
    }
}
?>