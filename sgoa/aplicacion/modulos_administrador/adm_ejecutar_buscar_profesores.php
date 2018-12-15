<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
//header("Location:index2.php");
    echo "ERES PROFESOR";
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    echo "ERES ESTUDIANTE";
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

        .table > tbody > tr > td {
            vertical-align: middle;
        }

    </style>


    <body>
        <?php include './navbar_adm_profesores.php'; ?>
        <!-- Inicio formulario de búsqueda -->

        <!-- presentacion de objetos de aprendizaje-->
        <div class="container-fluid text-center">    
            <div class="row content">
                <!-- --------------------------------------------- -->
                <div class="col-sm-12 text-center"> 
                    <h2> Administración de estudiantes</h2>
                    <form onsubmit="return validar_busqueda_cedula()" action="../modulos_administrador/adm_ejecutar_buscar_profesores.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">
                            <a href="adm_buscar_profesores.php">Regresar</a>
                        </div>
                        <div class="col-md-3 text-left ">
                            <select class= "form-control" name="tipo_criterio" dir="ltr" required id="select_criterio">
                                <option value="">Filtrar por:</option>
                                <option value="nombre">nombre</option>
                                <option value="usuario">usuario</option>
                                <option value="cedula">cédula</option>
                            </select></br>
                        </div>
                        <div class="col-md-3 text-center">
                            <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>
                        </div>
                        <div class="col-md-3 text-left">
                            <button id="registrar" type="submit" class="btn btn-danger">Buscar</button>
                            </br></br>
                        </div>
                    </form>

                    <?php
                    require_once '../clases_negocio/clase_conexion.php';
                    require '../clases_negocio/funciones_administrador.php';

                    $criterio = filter_input(INPUT_POST, 'tipo_criterio');
                    $valor_criterio = filter_input(INPUT_POST, 'criterio_busqueda');
                    $statement = 'select u.*,p.nombres, p.apellidos, p.ci,p.mail from usuario as u, profesor as p where u.idUsuario=p.id_usuario';
                    $clausula_where = '';
                    switch ($criterio) {
                        case 'nombre':
                            $clausula_where = ' and (p.nombres like "%' . $valor_criterio . '%"  or p.apellidos like "%' . $valor_criterio . '%")';
                            $statement = $statement . $clausula_where;
                            break;
                        case 'usuario':
                            $clausula_where = ' and u.usuario like "%' . $valor_criterio . '%"';
                            $statement = $statement . $clausula_where;
                            break;
                        case 'cedula':
                            $clausula_where = ' and p.ci= "' . $valor_criterio . '"';
                            $statement = $statement . $clausula_where;
                            break;
                    }

                    //echo $statement;
                    $conexion = new Conexion();
                    $consulta = $conexion->prepare($statement);
                    $consulta->setFetchMode(PDO::FETCH_ASSOC);
                    $consulta->execute();

                    $id_usuario = $_SESSION['id'];


                    echo '<table border ="1|1" class="table table-condensed";>';
                    echo '<tr class="warning">';
                    echo '<td>Id usuario</td>';
                    echo '<td>Usuario</td>';
                    echo '<td>tipo</td>';
                    echo '<td>Activo?</td>';
                    echo '<td>Nombre completo</td>';
                    echo '<td>Cedula</td>';
                    echo "</tr>";

                    if ($consulta->rowCount() != 0) {
                        while ($row = $consulta->fetch()) {
                            echo '<tr class="success">';
                            echo '<td>' . $row['idUsuario'] . '</td>';
                            echo '<td>' . $row['usuario'] . '</td>';
                            echo '<td>' . $row['tipo_usuario'] . '</td>';
                            echo '<td>' . $row['activo'] . '</td>';
                            echo '<td>' . $row['apellidos'] . '  ' . $row['nombres'] . '</td>';
                            echo '<td>' . $row['ci'] . '</td>';
                            if ($row['activo'] == 'V') {
                                echo '<td><a href="adm_buscar_profesores.php?id=' . $row['idUsuario'] . '&id_gestion=1">Desactivar usuario</a></td>';
                            } else {
                                echo '<td><a href="adm_buscar_profesores.php?id=' . $row['idUsuario'] . '&id_gestion=2&mail=' . $row['mail'] . '&usuario=' . $row['usuario'] . '&contrasenia=' . $row['contrasenia'] . '">Activar usuario</a></td>';
                            }
                            echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el profesor seleccionado? Se eliminarán los objetos de aprendizaje asociados al mismo');\" href='adm_buscar_profesores.php?id=" . $row['idUsuario'] . "&id_gestion=3'><span class='glyphicon glyphicon-remove'></a></td>";

                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                    $id_gestion = filter_input(INPUT_GET, 'id_gestion');
                    $id = filter_input(INPUT_GET, 'id');

                    if ($id_gestion == 1) {
                        act_des_usuario($id, "F");
                        echo '<script>alert("Usuario desactivado correctamente")</script> ';
                        echo "<script>location.href='adm_buscar_profesores.php'</script>";
                    }
                    if ($id_gestion == 2) {
                        $mail = filter_input(INPUT_GET, 'mail');
                        $user = filter_input(INPUT_GET, 'usuario');
                        $password = filter_input(INPUT_GET, 'contrasenia');
                        enviar_mail($mail,$user,$password);
                        act_des_usuario($id, "V");
                        echo '<script>alert("Usuario activado correctamente")</script> ';
                        echo "<script>location.href='adm_buscar_profesores.php'</script>";
                    }
                    if ($id_gestion == 3) {
                        eliminar_objetos_aprendizaje_asociados_a_id($id);
                        if (eliminar_usuario($id)) {
                            echo '<script>alert("Usuario eliminado correctamente")</script> ';
                        } else {
                            echo '<script>alert("El usuario no se ha podido eliminar")</script> ';
                        }

                        echo "<script>location.href='adm_buscar_profesores.php'</script>";
                    }


                    $conexion = null;
                    ?>

                    <!-- --------------------------------------------- -->

                </div>
            </div>
        </div></br></br></br>
        <script>
            function validar_busqueda_cedula() {
                var e = document.getElementById("select_criterio");
                var strCriterio = e.options[e.selectedIndex].value;
                flag = false;
                if (strCriterio === "cedula") {
                    cedula = document.getElementById("criterio_busqueda").value;
                    if (validar_cedula(cedula) === true) {
                        flag = true;
                    } else {
                        alert("La cédula ingresada no es válida.");
                        flag = false;
                    }
                } else {
                    flag = true;
                }
                return flag;
            }

            function isDigit(str) {
                return str && !/[^\d]/.test(str);
            }

            function validar_cedula(cedula) {
                flag = false;
                if (isDigit(cedula)) {
                    //Preguntamos si la cedula consta de 10 digitos
                    if (cedula.length === 10) {

                        //Obtenemos el digito de la region que sonlos dos primeros digitos
                        var digito_region = cedula.substring(0, 2);

                        //Pregunto si la region existe ecuador se divide en 24 regiones
                        if (digito_region >= 1 && digito_region <= 24) {

                            // Extraigo el ultimo digito
                            var ultimo_digito = cedula.substring(9, 10);

                            //Agrupo todos los pares y los sumo
                            var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));

                            //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
                            var numero1 = cedula.substring(0, 1);
                            var numero1 = (numero1 * 2);
                            if (numero1 > 9) {
                                var numero1 = (numero1 - 9);
                            }

                            var numero3 = cedula.substring(2, 3);
                            var numero3 = (numero3 * 2);
                            if (numero3 > 9) {
                                var numero3 = (numero3 - 9);
                            }

                            var numero5 = cedula.substring(4, 5);
                            var numero5 = (numero5 * 2);
                            if (numero5 > 9) {
                                var numero5 = (numero5 - 9);
                            }

                            var numero7 = cedula.substring(6, 7);
                            var numero7 = (numero7 * 2);
                            if (numero7 > 9) {
                                var numero7 = (numero7 - 9);
                            }

                            var numero9 = cedula.substring(8, 9);
                            var numero9 = (numero9 * 2);
                            if (numero9 > 9) {
                                var numero9 = (numero9 - 9);
                            }

                            var impares = numero1 + numero3 + numero5 + numero7 + numero9;

                            //Suma total
                            var suma_total = (pares + impares);

                            //extraemos el primero digito
                            var primer_digito_suma = String(suma_total).substring(0, 1);

                            //Obtenemos la decena inmediata
                            var decena = (parseInt(primer_digito_suma) + 1) * 10;

                            //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
                            var digito_validador = decena - suma_total;

                            //Si el digito validador es = a 10 toma el valor de 0
                            if (digito_validador == 10)
                                var digito_validador = 0;

                            //Validamos que el digito validador sea igual al de la cedula
                            if (digito_validador == ultimo_digito) {
                                //console.log('la cedula:' + cedula + ' es correcta');
                                flag = true;
                            } else {
                                //console.log('la cedula:' + cedula + ' es incorrecta');
                                flag = false;
                            }

                        } else {
                            // imprimimos en consola si la region no pertenece
                            //console.log('Esta cedula no pertenece a ninguna region');
                            flag = false;
                        }
                    } else {
                        //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
                        //console.log('Esta cedula tiene menos de 10 Digitos');
                        flag = false;
                    }
                } else
                {
                    flag = false;
                }
                return flag;
            }

        </script>
        <footer class="label-default container-fluid text-center">
            <p class="copyright small">Copyright &copy; Jaime Crespin, Jossué Dután, Alexis Maldonado 2018</p>
        </footer>
    </body>

</html>






