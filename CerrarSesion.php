<?php

    session_start();

    error_reporting(0);

    $varsesion = $_SESSION['usuario'];

    if($varsesion == null|| $varsesion = '')

    {

        header("location: index.php");

        die();

    }

    session_destroy();

    header("Location: index.php");

?>