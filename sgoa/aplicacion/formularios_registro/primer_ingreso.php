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
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation"> <!-- /.le dejo para que ocupe espacio :v -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../../index.php">Inicio</a>
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
        <div class="center">
        <form action="../../aplicacion/ingresar_nueva_contrasena.php" method="post">
            <h2 style="color: #004e91; font-size: 175%;">Cambio de contraseña</h2>
            <h4 style="color: #000000; font-size: 125%;">Con la finalidad de asegurar su información, le solicitamos que ingrese una nueva contraseña para su cuenta.</h4>
            <div data-step="2" data-intro="En esta sección ingresas tus datos" class="Ingreso_datos">
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Contraseña" required name="pass"></input>
                    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                </div>
            </div>

            <br>
            <button class="btn btn-primary btn-s" type="submit">
                <span class="glyphicon glyphicon-log-in"></span> Guardar
            </button>
            <!--<h2 style = "color: #004e91; font-size: 80%"; align="right"> ¿Olvidó su contraseña? </h2>-->
        </form>
        <script type="text/javascript" src="../../intro.js/intro.js"></script>
        
    </body>
</html>