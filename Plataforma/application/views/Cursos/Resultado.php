<?php
    error_reporting(0);
    session_start();
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }/*.site_url('alumno/MisCursos') */
    

    
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
        .pregresp 
        {
            border: 1px solid #7DA5E0;
            padding: 10px;
            margin: 10px;
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: bold;
        }

        .pregunta 
        {
            color: #7DA5E0;
        }

        .respuestas 
        {
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

        .imgresp
        {
            height: 50px;
            width:50px;
        }

        /*[type=radio] { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        [type=radio] + img {
            cursor: pointer;
        }

        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }*/
    </style>
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> 
</head> 
<body>  
    <?php
        $this->load->view('Cursos/Nav');
    ?>
    <br><br>


    
    <div class="container">

        <table id="table" class="table  table-bordered">
            
            <tbody>
                <tr>
                    <td style="width:70px"><b>Evaluacion</b></td>
                    <td id="tevaluacion" colspan="2">Diagnostica</td>
                </tr>
                <tr>
                    <td  style="width:70px"><b>Alumno</b></td>
                    <td colspan="2"><?php echo $varsesion ?></td>
                </tr>
                <!--<tr>
                    <td style="width:70px"><b>Puntos</b></td>
                    <td id="puntos" colspan="2"></td>
                </tr>-->
            </tbody>
        </table>
        <br>

        <div id="contenedroPreguntas">
            
        </div>
        <br>
        
    </div>



  <!-- Modal -->
  <div class="modal fade" id="ModalImagen" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Imagen</h4>
        </div>
        <div id="ContenidoIMG" class="modal-body">
                        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

                    <!--<div class="modal fade" tabindex="-1" role="dialog" id="ModalImagen" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" id="CancelarModa">&times;</button>
                                    <h5 class="modal-title">Imagen</h5>
                                </div>
                                <div id="ContenidoIMG" class="modal-body">
                        
                                </div>
                                <div class="modal-footer">
                                    <button id="CerrarModal" onclick="cerrar()" type="button" class="btn btn-primary">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>  -->   



</body>  
<html>


<script>


$(document).ready(function () {
            //optiene la clave de usuario actual
            let usuario = '<?php echo $varsesion; ?>';
        
            /**
            * Optiene los datos de alumno relacionados con este usuario
            */
            $.get( '<?php echo site_url();?>/Cursos/EncuestaController/obtenerAlumno', { varusuario: usuario} )
            .done(function( data ) {
                let obj = JSON.parse( data );// convierte los datos optenidos a un objeto de tipo json
                actualizarHeader(obj[0]);
                console.log(obj);
            });
            cargarPreguntasCorrectas();
        });

        function actualizarHeader(data){
            $('#userName').html('<br>'+data.nombre+' '+data.app); // Coloca el nombre de usuario y apellido paterno en el navbar
            console.log(data);
            let inN = data.nombre.split( "", 1 );
            let inA = data.app.split( "", 1 );
            $('#inicial').html(inN+inA);
        }

    function cargarPreguntasCorrectas()
    {

        var id_evaluacion = <?php echo $_GET['id_evaluacion'];?>

        $.ajax
        ({
            type:'post',
            url:'<?php echo site_url();?>/Cursos/EvaluacionController/ConsultarRespuestaCorrecta?Curso=<?php echo $_GET['curso'];?>&id_evaluacion='+id_evaluacion,    
            success:function(resp)
            {
                $("#contenedroPreguntas").append(resp);
            }
        });

        
        $.ajax
        ({            
            url:'<?php echo site_url();?>/Cursos/EvaluacionController/Calificacion?id_evaluacion='+id_evaluacion,
            success:function(resp)
            {
                $("#table tbody").append(resp);
            }
        });

    
    
    }


</script>