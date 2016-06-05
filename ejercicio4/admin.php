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
        <?php 
            
            if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true){
                    print_r("<h1>Consola de administración</h1>");
                    print_r("<p>Aquí estarían todos los controles de administración</p>");
                }else{
                    print_r("<h1>Acceso denegado!</h1>");
                    print_r("<p>No tienes permisos suficientes para ver el contenido.</p>");
                }
            }else{
                print_r("<h1>Usuario no registrado!</h1>");
                print_r("<p>Debe iniciar sesión para ver el contenido.</p>");
            }
        
        ?>
    </div>

    <?php include_once("sidebarDer.php"); ?>

    <?php include_once("pie.php"); ?>

</div> <!-- Fin del contenedor -->

</body>
</html>