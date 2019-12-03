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
    <title>Contenido del curso</title>
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <!--estilos bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilosTemario.css">
    <!--iconos-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>                            
     <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> <!-- nuevo font awesome -->
<style>
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
<body>  
<?php
        $this->load->view('Cursos/Nav');
?>

<!-- nav -->

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand text-left" href="<?php echo site_url();?>/alumno/MisCursos">
    <img class="login-img text-left" src="<?php echo base_url();?>app-assets/imagenes/logo.png" style="width: 50%; margin: 0;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">

    <form class="form-inline my-2 my-lg-0">
        <div class="input-group">
           <input id="textBuscar" type="text" class="buscar form-control" placeholder="Buscar">
           <div class="input-group-append">
                <button id="buscar" class="bustcar btn btn-outline-info" type="button">
                    <span class="fa fa-search form-control-feedback"></span>
                </button>
           </div>
        </div>    
    </form>
        <ul class="navbar-nav offset-lg-1 offset-xl-3">
            <!--<li class="nav-item">
                <a class="nav-link" style="color: #07ad90;" href="<?php echo site_url();?>/Cursos/NuevosCursos">Nuevos cursos</a>
            </li>--><!--
               <li class="dropdown">
                <a href="" class="btn" data-toggle="dropdown" >
                    <span class="far fa-bell fa-2x" style="color: #07ad90;" title="Notificaciones"></span>
                </a>
                <ul class="dropdown-menu">

                </ul>
            </li>
            <li class="dropdown">
                <a href="" class="btn" data-toggle="dropdown" >
                    <span class="far fa-user fa-2x" style="color: #07ad90;"  title="Perfil"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">
                            <span class="fas fa-user-circle fa-2x" style="color: #07ad90;" title="Perfil"></span>
                            <?php 
                                echo $varsesion;
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url();?>/alumno/MisCursos"> <button class="btn btn-light col-12 text-left"> <span class="far fa-folder pull-left " style="color: #07ad90;font-size: 16px;"></span><pre>  Mis cursos</pre></button></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url();?>/Cursos/NuevosCursos"><button class="btn btn-light col-12 text-left"><span class="fas fa-folder-plus pull-left " style="color: #07ad90;"></span> <pre>  Nuevo curso</pre></button></a>
                    </li>
                    <li>
                        <a href=""><button class="btn btn-light col-12 text-left"><span class="fas  fa-info-circle  pull-left" style="color: #07ad90;"></span><pre>  Ayuda</pre>  </button></a>
                    </li>
                    <li>
                        <a href="../../../CerrarSesion.php"><button class="btn btn-light col-12 text-left"> <span class=" fas fa-sign-out-alt  pull-left" style="color: #07ad90;"></span><pre>  Salir</pre></button> </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav> -->

<?php //echo $curso =$_GET['curso']; ?>


<section class="seccion-superior"><!--Esta es la parte superior del temario-->
    <div class="row pt-4 py-4 offset-1">
        <div class="panelImagen col-lg-3 ">
            <div id="imagen">


            </div>
        </div>
        <div class="col-lg-8 ">
            <div >
                
                <div id="info">
                
                </div>

                        
            </div>
        </div>
    </div>
</section>

<br>
<div class="popup" >
    <div class="ml-5">
        <!-- switchButton -->
        <h4>Aplicar recomendaciones 
        <label class="switch">
            <input id="check_id" type="checkbox" onclick="mostrarPop();" checked >
            <span class="slider round"></span>
        </label></h4>
    </div>
  <span class=" popuptext" id="myPopup">Contenido adaptado al examen diagnostico!</span>
</div>
    <div id="main" class="row">
        <!--Menu desplegable-->
        <div id="accordion" role="tablist" aria-multiselectable="true" class="container t-1 pt-5 col-md-11">
            <!--Leccion uno-->
            <div  id="Leccion">
                        
                <div id="Temas">
                            <!--Tema-->
                </div>
                            
            </div>
        </div>
    </div>
