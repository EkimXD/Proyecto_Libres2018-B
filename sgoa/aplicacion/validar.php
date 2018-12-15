<?php

session_start();
require '../aplicacion/clases_negocio/clase_conexion.php';

$usuario = filter_input(INPUT_POST, 'user');
$contrasenia = filter_input(INPUT_POST, 'pass');
$tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario');


$conexion = new Conexion();
$query = "select * from usuario where usuario=?";
$consulta = $conexion->prepare($query);
$consulta->setFetchMode(PDO::FETCH_ASSOC);
$consulta->execute(array($usuario));
if ($consulta->rowCount() != 0) {
    $fila = $consulta->fetch();
    switch ($fila['tipo_usuario']) {
        case 'ADM':
            if ($tipo_usuario == 'ADM') {
                if ($fila['contrasenia'] == $contrasenia) {
                    if ($fila['activo'] == 'V') {
                        $_SESSION['id'] = $fila['idUsuario'];
                        $_SESSION['usuario'] = $fila['usuario'];
                        $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
                        echo "<script>location.href='../aplicacion/modulos_administrador/adm_objetos_aprendizaje.php'</script>";
                    } else {
                        echo '<script>alert("Usuario inactivo. Debe contactar a un administrador.")</script> ';
                        echo "<script>location.href='../../index2.php'</script>";
                    }
                } else {
                    echo '<script charset="UTF-8">alert("Contraseña no válida.")</script> ';
                    echo "<script>location.href='../../index2.php'</script>";
                }
            } else {
                echo '<script>alert("TIPO DE USUARIO INCORRECTO")</script> ';
                echo "<script>location.href='../../index2.php'</script>";
            }
            break;
        case 'PRO':
            if ($tipo_usuario == 'PRO') {
                if ($fila['contrasenia'] == $contrasenia) {
                    if ($fila['activo'] == 'V') {
                        $_SESSION['id'] = $fila['idUsuario'];
                        $_SESSION['usuario'] = $fila['usuario'];
                        $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
                        echo "<script>location.href='../aplicacion/modulos_profesor/pro_importar_catalogar.php'</script>";
                    } else {
                        echo '<script>alert("Usuario inactivo. Debe contactar a un administrador.")</script> ';
                        echo "<script>location.href='../../index2.php'</script>";
                    }
                } else {
                    echo '<script charset="UTF-8">alert("Contraseña no válida.")</script> ';
                    echo "<script>location.href='../../index2.php'</script>";
                }
            } else {
                echo '<script>alert("TIPO DE USUARIO INCORRECTO")</script> ';
                echo "<script>location.href='../../index2.php'</script>";
            }
            break;
        case 'EST':
            if ($tipo_usuario == 'EST') {
                if ($fila['contrasenia'] == $contrasenia) {
                    if ($fila['activo'] == 'V') {
                        $_SESSION['id'] = $fila['idUsuario'];
                        $_SESSION['usuario'] = $fila['usuario'];
                        $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
                        echo "<script>location.href='../aplicacion/modulos_estudiante/est_buscar.php'</script>";
                    } else {
                        echo '<script>alert("Usuario inactivo. Debe contactar a un administrador.")</script> ';
                        echo "<script>location.href='../../index2.php'</script>";
                    }
                } else {
                    echo '<script charset="UTF-8">alert("Contraseña no válida.")</script> ';
                    echo "<script>location.href='../../index2.php'</script>";
                }
            } else {
                echo '<script>alert("TIPO DE USUARIO INCORRECTO")</script> ';
                echo "<script>location.href='../../index2.php'</script>";
            }
            break;
    }
} else {
    echo '<script>alert("ESTE USUARIO NO EXISTE, PORFAVOR REGISTRESE PARA PODER INGRESAR")</script> ';
    echo "<script>location.href='../../index2.php'</script>";
}
$consulta = null;
?>
