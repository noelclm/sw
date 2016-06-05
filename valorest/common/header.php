<?php

function getHeader(){

    $html = "<header>\r\n";
                // Con row-column los elemntos que va encontrando los coloca en una fila
                // dependiendo de la resolucion cambia a columna
                "<div class=\"row-column center-margin-auto\">\r\n".
                    // Con grow2 ocupa todo el espacio posible, dejando lo justo para los demas elemntos
                    "<div id=\"logo\" class=\"\">\r\n".
                        "<h1><a href=\"index.php\">ValoRest</a></h1>\r\n".
                    "</div>\r\n".

                    "<div id=\"search\">\r\n".
                        "<form name=\"buscador\" method=\"post\" action=\"\">\r\n".
                            "<input name=\"buscar\" type=\"search\" placeholder=\"Buscar aquí...\" autofocus >\r\n".
                            "<input type=\"image\" name=\"buscador\" src=\"img/".IMAGE_SEARCH."\">\r\n".
                        "</form>\r\n".
                    "</div>\r\n".

                    "<div id=\"sesion\">\r\n";
                    // Dependiendo si esta logeado o no muestra un mensaje distinto
                    if(isset($_SESSION['Login']) && $_SESSION['Login']==true){
                        $html .=  "<a href=\"#?logOut=true\">Salir</a>\r\n";
                    }else{
                        $html .=  "<a href=\"login.php\">Inicia Sesión</a>\r\n";
                    }

    $html .=        "</div>\r\n".

                "</div>\r\n".

            "</header>\r\n".

    return $hmtl;

}

?>