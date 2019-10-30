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
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>       
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script>    

    <style>
        /* * {
            text-decoration: none;
            color: black;
        } */
        h6, li, div,p {
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
        /**
        * Sirbe para cargar el ultimo material visto de este curso
        * El cual se almacena en el localstorage del navegador 
        */
        function mostrar(id){
            let claveUsuario = '<?php echo $varsesion ?>';
            let esSession = false;
            // De esta forma se obtiene el ultimo material visto del curso el cual se optiene
            // por medio del local storage usando el id del curso como clave
            var Ultimo = window.localStorage.getItem(id); //se obtiene un JsonString como resultado


            if(Ultimo != null){ //si existe se carga en un objeto y se accede a los datos de la variable
                ult  = JSON.parse(Ultimo); //Se convierte el JsonString a objeto para poder disponer de sus datos
                if(claveUsuario === ult.claveUsuario) esSession = true;
                ruta = ult.url.substring(50);//contiene la ruta del material
                uta  = ruta.split(".");//se divide en un vector para eliminar la extencion del archivo
                ava  = ult.avance;//contiene el avance del material visitado
                tipo = ult.tipo;//contiene el tipo de material que se esta bisitando existen solo 3 tipos
                claveMat = ult.material;
            }
            console.log(esSession);
            
            if(Ultimo == null || !esSession){/**Si no existe un ultimo material visitado de este curso se consulta a la base de datos
                      Cual es el ultimo material visto del curso para que este pueda ser mostrado
                       */
                
                
                 $.ajax({
                     type: "post",
                     url: "<?php echo site_url();?>/Cursos/MisCursosController/CargarUltimo",
                     data: {claveCurso:id,claveAlumno:'<?php echo $varsesion; ?>'},
                     async:false,
                     success: function (response) {
                        if(response != 'null'){
                         console.log(response );
                    
                         obj = JSON.parse(response);
                         claveMat = obj.id;
                         ruta = "Material/"+obj.clave_curso+"/"+obj.leccion+"/"+obj.tema+"/"+obj.Descripcion+".mpg";
                         uta  = ruta.split(".");
                         tipo = obj.tipo;
                         ava = obj.avance;
                        }else{
                            /**
                             * Si no hay un ultimo curso revisdado en la base de datos entonces cargamos el primer 
                             * material del curso con orden de temas
                             */
                            $.ajax({
                                type: "post",
                                url: "<?php echo site_url();?>/Cursos/MisCursosController/CargarPrimerMaterial",
                                data: {claveCurso:id},
                                async:false,
                                success: function (response) {
                                    obj = JSON.parse(response);
                                    claveMat = obj.id;
                                    ruta = "Material/"+obj.clave_curso+"/"+obj.leccion+"/"+obj.tema+"/"+obj.Descripcion+".mpg";
                                    uta  = ruta.split(".");
                                    tipo = obj.tipo;
                                    ava = 0;
                                }
                            });
                        }
                     }
                 });
            }
            var url = '<?php echo site_url();?>/Material?curso='+id+'';
            
            var form = $('<form action="' + url + '" method="post">' +
              '<input type="text" name="materialSend" value="' + uta[0] + '" />' +
              '<input type="text" name="tipo" value="' + tipo + '" />'+
              '<input type="text" name="avance" value="'+ava+'" />'+
              '<input type="text" name="claveMat" value="'+claveMat+'" />'+
              '</form>');
            $('body').append(form);
            form.submit(); 
        }

    </script>


        <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/popper.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>app-assets/js/myjs.js"></script>  

    

</body>      
</html>