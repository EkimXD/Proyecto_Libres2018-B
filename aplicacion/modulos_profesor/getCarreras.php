<?php 
    require_once 'High/examples/pie-basic/conexion.php';

    $idfacultad = $_POST['idfacultad'];
    $sqlC = "SELECT materia_id, materia_nombre FROM materia WHERE facultad_id ='$idfacultad'";
    $resultC = mysqli_query($conexion, $sqlC); 
	
	$html = "<option value='0'> Seleccionar Materia</option>";

    while($rowM = mysqli_fetch_array($resultC)){
    	$html.= "<option value='".$rowM['materia_id']."'>".$rowM['materia_nombre']."</option>";
	}

    echo $html;
?>

