<?php
$salida = "
<ul id=\"mi_lista\">";
    require("connect_db.php");
    $resultado_cursos = "SELECT * FROM Temas ORDER BY secuencia ASC";
    $resultado_cursos = mysql_query($resultado_cursos);
    while($registro_cursos = mysql_fetch_array($resultado_cursos)){
        $salida = $salida . "
        <li id=\"miorden_". $registro_cursos['id']."\">".
            $registro_cursos['id'] . " - ". $registro_cursos['nombre']."
        </li>";
    }
$salida = $salida . "</ul>";
echo $salida;
?>