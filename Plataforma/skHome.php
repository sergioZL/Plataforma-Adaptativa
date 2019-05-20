<?php
if (isset($_POST['curso'])) {
    $consulta = $_POST['curso'];
    $consulta == "" ? ($sql = "SELECT * FROM Cursos LIMIT 10") : ($sql = "SELECT * FROM Cursos WHERE nombre like '%".$consulta."%'");
}else{
    $sql = "SELECT * FROM Cursos LIMIT 10";
}
$salida = "";
require("connect_db.php");
$st = mysql_query($sql);
if ($st == false) {
    $salida = "Sorry... Algo salio mal. Vuelve a intentarlo.";
}else{
    $salida = "";
    while ($rs = mysql_fetch_array($st)) {
        $nom = $rs['nombre'];
        $salida = $salida."
        <div class=\"jumbotron col-md-3\" style=\"float: left; padding:10px; margin: 5px;\">
            <h3 class=\"display-4\">".$rs['nombre']."</h3>
            <div style=\"width: 250px;
height: 140px;
line-height: 50px;
text-align: center;
color: white;
font-size: 10px;\">
            <img id=\"IMGCurso\" src=\"data:image/jpg;base64,".$rs['foto']."\" style=\"height: 100%;
width: 100%;
overflow: hidden;
margin-block-end: 5px;\"/>
            </div>
            <p class=\"lead\">".$rs['descripcion']."</p>
            <hr class=\"my-4\">
            <p>Presiona el botón para ver y editar.</p>
            <p class=\"lead\">
                <a href=\"edFrmCursos.php?cveCurso='".$rs['clave']."'\">
                <input type=\"button\" class=\"btn btn-primary btn-md\" value=\"Editar\">
                </a>
                <input type=\"button\" class=\"btn btn-warning btn-md\" onclick=\"edCursos('".$rs['clave']."')\" value=\"Borrar\">
            </p>
        </div>";
    }#Fin del while
}
echo $salida;
?>

