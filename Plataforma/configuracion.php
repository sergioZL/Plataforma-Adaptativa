<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Plataforma</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Plataforma">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="estilos/bootstrap-4/css/bootstrap.min.css">
        <link href="estilos/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    </head>
</style>
<body>
    <header class="main-header">
    <?php include 'nav_bar.php'; ?>
    </header>
    <div class="barra_posicion">
    <?php
        $cadena = "Curso: no seleccionado";
        if (isset($_SESSION["u_curso"])) {
            $curso = $_SESSION["u_curso"];
            $cadena = 'Curso: ' . $curso;
            if (isset($_SESSION["u_leccion"])) {
                $lecciones = $_SESSION["u_leccion"];
                $cadena = $cadena . "-> Lección: " . $lecciones;
                if (isset($_SESSION["u_tema"])) {
                    $tema = $_SESSION["u_tema"];
                    $cadena = $cadena . "->Tema: " . $tema;
                }
            }
        }
        echo $cadena;
    ?>    
    </div>
<?php
    include 'sideLayer.php';
    include 'modPwd.php';
?>    
<div class="container">
    <div class="formularios" id="formularios"></div>
</div>
    
<div class="container">
    <div id="mensaje"></div>
    <div class="orden" id="orden">
          <!-- Contenido lista orden--> 
    </div>    
</div>
    <script src="estilos/js/jquery-3.2.1.min.js"></script>
    <script src="estilos/bootstrap-4/js/bootstrap.min.js"></script>
    <script src="skFormas.js"></script>
    <?php
    if (isset($_SESSION["u_FormActiva"])) {
            $formActiva = $_SESSION["u_FormActiva"];
            $lanzado = "<script>buscar_datos('".$formActiva."');</script>";
            echo $lanzado;
        }else{
            $lanzado = "<script>buscar_datos('curso');</script>";
            echo $lanzado;
        }
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function () {
    $(function () {
                    $("#mi_lista").sortable({update: function () {
                            var ordem_atual = $(this).sortable("serialize");
                            $.post("proceso_orden.php", ordem_atual, function (retorno) {
                                //Imprimir resultado 
                                $("#mensaje").html(retorno);
                                //Muestra mensaje
                                $("#mensaje").slideDown('slow');
                                RetirarMensaje();
                            });
                        }
                    });
                });
                
// Elimina mensajes despues de un determiando periodo de tiempo 1900 milissegundos
    function RetirarMensaje(){
                    setTimeout( function (){
                        $("#mensaje").slideUp('slow', function(){});
                    }, 1900);
                }
            });

        $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        });

        });
    </script>
</body>
</html>