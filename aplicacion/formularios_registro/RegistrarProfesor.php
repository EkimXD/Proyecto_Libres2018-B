<!DOCTYPE html >
<html  lang="es">
    <head>
        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-responsive.css"></link>
        <link rel="stylesheet" type="text/css" href="../../estilos/estilosProf.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/funciones_validar_formularios.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0"></meta>
        <title>Proyecto SGOA</title>
    </head>
    <body>
        
        <form method="post" action="ejecutar_registrar_profesor.php"  onsubmit=" return validar_formulario_profesor()" >
            <legend style="font-size: 18pt;" ><b>Registro Profesor</b></legend>
            <input class="form-control" placeholder=" Cédula" id="cedula" type="text"required name="cedula"></input>
            <input class="form-control" placeholder=" Nombres" id="nombres" type="text" required name="nombres"></input>
            <input class="form-control" placeholder="  Apellidos" id="apellidos" type="text"required name="apellidos"></input>
            <input class="form-control" placeholder=" E-mail" id="email" type="email"required name="email"></br></input>
            <label style="font-size: 10pt;color:#808080" >Departamento</label>
            <?php
            require_once '../../aplicacion/clases_negocio/clase_conexion.php';
            $query = 'SELECT * FROM departamento';
            $conexion = new Conexion();
            $consulta = $conexion->prepare($query);
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $consulta->execute();
            echo '<select class= "form-control"  name="departamento" required>';
            echo '<option value="">Selecione departamento</option>';
            if ($consulta->rowCount() != 0) {
                while ($row = $consulta->fetch()) {
                    echo '<option value="' . $row['iddepartamento'] . '">' . $row['departamento'] . '</option>';
                }
            }
            echo '</select></br>';
            $consulta = null;
            ?>
            <label style="font-size: 10pt;color:#808080" >Facultad</label>
            <?php
            $query1 = 'SELECT * FROM facultad';
            $conexion1 = new Conexion();
            $consulta1 = $conexion1->prepare($query1);
            $consulta1->setFetchMode(PDO::FETCH_ASSOC);
            $consulta1->execute();
            echo '<select class= "form-control"  name="facultad" required>';
            echo '<option value="">Seleccione facultad </option>';
            if ($consulta1->rowCount() != 0) {
                while ($row = $consulta1->fetch()) {
                    echo '<option value="' . $row['idfacultad'] . '">' . $row['facultad'] . '</option>';
                }
            }
            echo '</select></br>';
            $consulta1 = null;
            ?>
            
            <input style="font-size: 14pt;text-align: center;" class="btn btn-info btn-responsive btninter centrado" type="submit" value="Enviar">
        </form>


    </body>
</html>