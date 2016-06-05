<?php session_start(); ?>
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
        
        <h1>Acceso al sistema</h1>
        <fieldset>
            <legend>Usuario y Contraseña:</legend><br>
            <form action="procesarLogin.php" method="post">
                <label for="username">Name:</label><input type="text" name="username" required ><br><br>
                <label for="password">Password:</label><input type="password" name="password" required ><br><br>
                <button type="submit">Entrar</button>
            </form>
        </fieldset>
        
    </div>

    <?php include_once("sidebarDer.php"); ?>

    <?php include_once("pie.php"); ?>

</div> <!-- Fin del contenedor -->

</body>
</html>