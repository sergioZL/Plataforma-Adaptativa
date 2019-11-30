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
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'> 
    
    <style>
        #form {
          width: 250px;
          margin: 0 auto;
          height: 50px;
        }

        #form p {
          text-align: center;
        }

        #form label {
          font-size: 20px;
        }

        input[type="radio"] {
          display: none;
        }

        label {
          color: grey;
        }

        .clasificacion {
          direction: rtl;
          unicode-bidi: bidi-override;
        }

        label:hover,
        label:hover ~ label {
          color: orange;
        }

        input[type="radio"]:checked ~ label {
          color: orange;
        }
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
            /*background-image: linear-gradient( #e6f7ff 5%,#0044cc 95%);*/
            
        	background-image: -webkit-gradient(linear,
        									   left bottom,
        									   left top,
        									   color-stop(0.44, rgb(122,153,217)),
        									   color-stop(0.72, rgb(73,125,189)),
        									   color-stop(0.86, rgb(28,58,148)));
            overflow-x: hidden;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            padding-top: 60px; 
        }
        /* .sidenav::-webkit-scrollbar {
            display: none;
        } */
        .barra{
            height:100%;
            overflow-y: scroll;
            margin-bottom: 20px;
        }
        .barra::-webkit-scrollbar {
            display: none;
        }
        .sidenav::-webkit-scrollbar-track
        {
        	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        	background-color: #F5F5F5;
        	border-radius: 10px;
        }

        .sidenav::-webkit-scrollbar
        {
        	width: 10px;
        	background-color: #F5F5F5;
        }

        .sidenav::-webkit-scrollbar-thumb
        {
        	border-radius: 10px;
        	background-image: -webkit-gradient(linear,
        									   left bottom,
        									   left top,
        									   color-stop(0.44, rgb(122,153,217)),
        									   color-stop(0.72, rgb(73,125,189)),
        									   color-stop(0.86, rgb(28,58,148)));
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
        .font-weight-bold{
            color:black;
            font-size: 20px;
        }
        .temas{
            font-size: 19px;
        }
        


        .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px green;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
    </style>
  </head>
  <body onunload="guardarAvances()">
        
        <!--Menu canvas lateral-->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="row" >
            <!-- <div class="btn-group btn-group-lg offset-4" role="group" aria-label="Basic example">                    
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(1);Pause();" ><span class="fa fa-file-video-o "></span></button>
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(2);Pause();"><span class="fa fa-file-audio-o "></span></button>
                    <button type="button" class="btn btn-outline-secondary" onclick="filterSelection(3);Pause();"><span class="fa fa-file-pdf-o "></span></button>
            </div> -->
            <div class="pull-right pt-5"><a href="<?php echo site_url();?>/Cursos/Temario?curso=<?php echo   $curso?>" style="text-decoration: none; color:rgba(255, 255, 255, 0.63);">ir al temario  </a></div>
            </div>
            
                <div class="ml-1">
                    <!-- switchButton -->
                    Personalizar 
                <label class="switch">
                    <input id="check_id" type="checkbox" onclick="mostrarPop();" checked >
                    <span class="slider round"></span>
                </label>
                </div>

            <!--nuevos elementos del menu desplegable-->

            <div  class="row ">   
                    <!--Menu desplegable-->
                <div id="accordion" role="tablist" aria-multiselectable="true" class="container barra t-2 pt-2 col-md-12 ">
                    
                    <div  id="Leccion" class="Leccion  style-8" >


                    </div>
                </div>                          
            </div>
        </div>                          
    </div>
    <?php
        $display = 'display:block;';
        if(isset($_POST['materialSend'])){
            $tipo = $_POST['tipo'];
            if($_POST['tipo'] != 1){ 
                $display = 'display:none;';
            }else{
                 $avance = $_POST['avance'];
                 $surce =  base_url(trim($_POST['materialSend'])).'.mp4'.'#t='.$avance; 
            }
        }
        else $surce =  base_url()."Material/video/SpaceX Falcon Heavy.mp4"
    ?>
    <div class="container_Video" id="Video" style="<?php echo $display; ?>">    
        <div class="containerVideo">
            
            <div id="VideoRoute" >
                <video id="video" class="video" controls preload="metadata" controlslist="nodownload">
                    <source id="vid" src="<?php echo  $surce; ?>"><!--#t=15 para empezar en el segundo--> 
                    
                </video>
                <center id="opciones" class="m-5 d-none">
                    <button onclick="openNav()" class=" btn btn-dark sticky-top"> Ver mas </button>
                    <button id="ValoracionModal" data-toggle="modal" data-target="#modalPregunta" class=" btn btn-dark sticky-top" style="color:#ffff;"> Evaluar Material </button>
                </center>
            </div>
        
            <div class="submenu" onclick="Pause()">
                <div class="menu pointer col-md-1 pt-5  icon_white  submenuVideo">
                    <span  style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>
       
            </div>
        </div>
    </div>
    <?php
        $disp = 'display:none;';
        if(isset($_POST['materialSend'])){
            if($_POST['tipo'] != 2){ 
                $display = 'display:none;';
            }else{
                $avance = $_POST['avance'];
                $surc =  base_url(trim($_POST['materialSend'])).'.mp3'.'#t='.$avance; 
                //$surc =  base_url(trim($_POST['materialSend'])).'.mp3'; 
                $display = 'display:none;';
                $disp = 'display:Block;';
            }
        }
        else  $surc =  base_url().'Material/audio/Alan Walker - Faded (Instrumental Version).mp3';
    ?>

    <div class="container_Audio" id="Audio" style="<?php echo $disp; ?>">
        <div class="containerAudio">    
            <div id="audioRoute">
                <audio class="audio" id="audio" controls preload="metadata" controlslist="nodownload" style="width: 50%;">
                    <source id="aud" src="<?php echo $surc ?> "> 
                </audio>
                <center id="opciones" class="m-5 ">
                    <button onclick="openNav()" class=" btn btn-dark sticky-top"> Ver mas </button>
                    <a id="ValoracionModal" data-toggle="modal" data-target="#modalPregunta" class=" btn btn-dark " style="color:#ffff;">Valorar Material</a>
                </center> 
            </div>

            <div class="submenu" onclick="Pause()">
                <div class="menu pointer col-md-1 pt-5  icon_white submenuAudio">
                    <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>         
            </div>
        </div>
    </div>

    <?php
        $dis = 'display:none;';
        if(isset($_POST['materialSend'])){
            if($_POST['tipo'] != 3){ 
                $display = 'display:none;';
            }else{
                $sur =  base_url(trim($_POST['materialSend'])).'.pdf'; 
                $display = 'display:none;';
                $disp = 'display:none;';
                $dis = 'display:block;';
            }
        }
        else  $sur =  base_url().'Material/pdf/UnidadesTematicas_Programacion.pdf#page=17';
    ?>

    <div class="container_PDF" id="PDF" style="<?php echo $dis?>" > 
        <div class="submenu" onclick="Pause()">
            <div class="menu pointer col-md-1 pt-5  icon_white submenuAudio">
                <span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>         
        </div>    
        <iframe  id="pdf" style="width:100%; border:none; height:100vh;" src="<?php echo $sur; ?>" style="width: 100%;height: 100%;" type="application/pdf" >
        
        </iframe>
        <center id="opciones" class="m-5 ">
            <button onclick="openNav()" class=" btn btn-dark sticky-top"> Ver mas </button>
            <a id="ValoracionModal" data-toggle="modal" data-target="#modalPregunta" class=" btn btn-dark " style="color:#ffff;">Valorar Material</a>
        </center>
    </div>

    <div class="modal fade bd-example-modal-md" id="modalPregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-200 font-weight-bold" id="chan">Tu opinión es importante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> X
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="contenedorValoracion"> 
                    <form>
                      <p class="clasificacion">
                        <div id="valoracionContainer">
                            <h2>El contenido ya ha sido valorado!</h2>
                        </div>
                      </p>
                    </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

<script>
        let valorado = false;
        let tiempoInicio = new Date();
        let indexpage = -1;
        var tipos = <?php echo $_POST['tipo']; ?>+0;
        var claveMaterial = '<?php echo $_POST['claveMat']; ?>';
        let  paginasPreguntas;
        let temario;

        function mostrarPop() {
            $('#myPopup').removeClass('show');
            $("#Leccion").html('');
            temas(temario);
        }

        $(document).ready(function(){

            CargarLecciones();
            $("#video").on('ended', function(){ //Se ejecutan el video llegue a su fin
                $('#opciones').removeClass('d-none');
                if(valorado) $('#ValoracionModal').addClass("d-none");
            });

            $("#audio").on('ended', function(){ //Se ejecutan el audio llegue a su fin
                $('#opciones').removeClass('d-none');
                if(valorado) $('#ValoracionModal').addClass("d-none");
            });
           
            consultarValoracion( '<?php echo $varsesion; ?>', '<?php echo $_POST['claveMat']; ?>');

        });      
        let consultarValoracion = (Usuario, Material) => {

            $.ajax
            ({
                type:'get',
                url:"<?php echo site_url();?>/Material/MaterialController/optenerPreguntasValoracion",
                data:{ usuario: Usuario, material: Material  },    
                success:function(resp)
                {  
                    
                    if(resp === "valorado"){
                        $('#ValoracionModal').addClass("d-none");
                          valorado = true;
                          $('#valoracionContainer').html('<h2>El contenido ya ha sido valorado!</h2>');
                        }else {
                            paginasPreguntas = JSON.parse(resp);
                            cargarValoracion(1);
                            valorado = false;
                        }
                }
            });
        }
        let cargarValoracion = (index ) => {

            indexpage =  indexpage+index;
            if(indexpage < paginasPreguntas.length){
            let preguntasPagina = paginasPreguntas[indexpage].preguntas;
            let preguntas = '';
            let i = 0;
            for (const pregunta of preguntasPagina) {
                
                 preguntas +='<div id="pregresp"  class="row">'+
                                   '<div id="enun" class="enunciado">'+
                                   ` ${ pregunta.enunciado }`+
                                   '</div>'+
                                   '<div id="respuestas"  class="ml-3">'+
                                   `    <input id="radio${ pregunta.idpv }" type="radio" name="estrellas${ pregunta.idpv }" value="5" onclick="ponerEstrellas(  ${indexpage}, ${i}, 5)">`+
                                   `    <label for="radio${ pregunta.idpv }">★</label>`+
                                   `    <input id="radio${ pregunta.idpv + 1 }" type="radio" name="estrellas${ pregunta.idpv }" value="4" onclick="ponerEstrellas(  ${indexpage}, ${i}, 4)">`+
                                   `    <label for="radio${ pregunta.idpv + 1 }">★</label>`+
                                   `    <input id="radio${ pregunta.idpv + 2 }" type="radio" name="estrellas${ pregunta.idpv }" value="3" onclick="ponerEstrellas(  ${indexpage}, ${i}, 3)">`+
                                   `    <label for="radio${ pregunta.idpv + 2 }">★</label>`+
                                   `    <input id="radio${ pregunta.idpv + 3 }" type="radio" name="estrellas${ pregunta.idpv }" value="2" onclick="ponerEstrellas(  ${indexpage}, ${i}, 2)">`+
                                   `    <label for="radio${ pregunta.idpv + 3 }">★</label>`+
                                   `    <input id="radio${ pregunta.idpv + 4 }" type="radio" name="estrellas${ pregunta.idpv }" value="1" onclick="ponerEstrellas(  ${indexpage}, ${i}, 1)">`+
                                   `    <label for="radio${ pregunta.idpv + 4 }">★</label>`+
                                   `</div>`+
                              `</div>`;
                i++;
            }
                    $('#valoracionContainer').html(`<h3> ${ paginasPreguntas[indexpage].categoria } </h3>`+preguntas+
                                                  '<div style="margin-bottom: 10px; color:white;">'+
                                                      '<center>'+
                                                        '<a id="Siguiente" class="btn btn-primary" onclick="cargarValoracion(1)">Siguiente</a>'+
                                                      '</center> <br>'+
                                                      '<center><a id="Valorar"  data-dismiss="modal" aria-label="Close" class="btn btn-primary" onclick="valorar()">Enviar</a></center>'+
                                                   '</div>');
            } 
            if(indexpage >= paginasPreguntas.length -1) $('#Siguiente').addClass("d-none");
        }

        function ponerEstrellas( idxC, idxp, valor ){
            paginasPreguntas[idxC].preguntas[idxp].valoracion = valor;
            let pregunta = paginasPreguntas[idxC].preguntas[idxp];
            
        }

        function valorar(){
            let valoracion = [];
            for (const pagina of paginasPreguntas) {
                
                let preguntas = pagina.preguntas;
                for (const pregunta of preguntas) {
                    valoracion.push({
                        idinscrito: '<?php echo $varsesion; ?>',
                        idpv: pregunta.idpv,
                        valoracion: pregunta.valoracion || 0,
                        idmaterial: claveMaterial
                    });
                }
            }

            // Se envia la valoracion para que sea guardada

            $.ajax({
                type: "post",
                url: "<?php echo site_url();?>/Material/MaterialController/valorar",
                data: {valoracion: valoracion},
                success: function (response) {
                    // console.log(response);
                }
            });

            $('#valoracionContainer').html('<h2>El contenido ya ha sido valorado!</h2>');

            indexpage=-1;
        }
        function CargarLecciones()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Material/MaterialController/TemarioLateral?IdCurso=<?php echo $curso;?>',    
                dataType:"json",
                data:{Usuario: '<?php echo $varsesion; ?>'},
                success:function(resp)
                {   
                    temario = resp;
                    
                    temas(temario);
                }
            });
            
        }

        function temas(lecciones)
        {
            for (const leccion of lecciones) {    
                $("#Leccion").append('<div class="card leccion shadow-sm mb-3 rounded-0 ">'+
                    '<h6 class="card-header bg-white">'+
                        '<!--Cabecera del menu desplegable-->'+
                        '<a data-toggle="collapse" href="#contenido' + leccion.secuencia+ '" aria-expanded="true" aria-controls="contenidoUno"'+
                            'id="leccion' + leccion.secuencia+ '" class="d-block">'+
                            '<i class="fa fa-chevron-down pull-right"></i><p class="font-weight-bold">'
                            +'<small>'+'Lección '+ leccion.secuencia+': '+leccion.nombre +'</small>'+ 
                        '</p></a>'+
                    '</h6>'+
                    '<div id="contenido' + leccion.secuencia+ '" class="collapse" aria-labelledby="leccion' + leccion.secuencia+ '">'+
                    '<!--Contenido del menu desplegable-->'+
                        '<!--<div class="card-body">'+
                        '</div>-->'
                    
                );
                for (const tema of leccion.temas) {
                    let ocultar = false;
                    if ($('#check_id').is(":checked"))
                    {
                        let calificacion = 0;
                        if(tema.evaluado){
                            calificacion =( (tema.evaluado.porcentaje * 10) /  tema.evaluado.total/100);
                        }
                        if(calificacion > 9) ocultar = true;
                    }
                    if(!ocultar) $('#contenido'+leccion.secuencia+'').append('<div class="card rounded-0"  >'+
                                                                    '<h5 class="card-header" style="height: 70px;">'+
                                                                        '<a data-toggle="collapse" href="#content'+tema.id+'" aria-expanded="true"'+
                                                                            'aria-controls="content'+tema.id+'" id="Tema'+tema.id+'" class="d-block">'+
                                                                            '<i class="fa fa-chevron-down pull-right"></i>'+
                                                                            '<p class="font-weight-bold temas"><small> <span class=" badge badge-primary badge-pill">'+tema.avance+'%</span>Tema '+tema.secuencia+': '+tema.nombre+'</small><p>'+
                                                                        '</a>'+
                                                                    '</h5>'+
                                                                '<div id="content'+tema.id+'" class="collapse carta-body" aria-labelledby="Tema'+tema.id+'">'+
                                                                '<!--<div class="card-body carta-body" style="width: 100%;">'+
                
                                                                '</div>-->'+
                                                                '</div>'+
                                                                '</div>');  
                    
                        var a = tema.materials;
                        var swapp;
                        var n = a.length-1;
                        var x=a;
                        do {
                            swapp = false;
                            for (var i=0; i < n; i++)
                            {
                                if(tema.materials[i].valoracion){
                                    if (x[i].valoracion.valoracion < x[i+1].valoracion.valoracion)
                                    {
                                       var temp = x[i];
                                       x[i] = x[i+1];
                                       x[i+1] = temp;
                                       swapp = true;
                                    }
                                }  
                            }
                            n--;
                        } while (swapp);
                        tema.materials = x; 
                        let p = 0;
                    for (const material of tema.materials) {

                        tipo = material.tipo_material;
                        icono = '';
				        switch (tipo) {
				        	case '1':
				        		icono = 'fas fa-play-circle fa-2x';
				        		break;
				        	case '2':
				        		icono = 'fas fas fa-volume-up fa-2x';
				        		break;
				        	case '3':
				        		icono = 'fas fa-file-pdf fa-2x';
				        		break;
				        	default:
				        		
				        		break;
				        }
                        let recon = '';
                        if(p===0) recon = 'border-left: 3px solid green; background-color:#f0f0f0;';
                        let avanceMaterial = material.avance || 0;
                        let nombre = material.descripcion_material.split(' ').join('_');
                        let ruta = '&quot Material/'+material.clave_curso+'/'+leccion.clave+'/'+material.id_temas+'/'+nombre+'&quot';
                        let duracion = material.duracion || 0;
                        let porcentaje = avanceMaterial * 100 / duracion;
                        $('#content'+tema.id+'').append('<button style="width: 100%; '+recon+' border-radius: 0px;" class="btn btn-link" onclick="mostrar('+ruta+','+tipo+','+material.id+','+avanceMaterial+');"><p class="h6 pull-left">'+ 
                                                        '<span class="'+icono+'"></span> &nbsp;'+
                                                        ''+material.descripcion_material+''+
                                                        `<br><small class="pull-left text-dark">${ (((material.avance || 0)/60).toFixed()) } | ${ (((material.duracion || 0)/60).toFixed())} min</small>`+
                                                        '</p>'+
                                                        // '<div class="progress" style="height:3px; width: 100%;">'+
                                                        // '<div class="progress-bar bg-info" role="progressbar" style="width: '+porcentaje+'%; height:5px;" aria-valuenow="'+porcentaje+'" aria-valuemin="0" aria-valuemax="100"></div>'+
                                                        // '</div>'+
                                                        '</button><br>');
                        p++;
                    }
                }

            }
        }
        function mostrar(rout,tipo,id,avance){
            
            var routa = '<?php echo base_url() ?>'+rout.trim();
            
            claveMaterial = id;
            indexpage = -1;
            filterSelection(routa,tipo,id,avance);
        }
        function filterSelection(newUrl,idButton,id,avance)
        {
            
            consultarValoracion( '<?php echo $varsesion; ?>', id);
            var Video = document.getElementById('Video');
            var Audio = document.getElementById('Audio');
            var PDF = document.getElementById('PDF');
            tiempoInicio = new Date();

            switch(idButton) {
            case 1:
                tipos = 1;
                newUrl = newUrl+'.mp4';
                // console.log(newUrl);
                // $('#vid').attr("src", newUrl);
                $("#VideoRoute").children().remove();

                $("#VideoRoute").append(
                '<video  id="video" autoplay class="video" controls preload="metadata" controlslist="nodownload">'
                    +'<source clave="'+id+'" id="vid" src="'+newUrl+'#t='+avance+'"><!--#t=15 para empezar en el segundo-->' 
                +'</video>'
                +'<center id="opciones" class="m-5">'
                    +'<button onclick="openNav()" class=" btn btn-dark sticky-top"> Ver mas </button>'
                    +'<button id="ValoracionModal" data-toggle="modal" data-target="#modalPregunta" class=" btn btn-dark sticky-top" style="color:#ffff;"> Evaluar Material </button>'
                +'</center>'
                );
                Video.style.display = 'block';
                Audio.style.display = 'none';
                PDF.style.display = 'none';
                break;

            case 2: 
                tipos = 2;
                newUrl = newUrl+'.mp3';
                $("#audioRoute").children().remove();

                 $("#audioRoute").append(
                    '<div id="audioRoute">'
                        +'<audio  class="audio" id="audio" controls preload="metadata" controlslist="nodownload" style="width: 50%;">'
                            +'<source clave="'+id+'" id="aud" src="'+newUrl+'#t='+avance+'">' 
                        +'</audio>'
                        +'<center id="opciones" class="m-5 ">'
                            +'<button onclick="openNav()" class=" btn btn-dark sticky-top"> Ver mas </button>'
                            +'<a id="ValoracionModal" data-toggle="modal" data-target="#modalPregunta" class=" btn btn-dark " style="color:#ffff;">Valorar Material</a>'+
                        +'</center>'
                    +'</div>');

                Video.style.display = 'none';
                Audio.style.display = 'block';
                PDF.style.display = 'none';
                break;

            case 3:
                tipos = 3;
                newUrl = newUrl+'.pdf#page=1';
                $('#pdf').attr("src", newUrl);
                 Video.style.display = 'none';
                 Audio.style.display = 'none';
                 PDF.style.display = 'block';
                 guardarAvances();
                break;
            }
        }
        
        function Pause() {
            var Video = document.getElementById("video"); 
            Video.pause();
            console.log('Current time',Video.currentTime);
            var Audio = document.getElementById("audio"); 
            Audio.pause(); 
            guardarAvances();
        }
            
        function guardarAvances(){
            let tiempoFin = new Date();
            var hora =  tiempoFin.getHours() - tiempoInicio.getHours();
            var minutos = tiempoFin.getMinutes() - tiempoInicio.getMinutes();
            let tiempEnMinutos = minutos + ( hora * 60 );
            var ultimo = '';
            switch (tipos) {
                case 1:
                    var rout = $('#vid').attr('src');
                    terial= $('#vid').attr('clave');
                    if(terial) claveMaterial = terial;
                    console.log('Clave material',claveMaterial);
                    
                    var Video = document.getElementById("video"); 
                    var res = rout.split("/");  
                    var ultimo = {
                        leccion:res[7],
                        tema:res[8],
                        claveUsuario:'<?php echo $varsesion ?>',
                        nombre:res[9],
                        url:rout,
                        tipo:tipos,
                        avance:Video.currentTime,
                        material:claveMaterial,
                        tiempo_promedio: tiempEnMinutos,
                        duracion:Video.duration
                    }
                    var clave = '<?php echo $curso; ?>';
                    window.localStorage.setItem(  clave , JSON.stringify( ultimo ) );

                    MaterialUltimo = JSON.stringify(ultimo);
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url();?>/Material/MaterialController/setUltimo",
                        data: {ultimo:MaterialUltimo,Curso:'<?php echo $curso; ?>',Usuario:'<?php echo $varsesion ?>'},
                        success: function (response) {
                            console.log(response);
                        }
                    });

                    break;
                case 2:
                    var rout = $('#aud').attr('src');
                    var terial= $('#aud').attr('clave');
                    if(terial) claveMaterial = terial;
                    console.log('Clave material',claveMaterial);
                    console.log('Tiempo promedio',tiempEnMinutos);
                    var Audio = document.getElementById("audio"); 
                    var res = rout.split("/");  
                    var ultimo = {
                        leccion:res[7],
                        claveUsuario:'<?php echo $varsesion ?>',
                        tema:res[8],
                        nombre:res[9],
                        url:rout,
                        tipo:tipos,
                        avance:Audio.currentTime,
                        material:claveMaterial,
                        tiempo_promedio: tiempEnMinutos,
                        duracion:Audio.duration
                    }
                    var clave = '<?php echo $curso; ?>';
                    window.localStorage.setItem(  clave , JSON.stringify( ultimo ) );
                    MaterialUltimo = JSON.stringify(ultimo);
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url();?>/Material/MaterialController/setUltimo",
                        data: {ultimo:MaterialUltimo,Curso:'<?php echo $curso; ?>',Usuario:'<?php echo $varsesion ?>'},
                        success: function (response) {
                            console.log(response);
                        }
                    });
                    break;
                case 3:
                     var rout = $('#pdf').attr('src');
                     var currentPageNum = $('#pdf').contents().find('#input').val();
                      var res = rout.split("/");  
                      var ultimo = {
                          leccion:res[7],
                          tema:res[8],
                          nombre:res[9],
                          url:rout,
                          tipo:tipos,
                          avance:currentPageNum,
                          tiempo_promedio: tiempEnMinutos,
                          material:claveMaterial
                     }
                    var clave = '<?php echo $curso; ?>';
                    window.localStorage.setItem(  clave , JSON.stringify( ultimo ) );

                    MaterialUltimo = JSON.stringify(ultimo);
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url();?>/Material/MaterialController/setUltimo",
                        data: {ultimo:MaterialUltimo},
                        success: function (response) {
                            
                            console.log(JSON.parse(response));
                        }
                    });

                    break;
                
                default:
                    break;
            }

        }


    </script>
    
    
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <!--<script src="<?php echo base_url();?>app-assets/js/audio.js"></script>-->