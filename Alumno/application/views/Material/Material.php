<!DOCTYPE html>
<html lang="es" data-textdirection="ltr" class="loading">
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Material</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/bootstrap.css"><!--
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/diseñoAudio.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/diseñoVideo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/diseñoPDF.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>app-assets/css/estilo.css">
    
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
    </style>
  </head>
  <body>

        <!--Menu canvas lateral-->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="row">
            <div class="btn-group btn-group-lg offset-4" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(1)"><span class="fa fa-file-video-o "></span></button>
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(2)"><span class="fa fa-file-audio-o "></span></button>
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(3)"><span class="fa fa-file-pdf-o "></span></button>
            </div>
            </div>
    <!--nuevos elementos del menu desplegable-->                
    <div  class="row">
            <!--Menu desplegable-->
        <div id="accordion" role="tablist" aria-multiselectable="true" class="container t-2 pt-5 col-md-11">
            <!--Leccion uno-->
            <div class="card leccion shadow-sm mb-3 rounded-0">
                <h5 class="card-header"><!--Cabecera del menu desplegable-->
                    <a data-toggle="collapse" href="#contenidoUno" aria-expanded="true" aria-controls="contenidoUno" id="leccionUno" class="d-block">
                        <i class="fa fa-chevron-down pull-right"></i>
                        Leccion #1
                    </a>
                </h5>
                <div id="contenidoUno" class="collapse" aria-labelledby="leccionUno"><!--Contenido del menu desplegable-->
                                <!--Tema-->
                    <div class="card rounded-0">
                            <h5 class="card-header">
                                <a data-toggle="collapse" href="#contenidoUno-temaUno" aria-expanded="true" aria-controls="contenidoUno-temaUno" id="leccionUno-temaUno" class="d-block">
                                    <i class="fa fa-chevron-down pull-right"></i>
                                    Tema #1
                                </a>
                            </h5>
                            <div id="contenidoUno-temaUno" class="collapse" aria-labelledby="leccionUno-temaUno">
                                <div class="card-body">
                                    <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                    <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                    <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                </div>
                                
                            </div>
                    </div>
                                     <!--Tema-->
                    <div class="card rounded-0">
                            <h5 class="card-header">
                                <a data-toggle="collapse" href="#contenidoUno-temaDos" aria-expanded="true" aria-controls="contenidoUno-temaDos" id="leccionUno-temaDos" class="d-block">
                                    <i class="fa fa-chevron-down pull-right"></i>
                                    Tema #2
                                </a>
                            </h5>
                            <div id="contenidoUno-temaDos" class="collapse" aria-labelledby="leccionUno-temaDos">
                                <div class="card-body">
                                    <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                    <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                    <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                </div>
                                
                            </div>
                    </div>
                                <!--Tema-->
                    <div class="card rounded-0">
                           <h5 class="card-header">
                               <a data-toggle="collapse" href="#contenidoUno-temaTres" aria-expanded="true" aria-controls="contenidoUno-temaTres" id="leccionUno-temaTres" class="d-block">
                                   <i class="fa fa-chevron-down pull-right"></i>
                                   Tema #3
                               </a>
                           </h5>
                           <div id="contenidoUno-temaTres" class="collapse" aria-labelledby="leccionUno-temaTres">
                               <div class="card-body">
                                <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                               </div>
                               
                           </div>
                   </div>
                </div>
            </div>
            <!--Leccion Dos-->
            <div class="card leccion shadow-sm mb-3 rounded-0">
                    <h5 class="card-header"><!--Cabecera del menu desplegable-->
                        <a data-toggle="collapse" href="#contenidoDos" aria-expanded="true" aria-controls="contenidoDos" id="leccionDos" class="d-block">
                            <i class="fa fa-chevron-down pull-right"></i>
                            Leccion #2
                        </a>
                    </h5>
                    <div id="contenidoDos" class="collapse show" aria-labelledby="leccionDos"><!--Contenido del menu desplegable-->
   
                                    <!--Tema-->
                        <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoDos-temaUno" aria-expanded="true" aria-controls="contenidoDos-temaUno" id="leccionDos-temaUno" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #1
                                    </a>
                                </h5>
                                <div id="contenidoDos-temaUno" class="collapse" aria-labelledby="leccionDos-temaUno">
                                    <div class="card-body">
                                        <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                        <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                        <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                    </div>
                                </div>
                        </div>
    
                        <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaDos" aria-expanded="true" aria-controls="contenidoTres-temaDos" id="leccionTres-temaDos" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #2
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaDos" class="collapse show" aria-labelledby="leccionTres-temaDos">
                                    <div class="card-body">
                                        <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                        <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                        <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                    </div>
                                    
                                </div>
                        </div>
           
                        <div class="card rounded-0">
                               <h5 class="card-header">
                                   <a data-toggle="collapse" href="#contenidoDos-temaTres" aria-expanded="true" aria-controls="contenidoDos-temaTres" id="leccionDos-temaTres" class="d-block">
                                       <i class="fa fa-chevron-down pull-right"></i>
                                       Tema #3
                                   </a>
                               </h5>
                               <div id="contenidoDos-temaTres" class="collapse" aria-labelledby="leccionDos-temaTres">
                                   <div class="card-body">
                                    <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                    <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                    <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                   </div>
                                   
                               </div>
                       </div>
                </div>
            </div>   
            <!--Leccion tres-->
            <div class="card leccion shadow-lg mb-3 rounded-0">
                    <h5 class="card-header"><!--Cabecera del menu desplegable-->
                        <a data-toggle="collapse" href="#contenidoTres" aria-expanded="true" aria-controls="contenidoTres" id="leccionTres" class="d-block">
                            <i class="fa fa-chevron-down pull-right"></i>
                            Leccion #3
                        </a>
                    </h5>
                    <div id="contenidoTres" class="collapse" aria-labelledby="leccionTres"><!--Contenido del menu desplegable-->
                                    <!--Tema-->
                        <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaUno" aria-expanded="true" aria-controls="contenidoTres-temaUno" id="leccionTres-temaUno" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #1
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaUno" class="collapse" aria-labelledby="leccionTres-temaUno">
                                    <div class="card-body">
                                        <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                        <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                        <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                    </div>
                                    
                                </div>
                        </div>
                                         <!--Tema-->
                        <div class="card rounded-0">
                                <h5 class="card-header">
                                    <a data-toggle="collapse" href="#contenidoTres-temaDos" aria-expanded="true" aria-controls="contenidoTres-temaDos" id="leccionTres-temaDos" class="d-block">
                                        <i class="fa fa-chevron-down pull-right"></i>
                                        Tema #2
                                    </a>
                                </h5>
                                <div id="contenidoTres-temaDos" class="collapse" aria-labelledby="leccionTres-temaDos">
                                    <div class="card-body">
                                        <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                        <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                        <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                    </div>
                                    
                                </div>
                        </div>
                                    <!--Tema-->
                        <div class="card rounded-0">
                               <h5 class="card-header">
                                   <a data-toggle="collapse" href="#contenidoTres-temaTres" aria-expanded="true" aria-controls="contenidoTres-temaTres" id="leccionTres-temaTres" class="d-block">
                                       <i class="fa fa-chevron-down pull-right"></i>
                                       Tema #3
                                   </a>
                               </h5>
                               <div id="contenidoTres-temaTres" class="collapse" aria-labelledby="leccionTres-temaTres">
                                   <div class="card-body">
                                    <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                                    <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                                    <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                                   </div>
                               </div>
                       </div>
                    </div>
                </div>     
        </div>
    </div>                          
        </div>


    <div class="container_Video" id="Video">    
        <div id="main" class="containerVideo">
            
            <video id="video" class="video">
                <source src="<?php echo  base_url(); ?>Material/video/SpaceX Falcon Heavy.mp4"> 
            </video>
        
            <div class="submenu">
                <div class="menu pointer col-md-1 pt-5  icon_white  submenuVideo">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>
            <div class="pull-right pt-5"><a href="Temario.php" style="text-decoration: none; color:rgba(255, 255, 255, 0.63);">ir al temario</a></div>
            <div class="controlsVideo">
                <div class="progressVideo pointer">
                    <div class="barVideo">

                    </div>
                </div>
                            
                <i class="fa fa-play playPausebtnVideo med_icon icon_white pointer"></i>
                <div class="timeVideo">
                    <span class="current_timeVideo">00:00</span> /
                    <span class="full_durationVideo">00:00</span>
                </div>


                <div class="pull-rightVideo">
                    <input type="range" class="volume_rangeVideo" min="0" max="1" step="00.1" value="1">

                    <i class="fa fa-volume-up volume_btnVideo icon_white pointer"></i> &nbsp;&nbsp;&nbsp;
                    <i id="expand_btnVideo" class="fa fa-step-forward expand_btnVideo icon_white pointer"></i>&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-arrows-alt full_screenVideo icon_white pointer"></i>&nbsp;&nbsp;&nbsp;
                </div>

            </div>
        </div>
    </div>



    <div class="container_Audio" id="Audio" style="display:none;">
        <div class="containerAudio">    
            <audio class="audio">
                <source src="<?php echo  base_url(); ?>Material/audio/Alan Walker - Faded (Instrumental Version).mp3"> 
            </audio>
            
            <div class="loading">
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
                <div class="obj"></div>
            </div>
            
            <div class="submenu">
                <div class="menu pointer col-md-1 pt-5 icon_white submenuAudio">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
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


                <div class="pull-right">
                    <input type="range" class="volume_rangeAudio" min="0" max="1" step="00.1" value="1">

                    <i class="fa fa-volume-up volume_btnAudio icon_white pointer"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
 


    <div class="container_PDF" id="PDF" style="display:none;"> 
        <div class="container">

            <div class="submenu">
                <div class="menu pointer col-md-1 pt-5 icon_white">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                    <div class="bloqueo">
        </div>
                </div>         
            </div>

            <iframe src="<?php echo  base_url(); ?>Material/pdf/UnidadesTematicas_Programacion.pdf#page=17" style="width: 100%;height: 100%;" ></iframe>
        </div>
    </div>



    <script>
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
    </script>

    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/video.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/audio.js"></script>