<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    header("Location:../../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
    
}
   
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>

    <meta charset="utf-8"></meta>
    <link rel="stylesheet" href="../../../plugins/bootstrap/css/bootstrap.min.css"></link>
    <script type="text/javascript" src="../../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <title>Proyecto SGOA</title>
</head>
<style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
    }
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 390px}
    /* Set gray background color and 100% height */
    .sidenav {
        padding-top: 20px;
        background-color: #f1f1f1;
        height: 100%;
    }
    html{
        min-height: 100%;
        position: relative;
    }
    body{
        margin:0;
        margin-bottom: 40px;
    }
    /* Set black background color, white text and some padding */
    footer {
        background-color: #555;
        color: white;
        padding: 15px;
        position: fixed;
        bottom: 0;
        width: 100%;
        padding-top:5px;
    padding-bottom:5px;
    }
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
        .sidenav {
            height: auto;
            padding: 15px;
        }
        .row.content {height:auto;}
    }
    .table > tbody > tr > td {
        vertical-align: middle;
    }
       .estadistica{
        -webkit-column-count: 3; /* Chrome, Safari, Opera */
        -moz-column-count: 3; /* Firefox */
        column-count: 2;
        
    }
</style>


<body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>

    <meta charset="utf-8"></meta>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
    <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <title>Proyecto SGOA</title>
</head>
<style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
    }
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 390px}
    /* Set gray background color and 100% height */
    .sidenav {
        padding-top: 20px;
        background-color: #f1f1f1;
        height: 100%;
    }
    html{
        min-height: 100%;
        position: relative;
    }
    body{
        margin:0;
        margin-bottom: 40px;
    }
    /* Set black background color, white text and some padding */
    footer {
        background-color: #555;
        color: white;
        padding: 15px;
        position: fixed;
        bottom: 0;
        width: 100%;
        padding-top:5px;
    padding-bottom:5px;
    }
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
        .sidenav {
            height: auto;
            padding: 15px;
        }
        .row.content {height:auto;}
    }
    .table > tbody > tr > td {
        vertical-align: middle;
    }
       .estadistica{
        -webkit-column-count: 3; /* Chrome, Safari, Opera */
        -moz-column-count: 3; /* Firefox */
        column-count: 2;
        
    }
</style>


<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bienvenid@: <strong><?php echo $_SESSION['usuario']?></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Objetos de aprendizaje
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../../modulos_administrador/adm_objetos_aprendizaje.php">Importar y catalogar objetos de aprendizaje</a></li>
                        <li><a href="../../modulos_administrador/adm_buscar.php">Buscar y administrar objetos de aprendizaje</a></li>
                    </ul>
                </li>
                <li><a href="../../modulos_administrador/adm_buscar_profesores.php">Gestionar Profesores</a></li>
                <li ><a href="../../modulos_administrador/adm_buscar_estudiantes.php">Gestionar Estudiantes</a></li>
                <li ><a href="../../modulos_administrador/adm_comentarios_todos.php">Gestionar comentarios</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gestión de colaboradores
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="buscar_colaborador.php">Buscar</a></li>
                        <li><a href="eliminar_colaborador.php">Eliminar</a></li>
                    </ul>
                </li>
                <li><a href="../../modulos_administrador/adm_herramientas.php">Herramientas</a></li>
                <li ><a href="../modulo_foro/index.php">Foro</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php 



/* Los datos cédula de identidad, nombres y apellidos, fecha de nacimiento, género, 
dirección de domicilio, telefono convencional, telefono celular y correo electrónico
se encuentran entre la tabla usuario, la tabla estudiante o profesor segun corresponda
y la tabla colaboradores.


Se deben desplegar todos los campos de cada colaborador indicados arriba (el numero total
de colaboraciones por cada uno)(como en el archivo "modulos_administrador/adm_buscar.php")
en una tabla como en el archivo index.php del modulo foro.

En esta tabla debe existir un boton de eliminar por cada colaborador. Si se da click, se debe
actualizar el campo "activo" de la tabla colaborador a "F" (falso).

NO SE DEBEN BORRAR Y/O ACTUALIZAR NINGUN OTRO DATO.

Debe tener la opción de buscar por: apellido o cédula.


*/


?>


<body>

<?php 
    require_once '../../clases_negocio/clase_conexion.php';

    $conexion = new Conexion();
    $statement = "SELECT count(*), colaborador.activo FROM colaborador JOIN usuario ON (colaborador.idUsuario=usuario.idUsuario) 
            WHERE usuario.idUsuario =".$_SESSION['id'];
    $consulta = $conexion->prepare($statement);
	$consulta->setFetchMode(PDO::FETCH_ASSOC);
	$consulta->execute();
	$row = $consulta->fetch();
    $activo = $row['activo'];
    $numero = $row['count(*)'];
    

?>

