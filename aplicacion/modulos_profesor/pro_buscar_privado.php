<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}
?>
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Repositorios
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../modulos_profesor/pro_buscar.php">Repositorio público</a></li>
                        <li><a href="../modulos_profesor/pro_buscar_privado.php">Repositorio privado</a></li>
                    </ul>
                </li>
                        <li><a href="../modulos_comunes/modulo_foro/index.php">Foro</a></li>
                          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Inicio formulario de búsqueda -->

<!-- presentacion de objetos de aprendizaje-->
<div class="container-fluid text-center">
    <div class="row content">
        <!-- --------------------------------------------- -->
        <div class="col-sm-12 text-center">
            <h2> Administración de recursos de aprendizaje</h2>
            <form action="../modulos_profesor/pro_ejecutar_buscar_privado.php" method="post" enctype="multipart/form-data">
                <div class="col-md-3">
                </div>
                <div class="col-md-3 text-left ">
                    <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                        <option value="">Filtrar por:</option>
                        <option value="autor">autor</option>
                        <option value="nombre">nombre</option>
                        <option value="descripcion">descripcion</option>
                        <option value="institucion">institucion</option>
                        <option value="palabras_clave">palabra clave</option>
                        <option value="cbx_materia">materia</option>
                    </select></br>
                </div>
                <div class="col-md-3 text-center">
                    <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>
                </div>
                <div class="col-md-3 text-left">
                    <button id="registrar" type="submit" class="btn btn-success">Buscar</button>
                    </br></br>
                </div>
            </form>
            <form action="../modulos_profesor/pro_importar_catalogar_privado.php" method="post" enctype="multipart/form-data">
            <div class="col-md-3 text-left">
                <button id="subirRA" type="submit" class="btn btn-success">Subir Recurso de aprendizaje</button>
                </br></br>
                </div>
            </form>
            </div>
            <div class="container" >
                <table class="table table-striped"border ="1|1" class="table table-bordered" id="tabla">
                    <thead>
                    <tr class="warning">
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td>Institución</td>
                        <td>Fecha Creación</td>
                        <td>Palabras Clave</td>
                            </tr>
                    </thead>
            </div>

            <?php
            require_once '../clases_negocio/clase_conexion.php';
            require '../clases_negocio/funciones_oa_profesor.php';
            require '../clases_negocio/funciones_oa_estudiante.php';
            //$id_usuario = $_SESSION["id_usuario"];
            $id_usuario = $_SESSION['id'];
            $statement = 'select * from objeto_aprendizaje where id_usuario ="' . $_SESSION['id'] . '"and tipo_repo = 1';
            $conexion = new Conexion();
            $consulta = $conexion->prepare($statement);
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $consulta->execute();

            $id_usuario = $_SESSION['id'];

            if ($consulta->rowCount() != 0) {
                while ($row = $consulta->fetch()) {
                    echo '<tr class="success">';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['descripcion'] . '</td>';
                    echo '<td>' . $row['institucion'] . '</td>';
                    echo '<td>' . $row['fechaCreacion'] . '</td>';
                    echo '<td>' . $row['palabras_clave'] . '</td>';

                    if ($id_usuario == $row['id_usuario']) {
                        echo '<td><a href="pro_actualizar_oa.php?id=' . $row['idobjeto_aprendizaje'] . '"><span class="glyphicon glyphicon-refresh"></a></td>';
                        echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el objeto de aprendizaje?');\" href='pro_buscar_privado.php?id=".$row['idobjeto_aprendizaje']."&idborrar=2'><span class='glyphicon glyphicon-trash'></a></td>";
                    } else {
                        echo '<td>----</td>';
                        echo '<td>----</td>';
                    }
                    echo "<td><a href=" . $row['ruta'] . "  onclick= \"myFunction('" . $row['idobjeto_aprendizaje'] . "');\" >Descargar</a></td>";
                    echo "<td><a href=publicar.php onclick=\"myFunction2('" . $row['idobjeto_aprendizaje'] . "');\" >Publicar</a></td>";
                }

            }

            echo '</table>';
            extract($_GET);
            if (@$idborrar == 2) {
                eliminar_objeto_aprendizaje($id);
                echo '<script>alert("REGISTRO ELIMINADO")</script> ';
                echo "<script>location.href='pro_buscar_privado.php'</script>";
            }
            $conexion = null;
            ?>
            <script type = "text/javascript">
                (function(){
                    location.reload();
                    //$("#tabla").ajax().reload();
                }, 10000);

                function myFunction($id_objeto)
                {

                    $.ajax({

                        url: 'pro_ejecutar_actualizar_descarga.php',
                        type: 'POST',
                        data: 'objeto_id='+$id_objeto,

                        async : false,

                    });

                }
                function myFunction2($id_objeto)
                {

                    $.ajax({

                        url: 'publicar.php',
                        type: 'POST',
                        data: 'objeto_id='+$id_objeto,

                        async : false,

                    });

                }
            </script>
            <script>
                function hacer_hover($x)
                {
                    myPopup = window.open('../modulos_administrador/previsualizar.php?vs='+$x,'popupWindow','width=640,height=480');
                    myPopup.opener = self;
                }
            </script>

        </div>

        
        <div class="estadistica">
        <div class="column">
            <embed src= "../modulos_profesor/High/examples/pie-basic/index.php" height="500" width="600"></embed>    
            </div>

            <div class="column">
            <embed src= "../modulos_profesor/High/examples/pie-basic/estadisticaDescargas.php" height="500" width="600"></embed>
            </div>


        </div>

    </div>
</div></br></br></br>

</body>

</html>

