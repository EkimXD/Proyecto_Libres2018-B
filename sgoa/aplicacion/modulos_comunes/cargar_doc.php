<?php

// comprobamos que el arhivo no sea mayor de 1Mb
if($_FILES["archivo"]["size"]>1000000){
echo "Solo se permiten archivos menores de 1MB";
}else{
// sacamos todas las propiedades del archivo
$nombre_archivo = $_FILES['archivo']['name'];
$tipo_archivo= $_FILES['archivo']['type'];
$tamano_archivo = $_FILES["archivo"]['size'];
$direccion_temporar = $_FILES['archivo']['tmp_name'];
// movemos el archivo a la capeta de nuestro servidor
move_uploaded_file($_FILES['archivo']['tmp_name'],"../videos/" . $_FILES['archivo']['name']);
}
?>













?>