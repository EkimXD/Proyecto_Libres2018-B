<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
        
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
    header("Location:../../../index.php");
}
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

<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bienvenid@: <strong><?php echo $_SESSION['usuario'] ?></strong></a>
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
     </nav>
     <div class="col-sm-12 text-center"> 
                    <h2> Actualización de Datos</h2>
            </div>

            <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-md-3 text-center">
                    <!--<input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>-->
                </div>
                <div class="col-md-3 text-left">
                    <br><br>
                </div>
                <div class="container">
<?php
    require '../../clases_negocio/clase_conexion.php';
    $idLogin = $_SESSION['id'];
    echo "Id User: ".$idLogin."<br>";
    $nombre = $_SESSION['usuario'];
    echo "Usuario".$nombre;
    $tipo_usuario = $_SESSION['tipo_usuario'];

    if($tipo_usuario =='PRO'){
        $statement = "select * from usuario join colaborador on (usuario.idUsuario=colaborador.idUsuario) join profesor on (colaborador.idUsuario=profesor.id_usuario) where colaborador.idUsuario=".$idLogin;

    }else{
        $statement = "select * from usuario join colaborador on (usuario.idUsuario=colaborador.idUsuario) join estudiante on (colaborador.idUsuario=estudiante.id_usuario) where colaborador.idUsuario=".$idLogin;
    }

    $conexion = new Conexion();
    $consulta = $conexion->prepare($statement);

    $consulta->execute();
    $row = $consulta->fetch(PDO::FETCH_ASSOC);
    
    $usuario = $row['usuario'];
    $ci = $row['ci'];
    $foto = $row['foto'];
    $nombre = $row['nombres'];
    $apellido = $row['apellidos'];
    $direccion = $row['domicilio'];
    $fecha = $row['fecha_nacimiento'];
    $correo = $row['mail'];
    $telefono = $row['celular'];

?>

<table class="table table-striped" border ="1|1" class="table table-bordered" id="tabla">
<thead>
<form name="form" action="ejecutar_actualizar.php" method="post" enctype="multipart/form-data">
    <tr class="success">
    <th>Foto</th>
    <td>
    <img src ="<?php echo $foto?>" width="150" height="150"> <br>
    <input type="file" name="archivo" id="archivo">
         </td>
    </tr>
    <tr class="success">
		<th>Usuario </th>
		<td><?php echo $usuario?></td>
    </tr>
    <tr class="success">
      <th>CI</th>
      <td><input type="text" name="ci" cols="100" rows="50" required="required" value = <?php echo $ci?>></td>
    </tr>
    <tr class="success">
      <th>Nombre</th>
      <td><input type="text" name="nombre" cols="100" rows="50" required="required" value = <?php echo $nombre?>></td>
    </tr>
    <tr class="success">
      <th>Apellido</th>
      <td><input type="text" name="apellido" cols="100" rows="50" required="required" value = <?php echo $apellido?>></td>
    </tr>
    <tr class="success">
      <th>Dirección</th>
      <td><input type="text" name="direccion" cols="50" rows="5" required="required" value = <?php echo $direccion?>></td>
    </tr>
    <tr class="success">
      <th>Fecha de Nacimiento</th>
      <td><input type="text" name="fecha_nacimiento" cols="50" rows="5" required="required" value = <?php echo $fecha?>></td>
    </tr>
    <tr class="success">
      <th>Correo Electrónico</th>
      <td><input type="text" name="correo" cols="50" rows="5" required="required" readonly = "readonly" value = <?php echo $correo?>></td>
    </tr>
    <tr class="success">
      <th>Teléfono</th>
      <td><input type="text" name="telefono" cols="50" rows="5" required="required" value = <?php echo $telefono?>></td>
    </tr>
    
    <tr class="warning">
      <td></td><td><input type="submit" id="submit" name="submit" value="Actualizar Datos"></td>
    </tr>
    </form>
    
    </thead>
</table>
</div>

</body>
</html>