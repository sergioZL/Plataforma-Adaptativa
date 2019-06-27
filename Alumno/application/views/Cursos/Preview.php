<?php 
     $curso =$this->input->get('curso');
    error_reporting(0);
    session_start();
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- ARCHIVO BOOTSTRAP 4 CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.min.css">
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">   
    <!--Iconos-->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'> 
    <title>Preview del Curso</title>
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>          
</head>
<body>
    <?php
        $this->load->view('Cursos/Nav');
    ?>
    <section class="seccion-superior py-4 mt-5 ">     
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div id="imagen">
                    
                    </div>
                    <div class="card-body">
                      <h5 class="card-title  text-center">Este curso contiene</h5>
                      <p class="card-text">
                            <i class='far fa-file-video fa-2x'></i> 10 videos acerca de los temas tratados en las lecciones <br>
                            <i class='far fa-file-audio fa-2x'></i> 10 audios acerca de los temas tratados en las lecciones <br>
                            <i class='far fa-file-pdf fa-2x'></i> 10 documentos pdf acerca de los temas tratados en las lecciones <br>
                            <i class='far fa-check-square fa-2x'></i> una evaluacion por cada una de las lecciones tomadas en el curso <br>
                      </p>
                      <a href="Pregunta?curso=<?php echo $curso ?>" class="btn btn-primary btn-superior">!Inscribete!</a>
                    </div>
                  </div>
            </div>
            <div id="info" class="col-12 col-md-6 text-center text-md-left align-self-md-center text-white ">

              


            </div>
          </div>
        </div>
      </section>

      <div class="container">
          <!--Esta seccion servira para agregar descripciones hacerca del conosimiento que el usuario obtendra-->
            <div class="card py-4 ">
              <div class="card-body row" >
                  <h4 class="card-title col-12">Lo que aprenderas</h4>
                  <div id="descripciones" class="card-body row">
                  
                  </div>
              </div>
            </div>
        <!--Contenido del curso-->
        <br>
        <div class="contenido">
            <h4>Contenido del curso</h4>
             









            <div id="main" class="row">
                <!--Menu desplegable-->
                <div id="accordion" role="tablist" aria-multiselectable="true" class="container t-2 pt-5 col-md-11">
                    <!--Leccion uno-->
                    <div  id="Leccion">
                        
                        <div id="Temas">
                            <!--Tema-->
                        </div>
                            
                    </div>
                </div>
            </div>

            <br><br><br><br><br>






        </div>
      </div>

    <script>
        CargarCursos();
        CargarLecciones();
        aprendizaje();

        function CargarCursos()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarPorIDCursos?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                dataType:"json",
                success:function(resp)
                {
                    $("#imagen").append(
                        '<img class="card-img-top h-100" style="min-height: 250px; width: 100%;"  src="data:image/jpg;base64,'+ resp[0].foto+'" alt="Proyecto 1"  ">'                        
                    );

                    $("#info").append(
                        '<h1 class="display-4 font-weight-bold text-primary"> ' + resp[0].nombre +'</h1>' +
                        '<p>'+ resp[0].descripcion +'</p>' +
                        '<p>Fecha de ultima actualización: ' + resp[0].fechaActualizado + ' </p>'+
                        '<a href="#descripciones" class="btn btn-primary btn-lg btn-superior">Leér más</a>'
                    );                    
                }
            });
        }

        function aprendizaje()
        {

            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarAprendizajeIDCursos?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                success:function(resp)
                {
                    $('#descripciones').append(resp);
                }
            });            
        }

        function CargarLecciones()
        {

            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarTodosLeccionPorIDCursos?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                dataType:"json",
                success:function(resp)
                {
                    var n = resp.length;
                    //var data = JSON.parse(resp);

                    for(var i = 0; i < n; i++)
                    {
                        temas(resp,i);
                    }
                }
            });
        }


        function temas(data,i)
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/PreviewController/ConsultarTemasCursos?IdLeccion='+data[i].clave,
                success :function(resp)
                {
                    $("#Leccion").append(
                        '<div class="card leccion shadow-sm mb-3 rounded-0">'+
                            '<h5 class="card-header">'+
                                '<!--Cabecera del menu desplegable-->'+
                                '<a data-toggle="collapse" href="#contenido' + data[i].secuencia+ '" aria-expanded="true" aria-controls="contenidoUno"'+
                                    'id="leccion' + data[i].secuencia+ '" class="d-block">'+
                                    '<i class="fa fa-chevron-down pull-right"></i>'
                                    + data[i].nombre +' #'+ data[i].secuencia +
                                '</a>'+
                            '</h5>'+
                        '<div id="contenido' + data[i].secuencia+ '" class="collapse" aria-labelledby="leccionUno">'+
                            '<!--Contenido del menu desplegable-->'+
                            '<div class="card-body">'+
                                '<h6>Este es el contenido de la leccion</h6>'+
                                '<p>' + data[i].descripcion+ '</p>'+
                            '</div>'+resp
                    );
                }                    
            });
        }

        $('#buscar').click(function()
        {
            if( $("#textBuscar").val() != "")
                window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
        });
        
    </script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>

</body>
</html>