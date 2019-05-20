<?php
// Datos del servidor MySQL
$servidor = "localhost";
$usuariodb = "root";
$passworddb = "";
$database = "plataforma";
	
//Creando la conexion con el servidor
$conexion = mysqli_connect($servidor, $usuariodb, $passworddb, $database);