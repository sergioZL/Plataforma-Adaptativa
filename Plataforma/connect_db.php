<?php
	$link =mysql_connect("localhost", "root", "");
	if($link){
		mysql_select_db("plataforma", $link);
	}else{
		echo "<script>alert('Error en conexion a bd: ".mysql_error()."')</script>";
	}
?>