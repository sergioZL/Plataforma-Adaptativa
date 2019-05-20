<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Estilos de bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.min.css">
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">
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
                <a href="AgregarAlCurso.php?curso=<?php echo $curso =$_GET['curso']; ?>"><button type="button" class="btn  botonBlanco text-white font-weight-bold" > <h4> Comenzar desde el principio</h4></button></a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?php echo base_url();?>app-assets/imagenes/apple.png" class="py-4" alt="">
                <br>
                <a href="Temario"> <button type="button" class="btn  botonBlanco text-white font-weight-bold "><h4>Tomar examen diagnostico </h4> </button></a>
            </div>
        </div>
    </div>
</body>
</html>