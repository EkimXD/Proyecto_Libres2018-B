
<?php
	session_start();
	$usr=0;
   if (@!$_SESSION['usuario']) {
	   header("Location:../../index2.php");
   } elseif ($_SESSION['tipo_usuario'] == 'EST') {
	   //header("Location:index2.php");
	   echo "eres estudiante";
	   $usr=1;
   } elseif ($_SESSION['tipo_usuario'] == 'ADM') {
	   echo "eres administrador";
   }
	   
	include("conexionBD.php");
	
	if(isset($_POST["submit"])){
		if(!empty($_POST['mensaje'])){
			$autor=$_POST['autor'];
			$titulo=$_POST['titulo'];
			$mensaje=$_POST['mensaje'];
			$respuestas=$_POST['respuestas'];
			$identificador=$_POST['identificador'];
			$usuario = $_SESSION['usuario'];
			$fecha = date("d-m-y");
            $direccion_doc=$_FILES['archivo']['tmp_name'];
			
			//Evitamos que el usuario ingrese HTML
			$mensaje = htmlentities($mensaje);
			echo "identificador:";
			echo $identificador;
			
			//Grabamos el mensaje en la base de datos.
			$query = "INSERT INTO foro (autor, titulo, mensaje, identificador, fecha, ult_respuesta) VALUES ('$usuario', '$titulo', '$mensaje', '$identificador','$fecha','$fecha','$direccion_doc')";
			
			echo $query;
			echo "identificador:";
			echo $identificador;
			$result = $mysqli->query($query);
			
			/* si es un mensaje en respuesta a otro actualizamos los datos */
			if ($identificador != 0)
			{
				$query2 = "UPDATE foro SET respuestas=respuestas+1 WHERE ID='$identificador'";
				$result2 = $mysqli->query($query2);
				echo $query2;
				Header("Location: foro.php?id=$identificador");
				exit();
			}
			Header("Location: index.php");
		}
	}
?>