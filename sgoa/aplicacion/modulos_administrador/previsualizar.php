<?php

$variable=($_GET['vs']);
$za = new ZipArchive(); 
$za->open($variable);
$carpeta = '../../storage/Temp';

	if (!file_exists($carpeta))
	{
    mkdir($carpeta, 0777, true);
	}
    else{
    	rrmdir($carpeta);
    }

$za->extractTo($carpeta); 
header("Location: ../../storage/Temp/index.html");
 function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 } 
$za->close();

?>

