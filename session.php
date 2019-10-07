<?php
session_start();
$username = $_POST['usu']; 
$pwd = $_POST['password'];

$regreso = 0;
$_SESSION['usuario'] = $username;

//$conexion = mysqli_connect("172.16.50.92:3306","ti","MYZhhWxV5QAye34A","ti");
$conexion = mysqli_connect("127.0.0.1:3306","ti","MYZhhWxV5QAye34A","ti");

$consulta="SELECT * FROM usuario WHERE clave ='$username'";
$sql2 = mysqli_query($conexion,$consulta);



if ($sql2 == false) {
	echo "<script>alert('Error al consultar el usuario. Vuelva a intentarlo')</script>";
	$regreso++;
}
 
if ($regreso == 0) {
	$rs = $sql2->fetch_assoc();
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
						header("location:Plataforma/index.php/alumno/MisCursos");
						break;
					case 'pr':
						//header("location:Plataforma/index.php/cursos/nuevo_curso");
						header("location:Plataforma/index.php/cursos/todos");
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