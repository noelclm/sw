<?php

//-------------------------------------------------------------------
// Funciones para interacturar con la base de datos
//-------------------------------------------------------------------

// Consulta en la base de datos y devuelve un array con los resultados
function consult($sql){
    
    $result = array();
    $bd = new DataAccess();
    $bd->run($sql);
    
    while(($fila = $bd->row()) !== false ){
        $result[] = $fila;
    }
 
    $bd->close();
    unset($bd);
    
    return $result;
    
}

// Modifica una entrada en la base de datos y devuelve true o false si da error
function modify($sql){
    
    $bd = new DataAccess();
    $result = $bd->run($sql);
    $bd->close();
    unset($bd);
    
    return $result;

}

// Inserta una nueva entrada en la base de datos y devuelve el id de la entrada o false si da error
function insert($sql){
    
    $bd = new DataAccess();
    if($bd->run($sql)){
        $result = lastId();
    }
    else{
        $result = false;
    }
    $bd->close();
    unset($bd);
    
    return $result;

}

// Elimina una entrada en la base de datos y devuelve true o false si da error
function remove($sql){
    
    $bd = new DataAccess();
    $result = $bd->run($sql);
    $bd->close();
    unset($bd);
    
    return $result;

}

// Busca en la base de datos el menu del tipo que se selecione y con los permisos del usuario
// lo devuelve en un array
function getMenu($type = 0){

    if(!isset($_SESSION['Rol'])){
        $result = consult("SELECT page,name,parameter FROM menu WHERE permissions = 0 AND type = ".$type." ORDER BY order ASC;");
    }
    else{
        $result = consult("SELECT page,name,parameter FROM menu WHERE permissions <= ".$_SESSION['Rol']." AND type = ".$type." ORDER BY order ASC;");
    }

    return $result;

}

//-------------------------------------------------------------------
// Funciones globales
//-------------------------------------------------------------------

// Genera el html a mostrar de cada página
function generateHTML($page,$message){

    require_once('header.php');
    require_once('footer.php');
    if(file_exists('../pages/'.$page.'.php')){
        require_once('../pages/'.$page.'.php');
    }else{
        require_once('../pages/404.php');
    }
    
    $html = "<html>\r\n";

    $html.= "<head>\r\n";
    $html.=     "<title>".TITLE_APLICATION."</title>\r\n";
    $html.=     "<meta charset=\"utf-8\"/>\r\n";
    $html.=     "<meta name=\"author\" content=\"".AUTHOR_APLICATION."\">\r\n";
    $html.=     "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estructura.css\" />\r\n";
    $html.=     "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/interfaz.css\" />\r\n";
    $html.= "</head>\r\n";

    $html.= "<body class=\"column\">\r\n";

    // Pone el header
    $html.= getHeader();

    // Con row-column los elemntos que va encontrando los coloca en una fila
    // dependiendo de la resolucion cambia a columna
    $html.= "<div class=\"center-margin row-column \">\r\n".

    // Con grow2 ocupa todo el espacio posible, dejando lo justo para los demas elemntos
    $html.= "<div id=\"carcase\" class=\"grow2\">\r\n";
    
    // Pone los datos de la pagina que va a mostrar
    $html.= getPage();


    $html.= "</div>\r\n</div>\r\n".

    // Pone el pie de página
    $html.= getFooter();        

    $html.= "</body>\r\n</html>\r\n";

    // Devuelve el codigo html de la pagina
    return $html;
}

?>