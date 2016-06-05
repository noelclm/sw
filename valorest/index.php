<?php

session_start();
session_regenerate_id(true);

// Cargamos los ficheros necesarios
require_once('definitions.php');
require_once('dataaccess.php');
require_once('functions.php');
require_once('security.php');

// Borra las sesiones que han caducado
logOutOldSession();

$message = "";
$page = "";

// Si ha expirado la sesion
if(!checkSession()){
    $message = EXPIRED_SESSION;
}

// Si no esta logeado comprueba las cookies
if(!isset($_SESSION['Login']) || !$_SESSION['Login']){
    checkCookie();
}

// Si ha pulsado en logout
if((isset($_GET['logOut']) && $_GET['logOut']) || (isset($_POST['logOut']) && $_POST['logOut'])){
    logOut();
    $message = FAREWELL_MESSAGE;
}

// Si se acaba de loguear
if(isset($_POST['login']) && $_POST['login'] && isset($_POST['username']) && isset($_POST['password'])){
    login($_POST['username'],$_POST['password']);
}

// Comprueba a que pagina tiene que ir, por defecto a principal
if(isset($_POST['page']) && $_POST['page'] != ""){
    $page = $_POST['page'];
}else if(isset($_GET['page']) && $_GET['page'] != ""){
    $page = $_GET['page'];
}else{
    $page = 'principal';
}

// Imprime el codigo generado
echo generateHTML($page,$message);

?>