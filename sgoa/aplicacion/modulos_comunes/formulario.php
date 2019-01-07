<?php
session_start();
 $usr=0;
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    //header("Location:index2.php");
    echo "eres estudiante";
    $usr=1;
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
    echo "eres administrador";
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
                        <li class="active"><a href="../modulos_profesor/pro_importar_catalogar.php">Importar y catalogar</a></li>
                        <li><a data-step="3" data-intro="Puedes Buscar tus objetos de aprendizaje aquí" href="../modulos_profesor/pro_buscar.php">Buscar</a></li>
                        <li><a data-step="4" data-intro="Puedes encontrar herramientas útiles para crear tus objetos de aprendizaje aquí" href="../modulos_profesor/pro_herramientas.php">Herramientas</a></li>
                        <li><a data-step="5" data-intro="Puedes encontrar o crear temas de discucion" href="../modulos_comunes/index.php">Foro</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row content">
                <div class="col-sm-12 text-center">
                        <h2> <img src="../../images/foro.png"style="float:left;width:300px;height:170px">AÑADE UN NUEVA TEMA EN EL FORO</h2> 
                </div>
                        
                <div class="col-sm-12">
                   <?php
                        if(isset($_GET["respuestas"]))
                            $respuestas = $_GET['respuestas'];
                        else
                            $respuestas = 0;
                        if(isset($_GET["identificador"]))
                            $identificador = $_GET['identificador'];
                        else
                            $identificador = 0;
                    ?>
                    <form name="form" action="agregar.php" method="post">
                        <input type="hidden" name="identificador" value="<?php echo $identificador;?>">
                        <input type="hidden" name="respuestas" value="<?php echo $respuestas;?>">
                        <div class="row">
                            <label class="col-xs-3">Autor:</label>
                            <div class="col-xs-9">
                                <input type="text" name="autor" style = "visibility:hidden" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label class="col-sm-3">Titulo:</label>
                            <div class="col-sm-9">
                                <input type="text"  name="titulo">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label class="col-sm-3">Mensaje:</label>
                            <div class="col-sm-9">
                                <textarea name="mensaje" cols="70" rows="5" required="required"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Añadir Nuevo Tema">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
