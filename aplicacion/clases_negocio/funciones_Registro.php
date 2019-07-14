<?php

require_once 'clase_conexion.php';
function obtener_tipo_usuario_con_id($id_usuario){
    $conexion = new Conexion();
    $statement = 'select * from usuario where idUsuario=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_usuario]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $tipo_usuario = $fila['tipo_usuario'];
    }
    if (isset($tipo_usuario)) {
        return $tipo_usuario;
    } else {
        return null;
    }
}

function obtener_id_profesor_con_id_usuario($id_usuario) {
    $conexion = new Conexion();
    $statement = 'select pro.idprofesor from usuario as us, profesor as pro where us.idUsuario=pro.id_usuario and us.idUsuario=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_usuario]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $id_profesor = $fila['idprofesor'];
    }
    if (isset($id_profesor)) {
        return $id_profesor;
    } else {
        return null;
    }
}

function obtener_profesor_como_arreglo($id_profesor) {
    $conexion = new Conexion();
    $statement = 'select * from profesor where idprofesor=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_profesor]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
    }
    if (isset($fila)) {
        return $fila;
    } else {
        return null;
    }
}

function obtener_nro_comentarios_oa($id_objeto_aprendizaje) {
    $conexion = new Conexion();
    $statement = 'select count(*) as nro_comentarios from objeto_aprendizaje as oa, comentario as c where oa.idobjeto_aprendizaje=c.id_objeto_aprendizaje and c.id_objeto_aprendizaje=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_objeto_aprendizaje]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $id_profesor = $fila['nro_comentarios'];
    }
    if (isset($id_profesor)) {
        return $id_profesor;
    } else {
        return null;
    }
}

function obtener_oa_como_arreglo($id_objeto_aprendizaje) {
    $conexion = new Conexion();
    $statement = 'select * from objeto_aprendizaje where idobjeto_aprendizaje=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_objeto_aprendizaje]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
    }
    if (isset($fila)) {
        return $fila;
    } else {
        return null;
    }
}

function insertar_valoracion($id_objeto_aprendizaje,$idusuario,$puntaje){
    $conexion=new Conexion();
    $statement = 'INSERT INTO valoracion (idvaloracion,idobjeto_aprendizaje,idusuario,puntuacion) VALUES (?,?,?,?)';
    $consulta = $conexion ->prepare($statement);
     if ($consulta->execute(array(null,$id_objeto_aprendizaje,$idusuario,$puntaje))) {
        return true;
    } else {
        return false;
    }
}

function consultarNombreUsuario($id_usuario){
    $conexion = new Conexion();
    $statement = 'select usuario from usuario where idusuario=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$id_usuario]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
    }
    if (isset($fila)) {
        return $fila;
    } else {
        return null;
    }
}

function actualizar_oa($id_objeto_aprendizaje, $nombre, $descripcion, $institucion, $palabras_clave) {
    //actualiazcion en storage
    $nombre_original = obtener_oa_como_arreglo($id_objeto_aprendizaje)['nombre'];
    $ruta_inicial = obtener_oa_como_arreglo($id_objeto_aprendizaje)['ruta'];
    if ($nombre_original != $nombre) {
        $nueva_ruta = '../../storage/' . urlencode($nombre) . '.zip';
        rename($ruta_inicial, $nueva_ruta);
        $statement_del = 'UPDATE objeto_aprendizaje set nombre="' . $nombre . '", descripcion="' . $descripcion . '", institucion="' . $institucion . '",palabras_clave="' . $palabras_clave . '", ruta="' . $nueva_ruta . '" where idobjeto_aprendizaje=' . $id_objeto_aprendizaje;
    } else {
        $statement_del = 'UPDATE objeto_aprendizaje set nombre="' . $nombre . '", descripcion="' . $descripcion . '", institucion="' . $institucion . '",palabras_clave="' . $palabras_clave . '" where idobjeto_aprendizaje=' . $id_objeto_aprendizaje;
    }
    //echo $statement_del;
    $conexion_del = new Conexion();
    $consulta_del = $conexion_del->prepare($statement_del);
    $consulta_del->execute();
}

function eliminar_objeto_aprendizaje($id_objeto_aprendizaje) {
    //eliminacion de storage
    $ruta = obtener_oa_como_arreglo($id_objeto_aprendizaje)['ruta'];
    unlink($ruta);
    //eliminacion de base de datos
    $statement_del = "DELETE FROM objeto_aprendizaje WHERE idobjeto_aprendizaje=?";
    $conexion_del = new Conexion();
    $consulta_del = $conexion_del->prepare($statement_del);
    $consulta_del->execute(array($id_objeto_aprendizaje));
}


function eliminarComentario($id_comentario){
    $statement_del = "DELETE FROM comentario WHERE idcomentario=?";
    $conexion_del = new Conexion();
    $consulta_del = $conexion_del->prepare($statement_del);
    $consulta_del->execute(array($id_comentario));
}

function actualizar_cant_materia ($materia_nombre){
    $statement_del = "UPDATE materia SET cantidad=cantidad+1 WHERE materia_id =?";
    $conexion_del = new Conexion();
    $consulta_del = $conexion_del->prepare($statement_del);
    $consulta_del->execute(array($materia_nombre));
}

function obtener_lista_de_oas() {
    $conexion = new Conexion();
    $statement = 'select nombre from objeto_aprendizaje';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    $arreglo = [];
    if ($consulta->rowCount() != 0) {
        while ($row = $consulta->fetch()) {
            array_push($arreglo, $row['nombre']);
        }
    }
    return implode(',', $arreglo);
}

