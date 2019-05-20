<?php ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Plataforma</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Plataforma">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="estilos/bootstrap-4/css/bootstrap.min.css">
        <!--link rel="stylesheet" href="estilos/bootstrap.min.css"-->
        <link href="estilos/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
        
    </head>
</style>
<body>
    <?php include('nav_bar.php');?>
    <div id="cursos" class="container col-md-12" style="display : flex; flex-wrap: wrap;">
        
    </div>
    <?php
    include 'modPwd.php';
    ?>
    <script src="estilos/js/jquery-3.2.1.min.js"></script>
    <script src="estilos/bootstrap-4/js/bootstrap.min.js"></script>
    <script src="skHome.js"></script>
    <script>
        $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        });

        });
    </script>
</body>
</html>