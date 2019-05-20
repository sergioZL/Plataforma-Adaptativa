<?php
        $uploadedfileload="true";
        #$uploadedfile_size=$_FILES[uploadedfile][size];
        $id_tema = ($_POST['id_tema']);
        $descripcion = $_POST['descripcion'];
        
        $msg = 'No ha seleccionado ninguna foto';
        
        #echo $_FILES['uploadedfile'][name];
        
        $add='../archivos/';
        $fichero_subido = $add.$id_tema.basename($_FILES['campoarchivo']['name']);
        $msj = '<script>alert('.$fichero_subido.')</script>';
        echo $msj;
        require("../connect_db.php");
        #$sql = "SELECT count(archivo) AS conteo FROM Recursos WHERE archivo = '$fichero_subido'";
        #$stsql = mysql_query($sql);
        #if ($stsql) {
            #$rssql = mysql_fetch_array($stsql);
            #if ((int)$rssql == 0) {
                if($uploadedfileload=="true"){
                    if(move_uploaded_file($_FILES['campoarchivo']['tmp_name'], $fichero_subido)){
                        #echo '<script>alert("Foto guardada")</script>';
                        #Actualización de fotos
                        $st = mysql_query("INSERT INTO `Recursos`(`archivo`, `descripcion`, `id_tema`) VALUES ('$fichero_subido','$descripcion','$id_tema')");
                        if ($st == false) {
                            echo "<sccript>alert('El archivo no pudo ser guardado');</script>";
                        }else{
                            echo "<sccript>alert('El archivo guardado correctamente.');</script>";
                        }
                    }else{
                        print_r($_FILES);
                        echo '<script>alert("Error al guardar el archivo")</script>';
                        #echo "<script>location.href='administracion.php'</script>";
                    }
                }
            #}else{
            #    echo "<sccript>alert('Ya existe un archivo con ese nombre');</script>";
            #}
        #}
        mysql_close($link);    
        $_SESSION["u_FormActiva"] = 'recursos';  
        echo "<script>location.href='../configuracion.php'</script>";
?>
