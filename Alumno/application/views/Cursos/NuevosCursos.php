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
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
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

<h3>Cursos Recomendados</h3>

    <div class="ContenedorCursos">
        <?php
      
        $Con = mysqli_connect('localhost','root','','plataforma');
    	$consulta = "SELECT * FROM `Cursos`;";
    
    	$rs = $Con->query($consulta);
        while($row = $rs ->fetch_assoc())
        {
        
        ?>

        <a href="Preview?curso=<?php echo $row['clave'] ?>">
        <div class="card" style="width: 250px; height:400px; margin-left: 20px;">
            <div class="Img">
                <img class="card-img-top" style="width: 250px; height:250px;" id="IMGCurso" src="data:image/jpg;base64,<?php echo ($row['foto']); ?>" alt="Card image cap">
            </div>
            <div class="card-body ">
                <h5 class="card-title text-center"><?php echo $row['nombre']?></h5>
                <p class="card-text text-center"><?php echo $row['descripcion']?></p>
            </div>
        </div>
        </a>

        <?php
        }
	
        ?>
    </div>

    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>
</body>
</html>