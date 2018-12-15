<?php 
 require_once '../aplicacion/clases_negocio/clase_administrador.php';
 $adminitrador=new Administrador('adminp','admin','ADM', 'V');
 $adminitrador->guardar();
 $adminitrador->presentarAdmins();
 echo $adminitrador->getUsuario(). ' se ha guardado correctamente con el id '.$adminitrador->getId();
 
?>