<div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-12 text-center"> 
                    <h2>ELIMINAR COLABORADORES</h2>

                    <form action="eliminar_colaborador.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-3">
                        </div>            
                        <div class="col-md-3 text-left ">
                            <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                                <option value="">Filtrar por:</option>
                                <option value="apellido">Apellido</option>
                                <option value="cedula">Cédula</option>
                            </select><br>
                        </div>
                    <div class="col-md-3 text-center">
                            <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>
                        </div>
                        <div class="col-md-3 text-left">
                            <button id="registrar" type="submit" class="btn btn-danger">Buscar</button>
                    <br><br>
                </div>

            </form>
            
            <div class="container" >
                <table class="table table-striped" border="1|1" class="table table-bordered" id="tabla">
                    <thead>
                    <tr class="warning">
                        <td>Nombre Completo</td>
                        <td>Cédula de identidad</td>
                        <td>Fecha de nacimiento</td>
                       <!-- <td>Género</td> -->
                        <td>Dirección de domicilio</td>
                        <td>Teléfono convencional</td>
                        <td>Teléfono celular</td>
                        <td>Correo electrónico</td>
                        <td>Colaboraciones</td>
					</tr>
					</thead>
            </div>
<?php 

    require '../../clases_negocio/funciones_administrador.php';
    $idLogin = $_SESSION['id'];
	$nombre = $_SESSION['usuario'];

    $conexion = new Conexion();
    $statement = "SELECT estudiante.id_usuario, estudiante.ci, estudiante.nombres, estudiante.apellidos, estudiante.mail, estudiante.domicilio, estudiante.celular, estudiante.convencional, estudiante.genero, estudiante.fecha_nacimiento, colaborador.colaboraciones, colaborador.idColaborador, colaborador.activo
    FROM estudiante JOIN colaborador
    on estudiante.id_usuario=colaborador.idUsuario
    UNION
    SELECT profesor.id_usuario, profesor.ci, profesor.nombres, profesor.apellidos, profesor.mail, profesor.domicilio, profesor.celular, profesor.convencional, profesor.genero, profesor.fecha_nacimiento, colaborador.colaboraciones, colaborador.idColaborador, colaborador.activo
    FROM profesor JOIN colaborador
    on profesor.id_usuario=colaborador.idUsuario";
    
    $criterio = filter_input(INPUT_POST, 'tipo_criterio');
    $valor_criterio = filter_input(INPUT_POST, 'criterio_busqueda');
    
    $clausula_where = " ";
        switch ($criterio) {
            case 'apellido':
                $clausula_where = ' and apellidos like "%' . $valor_criterio . '%" order by apellidos';
                $statement = $statement . $clausula_where;
                break;
            case 'cedula':
                $clausula_where = ' and ci like "%' . $valor_criterio . '%" order by ci';
                $statement = $statement . $clausula_where;
                break;
        }
    
    $consulta = $conexion->prepare($statement);
	$consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    

    if ($consulta->rowCount() != 0) {
	while($row = $consulta->fetch()){
		$id = $row['idColaborador'];
        $usuario = $row['nombres'] . '  ' . $row['apellidos'] ;
		$cedula = $row['ci'];
        $fecha = $row['fecha_nacimiento'];
        //$genero= $row['genero'];
        $direccion = $row['domicilio'];
        //$Tel_convencional= $row['convencional'];
        $Tel_celular= $row['celular'];
        $correo= $row['mail'];
        $colaboraciones= $row['colaboraciones'];
        $activo=$row['activo'];

        echo "<tr>";
			echo "<td>$usuario </td>";
			echo "<td>$cedula</td>";
            echo "<td>$fecha</td>";
            //echo "<td>$genero</td>";
            echo "<td>$direccion</td>";
          //  echo "<td>$Tel_convencional</td>";
            echo "<td>$Tel_celular</td>";
            echo "<td>$correo</td>";
            echo "<td>$colaboraciones</td>";
            echo "<td>$activo</td>";
            if ($row['activo'] == 'V') {
                echo '<td><a href="eliminar_colaborador.php?id=' . $row['idColaborador'] . '&id_gestion=1">Desactivar</a></td>';
            } else {
                echo '<td><a href="eliminar_colaborador.php?id=' . $row['idColaborador'] . '&id_gestion=2">Activar</a></td>';
            }
		echo "</tr>";
    }
}


    echo '</table>';
    $id_gestion = filter_input(INPUT_GET, 'id_gestion');
    $id = filter_input(INPUT_GET, 'id');
    if ($id_gestion == 1) {
     act_des_colaborador ($id, "F");
        echo '<script>alert("Colaborador desactivado correctamente")</script> ';
        echo "<script>location.href='eliminar_colaborador.php'</script>";
          }
   if ($id_gestion == 2) {
    act_des_colaborador($id, "V");
        echo '<script>alert("Colaborador activado correctamente")</script> ';
          echo "<script>location.href='eliminar_colaborador.php'</script>";
        }
        
    $conexion = null;

?>
</table>
<br>
<br>

</body>


</body>
</html>