<?php
require("../connect_db.php");
$array_cursos = $_POST['miorden'];

$orden = 1;
foreach($array_cursos as $id_curso){
	$resultado_cursos = "UPDATE Temas SET secuencia = $orden WHERE id = $id_curso";
	$resultado_cursos = mysql_query($resultado_cursos);	
	$orden++;
}
echo "<p><span style='color: green;'>La lista ha sido cambiada.</span></p>";