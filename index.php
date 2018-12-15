<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>

        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="sgoa/plugins/bootstrap/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="sgoa/estilos/style.css"></link>
        
        <title>Proyecto SGOA</title>
    </head>
    <body>
        <form action="sgoa/aplicacion/validar.php" method="post">
            <h2 style="color: #004e91; font-size: 250%;">Objetos de Aprendizaje</h2> 
            <br>  
            <select class= "form-control" name="tipo_usuario" dir="ltr" required>
                <option value="">Tipo de Usuario</option>
                <option value="ADM">Administrador</option>
                <option value="PRO">Docente</option>
                <option value="EST">Estudiante</option>
            </select></br>
            <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nombre de Usuario" required name="user"></input>
            <i class="glyphicon glyphicon-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Contraseña" required name="pass"></input>
            <i class="glyphicon glyphicon-lock form-control-feedback"></i>
            </div>
            <br>
            <button class="btn btn-primary btn-s" type="submit">
                <span class="glyphicon glyphicon-log-in"></span> Iniciar sesión
            </button>
            <h2 style = "color: #004e91; font-size: 80%"; align="right"> ¿Olvidó su contraseña? </h2>        
        </form>
        <form method="post">
                <h2 style="color: #004e91; font-size: 250%;">Regístrate</h2>
                    <td width="50%"> <a href="sgoa/aplicacion/formularios_registro/RegistrarProfesor.php"> Registrar Profesor</a></td></br>
                    <label></label>
                    <td width="50%" align="right" valign="middle"><a href="sgoa/aplicacion/formularios_registro/RegistrarEstudiante.php"> Registrar Estudiante</a></td>
                </form>
    </body>
</html>