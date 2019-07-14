<!DOCTYPE html >
<html  lang="es">
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-responsive.css"></link>
        <link rel="stylesheet" type="text/css" href="../../estilos/estilosEst.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/funciones_validar_formularios.js"></script>
        <title>Proyecto SGOA</title>
    </head>
    <body >
        <form action="ejecutar_registrar_estudiante.php"  onsubmit="return validar_formulario_estudiante()" method="post" enctype="multipart/form-data" >
            <legend style="font-size: 18pt;" ><b>Registro Estudiante</b></legend>

            <input class="form-control" placeholder=" Cédula"  id="cedula" type="text" required name="cedula">
            <input class="form-control" placeholder=" Nombres"  id="nombres" type="text" required name="nombres">
            <input class="form-control" placeholder=" Apellidos"  id="apellidos" type="text" required name="apellidos">
            <input class="form-control" placeholder=" E-mail"   id="email" type="email" required name="email">
            <input class="form-control" placeholder=" Carrera"   id="carrera" type="text" required name="carrera"> 
            <label style="font-size: 10pt;color:#808080" >Facultad</label>
            <?php
            require_once '../../aplicacion/clases_negocio/clase_conexion.php';
            $query1 = 'SELECT * FROM facultad';
            $conexion1 = new Conexion();
            $consulta1 = $conexion1->prepare($query1);
            $consulta1->setFetchMode(PDO::FETCH_ASSOC);
            $consulta1->execute();
            echo '<select class= "form-control"  name="facultad" required>';
            echo '<option value="">Selecione facultad</option>';
            if ($consulta1->rowCount() != 0) {
                while ($row = $consulta1->fetch()) {
                    echo '<option value="' . $row['idfacultad'] . '">' . $row['facultad'] . '</option>';
                }
            }
            echo '</select></br>';
            $consulta1 = null;
            ?>
            <p id="usuarios_existentes" style="display:none;" ><?php
                            //echo implode(",", scandir('../../storage/')); 
                            require '../clases_negocio/funciones_oa_profesor.php';
                            echo obtener_lista_de_usuarios();
                            ?></p>
            <p id="error_usuarios_duplicados" style="display:none; color:#FF0000;">
                                El usuario ya existe!!;
                            </p>
            <input class="form-control" placeholder=" Usuario"  id="usuario" type="text" required name="usuario">
            <input class="form-control" placeholder=" Contraseña"   id="contrasenia" type="password"required name="contrasenia">
            <input class="form-control" placeholder=" Confirme Contraseña"   id="contrasenia1" type="password"required name="contrasenia1"></br>
            <input class="btn btn-primary" type="submit"  id ="registrar">
        </form>

        <script>
            //funcion validacion objetos
            function comprobar_existencia(arreglo, valor) {
                var flag = false;
                for (i = 0; i < arreglo.length; i++)
                {
                    if (arreglo[i].trim().localeCompare(valor.trim()) === 0)
                        flag = true;
                }
                return flag;
            }
            $(document).ready(function () {
                var isvalue = document.getElementById("usuarios_existentes").innerHTML;
                isvalue = isvalue.split(',');
                $('#usuario').keyup(function () {
                    let useramount = $(this).val();
                    //alert(useramount+'.zip');
                    //alert(isvalue.includes(String(useramount + '.zip')));
                    if (comprobar_existencia(isvalue, useramount)) {
                        $('#error_usuarios_duplicados').slideDown("slow");
                        document.getElementById("registrar").disabled = true;
                    } else {
                        $('#error_usuarios_duplicados').slideUp("slow");
                        document.getElementById("registrar").disabled = false;
                    }
                });
            });

        </script>
    </body>
</html>