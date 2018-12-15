<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    echo "eres estudiante";
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
    echo "eres PROFESOR";
}
    require_once '../modulos_profesor/High/examples/pie-basic/conexion.php';
    $sql = "select * from facultad";
    $result = mysqli_query($conexion, $sql); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<script languaje = "javascript">
            $(document).ready(function(){
                $("#cbx_carreras").change(function(){
                    $("#cbx_carreras option:selected").each(function(){
                            idfacultad = $(this).val();

                            $.post("../modulos_profesor/getCarreras.php", {idfacultad: idfacultad}, function(data){
                                $("#cbx_materia").html(data);
                            });
                    });
                })
            });
        </script>
    <meta charset="utf-8"></meta>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0"></meta>
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
    footer {
        background-color: #555;
        color: white;
        padding: 15px;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    @media screen and (max-width: 767px) {
        .sidenav {
            height: auto;
            padding: 15px;
        }
        .row.content {height:auto;}
    }
</style>

<body>
<?php include './navbar_adm_obj_apr.php';?>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-4 col-sm-offset-4">
            <h2>Objeto de aprendizaje</h2>
            <form id="envio"  method="post" enctype="multipart/form-data">
                <p id="oas_existentes" style="display:none;" >
                    <?php
                    require '../clases_negocio/funciones_oa_profesor.php';
                    echo obtener_lista_de_oas();
                    ?></p>
                <div class="form-group">
                    <label for="file">Archivo que contine el objeto de aprendizaje:</label>
                    <p id="error1" style="display:none; color:#FF0000;">
                        Formato de archivo ínvalido! Solo se admiten archivos .zip.
                    </p>
                    <p id="error2" style="display:none; color:#FF0000;">
                        El límite máximo de tamaño de archivo es 10MB.
                    </p>
                    <input type="file" class="form-control" id="o_aprendizaje" name="o_aprendizaje" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <p id="oas_duplicados" style="display:none; color:#FF0000;">
                        El nombre de objeto ya ha sido utilizado!
                    </p>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre de objeto de aprendizaje" name="nombre" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción" name="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="institucion">Institución:</label>
                    <input type="text"  class="form-control" id="institucion" placeholder="Institución"  name="institucion" required>
                </div>

                <div class="form-group">
                    <label for="palabras_claves">Palabras claves:</label>
                    <input type="text"  class="form-control" id="palabras_claves" placeholder="Palabras claves"  name="palabras_claves" required>
                </div>
                <label >Carreras:</label>
                 <select class= "form-control" id="cbx_carreras"  name="carreras" dir="ltr" required>
                <option value="0">Selecione una Carrera</option>
                <?php 

                    while($row = mysqli_fetch_array($result)){
                                ?>
                    <option value = "<?php echo $row['idfacultad'];?>"> <?php echo $row['facultad'];?></option>
                    <?php
                                    }
                                ?>
                            </select>
                            <label >Materias:</label>
                            <select class= "form-control" id="cbx_materia" name="cbx_materia" dir="ltr" required>
                            </select>

                <input type="submit" value="Subir OAs"/>
            </form>

        </div>
    </div>
</div></br></br></br>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    var a = 0;
    $('#o_aprendizaje').bind('change', function () {
        if (document.getElementById("registrar").disabled == false) {
            document.getElementById("registrar").disabled = true;
        }
        var ext = $('#o_aprendizaje').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['zip']) == -1) {
            $('#error1').slideDown("slow");
            $('#error2').slideUp("slow");
            a = 0;
        } else {
            var picsize = (this.files[0].size);
            if (picsize > 10000000) {
                $('#error2').slideDown("slow");
                a = 0;
            } else {
                a = 1;
                $('#error2').slideUp("slow");
            }
            $('#error1').slideUp("slow");

        }
    });

    $(function(){
        $("#envio").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("envio"));
            $.ajax({
                url: "adm_ejecutar_insertar_oa.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(html){
                    if(html==1){
                        alert("Datos guardados Satisfactoriamente");
                        $("#nombre").val('');
                        $("#descripcion").val('');
                        $("#institucion").val('');
                        $("#palabras_claves").val('');
                        $('#envio').val('');
                        $('#o_aprendizaje').val('');
                    }
                    else alert('No se pudo ingresar');
                }
            })

        });
    });

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
        var isvalue = document.getElementById("oas_existentes").innerHTML;
        isvalue = isvalue.split(',');
        $('#nombre').keyup(function () {
            let useramount = $(this).val();

            if (comprobar_existencia(isvalue, useramount)) {
                $('#oas_duplicados').slideDown("slow");
                document.getElementById("registrar").disabled = true;
            } else {
                $('#oas_duplicados').slideUp("slow");
                document.getElementById("registrar").disabled = false;
            }
        });
    });

    function validar_formulario() {
        var caracteres = /^[0-9a-zA-Z]+$/;
        if (document.getElementById('nombre').value.match(caracteres) && document.getElementById('nombre').value.length<=15)
        {
            return true;
        } else
        {
            if(!document.getElementById('nombre').value.match(caracteres)){
                alert('El nombre solo puede contener letras(no caracteres especiales) y numeros!');
            }
            if(document.getElementById('nombre').value.length>15){
                alert('El nombre solo puede contener 15 caracteres como máximo!');
            }
            return false;
        }
    }
</script>
</body>

</html>
