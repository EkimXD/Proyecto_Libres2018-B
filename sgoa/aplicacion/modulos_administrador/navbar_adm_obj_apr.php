<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#">Bienvenid@: <strong><?php echo $_SESSION['usuario'] ?></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown active">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Objetos de aprendizaje
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="adm_objetos_aprendizaje.php">Importar y catalogar objetos de aprendizaje</a></li>
                        <li><a href="adm_buscar.php">Buscar y administrar objetos de aprendizaje</a></li>
                    </ul>
                </li>
                <li><a href="adm_buscar_profesores.php">Gestionar profesores</a></li>
                <li><a href="adm_buscar_estudiantes.php">Gestionar Estudiantes</a></li>
                <li><a href="adm_herramientas.php">Herramientas</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>

