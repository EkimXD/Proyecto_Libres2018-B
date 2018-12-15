<?php
session_start();
date_default_timezone_set('America/Guayaquil');
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    //header("Location:index2.php");
    echo "eres estudiante";
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
    echo "eres profesor";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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


    body {font-family: Arial, Helvetica, sans-serif;}

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>


<body>

<?php include './navbar_adm_obj_apr.php'; ?>
<!--Inicio de formulario -->
<?php
require_once '../clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_oa_profesor.php';
require '../clases_negocio/funciones_oa_estudiante.php';
$id_objeto_aprendizaje = filter_input(INPUT_GET, 'id');

//extract($_GET);
$objeto_de_aprendizaje = obtener_oa_como_arreglo($id_objeto_aprendizaje);

?>

<div class="container">
    <div class="well text-center">
        <h2><?php echo $objeto_de_aprendizaje['nombre'] ?></h2>
        <p><?php echo $objeto_de_aprendizaje['descripcion'] ?></p>
        <div style="text-align:right">
            <p><?php echo $objeto_de_aprendizaje['fechaCreacion'] ?></p>
        </div>
    </div>

    <div class="table-responsive-sm">
        <table class="table thead-light">
            <div class="col-sm-6 col-sm-offset-3">
                <thead class="th">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <?php
                $statement = "select * from comentario where id_objeto_aprendizaje=?";
                $conexion = new Conexion();
                $consulta = $conexion->prepare($statement);
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute([$id_objeto_aprendizaje]);
                $timezone = date('m/d/Y h:i:s');


                if ($consulta->rowCount() != 0) {
                    while ($comentario = $consulta->fetch()) {
                        echo '<tr class="">';
                        echo '<th scope="row text-center">' . $comentario['idcomentario'] . '</th>';
                        echo '<td>' . $comentario['contenido'] . '</td>';
                        if (obtener_tipo_usuario_con_id($comentario['idusuario']) == 'ADM') {
                                echo '<td>ADMINISTRADOR</td>';
                        } elseif(obtener_tipo_usuario_con_id($comentario['idusuario']) == 'PRO') {
                            $profesor = obtener_profesor_como_arreglo(obtener_id_profesor_con_id_usuario($comentario['idusuario']));
                                echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                        }else{
                                $estudiante = obtener_estudiante_como_arreglo(obtener_id_estudiante_con_id_usuario($comentario['idusuario']));
                                echo '<td>' . $estudiante['nombres'] . ' ' . $estudiante['apellidos'] . '</td>';
                            }
                        //echo '<td>' . $timezone . '</td>';
                        echo '<td>' . $comentario['fechacomentario'] . '</td>';
                        if(($comentario['rutaimagen'])=="../../imagenes/")
                        {
                            echo '<td></td>';

                        }else{
                            echo "<td><a onclick=\"previewImagen('".$comentario['rutaimagen']."');\"><img id='imgId' src='". $comentario['rutaimagen'] . "' width='300' height='150'></a></td>";
                            
                        }
                        echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el objeto de aprendizaje?');\" href='adm_comentarios.php?id=".$comentario['id_objeto_aprendizaje']."&idcom=".$comentario['idcomentario']."&idborrar=2'><span class='glyphicon glyphicon-trash'></a></td>";

                        echo '</tr>';
                    }
                    extract($_GET);
                    if (@$idborrar == 2) {
                        eliminarComentario($idcom);
                        echo '<script>location.href="adm_comentarios.php?id='.$id.'"</script>';
                    }
                    $conexion = null;
                }
                ?>

                <script>
                    var modal = document.getElementById('myModal');
                    function previewImagen($x){
                        var img =document.getElementById('imgId');
                        var modalImg = document.getElementById('img01');
                        modal.style.display = "block";
                        modalImg.src = $x;

                    }


                    var span = document.getElementsByClassName("close")[0];
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                </script>

                </tbody>
            </div>

        </table>
    </div>
    <form action="../modulos_administrador/adm_ejecutar_comentar.php" method="post" enctype="multipart/form-data">
        <input class="form-control" style="display: none;" value='<?php echo $id_objeto_aprendizaje ?>'
               name="id_objeto_aprendizaje"> </input>

        <div class="form-group">
            <label for="contenido">Comentario:</label>
            <textarea type="tex" class="form-control" id="contenido" name="contenido" required></textarea>
            <input type="hidden" name="MAX_FILE_SIZE" value="524288">
            <fieldset>
                
                <legend>Seleccione una imagen JPEG, JPG o PNG</legend>
                <p><b>ARCHIVO:</b><input type="file" name="file" id= "file"/></p>
              
            </fieldset>
        </div>
        <div id = "vista-previa">
            
        </div>
        <input type="submit" name="submitted" value="Comentar"/>
        </br>
    </form>
</div>

</div></br></br></br>


<footer class="label-default container-fluid text-center">
    <p class="copyright small">Copyright &copy; Jaime Crespin, Jossué Dután, Alexis Maldonado 2018</p>
</footer>
</body>

</html>


