<?php
	
session_start();
	if (@!$_SESSION['usuario']) {
   		header("Location:../../index.php");
		} elseif ($_SESSION['tipo_usuario'] == 'EST') {
	} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
		
}	

$idLogin=$_SESSION['id'];
$nombre=$_SESSION['usuario'];

if (!empty($_FILES["archivo"]["name"])){
	$nombre_archivo = $_FILES['archivo']['name'];
	$tipo_archivo= $_FILES['archivo']['type'];
	$tamano_archivo = $_FILES["archivo"]['size'];
	$direccion_temporal = $_FILES['archivo']['tmp_name'];
	$direccion_servidor="imagenes/" . $_FILES['archivo']['name'];
	move_uploaded_file($_FILES['archivo']['tmp_name'],$direccion_servidor);
}else{
	$direccion_servidor = "";

}


require '../../clases_negocio/clase_conexion.php';

	if(isset($_POST["submit"])){

            $ci=$_POST['ci'];
            $nombre=$_POST['nombre'];
			$apellido=$_POST['apellido'];
			$direccion=$_POST['direccion'];
            $fecha=$_POST['fecha_nacimiento'];
            $correo=$_POST['correo'];
            $telefono=$_POST['telefono'];
			//Evitamos que el usuario ingrese HTML
			$conexion=new Conexion();
			//Grabamos el mensaje en la base de datos.
            $tipo_usuario = $_SESSION['tipo_usuario'];

            if($tipo_usuario =='PRO'){
                $statement = "UPDATE profesor set ci = '$ci', nombres = '$nombre', apellidos = '$apellido', 
                mail = '$correo', fecha_nacimiento = '$fecha', domicilio = '$direccion', celular = '$telefono' WHERE id_usuario = $idLogin";

            }else{
                $statement = "UPDATE estudiante set ci = '$ci', nombres = '$nombre', apellidos = '$apellido', 
                mail = '$correo', fecha_nacimiento = '$fecha', domicilio = '$direccion', celular = '$telefono' WHERE id_usuario = $idLogin";

            }

            $consulta = $conexion ->prepare($statement);
			$consulta->execute();

            $statement = "	UPDATE usuario set foto = '$direccion_servidor' WHERE idUsuario = $idLogin";

			echo $statement;

		   	$consulta = $conexion ->prepare($statement);
			$consulta->execute();

			Header("Location: perfil_colaborador.php");
			echo "<script charset=\"UTF-8\">alert(\"Comentario ingresado exitosamente\")</script>";

	}
?>