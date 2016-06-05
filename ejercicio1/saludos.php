<!DOCTYPE html>
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Mi Primera WEB</title>
        
    </head>
    <body>
    
        <?php
        
            $total = $_GET["num"];
            
            echo "<h1>Me has pedido que te salude ".$total." veces.</h1>";

            if($total == 42){
                echo '<p>En realidad, esa es la respuesta a la pregunta final sobre la vida, el universo y todo lo demás.</p>';
            }else{
                for($i = 0; $i < $total; $i++)
                    echo "<p>".$i." - ¡Hola Mundo!</p>";
            }            
            
        ?>
        
    </body>
</html>