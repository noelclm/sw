<?php

$page = "<h2>Inicia Sesión</h2>".
           "<fieldset>".
              "<form action=\"index.php\" method=\"post\">".
                  "<label for=\"username\">Nombre:</label><input type=\"text\" name=\"username\" required ><br><br>".
                  "<label for=\"password\">Contraseña:</label><input type=\"password\" name=\"password\" required ><br><br>".
                  "<input type=\"hidden\" name=\"login\" value=true>".
                  "<button type=\"submit\">Entrar</button>".
              "</form>".
           "</fieldset>";

echo $page;

?>