//inicio funciones de comentario
function insertar_comentario($contenido, $idusuario, $id_objeto_aprendizaje, $rutaimagen) {
    $conexion = new Conexion();
    $statement = 'INSERT INTO comentario (contenido,idusuario,id_objeto_aprendizaje, rutaimagen) VALUES (?, ?, ?, ?)';
    $consulta = $conexion->prepare($statement);
    if ($consulta->execute(array($contenido, $idusuario, $id_objeto_aprendizaje, $rutaimagen))) {
        return true;
    } else {
        return false;
    }
}

//incio funciones registro de estudiante 
function obtener_lista_de_usuarios() {
    $conexion = new Conexion();
    $statement = 'select usuario from usuario';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    $arreglo = [];
    if ($consulta->rowCount() != 0) {
        while ($row = $consulta->fetch()) {
            array_push($arreglo, $row['usuario']);
        }
    }
    return implode(',', $arreglo);
}

function insertar_usuario($usuario, $contrasenia, $tipo_usuario, $esta_activo, $cambio_clave) {
    $conexion = new Conexion();
    $statement = 'INSERT INTO usuario (usuario,contrasenia,tipo_usuario, activo, cambio_de_clave) VALUES (?,?,?, ?,?)';
    $consulta = $conexion->prepare($statement);
    if ($consulta->execute(array($usuario, $contrasenia, $tipo_usuario, $esta_activo,$cambio_clave))) {
        return true;
    } else {
        return false;
    }
}

function recuperar_id_usuario_por_nombre($usuario) {
    $conexion = new Conexion();
    $statement = 'select idUsuario from usuario where usuario = "' . $usuario . '"';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $id_usuario = $fila['idUsuario'];
    }
    if (isset($id_usuario)) {
        return $id_usuario;
    } else {
        return null;
    }
}


function insertar_profesor($ci, $nombres, $apellidos, $id_departamento, $id_facultad, $mail, $id_usuario) {
    $conexion = new Conexion();
    $statement = 'INSERT INTO profesor (ci,nombres,apellidos,id_departamento, id_facultad, mail, id_usuario) VALUES (?,?,?,?,?,?,?)';
    $consulta = $conexion->prepare($statement);
    if ($consulta->execute(array($ci, $nombres, $apellidos, $id_departamento, $id_facultad, $mail, $id_usuario))) {
        return true;
    } else {
        return false;
    }
}

function generar_cadena_aleatoria($length = 5) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud_caracteres = strlen($caracteres);
    $cadena_aleatoria = '';
    for ($i = 0; $i < $length; $i++) {
        $cadena_aleatoria .= $caracteres[rand(0, $longitud_caracteres - 1)];
    }
    return $cadena_aleatoria;
}

function generar_usuario_profesor($nombre, $apellido){
    $nombre1=explode(' ',$nombre)[0];
    $apellido1=explode(' ',$apellido)[0];
    $existe_usuario=true;
    $contador=0;
    while ($existe_usuario){
        if(obtener_nro_usuarios_con_usuario($nombre1.$apellido1.$contador)!=0){
            $contador=$contador+1;
            $existe_usuario=true;
        }else{
            $usuario=$nombre1.$apellido1.$contador;
            $existe_usuario=false;
        }
    }
    if(isset($usuario)){
        return $usuario;
    } else {
        return null;

    }
}



function obtener_nro_usuarios_con_usuario($usuario) {
    $conexion = new Conexion();
    $statement = 'select count(*) as nro_usuarios from usuario where usuario=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$usuario]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $nro_usuarios = $fila['nro_usuarios'];
    }
    if (isset($nro_usuarios)) {
        return $nro_usuarios;
    } else {
        return null;
    }
}

function actualizar_cant_descarga ($id_objeto){
    $statement_del = "UPDATE objeto_aprendizaje SET descarga=descarga+1 WHERE idobjeto_aprendizaje =?";
    $conexion_del = new Conexion();
    $consulta_del = $conexion_del->prepare($statement_del);
    $consulta_del->execute(array($id_objeto));
}

function consultar_materiaxid($cbx_materia){
    $conexion = new Conexion();
    $statement = 'select materia_nombre from materia where materia_id=?';
    $consulta = $conexion->prepare($statement);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute([$cbx_materia]);
    if ($consulta->rowCount() != 0) {
        $fila = $consulta->fetch();
        $materia_nombre = $fila['materia_nombre'];
    }
    if (isset($materia_nombre)) {
        return $materia_nombre;
    } else {
        return null;
    }
}

function enviar_mail3($to_mail, $usuario, $contrasenia)
{
	$email = 'proyecto.libres.2018b@gmail.com';
	echo '<script>alert($to_mail)</script>';
    $to = ''. $to_mail . '';
    $subject = 'SGOA!';
    $message = 'Credenciales para inicio de sesión
	Usuario:' . $usuario . 
	'Contrasenia: ' .$contrasenia. '';
    $headers = 'From: ' .$email . "\r\n". 
	'Reply-To: ' . $email. "\r\n" . 
	'X-Mailer: PHP/' . phpversion();
  
	if (mail($to_mail, $subject, $message, $headers)) {
        echo "SUCCESS";
    } else {
        echo "ERROR";
    }
}

function enviar_mail4($to_mail, $subj, $content)
{
	$email = 'proyecto.libres.2018b@gmail.com';
	$to = ''. $to_mail . '';
    $subject = $subj;
    $message = $content;
    $headers = 'From: ' .$email . "\r\n". 
	'Reply-To: ' . $email. "\r\n" . 
	'X-Mailer: PHP/' . phpversion();
  
    if (mail($to_mail, $subject, $message, $headers)) {
        echo "SUCCESS";
    } else {
        echo '<html><script>alert($to_mail)</script></html>';
        echo "ERROR";
    }
}
?>
