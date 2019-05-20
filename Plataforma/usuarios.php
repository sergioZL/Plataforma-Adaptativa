<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Plataforma</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Plataforma">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="estilos/bootstrap-4/css/bootstrap.min.css">
        <link href="estilos/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    </head>
</style>
<body>
    <header class="main-header">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" id="brand" href="configuracion.php"><b>Plataforma</b></a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php"><i class="fas fa-user"></i> Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-key"></i> Cambiar Contraseña</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav> 
    </header>
    <div class="formularios" id="formularios">
        <h2>Registro de Usuarios</h2>
        <form action="insert/addUsuarios.php" method="POST">
            <div class="form-group">
                <label for="clave">Clave:</label>
                <input type="text" class="form-control" id="clave" name="clave" placeholder="Clave del estudiante" maxlength="10">
            </div>
            <div class="form-group">
                <label for="pwd">Contraseña:</label>
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Contraseña para la plataforma" maxlength="10">
            </div>
            <div class="form-group">
                <label for="pwd2">Confirmar contraseña:</label>
                <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="Confirmar contraseña para la plataforma" maxlength="10">
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo de estudiante" maxlength="2">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <?php
    include 'modPwd.php';
    ?>
    <script src="estilos/js/jquery-3.2.1.min.js"></script>
    <script src="estilos/bootstrap-4/js/bootstrap.min.js"></script>
</body>
</html>