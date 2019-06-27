<?php
    error_reporting(0);
    session_start();
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }/*.site_url('alumno/MisCursos') */
    if($curso =$_GET['curso'] == "")
    {
        header('location:'.site_url('alumno/MisCursos'));   
    }

    
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion</title>
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <!--estilos bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">   
    <!--iconos-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>                            
    <style>
        .pregresp {
        border: 1px solid #7DA5E0;
        padding: 10px;
        margin: 10px;
        font-family: Arial, Verdana, Helvetica, sans-serif;
        font-size: 15px;
        font-weight: bold;
        }

        .pregunta {
        color: #7DA5E0;
        }

        .respuestas {
        color: #000000;
        }

        .fa-times
        {
            color: red;
        }

        .fa-check
        {
            color: greenyellow;
        }

        .checkeable input {
            display: none;
        }
        
        .checkeable img {
            width: 150px;
            border: 1px solid transparent;
        }
        
        .checkeable input {
            display: none;
        }

        .checkeable input:checked  + img {
            border-color: black;
        }
    </style>
</head> 
<body>  
    <?php
        $this->load->view('Cursos/Nav');
    ?>
    <br><br>

    
    <div class="container">
        <div id="contenedroPreguntas">
            
        </div>
        <br>
        <center><button type="button" id="Evaluar" class="btn btn-primary">Enviar</button></center>
        <br><br>
    </div>
    <!--<label class="checkeable">
        <input type="radio" name="cap1"/>
        <img src="http://www.primeskr.mx/wp-content/uploads/2014/10/cap-1_red.jpg"/>
    </label>
    <label class="checkeable">
        <input type="radio" name="cap2"/>
        <img src="http://inikweb.com/wp-content/uploads/2015/02/cap-1_red.jpg"/>
    </label>-->

</body>  
<html>


<script>


    $(document).ready(function()
    {
        cargarPreguntas();
    });

    function cargarPreguntas()
    {
        $.ajax
        ({
            type:'post',
            url:'<?php echo site_url();?>/Cursos/EvaluacionController/ConsultarPregunta?IdTema=1',    
            success:function(resp)
            {
                $("#contenedroPreguntas").append(resp);
            }
        });
        /*for(var i = 1; i<=10;i++)
        {
            $("#contenedroPreguntas").append(
                '<div class="pregresp">'+
                    '<div class="pregunta">'+i+'. ¿Crees que HTML es una buena tecnología?<br/></div>'+
                    '<div class="respuestas">'+
                        '<input type="radio" name="preg'+i+'" value="1" /> Sí<br/>'+
                        '<input type="radio" name="preg'+i+'" value="2" /> No<br/>'+
                        '<input type="radio" name="preg'+i+'" value="3" /> Ns/Nc<br/>'+
                    '</div>'+
                '</div>'
            );  
        }*/
    }

    function cargarPreguntasCorrectas()
    {
        var correcta = 1;
        for(var i = 1; i<=10;i++)
        {
            if(correcta ==1)
            {
                $("#contenedroPreguntas").append(
                    '<div class="pregresp">'+
                        '<div class="pregunta">'+i+'. ¿Crees que es una buena tecnología? <i class="fas fa-check"></i><br/></div>'+
                        '<div class="respuestas">'+
                            '<input type="radio" name="preg'+i+'" value="1" /> Sí<br/>'+
                            '<input type="radio" name="preg'+i+'" value="2" /> No<br/>'+
                            '<input type="radio" name="preg'+i+'" value="3" /> Ns/Nc<br/>'+
                        '</div>'+
                    '</div>'
                );  
                correcta = 2;
            }else
            {
                $("#contenedroPreguntas").append(
                    '<div class="pregresp">'+
                        '<div class="pregunta">'+i+'. ¿Crees que es una buena tecnología? <i class="fas fa-times"></i><br/></div>'+
                        '<div class="respuestas">'+
                            '<input type="radio" name="preg'+i+'" value="1" /> Sí<br/>'+
                            '<input type="radio" name="preg'+i+'" value="2" /> No<br/>'+
                            '<input type="radio" name="preg'+i+'" value="3" /> Ns/Nc<br/>'+
                        '</div>'+
                    '</div>'
                ); 
                correcta = 1;
            }
        }
    }

    $('#Evaluar').click(function()
    {
        
        $("#contenedroPreguntas").children().remove();   
        cargarPreguntasCorrectas();
    }); 


</script>