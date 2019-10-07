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
    <title>Buscar</title>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/diseñoMicurso.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
</head>
<body>

    <?php
        $this->load->view('Cursos/Nav');
    ?>
<br>
    
    <h3>Resultados de "<?php echo $this->input->get('nombre');?>"</h3>
    <div id="ContenedorCursos" class="card-deck ContenedorCursos">

    </div>
    


    <script>        


        CargarCursos();        
        
        function CargarCursos()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/BuscarController/ConsultarBuscarCursos?nombre=<?php echo $this->input->get('nombre');?>',    
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


<script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>  



</body>      
</html>