<?php

// Acceso a base de datos
define("SERVER_CONNECTION", "localhost");
define("USER_CONNECTION", "valorest");
define("PSW_CONNECTION", "0tserolav1");
define("BBDD_CONNECTION", "valorest");

// Parametros
define("IDLE_TIME", 604800); // En segundos (Un dia = 86400, Una semana = 604800)

// Tipos de roles
define("ROL_ADMIN", 1); define("LABEL_ROL_ADMIN", "Administrador");
define("ROL_EDIT", 2); ; define("LABEL_ROL_EDIT", "Editor");

global $ARRAY_ROLES; 
$ARRAY_ROLES = array(array(LABEL_ROL_ADMIN, ROL_ADMIN),
                     array(LABEL_ROL_EDIT, ROL_EDIT));

// Textos comunes
define("TITLE_APLICATION", "ValoRest");
define("AUTHOR_APLICATION", "Noel Clemente");
define("EXPIRED_SESSION", "La sesión ha caducado, vuelva a logearse.");
define("FAREWELL_MESSAGE", "Hasta pronto!");

// Imagenes
define("IMAGE_SEARCH", "search.png");

?>