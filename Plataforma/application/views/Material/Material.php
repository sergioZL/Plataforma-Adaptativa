<?php
    error_reporting(0);
    session_start();
    $curso = $_GET['curso'];
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }
    if($curso == null|| $curso == '')
    {
        header("location:".site_url('alumno/MisCursos'));
    }
?> 
<!DOCTYPE html>
<html lang="es" data-textdirection="ltr" class="loading">
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Material</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap.css"><!--
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/diseñoAudio.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/diseñoVideo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/diseñoPDF.css">
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        .bloqueo
        {
            position:relative;
            background-color:rgba(255,255,255,0.00);
            width:830px;
            height:850px;
        }
        
        .video
        {
            position: absolute;
            top: 50%;
            left: 42.5%;
            transform: translate(-50%, -50%);
        }

        .audio
        {
            position: absolute;
            top: 80%;
            left: 42.5%;
            transform: translate(-50%, -50%);
            margin-left: 7.5%;
            width: 85%;
            align-items: center;
            justify-content: center;
        }

        body {

        font-family: "Lato", sans-serif; }



        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-image: linear-gradient( #e6f7ff 5%,#0044cc 95%);
            overflow-x: hidden;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            padding-top: 60px; 
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #66ccff;
            display: block;
            -webkit-transition: 0.3s;
            transition: 0.3s; 
        }

        .sidenav a:hover {
            color: #c9e7f5; 
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px; 
        }

        .container_Audio .containerAudio
        {

            background-size: cover;
            background-color: #030729;
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .controlsAudio
        {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 10%;
            background-color: rgba(0,0,0,0.5);
        }


        #main {
            -webkit-transition: margin-left .5s;
            transition: margin-left .5s; 
        }
    </style>
  </head>
  <body>

        <!--Menu canvas lateral-->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="row">
            <div class="btn-group btn-group-lg offset-4" role="group" aria-label="Basic example">                    
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(1);Pause();" ><span class="fa fa-file-video-o "></span></button>
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(2);Pause();"><span class="fa fa-file-audio-o "></span></button>
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(3);Pause();"><span class="fa fa-file-pdf-o "></span></button>
            </div>
            <div class="pull-right pt-5"><a href="<?php echo site_url();?>/Cursos/Temario?curso=<?php echo  $curso?>" style="text-decoration: none; color:rgba(255, 255, 255, 0.63);">ir al temario</a></div>
            </div>
            <!--nuevos elementos del menu desplegable-->                
            <div  class="row">   
                    <!--Menu desplegable-->
                <div id="accordion" role="tablist" aria-multiselectable="true" class="container t-2 pt-5 col-md-11">
                    
                    <div  id="Leccion">


                    </div>
                </div>                          
            </div>
        </div>                          
    </div>
    
    <div class="container_Video" id="Video">    
        <div class="containerVideo">
            
            <div id="VideoRoute">
                <video id="video" class="video" controls preload="metadata" controlslist="nodownload">
                    <source src="<?php echo  base_url(); ?>Material/video/SpaceX Falcon Heavy.mp4"><!--#t=15 para empezar en el segundo--> 
                </video>
            </div>
        
            <div class="submenu" onclick="Pause()">
                <div class="menu pointer col-md-1 pt-5  icon_white  submenuVideo">
                    <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>
        </div>
    </div>
    

    <div class="container_Audio" id="Audio" style="display:none;">
        <div class="containerAudio">    
            <div id="audioRoute">
                <audio class="audio" id="audio" controls preload="metadata" controlslist="nodownload" style="width: 50%;">
                    <source src="<?php echo  base_url(); ?>Material/audio/Avicii - Levels.mp3"> 
                </audio>
            </div>
            <div class="submenu" onclick="Pause()">
                <div class="menu pointer col-md-1 pt-5  icon_white submenuAudio">
                    <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>
        </div>
    </div>


    <!--<div class="container_Audio" id="Audio" style="display:none;">
        <div class="containerAudio">    
            <div id="audioRoute">
                <audio class="audio" id="audio" controls preload="metadata" controlslist="nodownload" style="display:none;">
                    <source src="<?php echo  base_url(); ?>Material/audio/Alan Walker - Faded (Instrumental Version).mp3"> 
                </audio>
            </div> 
            <div class="submenu">
                <div class="menu pointer col-md-1 pt-5  icon_white submenuAudio">
                    <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>
            <div class="controlsAudio">
                <div class="progressAudio pointer">
                    <div class="barAudio">

                    </div>
                </div>
                
                <i class="fa fa-play playPausebtnAudio med_icon icon_white pointer"></i>
                <div class="timeAudio">
                    <span class="current_timeAudio">00:00</span> /
                    <span class="full_durationAudio">00:00</span>
                </div>


                <div class="pull-right" >
                    <input type="range" class="volume_rangeAudio" min="0" max="1" step="00.1" value="1">
                    <i class="fa fa-volume-up volume_btnAudio icon_white pointer"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>-->
 


    <div class="container_PDF" id="PDF" style="display:none;"> 
        <div class="submenu" onclick="Pause()">
            <div class="menu pointer col-md-1 pt-5  icon_white submenuAudio">
                <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>         
        </div>    
        <iframe style="width:100%; border:none; height:100vh;" src="<?php echo  base_url(); ?>Material/pdf/UnidadesTematicas_Programacion.pdf#page=17" style="width: 100%;height: 100%;" ></iframe>
        
    </div>


