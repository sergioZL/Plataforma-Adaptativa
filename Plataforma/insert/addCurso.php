<?php
	session_start();
	$clave  	 = $_POST['clave'];
	$nombre 	 = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$clave_carrera = $_POST['clave_carrera'];

	$image = addslashes($_FILES['campoarchivo']['tmp_name']);
	$name  = addslashes($_FILES['campoarchivo']['name']);
	$image = file_get_contents($image);
	$image = base64_encode($image);

	require("../connect_db.php");
	$rs = mysql_query("INSERT INTO `Cursos`(`clave`, `nombre`, `descripcion`, `foto`, `clave_carrera`) VALUES ('$clave','$nombre','$descripcion','$image','$clave_carrera')");
	if ($rs == false) {
		echo "<script>alert('El curso no fue guardado');</script>";
	}else{
		$_SESSION["u_curso"] = $clave;
		$_SESSION["u_FormActiva"] = 'lecciones';
	}
	mysql_close($link);
	echo "<script>location.href='../configuracion.php'</script>";
?>