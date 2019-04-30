<?php
session_start();
 $usr=0;
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    //header("Location:index2.php");
    $usr=1;
}

    require_once '../modulos_profesor/High/examples/pie-basic/conexion.php';
    $sql = "select * from facultad";
    $result = mysqli_query($conexion, $sql); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>
        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <link href="../../estilos/estilosHerramientas.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <script languaje = "javascript">
            $(document).ready(function(){
                $("#cbx_carreras").change(function(){
                    $("#cbx_carreras option:selected").each(function(){
                            idfacultad = $(this).val();

                            $.post("getCarreras.php", {idfacultad: idfacultad}, function(data){
                                $("#cbx_materia").html(data);
                            });
                    });
                })
            });
        </script>

        <link href="../../intro.js/introjs.css" rel="stylesheet">
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

        /* Set black background color, white text and some padding */
        html{
            min-height: 100%;
            position: relative;
        }
        body{
            margin:0;
            margin-bottom: 40px;
            /*background-color: #FFFFCC;
            background-image: url(../../images/fondotot.jpg);*/
        }
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;} 
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
                    <div class="pull-left image">
                        <?php
                            if($usr==1){
                                require_once'../clases_negocio/funciones_oa_estudiante.php';
                            echo "<img id='imgId' src='". obtener_imagen_es($_SESSION['usuario']) . "' width='40' height='40' class='img-circle'>";
                            
                            }else{
                                require_once'../clases_negocio/funciones_oa_profesor.php';
                                echo "<img id='imgId' src='". obtener_imagen_pro($_SESSION['usuario']) . "' width='40' height='40' class='img-circle'>";
                            }
                            
                        ?>
                    </div>
                    <a class="navbar-brand" href="#"> Bienvenid@: <strong><?php echo $_SESSION['usuario'] ?></strong></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="../modulos_profesor/pro_importar_catalogar.php">Importar y catalogar</a></li>
                        <li><a data-step="3" data-intro="Puedes Buscar tus objetos de aprendizaje aquí" href="../modulos_profesor/pro_buscar.php">Buscar</a></li>
                        <li><a data-step="4" data-intro="Puedes encontrar herramientas útiles para crear tus objetos de aprendizaje aquí" href="../modulos_profesor/pro_herramientas.php">Herramientas</a></li>
                        <li class="active"><a data-step="5" data-intro="Puedes encontrar o crear temas de discucion" href="../modulos_comunes/index.php">Foro</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- presentacion de objetos de aprendizaje-->
        <div class="container text-center">
            <div class="row content">
                <!-- --------------------------------------------- -->
                <div class="col-sm-12 text-center">
                    <h2> <img src="../../images/foro.png"style="float:left;width:300px;height:170px">BIENVENIDO AL FORO DE AYUDA</h2>
                    
                    <div class="container-fluid" >
                        <table  class="table table-striped"border ="1|1" class="table table-bordered" id="tabla">
                            <thead style="background-color:#FFFFCC">
                                <tr>
                                    <td ></td>
                                    <td>Titulo</td>
                                    <td>Fecha</td>
                                    <td>Respuestas</td>
                                </tr>
                            </thead>
                    </div>
                        <?php 
                            include("conexionBD.php");
                            $query = "SELECT * FROM  foro WHERE identificador = 0 ORDER BY fecha DESC";
                            $result = $mysqli->query($query);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                $id = $row['ID'];
                                $titulo = $row['titulo'];
                                $fecha = $row['fecha'];
                                $respuestas = $row['respuestas'];
                                echo "<tr style='background-color:#BAD6B8'>";
                                    echo "<td><a href='foro.php?id=$id'><span class='glyphicon glyphicon-hand-right'> Participar</a></td>";
                                    echo "<td>$titulo</td>";
                                    echo "<td>".date("d-m-y,$fecha")."</td>";
                                    echo "<td>$respuestas</td>";
                                echo "</tr>";
                            }
                            echo '</table>';
                        ?>
                        <a type="button" class="btn btn-lg btn-primary" href="formulario.php"><i class='glyphicon glyphicon-plus'></i> nuevo tema </a>
                </div>

            </div>
        </div>
    </body>

</html>
