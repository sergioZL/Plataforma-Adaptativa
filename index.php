<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Plataforma/app-assets/css/diseño.css">    
    <link rel="stylesheet" href="Plataforma/app-assets/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Login</title>
</head>
<body>


    <div id="contenedor" class="container d-flex justify-content-center">
        <div class="login">
            <form action="session.php" method="POST" >
                <h1 class="title"><h3></h3><img class="login-img" src="Plataforma/app-assets/imagenes/logo.png" title="Plataforma de Cursos" alt="Plataforma de Cursos"> <h3></h3></h1>
                    <br>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="usu" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" value="" onclick="Mostar()">  Mostrar Contraseña</label>
                    </div>
                    <br>

                    <button class="btn btn-primary btn-block">Ingresar</button>
                </p>
                <button id="registerlink" class="btn btn-link btn-block">Registrarse</button>
            </form>
        </div>
    </div>


    <script>

        $('#registerlink').click(function (e) { 
            e.preventDefault();
            var registercard = '<div class="card  w-sm-50" style="margin-top: 5%;">'+
                                  '<br>'+
                                  '<img class="align-self-center login-img border rounded-0 border-dark border-right-0 border-left-0" src="Plataforma/app-assets/imagenes/logo.png" alt="Card image cap">'+
                                  '<div class="card-body">'+
                                    '<form action="session.php" method="POST" >'+
                                        '<div class="form-group">'+
                                            '<input type="number" id="matricula" name="matricula" class="form-control text-center" placeholder="Matricula">'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<input type="password" i name="password" id="password" class="form-control text-center" placeholder="Contraseña">'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<input type="password" name="password2" id="password2" class="form-control text-center" placeholder="Repetir contraseña">'+
                                        '</div>'+
                                        '<div id="alerta2">'+
                                        '</div>'+
                                        '<div class="checkbox">'+
                                            '<label><input type="checkbox" value="" onclick="Mostar()">  Mostrar Contraseña</label>'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<input type="text" id="nombre" name="nombre" class="form-control text-center" placeholder="Nombre(s)">'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<input type="text" id="app" name="app" class="form-control text-center" placeholder="Apellido paterno">'+
                                        '</div>'+
                                        '<div class="form-group">'+
                                            '<input type="text" id="apm" name="apm" class="form-control text-center" placeholder="Apellido materno">'+
                                        '</div>'+
                                        '<select class="custom-select" id="carrera" name="carrera">'+
                                        '</select>'+
                                        '<br>'+
                                        '<br>'+
                                        '<div id="alerta">'+
                                        '</div>'+
                                        '<button id="validar" class="btn btn-primary btn-block">Registrar</button>'+
                                        '</p>'+
                                        '</form>'+
                                        '<button onclick="regresar();" class="btn btn-link btn-block">Regresar</button>'+
                                  '</div>'+
                                '</div>';
            //$('#contenedor').append(registercard);
            $('#contenedor').html(registercard);
            
            $('#validar').click(function (e) { 
                e.preventDefault();
                //validamos que todos los campos del formulario tengan los datos correspondientes
                var validar = true;
                var matricula = $('#matricula').val();
                var contrasena = $('#password').val();
                var contrasena2 = $('#password2').val();
                var nombre = $('#nombre').val();
                var app = $('#app').val();
                var apm = $('#apm').val();
                var carrera = $('#carrera').val();
                if(matricula == '' ) {
                    validar = false
                }
                if(contrasena == '' ) {
                    validar = false
                }
                if(contrasena2 == '' ) {
                    validar = false
                }
                if(nombre == '' ) {
                    validar = false
                }
                if(app == '' ) {
                    validar = false
                }
                if(apm == '' ) {
                    validar = false
                }
                if(carrera == '' ) {
                    validar = false
                }
                if(validar == false){
                    var kstring = '<div class="alert alert-warning" role="alert">'+
                                    '<strong>¡Algunos campos no han sido llenados!</strong>'+
                                 '</div>';
                    $('#alerta').html(kstring);
                    console.log(validar);
                }
                if(contrasena != contrasena2){
                    validar = false;
                    var kstring = '<div class="alert alert-warning" role="alert">'+
                                    '<strong>¡Las contraseñas no coinsiden!</strong>'+
                                 '</div>';
                    $('#alerta2').html(kstring);
                }
                
                
                if(validar == true) $( "form" ).submit();
            });
            showCarreras();
        });

        function regresar(){
            window.location.replace("http://127.0.0.1/Plataforma-Adaptativa/");
        }
        function Mostar() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            var x2 = document.getElementById("password2");
            if (x2.type === "password") {
                x2.type = "text";
            } else {
                x2.type = "password";
            }
        }  
        
        function showCarreras() {
            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1/Plataforma-Adaptativa/Plataforma/index.php/Cursos/BuscarController/getCarreras',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    
                    var carreras = '';
                    var i;
                    carreras = '<option value="0">Selecciona una carrera...</option>';

                    for(i = 0; i < data.length; i++) {
                        carreras += '<option value="'+data[i].clave+'">'+data[i].nombre+'</option>';
                    }
                    $('#carrera').html(carreras);
                },
                error: function() {
                    console.log('hubo un pedo');
                }
            });
        }      

    </script>

</body>
</html>