<!DOCTYPE html>
<?php 
    session_start();
    $users = array(array('usuario' => 'Juan','username' => 'user','password' => 'userpass'),
                   array('usuario' => 'Administrador','username' => 'admin','password' => 'adminpass'));

    if(isset($_POST['username']) && isset($_POST['password'])){
        
        foreach ($users as $key => $value) {
            if($value['username'] == $_POST['username']){
                if($value['password'] == $_POST['password']){
                    $_SESSION['nombre'] = $value['usuario'];
                    $_SESSION['username'] = $value['username'];
                    $_SESSION['login'] = true;
                    if($value['username'] == 'admin'){
                        $_SESSION['esAdmin'] = true;
                    }
                }
            }
        }
    }
?>
 
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
                print_r("<h1>Bienvenido ".$_SESSION['nombre']."</h1>");
                print_r("<p>Use el menú de la izquierda para navegar.</p>");
            }else{
                print_r("<h1>Usuario no registrado!</h1>");
                print_r("<p>Debe iniciar sesión para ver el contenido</p>");
            }
        
        ?>
        
    </div>

    <?php include_once("sidebarDer.php"); ?>

    <?php include_once("pie.php"); ?>

</div> <!-- Fin del contenedor -->

</body>
</html>