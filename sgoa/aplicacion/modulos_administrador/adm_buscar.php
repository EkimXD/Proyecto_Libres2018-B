<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {

    echo "ERES PROFESOR";
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    echo "ERES ESTUDIANTE";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">


<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="utf-8"></meta>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
    <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <title>Proyecto SGOA</title>
</head>
<style>

    .navbar {
        margin-bottom: 0;
        border-radius: 0;
    }


    .row.content {height: 390px}

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
<?php include './navbar_adm_obj_apr.php';?>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-12 text-center">
            <h2> Administración de Objetos de Aprendizaje</h2>
            <form action="../modulos_administrador/adm_ejecutar_buscar.php" method="post" enctype="multipart/form-data">
                <div class="col-md-3">
                </div>
                <div class="col-md-3 text-left ">
                    <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                        <option value="">Filtrar por:</option>
                        <option value="autor">Autor</option>
                        <option value="nombre">Nombre</option>
                        <option value="descripcion">Descripción</option>
                        <option value="institucion">Institución</option>
                        <option value="palabras_clave">Palabra Clave</option>
                    </select></br>
                </div>
                <div class="col-md-3 text-center">
                    <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar:" name="criterio_busqueda" required></br>
                </div>
                <div class="col-md-3 text-left">
                    <button id="registrar" type="submit" class="btn btn-success">Buscar</button>
                    </br></br>
                </div>
            </form>
            <div class="container" >
                <table class="table table-striped"border ="1|1" class="table table-bordered" id="tabla">
                    <thead>
                    <tr class="warning">
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td>Institución</td>
                        <td>Fecha Creación</td>
                        <td>Palabras Clave</td>
                        <td>Tamaño</td>
                        <td>Autor</td>
                        <td>Comentarios</td>
                        <td>Descargas</td>
                    </tr>
                    </thead>
            </div>

            <?php
            require_once '../clases_negocio/clase_conexion.php';
            require '../clases_negocio/funciones_oa_profesor.php';
            $statement = ("select * from objeto_aprendizaje");
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
                    echo '<td>' . number_format($row['tamanio'] / 1e6, 2, '.', '') . ' MB' . '</td>';
                    if (obtener_tipo_usuario_con_id($row['id_usuario']) == 'ADM') {
                        echo '<td>ADMINISTRADOR</td>';
                    } else {
                        $profesor = obtener_profesor_como_arreglo(obtener_id_profesor_con_id_usuario($row['id_usuario']));
                        echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                    }
                    echo '<td><a href="adm_comentarios.php?id=' . $row['idobjeto_aprendizaje'] . '">' . obtener_nro_comentarios_oa($row['idobjeto_aprendizaje']) . '</a></td>';
                    echo '<td>' . $row['descarga'] . '</td>';
                    echo '<td><a "href="adm_actualizar_oa.php?id=' . $row['idobjeto_aprendizaje'] . '"><span class="glyphicon glyphicon-refresh"></a></td>';
                    echo "<td><a id='borrar'onClick=\"eliminar('".$row['idobjeto_aprendizaje']."');\" href='adm_buscar.php?id=" . $row['idobjeto_aprendizaje'] . "&idborrar=2'><span class='glyphicon glyphicon-trash'></a></td>";

                    echo "<td><a href=" . $row['ruta'] . "  onclick= \"myFunction('" . $row['idobjeto_aprendizaje'] . "');\" >Descargar</a></td>";
                    echo "<td><a href='#' onmouseover=\"hacer_hover('".$row['ruta']."');\"><span class='glyphicon glyphicon-eye-open'></a></td>";
                    echo '</tr>';
                }
            }
            echo '</table>';
            extract($_GET);
            if (@$idborrar == 2) {
                eliminar_objeto_aprendizaje($id);
                echo '<script>alert("OA Eliminado Satisfactoriamente")</script> ';
                echo "<script>location.href='adm_buscar.php'</script>";

            }
            $conexion = null;
            ?>
            <script type = "text/javascript">
                (function(){
                    location.reload();
                    //$("#tabla").ajax().reload();
                }, 10000);

                function myFunction(id_objeto)
                {

                    $.ajax({

                        url: '../modulos_profesor/pro_ejecutar_actualizar_descarga.php',
                        type: 'POST',
                        data: 'objeto_id='+id_objeto,

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

                var dataTable = $('#tabla').DataTable({
                    "processing":true,
                    "serverSide":true,
                    "order":[],
                    "ajax":{
                        url:"fetch.php",
                        type:"POST"
                    },
                    "columnDefs":[
                        {
                            "targets":[0, 3, 4],
                            "orderable":false,
                        },
                    ],

                });

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
<footer class="label-default container-fluid text-center">
    <p class="copyright small">Copyright &copy; Jaime Crespin, Jossué Dután, Alexis Maldonado 2018</p>
</footer>
</body>

</html>

