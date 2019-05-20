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