<script>
        
        $(document).ready(function(){
            
            CargarLecciones();
            $("#video").on('ended', function(){
                //alert('El video ha finalizado!!!');
                
                $.ajax
                ({
                    type:'post',
                    url:'<?php echo site_url();?>/Material/MaterialController/SiguienteVideo?IdCurso=<?php echo $curso;?>&material=2',    
                    dataType:"json",
                    success:function(resp)
                    {                        
                        $("#VideoRoute").children().remove();

                        $("#VideoRoute").append(
                        '<video id="video" autoplay class="video" controls preload="metadata" controlslist="nodownload">'
                            +'<source src="<?php echo  base_url(); ?>Material/video/videoplayback.mp4#t=120"><!--#t=15 para empezar en el segundo-->' 
                        +'</video>'
                        );
                        filterSelection(1);
                    }
                });
            });

            $("#audio").on('ended', function(){
                //alert('El audio ha finalizado!!!');
                
                $.ajax
                ({
                    type:'post',
                    url:'<?php echo site_url();?>/Material/MaterialController/SiguienteAudio?IdCurso=<?php echo $curso;?>&material=2',    
                    dataType:"json",
                    success:function(resp)
                    {                        
                        $("#audioRoute").children().remove();

                        $("#audioRoute").append(
                            '<audio autoplay class="audio" id="audio" controls preload="metadata" controlslist="nodownload" style="width: 50%;>'
                                +'<source src="<?php echo  base_url(); ?>Material/audio/Alan Walker - Faded (Instrumental Version).mp3"><!--#t=15 para empezar en el segundo-->' 
                            +'</audio>'
                        );
                        filterSelection(2);
                    }
                });
            });
           
        });      
        
        function CargarLecciones()
        {

            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Material/MaterialController/ConsultarTodosLeccionPorIDCursos?IdCurso=<?php echo $curso;?>',    
                dataType:"json",
                success:function(resp)
                {
                    var n = resp.length;
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
                url:'<?php echo site_url();?>/Material/MaterialController/ConsultarTemasCursosID?IdLeccion='+data[i].clave,
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
                                resp+
                                '</div>'
                    );
                }                    
            });
        }
        
        function filterSelection(idButton)
        {

            var Video = document.getElementById('Video');
            var Audio = document.getElementById('Audio');
            var PDF = document.getElementById('PDF');


            switch(idButton) {
            case 1:
                Video.style.display = 'block';
                Audio.style.display = 'none';
                PDF.style.display = 'none';
                break;

            case 2:
                Video.style.display = 'none';
                Audio.style.display = 'block';
                PDF.style.display = 'none';
                break;

            case 3:
                Video.style.display = 'none';
                Audio.style.display = 'none';
                PDF.style.display = 'block';
                break;
            }
        }

        
        function Pause() { 
            var Video = document.getElementById("video"); 
            Video.pause();
            var Audio = document.getElementById("audio"); 
            Audio.pause(); 
        }
        

    </script>
    
    
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <!--<script src="<?php echo base_url();?>app-assets/js/audio.js"></script>-->