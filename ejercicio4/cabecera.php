<div id="cabecera">
    <h1>Mi gran página web</h1>
    
    <?php   
        if(isset($_SESSION['login']) && $_SESSION['login']==true){
            print_r("<div class=\"saludo\">Bienvenido, ".$_SESSION['nombre'].". <a href='logout.php'>Salir</a></div>");
        }else{
            print_r("<div class=\"saludo\">Usuario desconocido. <a href='login.php'>Login</a></div>");
        }
        
    ?>
    
</div>