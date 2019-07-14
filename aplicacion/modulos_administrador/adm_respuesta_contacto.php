<!DOCTYPE html >
<html  lang="es">
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap-responsive.css"></link>
        <link rel="stylesheet" type="text/css" href="../../estilos/estilosEst2.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/funciones_validar_formularios.js"></script>
        <title>Proyecto SGOA</title>
    </head>
    <body >
        <form action="adm_ejecutar_respuesta.php"  onsubmit="return " method="post" enctype="multipart/form-data" >
            <legend style="font-size: 18pt;" ><b>Respuesta</b></legend>
            <input class="form-control" placeholder=" Usuario"  id="usuario" type="text" required name="usuario">
            <input class="form-control" placeholder=" Correo"  id="correo" type="text" required name="correo">
            <input class="form-control" placeholder=" Asunto"  id="asunto" type="text" required name="asunto">
            <textarea class="form-control" placeholder=" Respuesta"  type="text" id="respuesta" rows="10" cols="40" required name="respuesta"></textarea>
            <br><input style="font-size: 14pt;text-align: center;" class="btn btn-info btn-responsive btninter centrado" type="submit" value="Enviar">
        </body>
</html>