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
    <title>Mi Cursos</title>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/diseñoMicurso.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css"/><!--
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css"/>-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       

    <style>
        * {
            text-decoration: none;
            color: black;
        }

        .filterDiv {
            float: left;
            display: none;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body>
    <?php
        $this->load->view('Cursos/Nav');
    ?>

    <div class="filtrar">
        <div class="row">
            <div class="col-4">
                <h6>Ordenar por</h6>
                <div class="ordenar">
                    <div class="dropdown text-left">
                        <button type="button" class="btn btn-primary dropdown-toggle btnDrop" data-toggle="dropdown">Ordenar por</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="ordenarAZ" href="#">Titulo: de A a Z</a>
                            <a class="dropdown-item" id="ordenarZA" href="#">Titulo: de Z a A</a>
                            <a class="dropdown-item" id="ordenarMen" href="#">Completado: del 0% a 100%</a>
                            <a class="dropdown-item" id="ordenarMay" href="#">Completado: del 100% a 0%</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <h6>Filtrar por</h6>
                <div class=" dropdown text-left">                
                    <button type="button" class="btn btn-primary dropdown-toggle btnDrop" data-toggle="dropdown">Categoria</button>
                    <div id="TemasCursos" class="dropdown-menu">
                        <!--<a class="dropdown-item" href="#">Redes</a>
                        <a class="dropdown-item" href="#">Programacion</a>
                        <a class="dropdown-item" href="#">Base de datos</a>-->
                    </div>
                </div>
            </div>
            <div class="col-4">
                <h6>Filtrar por</h6>
                <div class=" dropdown text-left BtnContainer">
                    <button type="button" class="btn btn-primary dropdown-toggle btnDrop" data-toggle="dropdown">Progreso</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item pointer" onclick="filterSelection('todos')">Todos</a>
                        <a class="dropdown-item pointer" onclick="filterSelection('Completos')">Completos</a>
                        <a class="dropdown-item pointer" onclick="filterSelection('EnCurso')">En Curso</a>    
                        <a class="dropdown-item pointer" onclick="filterSelection('SinEmpezar')">Sin empezar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>Mis Cursos</h3>
    <div id="ContenedorCursos" class="ContenedorCursos" style="margin-top: 20px; left: 25px;">       
              
        </div>            
    </div>

    <br><br>


    <script>        

        CargarCursos(1);
        CargarTemas();

        function CargarTemas()
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/MisCursosController/ConsultarCursosTodosTemasUsuarios',    
                success:function(resp)
                {
                    $("#TemasCursos").append(resp);
                }
            });
        }

        function CargarCursos(tipo)
        {
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/MisCursosController/ConsultarCursosUsuarios?tipo='+tipo,    
                success:function(resp)
                {
                    $("#ContenedorCursos").append(resp);
                    filterSelection("todos"); 
                }
            });
        }

        $('#buscar').click(function()
        {
            if( $("#textBuscar").val() != "")
                window.location.href="<?php echo site_url();?>/Cursos/Buscar?nombre="+ $("#textBuscar").val();
        });

        function filtrarTemas(categoria)
        {
            //alert(categoria);
            
            $("#ContenedorCursos").children().remove();
            $.ajax
            ({
                type:'post',
                url:'<?php echo site_url();?>/Cursos/MisCursosController/ConsultarCursosUsuariosCategoria?categoria='+categoria,    
                success:function(resp)
                {
                    $("#ContenedorCursos").append(resp);
                    filterSelection("todos"); 
                }
            });

        }

        $('#ordenarAZ').click(function()
        {
            $("#ContenedorCursos").children().remove();
            CargarCursos(2);    
        });

        $('#ordenarZA').click(function()
        {
            
            $("#ContenedorCursos").children().remove();
            CargarCursos(3);     
        });

        $('#ordenarMay').click(function()
        {
            $("#ContenedorCursos").children().remove();
            CargarCursos(4);    
        });

        $('#ordenarMen').click(function()
        {
            $("#ContenedorCursos").children().remove();
            CargarCursos(5);     
        });

        filterSelection("todos"); 

        function filterSelection(c) 
        {
            var x, i;
            x = document.getElementsByClassName("filterDiv");
            if (c == "todos") c = "";
            for (i = 0; i < x.length; i++) 
            {
                RemoverClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) AgregarClass(x[i], "show");
            }
        }
        
        function AgregarClass(element, name) 
        {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) 
            {
                if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
            }
        }
        
        function RemoverClass(element, name) 
        {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) 
            {
                while (arr1.indexOf(arr2[i]) > -1) 
                {
                    arr1.splice(arr1.indexOf(arr2[i]), 1);     
                }
            }
            element.className = arr1.join(" ");
        }
        
        var btnContainer = document.getElementById("BtnContainer");
        var btns = btnContainer.getElementsByC
        lassName("btn");
        for (var i = 0; i < btns.length; i++) 
        {
            btns[i].addEventListener("click", function()
            {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }

    </script>


        <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>  

    

</body>      
</html>