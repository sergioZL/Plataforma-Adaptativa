<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Alumno/app-assets/css/diseño.css">    
    <link rel="stylesheet" href="Alumno/app-assets/css/bootstrap.min.css">
    <script src="sitio/js/jquery.min.js" charset="utf-8"></script>
    <title>Login</title>
</head>
<body>


    <div class="container">
        <form action="session.php" method="POST" class="login">
            <h1 class="title"><h3></h3><img class="login-img" src="Alumno/app-assets/imagenes/logo.png" title="Plataforma de Cursos" alt="Plataforma de Cursos"> <h3></h3></h1>
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

                <button class="btn btn-primary btn-block">Inglesar</button>
            </p>
        </form>
    </div>


    <script>
        function Mostar() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>

    <script src="sitio/js/jquery-3.3.1.min.js"></script>
    <script src="sitio/js/popper.min.js"></script>
    <script src="sitio/js/bootstrap.min.js"></script>

</body>
</html>