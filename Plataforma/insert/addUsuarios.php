<?php
    $calve = $_POST['calve']);        
    $pwd = ($_POST['pwd']);
    $pwd2 = ($_POST['pwd2']);
    $tipo = ($_POST['tipo']);
    $valida = 0;
    if ($pwd != $pwd2) {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
        $valida++;
    }

    if ($valida == 0) {
        require("connect_db.php");
        $insert = mysql_query("INSERT INTO `Usuario`(`clave`, `password`, `tipo`, `activo`) VALUES ('$clave','$pwd','$tipo',1)");
        if ($insert == false) {
            echo "<script> alert('El usuario no fue registrado.')</alert>";
        }
        mysql_close($link);
    }
    echo "<script>location.href='../usuarios.php'</script>";

?>