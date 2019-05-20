<?php
	session_start();
	$clave_leccion  = $_POST['clave_leccion'];
	$nombre 	 	= $_POST['nombre'];
	$secuencia 		= 0;
	require("../connect_db.php");
	$sql = "SELECT count(*) AS cont FROM Temas WHERE id_leccion = '".$clave_leccion."'";
	$sqlRs = mysql_query($sql);
	if ($sqlRs == false) {
		$secuencia = 1;
	}else{
		$st = mysql_fetch_array($sqlRs);
		$secuencia = (int)$st['cont'];
		$secuencia++;
	}

	$sqlInsert = "INSERT INTO `Temas`(`nombre`, `secuencia`, `id_leccion`) VALUES ('$nombre', $secuencia ,'$clave_leccion')";
	$veri =  "<script>alert('".$sqlInsert."');</script>";
	$rs = mysql_query($sqlInsert);

	if ($rs == false) {
		echo "<script>alert('El tema no fue guardado.');</script>";

	}else{
		$_SESSION["u_tema"] = $nombre;
		$_SESSION["u_FormActiva"] = 'temas';
	}
	mysql_close($link);
	echo "<script>location.href='../configuracion.php'</script>";
?>