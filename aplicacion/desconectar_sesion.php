<?php
session_start();
if($_SESSION['usuario']){
        session_unset();
	session_destroy();
}
echo "<script>location.href='../index.php'</script>";
?>