</div>

    <script>
    let temario;
    let Ultimo;
    let claveUsuario = '<?php echo $varsesion ?>';
    let reconmendButton = false;


    function mostrarPop() {
        $('#myPopup').removeClass('show');
        $("#Leccion").html('');
        temas(temario);
    }
    var but = 'Comenzar desde el principio'; //Este mensaje se mostrara al usuario por default si este no ha revisado algun material antes
    $(document).ready(function () {
        var clave = '<?php echo $_GET['curso'];?>'; //Almacena la clave de curso al que pertenece los temas
        Ultimo = window.localStorage.getItem(clave); //Se optiene el ultimo material visitado por medio del local storage
        if(Ultimo != null){ //Si ya se tenia guardado el ultimo material visitdo en el localstorage  se obtienen los datos de este objeto
            ult = JSON.parse(Ultimo);
            if(claveUsuario == ult.claveUsuario) {
                but = ult.nombre.split(".");
                ruta = ult.url.substring(50);
                uta = ruta.split(".");
                ava = ult.avance;
                idmat = ult.material;
                name = but[0].replace(/_/g, ' ');
                tipo = ''+ult.tipo+'';
                icono = '';
			    switch (tipo) {
			    	case '1':
			    		icono = 'fas fa-play-circle fa-sm';
			    		break;
			    	case '2':
			    		icono = 'fas fas fa-volume-up fa-sm';
			    		break;
			    	case '3':
			    		icono = 'fas fa-file-pdf fa-sm';
			    		break;
			    	default:
                    
			    		break;
			    }
                $('#boton').html('');
                //Los datos obtenidos se guardan en el boton que muestra el ultimo material visitado de este curso
                $('#boton').append('<br><button type="button" style="margin: 0px; padding:0px; color:#000000; text-decoration:none;" class="btn btn-link" onclick="mostrar( &quot '+uta[0]+'&quot,'+ult.tipo+','+ava+','+idmat+');">  <h2 style="margin: 0px; padding:0px;" id="bot"> '+'<span class="'+icono+'"></span> '+name+'</h2>'+
                                    ` &nbsp;  <small>  &nbsp; &nbsp; ${ ((( ava || 0)/60).toFixed()) } | ${ (((ult.duracion || 0)/60).toFixed())} min  &nbsp; &nbsp;   continuar </small>`+
                                    '</button>');
                
            } 
        }

        //optiene la clave de usuario actual
        let usuario = '<?php echo $varsesion; ?>';
        
        /**
         * Optiene los datos de alumno relacionados con este usuario
         */
        $.get( '<?php echo site_url();?>/Cursos/EncuestaController/obtenerAlumno', { varusuario: usuario} )
            .done(function( data ) {
                let obj = JSON.parse( data );// convierte los datos optenidos a un objeto de tipo json
                actualizarHeader(obj);
            });
    });

        function actualizarHeader(data){
            $('#userName').html('<br>'+data.nombre+' '+data.app); // Coloca el nombre de usuario y apellido paterno en el navbar
            
            let inN = data.nombre.split( "", 1 );
            let inA = data.app.split( "", 1 );
            $('#inicial').html(inN+inA);
        }
    CargarInfoCursos();
    CargarLecciones();
        $('#buscar').click(function()
        {
            if( $("#textBuscar").val() != "")
                window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
        });

        function CargarLecciones()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/TemarioController/Temario?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                dataType:"json",
                data:{Usuario: '<?php echo $varsesion; ?>'},
                success:function(resp)
                {
                    temario = resp;
                    var n = resp.length;
                    temas(temario);

                }
            });
        }

        function temas(lecc)
        {
            let lecciones = lecc;
            console.log(lecciones);

            for (const leccion of lecciones) {    
                    $("#Leccion").append(
                        '<div class="card leccion shadow-sm mb-3 rounded-0" style="background-color:#07ad90;">'+
                            '<h5 class="card-header">'+
                                '<!--Cabecera del menu desplegable-->'+
                                '<a data-toggle="collapse" href="#contenido' + leccion.secuencia+ '" aria-expanded="true" aria-controls="contenido' + leccion.secuencia+ '"'+
                                    'id="leccion' + leccion.secuencia+ '" class="d-block">'+
                                    '<i class="fa fa-chevron-down pull-right"></i>'
                                    + leccion.secuencia +'. '+ leccion.nombre +
                                '</a>'+
                            '</h5>'+
                        '<div id="contenido' + leccion.secuencia+ '" class="collapse" aria-labelledby="leccionUno">'+
                            '<!--Contenido del menu desplegable-->'+
                            '<div class="card-body">'+
                                '<h6>Este es el contenido de la leccion</h6>'+
                                '<p>' + leccion.descripcion+ '</p>'+
                            '</div>'
                    );

                for (const tema of leccion.temas) {
                    let ocultar = false;
                    if ($('#check_id').is(":checked")){
                        let calificacion = 0;
                        if(tema.evaluado){
                            calificacion =( (tema.evaluado.porcentaje * 10) /  tema.evaluado.total/100);
                        }
                        if(calificacion > 9) ocultar = true;

                        let rec = tema.recomendado || 'nada';
                       

                        var a = tema.materials;
                        var swapp;
                        var n = a.length-1;
                        var x=a;
                        do {
                            swapp = false;
                            for (var i=0; i < n; i++)
                            {
                                if(tema.materials[i].valoracion){
                                    
                                        
                                    if ( x[i].valoracion.valoracion < x[i+1].valoracion.valoracion  || ( rec ==  x[i+1].id))
                                    {
                                        if (x[i].id != rec){
                                            var temp = x[i];
                                            x[i] = x[i+1];
                                            x[i+1] = temp;
                                            swapp = true;
                                        }
                                    }
                                }  
                            }
                            n--;
                        } while (swapp);
                        tema.materials = x;

                    }

                    if(!ocultar){
                        $('#contenido'+leccion.secuencia+'').append('<div class="card rounded-0"  >'+
                                                                       '<h5 class="card-header" style="height: 70px;">'+
                                                                           '<a data-toggle="collapse" href="#content'+tema.id+'" aria-expanded="true"'+
                                                                               'aria-controls="content'+tema.id+'" id="Tema'+tema.id+'" class="d-block">'+
                                                                               '<i class="fa fa-chevron-down pull-right"></i>'+
                                                                               '<p class="font-weight-bold temas"><small> <span class=" badge badge-primary badge-pill pull-right">'+tema.avance+'%</span>Tema '+tema.secuencia+': '+tema.nombre+'</small><p>'+
                                                                           '</a>'+
                                                                       '</h5>'+
                                                                   '<div id="content'+tema.id+'" class="collapse carta-body" aria-labelledby="Tema'+tema.id+'">'+
                                                                   '<!--<div class="card-body carta-body" style="width: 100%;">'+
                        
                                                                   '</div>-->'+
                                                                   '</div>'+
                                                                   '</div>');

                    }

 
                    let p = 0;

                    for (const material of tema.materials) {

                        if(!ocultar){
                            if(Ultimo == null || (claveUsuario != ult.claveUsuario)  ){ //Si no habia un ultimo en local o la clave de usuario del ultimo guardado es diferente al usario actual
                                
                                if(!reconmendButton ) {
                                    but = material.descripcion_material.split(".");
                                    name = but[0].replace(/_/g, ' ');
                                    let ru = '&quot Material/'+material.clave_curso+'/'+leccion.clave+'/'+material.id_temas+'/'+name+'&quot';
                                    uta = ru.split(".");
                                    ava =  material.avance || 0;
                                    idmat = material.id;
                                    tipo = ''+material.tipo_material+'';
                                    icono = '';
		                    	    switch (tipo) {
		                    	    	case '1':
		                    	    		icono = 'fas fa-play-circle fa-sm';
		                    	    		break;
		                    	    	case '2':
		                    	    		icono = 'fas fas fa-volume-up fa-sm';
		                    	    		break;
		                    	    	case '3':
		                    	    		icono = 'fas fa-file-pdf fa-sm';
		                    	    		break;
		                    	    	default:
                                        
		                    	    		break;
		                    	    }
                                    $('#boton').html('');
                                    //Los datos obtenidos se guardan en el boton que muestra el ultimo material visitado de este curso
                                    $('#boton').append('<br><button type="button" style="color:#000000; text-decoration:none;" class="btn btn-link" onclick="mostrar(  '+uta[0]+' ,'+tipo+','+ava+','+idmat+');">  <h2 style="margin: 0px; padding:0px;" id="bot"> '+'<span class="'+icono+'"></span> '+name+'</h2>'+
                                                        ` &nbsp;  <small>  &nbsp; &nbsp; Recomendado  &nbsp; &nbsp; </small>`+
                                                        '</button>');
                                    reconmendButton = true;
                                } 
                            }
                        }



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
                        let recomendado = '';
                        if ($('#check_id').is(":checked")){
                            if( tema.recomendado == null ){
                                if(p===0) recon = 'border-left: 3px solid green; background-color:#f0f0f0;';
                            } else if( tema.recomendado == material.id) {
                                recomendado = 'Recomendado';
                                recon = 'border-left: 3px solid green; background-color:#f0f0f0;';
                            }
                        }
                        let avanceMaterial = material.avance || 0;
                        let nombre = material.descripcion_material.split(' ').join('_');
                        let ruta = '&quot Material/'+material.clave_curso+'/'+leccion.clave+'/'+material.id_temas+'/'+nombre+'&quot';
                        let duracion = material.duracion || 0;
                        let porcentaje = avanceMaterial * 100 / duracion;                                                                           
                        $('#content'+tema.id+'').append('<button style="width: 100%;'+recon+' border-radius: 0px;" class="btn btn-link" onclick="mostrar('+ruta+','+tipo+','+avanceMaterial+','+material.id+');"><p class="h6 pull-left">'+ 
                                                        '<span class="'+icono+'"></span> &nbsp; '+
                                                        ''+material.descripcion_material+''+
                                                        `<br><small class="pull-left">${ (((material.avance || 0)/60).toFixed()) } | ${ (((material.duracion || 0)/60).toFixed())} min &nbsp; &nbsp; &nbsp; <small> ${ recomendado }  </small> </small>`+
                                                        '</p>'+
                                                        '</button><br>');
                                                        p++;
                    }
                }

            }
        }


        function CargarInfoCursos()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/TemarioController/ConsultarPorIDCursos?IdCurso=<?php echo $curso = $_GET['curso'];?>',    
                dataType:"json",
                success:function(resp)
                {
                    
                    $("#imagen").append(
                        '<img class="card-img-top h-75 w-75" src="data:image/jpg;base64,'+ resp[0].foto+'" alt="Proyecto 1">'
                    );

                    $("#info").append(

                        '<h2 class="text-white">' + resp[0].nombre +'</h2>'+
                        '<h4 class="text-white">has completado: 1 leccion de 5</h4>'+
                            '<div class="progress">'+
                                '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"'+
                                'aria-valuemin="0" aria-valuemax="100" style="width:' + resp[0].avance +'%">'+
                                    resp[0].avance +'% de progreso'+
                                '</div>'+
                            '</div>'+
                        '<div id="boton"></div>'
                        
                    );                    
                }
            });
        }
        /**
         * Esta funcion sirve para enviar datos a la vista de materiales los cuales sirven para mostrar
         * Los ultimos materiales visitados en el curso 
         */
        function mostrar(data,tipo,ava = null,claveMaterial = null){
            var url = '<?php echo site_url('/Material?curso='.$curso);?>';// almacena la la url de la vista material
            if(claveMaterial) claveMat = claveMaterial;
            var form = $('<form action="' + url + '" method="post" class="d-none">' + // contiene un string con los datos de un formulario
              '<input type="text" name="materialSend" value="' + data + '" />' +
              '<input type="text" name="tipo" value="' + tipo + '" />'+
              '<input type="text" name="avance" value="'+ava+'" />'+
              '<input type="text" name="claveMat" value="'+claveMat+'" />'+
              '</form>');
            $('body').append(form);//se agrega el formulario al html de la pagina 
            form.submit();//se realiza el submit del formulario
        }
    </script>  

     
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>
</body>
</html>