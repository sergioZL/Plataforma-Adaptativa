<?php
  #session_start();
  #if (isset($_SESSION["u_usuario"])) {
  #      $usuario = $_SESSION["u_usuario"];
  #      $tipo_user_u = $_SESSION["u_tipo_user"];
         $usuario = "Luis";
         $tipo_user_u = "Profesor";
  #      require("connect_db.php");
  #      $query = "SELECT * FROM evento WHERE seccion = '".$seccion_u."' ORDER BY nombre";
        
        echo "<!--   CEACIÓN DE CAMBIO DE PWD  -->";
        echo "<div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">";
        echo "  <div class=\"modal-dialog\" role=\"document\">";
        echo "    <div class=\"modal-content\">";
        echo "      <div class=\"modal-header\">";
        echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Cambio de Contraseña</h5>";
        echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">";
        echo "          <span aria-hidden=\"true\">&times;</span>";
        echo "        </button>";
        echo "      </div>";
        echo "      <div class=\"modal-body\">";
        echo "        <form method=\"post\" action=\"edPwd.php\">";
        
        echo "          <div class=\"form-group\">";
        echo "            <label for=\"recipient-name\" class=\"col-form-label\">Usuario:</label>";
        echo "            <input type=\"text\" class=\"form-control\" id=\"nick\" name=\"nick\" value=\"".$usuario."\" readonly>";
        echo "            <label for=\"recipient-name\" class=\"col-form-label\">Tipo de usuario:</label>";
        echo "            <input type=\"text\" class=\"form-control\" id=\"seccion\" name=\"seccion\" value=\"".$tipo_user_u."\" readonly>";
        echo "          </div>";
        
        echo "          <div class=\"form-group\">";
        echo "            <label for=\"recipient-name\" class=\"col-form-label\">Nueva Contraseña:</label>";
        echo "            <input type=\"text\" class=\"form-control\" id=\"pwd\" name=\"pwd\">";
        echo "          </div>";
        
        echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cerrar</button>";
        echo "        <button type=\"submit\" class=\"btn btn-primary\">Cambiar</button>";
        
        echo "        </form>";
        echo "      </div>";
        echo "      <div class=\"modal-footer\">";
        
        echo "      </div>";
        echo "    </div>";
        echo "  </div>";
        echo "</div>";
        echo "<!--  FIN CEACIÓN DE CAMBIO DE PWD  -->";      
  #}else{
  #  echo "<script>location.href='cerrar_sesion.php'</script>";
  #}

?>