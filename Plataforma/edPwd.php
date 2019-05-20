<?php 
  session_start();
  if (isset($_SESSION["u_usuario"])) {
        // RECEPCION DE PARAMETROS
        $nick=($_POST['nick']);
        $pwd=($_POST['pwd']);
        $tipo_usuario = $_POST['u_tipo_user'];
        
        #Actualización de Avance
        require("connect_db.php");
        $actualizar=mysql_query("UPDATE tblusuarios SET pwd=MD5('$pwd') WHERE tipo_usuario='$tipo_usuario' and nick = '$nick'");
        if ($actualizar==false) {
        	echo '<script language="javascript">alert("Error al modificar Contraseña");</script>';
        }
        
        mysql_close($link);
        echo "<script>location.href='configuracion.php'</script>";      
  }else{
    echo "<script>location.href='cerrar_sesion.php'</script>";
  }

 ?>