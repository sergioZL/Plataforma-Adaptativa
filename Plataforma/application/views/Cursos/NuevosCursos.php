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

        function CargarCursos()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/NuevoCursosController/ConsultarCursosUsuarios',    
                success:function(resp)
                {
                    $("#ContenedorCursos").append(resp);
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