<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>

        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../estilos/style.css"></link>

        <!-- intro.js -->
        <link href="../../intro.js/introjs.css" rel="stylesheet">

        <title>Proyecto SGOA</title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../../index.php">Inicio</a>
					<!--<a class="navbar-brand" href="../../aplicacion/formularios_registro/Login.php">Inicio</a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="tour-step tour-step-two collapse navbar-collapse navbar-right navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="Login.php">Login</a></li>
                        <!--<li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>

        <div class="intro-header">
        <form action="../../aplicacion/validar.php" method="post">
            <h2 style="color: #004e91; font-size: 250%;">Objetos de Aprendizaje</h2>
            <br>
            <select data-step="1" data-intro="¡Bienvenido! Selecciona tu usuario para ingresar al sistema" class= "form-control" name="tipo_usuario" dir="ltr" required>
                <option value="">Tipo de Usuario</option>
                <option value="ADM">Administrador</option>
                <option value="PRO">Docente</option>
                <option value="EST">Estudiante</option>
            </select></br>
            <div data-step="2" data-intro="En esta sección ingresas tus datos" class="Ingreso_datos">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Nombre de Usuario" required name="user"></input>
                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Contraseña" required name="pass"></input>
                    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                </div>
            </div>
            <br>
            <button class="btn btn-primary btn-s" type="submit">
                <span class="glyphicon glyphicon-log-in"></span> Iniciar sesión
            </button>
            <p>&nbsp;</p>
			
			
			<button class="btn btn-password btn-s" type="submit">
                <span class="glyphicon glyphicon-log-in"> <a href="../../aplicacion/formularios_registro/recuperar_contrasenia.php"> Cambiar Contraseña</a></span>
                
                
            </button>
            <p>&nbsp;</p>
			
           
            <!--<h2 style = "color: #004e91; font-size: 80%"; align="right"> ¿Olvidó su contraseña? </h2>-->
        </form>
        <form method="post">
            <h2 style="color: #004e91; font-size: 250%;">Regístrate</h2>
            <div data-step="3" data-intro="En esta sección te puedes registrar" class="Registro_usuarios">
                <td width="50%"> <a href="../../aplicacion/formularios_registro/RegistrarProfesor.php"> Registrar Profesor</a></td></br>
                <label></label>
                <td width="50%" align="right" valign="middle"><a href="../../aplicacion/formularios_registro/RegistrarEstudiante.php"> Registrar Estudiante</a></td>
            </div>
        </form>
        <script type="text/javascript" src="../../intro.js/intro.js"></script>
        
        <form method="post">
            <h2 style="color: #004e91; font-size: 250%;">Contáctanos</h2>
                <div data-step="4" data-intro="Cuéntanos tu experiencia. ¡Estaremos gustosos!"  class="Contáctanos">
                <td width="50%"> <a href="../../aplicacion/modulos_comunes/contacto_experiencia.php"> Cúentanos tu experiencia</a></td></br>
                <label></label>
                </div>
            </div>
            <br>
            <a class="btn btn-info btn-success" href="javascript:void(0);" onclick="javascript:introJs().setOption('showProgress', true).start();">Ayuda</a>
            <br>
        </form>
    </body>
</html>