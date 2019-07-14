<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
        
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

<?php 
    if ($_SESSION['tipo_usuario'] == 'ADM'){
        echo '<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bienvenid@: <strong>'.$_SESSION['usuario'].'</strong></a>
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
    </nav>';

    }else {
        echo '<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bienvenid@: <strong>'.$_SESSION['usuario'] .'</strong></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="../../modulos_profesor/pro_importar_catalogar.php">Importar y catalogar</a></li>
                    <li><a href="../../modulos_profesor/pro_buscar.php">Buscar</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Colaboradores
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="buscar_colaborador.php">Buscar</a></li>
                        <li><a href="perfil_colaborador.php">Perfil</a></li>
                        <li><a href="actualizar_datos_colaborador.php">Actualizar datos</a></li>
                        </ul>
                    </li>
                    <li><a href="../../modulos_profesor/pro_herramientas.php">Herramientas</a></li>
                    <li><a href="../modulo_foro/index.php">Foro</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../../desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
            </div>
        </div>
     </nav> ';
    }
  
/* Los datos cédula de identidad, nombres y apellidos, fecha de nacimiento, género, 
dirección de domicilio, telefono convencional, telefono celular y correo electrónico
se encuentran entre la tabla usuario, la tabla estudiante o profesor segun corresponda
y la tabla colaboradores.


Se deben desplegar todos los campos de cada colaborador indicados arriba (incluyendo las
colaboraciones para descargar y el nombre de las colaboraciones)(como en el archivo "modulos_administrador/adm_buscar.php")
en una tabla como en el archivo index.php del modulo foro. 
Debe tener la opción de buscar por: apellido o cédula.
*/
?>
<!-- Inicio formulario de búsqueda -->

<!-- presentacion de objetos de aprendizaje-->
<div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-12 text-center"> 
                    <h2>BÚSQUEDA DE COLABORADORES</h2>
            <form action="buscar_colaborador.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-3">
                        </div>            
                        <div class="col-md-3 text-left ">
                            <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                                <option value="">Buscar por:</option>
                                <option value="apellido">Apellido</option>
                                <option value="cedula">Cédula</option>
                            </select><br>
                        </div>
                    <!--<input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>-->
               
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
                        <td>Usuario</td>
                        <td>Tipo de Usuario</td>
                        <td>Apellido</td>
                        <td>Cédula</td>
                        <td>Correo</td>
                        <td>Objetos de Aprendizaje</td>
                    </tr>
                    </thead>
            </div>



<?php
    $idLogin = $_SESSION['id'];
    $nombre = $_SESSION['usuario'];
    require '../../clases_negocio/clase_conexion.php';

    $conexion = new Conexion();
    $statement = "SELECT pro.apellidos, u.usuario,  u.tipo_usuario, pro.ci, pro.mail ,u.idUsuario, OA.ruta FROM estudiante AS pro JOIN usuario AS u ON (pro.id_usuario=u.idUsuario) JOIN objeto_aprendizaje AS OA ON OA.id_usuario=u.idUsuario Where pro.id_usuario in ( select id_usuario from objeto_aprendizaje Where idobjeto_aprendizaje > 0)";

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

    $consulta->execute();

    //defino las variables
    while($row = $consulta->fetch()){
        $id = $row['idUsuario'];
        $usuario = $row['usuario'];
        $tipousuario = $row['tipo_usuario'];
        $apellido = $row['apellidos'];
        $cedula = $row['ci'];
        $correo = $row['mail'];
        $Objt = $row['ruta'];
        echo "<tr>"; //lleno las los campos
            echo "<td>$usuario </td>";
            echo "<td>$tipousuario </td>";
            echo "<td>$apellido</td>";
            echo "<td> $cedula</td>";
            echo "<td>$correo</td>";
            echo "<td>$Objt</td>";
            if($tipousuario=='PRO'){
                echo "<td><a href= ../../modulos_profesor/pro_buscar.php>Revisar objeto/s de aprendizaje</a></td>";
            }else{
                echo "<td><a href= ../../modulos_estudiante/est_buscar.php>Revisar objeto/s de aprendizaje</a></td>";
            }
            echo "<td><a href=perfil_colaborador.php?idLogin=".$id.">Ver perfil</a></td>";
        echo "</tr>";
    }
?>
</body>
</html>