<?php
	$enunciado  	 = $_POST['enunciado'];
	$clave_temas = $_POST['clave_temas'];

	$image = addslashes($_FILES['campoarchivo']['tmp_name']);
	$name  = addslashes($_FILES['campoarchivo']['name']);
	$image = file_get_contents($image);
	$image = base64_encode($image);

	require("../connect_db.php");
	$rs = mysql_query("INSERT INTO `Preguntas`(`enunciado`, `imagen`, `id_tema`) VALUES ('$enunciado', '$image','$id_tema')");
	if ($rs == false) {
		echo "<script>alert('La pregunta no fue guardada');</script>";
	}
	mysql_close($link);
	echo "<script>location.href='../configuracion.php'</script>";
?>