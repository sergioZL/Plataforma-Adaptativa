<?php
	session_start();
	$clave_curso  	 = $_POST['clave_tcurso'];
	$nombre 	 = $_POST['nombre'];
	$secuencia = 0;
	require("../connect_db.php");
	$sql = "SELECT count(*) AS cont FROM Lecciones WHERE clave_curso = '".$clave_curso."'";
	$sqlRs = mysql_query($sql);
	if ($sqlRs == false) {
		$secuencia = 1;
	}else{
		$st = mysql_fetch_array($sqlRs);
		$secuencia = (int)$st['cont'];
		$secuencia++;
	}

	$sqlInsert = "INSERT INTO `Lecciones`(`nombre`, `secuencia`, `clave_curso`) VALUES ('$nombre', '$secuencia','$clave_curso')";
	$rs = mysql_query($sqlInsert);

	if ($rs == false) {
		echo "<script>alert('El tema no fue guardado.');</script>";
	}else{
		$_SESSION["u_leccion"] = $nombre;
		$_SESSION["u_FormActiva"] = 'temas';
	}
	mysql_close($link);
	echo "<script>location.href='../configuracion.php'</script>";
?>