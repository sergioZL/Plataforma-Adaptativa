<?php
session_start();
$username = $_POST['usu']; 
$pwd = $_POST['password'];

$regreso = 0;
$_SESSION['usuario'] = $username;

header("location:Alumno/index.php/alumno/MisCursos");

require("Plataforma/connect_db.php");
$sql2=mysql_query("SELECT * FROM Usuario WHERE clave ='$username'");

if ($sql2 == false) {
	echo "<script>alert('Error al consultar el usuario. Vuelva a intentarlo')</script>";
	$regreso++;
}

if ($regreso == 0) {
	$rs = mysql_fetch_array($sql2);
	if ($rs == false){
		$regreso++;
		echo "<script>alert('Error al realizar consulta. Vuelva a intentarlo')</script>";
	}
}
	
if ($regreso == 0) {	 
	if ($rs['activo'] == false) {
		$regreso++;
		echo "<script>alert('El usuario no esta activo.')</script>";
	}
}

if ($regreso == 0) {
	if ($rs['password'] == $pwd) {
		$tip = $rs['tipo'];
				switch ($tip) {
					case 'al':
						header("location:Alumno/index.php/alumno/MisCursos");
						break;
					case 'pr':
						header("location:Plataforma/home.php");
						break;
					case 'su':
						header("location:Plataforma/usuarios.php");
						break;
					default:
						echo "<script>alert('Error en el registro')</script>";
						break;
	}#cierra switch
}else{
	$regreso ++;
	echo "<script>alert('La contraseña no es correcta.')</script>";
	}#else
}#if

if ($regreso > 0) {
	echo "<script>location.href='index.php'</script>";
}