<!DOCTYPE html> 
<html> 
<body> 
<?php

session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}

if(isset($_GET["url"]))
$url = $_GET['url'];

?>

<video width="500" controls>
  <source src="../<?php echo $url?>" type="video/mp4">
  Your browser does not support HTML5 video.
</video>


</body> 
</html>
