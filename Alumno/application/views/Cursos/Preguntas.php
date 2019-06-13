<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Estilos de bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.min.css">
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>

    <title>Desear realizar el examen diagnostico</title>
</head>
<body class="question">
    <div class="container pt-5">
        <div class="row pt-5">
            <div class="col-12">
                <p class="text-white display-4">
                    En esta parte irá el texto con el cual se le preguntara a los alumnos si decean realizar el examen 
                    diagnostico o desean empezar el curso desde cero
                </p>
            </div>
            <div class="columna1 col-lg-6 text-center">
                <img src="<?php echo base_url();?>app-assets/imagenes/rocket .png" class="py-4" alt="">
                <br>
                <button id='incribir' type="button" class="btn  botonBlanco text-white font-weight-bold" ><h4> Comenzar desde el principio</h4></button>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?php echo base_url();?>app-assets/imagenes/apple.png" class="py-4" alt="">
                <br>
                <button id='incribirExamen' type="button" class="btn  botonBlanco text-white font-weight-bold "><h4>Tomar examen diagnostico </h4> </button>
            </div>
        </div>
    </div>

    <script>
        /*
            1 - Incribir inicio
            2 - tomar Examen
        */
        var tipo = 0;
        
        $('#incribir').click(function()
        {
            tipo = 1;
            IncribirCurso();    
        });

        $('#incribirExamen').click(function()
        {
            tipo = 2;
            IncribirCurso();
        });

        function IncribirCurso()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreguntasController/IncribirAlumno?IdCurso=<?php echo $_GET['curso']; ?>&idUsuario=<?php session_start(); echo $_SESSION['usuario']?>',    
                success:function(resp)
                {
                    alert(resp);
                    if(tipo == 1)
                        window.location.href="Preview?curso=<?php echo $_GET['curso']; ?>";
                    else
                        window.location.href="Temario?curso=<?php echo $_GET['curso']; ?>";
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                { 
                    if(tipo == 1)
                        window.location.href="Preview?curso=<?php echo $_GET['curso']; ?>";
                    else
                        window.location.href="Temario?curso=<?php echo $_GET['curso']; ?>";
                    
                }    
            });
        }

    </script>
</body>
</html>