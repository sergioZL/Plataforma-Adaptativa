<?php
	$link =mysql_connect("172.16.50.92", "ti", "MYZhhWxV5QAye34A");
	if($link){
		mysql_select_db("ti", $link);
	}else{
		echo "<script>alert('Error en conexion a bd: ".mysql_error()."')</script>";
	}
?>