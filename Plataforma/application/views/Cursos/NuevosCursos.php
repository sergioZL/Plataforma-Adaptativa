<?php
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
    <title>Nuevos Cursos</title>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/diseño.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> 
    <style>
        a:link {
            text-decoration: none;
        }

        a {
           color: black;
        }
    </style>

</head>
<body>


    <?php
        $this->load->view('Cursos/Nav');
    ?>

    <h3>Cursos Recomendados</h3>
    <div id="ContenedorCursos" class="ContenedorCursos">
        
    </div>
    <br>
    <br>

    <script>
        //optiene la clave de usuario actual
        let usuario = '<?php echo $varsesion; ?>';
        $(document).ready(function () {
        
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

        function CargarCursos()
        {
            $.ajax
            ({
                type:'get',
                url:'<?php echo site_url();?>/Cursos/NuevoCursosController/ConsultarCursosUsuarios',
                data: {alumno:usuario},    
                success:function(resp)
                {
                    // $("#ContenedorCursos").append(resp);
                    let cursos = JSON.parse(resp);
                    mostrarCursos(cursos);
                }
            });
        }
        let mostrarCursos = (cursos) => {
            for (const curso of cursos) {
                
                let contenedor = '<div class="card" style="width: 250px; height:auto; margin-left: 20px;">'+
				                    '<a href="Preview?curso='+curso.clave+'">'+
					                    '<div class="Img">'+
						                    '<img class="card-img-top" style="width: 250px; height:250px;" id="IMGCurso" src="data:image/jpg;base64,'+curso.foto+'" alt="Card image cap">'+
					                    '</div>'+
					                    '<div class="card-body ">'+
						                    '<h5 class="card-title text-center">'+curso.nombre+'</h5>'+
						                    '<p class="card-text text-center">'+curso.descripcion+'</p>'+
					                    '</div>'+
				                    '</a>'+
			                     '</div>';

                $("#ContenedorCursos").append(contenedor);
            }
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