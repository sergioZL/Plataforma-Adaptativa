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
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> 

</head>
<body>
    <?php
        $this->load->view('Cursos/Nav');
    ?>
    <section class="seccion-superior ">     
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-4">
                <div class="card" style="width: 18rem;" >
                    <div id="imagen">
                    
                    </div>
                    <!-- <div class="card-body">
                      <h6 class="card-title  text-center">Este curso contiene</h6>
                      <p class="card-text">
                            <i class='far fa-file-video'></i> <font size="2">2 videos acerca de los temas tratados en las lecciones</font> <br>
                            <i class='far fa-file-audio'></i> <font size="2"> 1 audios acerca de los temas tratados en las lecciones</font> <br>
                            <i class='far fa-file-pdf '></i> <font size="2"> 1 documentos pdf acerca de los temas tratados en las lecciones </font> <br>
                            <i class='far fa-check-square'> </i> <font size="2"> una evaluacion por cada una de las lecciones tomadas en el curso </font><br>
                        </p>
                      <a href="Pregunta?curso=<?php echo $curso ?>" class="btn btn-primary btn-superior">!Inscribete!</a>
                    </div> -->
                </div>
            </div>
            <div id="info" class="col-12 col-md-8 text-center text-md-left align-self-md-center text-white ">

              


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
        <div class="modal fade bd-example-modal-md" id="modalPregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-200 font-weight-bold" id="chan">Selecciona una opcion para continuar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <br/>
                    <div class="modal-body mx-3">
                        <div style="margin-bottom: 10px; color:white;">
                            <center>
                                <a id="inscribir" class="btn btn-primary">Comenzar desde el principio</a>
                                <a id="incribirExamen" class="btn btn-primary">Tomar examen diagnostico</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            });
        });

        function actualizarHeader(data){
            $('#userName').html('<br>'+data.nombre+' '+data.app); // Coloca el nombre de usuario y apellido paterno en el navbar
            console.log(data);
            let inN = data.nombre.split( "", 1 );
            let inA = data.app.split( "", 1 );
            $('#inicial').html(inN+inA);
        }


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
                        '<img class="card-img-top h-50 w-100"  src="data:image/jpg;base64,'+ resp[0].foto+'" alt="Proyecto 1"  ">'                        
                    );

                    $("#info").append(
                        '<h1 class="display-4 font-weight-bold text-black"> ' + resp[0].nombre +'</h1>' +
                        '<p>'+ resp[0].descripcion +'</p>' +
                        '<p>Fecha de ultima actualización: ' + resp[0].fechaActualizado + ' </p>'+
                        '<a data-toggle="modal" data-target="#modalPregunta" class=" btn btn-primary btn-superior" style="background-color:#07ad90;">!Inscribete!</a>'
                        // '<a href="Pregunta?curso=<?php echo $curso ?>"   class="btn btn-primary btn-superior" style="background-color:#07ad90;">!Inscribete!</a>'
                        // '<a href="#descripciones" class="btn btn-primary btn-lg btn-superior">Leér más</a>'
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
                    temas(resp);
                    // var n = resp.length;
                    // //var data = JSON.parse(resp);

                    // for(var i = 0; i < n; i++)
                    // {
                    //     temas(resp,i);
                    // }
                }
            });
        }


        function temas(data)
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
                    if(data.length > 1) temas(data.slice(1,data.length));
                }                    
            });
        }

        $('#buscar').click(function()
        {
            if( $("#textBuscar").val() != "")
                window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
        });
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
                        window.location.href="Temario?curso=<?php echo $_GET['curso']; ?>";
                    else
                        window.location.href="Evaluacion?curso=<?php echo $_GET['curso']; ?>";
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                { 
                    if(tipo == 1)
                        window.location.href="Temario?curso=<?php echo $_GET['curso']; ?>";
                    else
                        window.location.href="Evaluacion?curso=<?php echo $_GET['curso']; ?>";
                    
                }    
            });
        }
    </script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>

</body>
</html>