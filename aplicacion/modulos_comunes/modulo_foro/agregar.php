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

if (!empty($_FILES["video"]["name"])){
	$nombre_archivo = $_FILES['video']['name'];
	$tipo_archivo= $_FILES['video']['type'];
	$tamano_archivo = $_FILES["video"]['size'];
	$direccion_temporal = $_FILES['video']['tmp_name'];
	$direccion_servidor_video="videos/" . $_FILES['video']['name'];
	move_uploaded_file($_FILES['video']['tmp_name'],$direccion_servidor_video);
}else{
	$direccion_servidor_video = "";

}

require '../../clases_negocio/clase_conexion.php';

	if(isset($_POST["submit"])){
		if(!empty($_POST['mensaje'])){
			$titulo=$_POST['titulo'];
			$mensaje=$_POST['mensaje'];
			$respuestas=$_POST['respuestas'];
			$identificador=$_POST['identificador'];
			$fecha=date("d-m-y");
			//Evitamos que el usuario ingrese HTML
			$mensaje = htmlentities($mensaje);
			$conexion=new Conexion();
			//Grabamos el mensaje en la base de datos.
			
			$query = "	INSERT INTO foro (idUsuario, titulo, mensaje, identificador, imagen, video) 
						VALUES ('$idLogin', '$titulo', '$mensaje', $identificador, '$direccion_servidor', '$direccion_servidor_video')";
			
			echo $query;
						
		   	$consulta = $conexion ->prepare($query);
			$consulta->execute();
			 				
			 		
			/* si es un mensaje en respuesta a otro actualizamos los datos */
			if ((int)$identificador != 0)
			{
				
				$query2 = "UPDATE foro SET respuestas=".($respuestas+1)." WHERE idForo=".$identificador;
				$consulta = $conexion ->prepare($query2);
				if($consulta->execute()){
				}
				else{
   
   
				}
				Header("Location: foro.php?id=$identificador");
				exit();
			}
			Header("Location: index.php");
			echo "<script charset=\"UTF-8\">alert(\"Comentario ingresado exitosamente\")</script>";
		}
	}
?>