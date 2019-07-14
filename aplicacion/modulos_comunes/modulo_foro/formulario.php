<?php

session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}

if(isset($_GET["respuestas"]))
$respuestas = $_GET['respuestas'];
else
$respuestas = 0;
if(isset($_GET["identificador"]))
$identificador = $_GET['identificador'];
else
$identificador = 0;
    $idLogin = $_SESSION['id'];
    $nombre = $_SESSION['usuario'];
    
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
<?php if ($_SESSION['tipo_usuario'] == 'ADM' ){
   
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
                    <li><a href="../modulos_comunes/modulo_colaboradores/buscar_colaborador.php">Buscar</a></li>
                    <li><a href="../modulos_comunes/modulo_colaboradores/eliminar_colaborador.php">Eliminar</a></li>
                </ul>
            </li>
                <li><a href="../../modulos_administrador/adm_herramientas.php">Herramientas</a></li>
                <li class="active"><a href="index.php">Foro</a></li>">
                
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>';
   
  
   
}else{

    echo '<nav class="navbar navbar-inverse">
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
                <li><a href="../../modulos_profesor/pro_importar_catalogar.php">Importar y catalogar</a></li>
                <li><a href="../../modulos_profesor/pro_buscar.php">Buscar</a></li>
                <li><a href="../../modulos_profesor/pro_herramientas.php">Herramientas</a></li>
                <li class="active"><a href="index.php">Foro</a></li>
                          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
 </nav>';
    
}
?>
<!-- Inicio formulario de búsqueda -->

<div class="container-fluid text-center">
    <div class="row content">
    <div class="col-md-3 text-center">
                    <!--<input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>-->
                </div>
                <div class="col-md-3 text-left">
                    <br><br>
                </div>
                <div class="container">

<table class="table table-striped" border ="1|1" class="table table-bordered" id="tabla">
<thead>
<form name="form" action="agregar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="identificador" value="<?php echo $identificador;?>">
	<input type="hidden" name="respuestas" value="<?php echo $respuestas;?>">
    <tr class="success">
		<th>Autor </th>
		<td><?php echo $nombre?></td>
    </tr>
    <tr class="success">
      <th>Titulo</th>
      <td><input type="text" name="titulo" cols="50" rows="5" required="required"></td>
    </tr>
    <tr class="success">
      <th>Mensaje</th>
      <td><textarea name="mensaje" cols="50" rows="5" required="required"></textarea></td>
    </tr>
    <tr class="success">
    <th>Foto</th>
    <td>
    <input type="file" name="archivo" id="archivo">
         </td>
    </tr>
    <tr class="success">
    <th>Video</th>
    <td>
    <input type="file" name="video" id="video">
     </td>
     </tr>
    <tr class="warning">
      <td></td><td><input type="submit" id="submit" name="submit" value="Enviar Mensaje"></td>
    </tr>
    </form>
    
    </thead>
</table>
</div>
      </div>
      <td><button onclick="location.href='index.php'">REGRESAR</td>
</body>
</html>