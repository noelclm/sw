<?php 
    session_start(); 
    unset($_SESSION['nombre']);
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    unset($_SESSION['esAdmin']);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portada</title>
</head>

<body>

<div id="contenedor">

    <?php include_once("cabecera.php"); ?>

    <?php include_once("sidebarIzq.php"); ?>

    <div id="contenido">
        <h1>Hasta pronto!</h1>
    </div>

    <?php include_once("sidebarDer.php"); ?>

    <?php include_once("pie.php"); ?>

</div> <!-- Fin del contenedor -->

</body>
</html>