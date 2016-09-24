<?php

/*
	Practica ValoRest: Pagina par la asignatura SW
    Copyright (C) 2016  
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Hace todas las comprobaciones al cargar la pagina
function start($rol = 0){

    // Borra las sesiones que han caducado
    logOutOldSession();

    // Si la seccion es solo para un tipo de rol comprueba que sea el adecuado
    if($rol != 0 && (!isset($_SESSION['Rol']) || $_SESSION['Rol'] < $rol)){
      header('Location: sinpermisos.php');
    }

    $message = "";

    // Si no esta logeado comprueba las cookies
    if(!isset($_SESSION['Login']) || !$_SESSION['Login']){
        checkCookie();
    }else{
        // Si ha expirado la sesion
        if(!checkSession()){
            $message = "La sesión ha caducado, vuelva a logearse.";
        }   
    }

    // Si ha pulsado en logout
    if(((isset($_GET['logOut']) && $_GET['logOut']) || (isset($_POST['logOut']) && $_POST['logOut'])) && (isset($_SESSION['Login']) && $_SESSION['Login'])){
        logOut();
        $message = "Hasta pronto!";
    }

    // Si se acaba de loguear
    if(isset($_POST['login']) && $_POST['login'] && isset($_POST['username']) && isset($_POST['password'])){

        if(!isset($_POST['saveSession']))
            $_POST['saveSession'] = false;

        $message = login($_POST['username'],$_POST['password'],$_POST['saveSession']);

    }

    return $message;

}

function logIn($name,$psw,$save) {

    $result = consult("SELECT * FROM user WHERE user = '".$name."' ;");

    if(count($result) != 1){
          return "Usuario o contraseña incorrecto";
    }
    foreach ($result as $key => $value){

        if(password_verify($psw, $value['psw'])){

            $_SESSION['Name'] = $value['name'];
            $_SESSION['UserName'] = $value['user'];
            $_SESSION['IdUser'] = $value['iduser'];
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['SKey'] = session_id();
            $_SESSION['IPaddress'] = userIpAddress();
            $_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];
            $_SESSION['Login'] = true;
            $_SESSION['Rol'] = $value['rol']; 

            if($save){
                setcookie("IdUser", $_SESSION['IdUser'] , time()+(IDLE_TIME));
                setcookie("SKey", $_SESSION['SKey'], time()+(IDLE_TIME));
                setcookie("Login", $_SESSION['Login'], time()+(IDLE_TIME));
                setcookie("IPaddress", $_SESSION['IPaddress'], time()+(IDLE_TIME));
                setcookie("Rol", $_SESSION['Rol'], time()+(IDLE_TIME));
                setcookie("UserName", $_SESSION['UserName'], time()+(IDLE_TIME));
                setcookie("Name", $_SESSION['Name'], time()+(IDLE_TIME));
            }
            

            insert("INSERT INTO `session` (`iduser`,`key`,`activesince`,`lastactivity`,`ip`) VALUES (".$_SESSION['IdUser'].",'".$_SESSION['SKey']."',".$_SESSION['LastActivity'].",".$_SESSION['LastActivity'].",'".$_SESSION['IPaddress']."');");
            return "Bienvenido ".$_SESSION['Name'];
        }else{
            return "Usuario o contraseña incorrecto";
        }

    }
    
}

function checkSession(){

    $result = consult("SELECT * FROM `session` WHERE `key` = '".$_SESSION['SKey']."';");

    if(count($result)){
        $result = $result[0];
        if($result['iduser']==$_SESSION['IdUser'] && $result['ip']==$_SESSION['IPaddress']){
            modify("UPDATE session SET `lastactivity` = ".$_SERVER['REQUEST_TIME']." WHERE `key` = '".$_SESSION['SKey']."';");
            
            return true;
        }else{
            logOut();
            return false;
        }
        
    }else{
        logOut();
        return false;
    }

}

function checkCookie(){

    if (isset($_COOKIE["IdUser"]) && isset($_COOKIE["SKey"]) && isset($_COOKIE["Login"]) && isset($_COOKIE["IPaddress"]) && isset($_COOKIE["Rol"])&& isset($_COOKIE["UserName"]) && isset($_COOKIE["Name"])){
       
        $result = consult("SELECT * FROM `session` WHERE `ip` = '".$_COOKIE['IPaddress']."' AND `iduser` = ".$_COOKIE['IdUser']." AND `key` = '".$_COOKIE['SKey']."';");

        if(count($result)){
            $_SESSION['Name'] = $_COOKIE['Name'];
            $_SESSION['UserName'] = $_COOKIE['UserName'];
            $_SESSION['IdUser'] = $_COOKIE['IdUser'];
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['SKey'] = $_COOKIE['SKey'];
            $_SESSION['IPaddress'] = $_COOKIE['IPaddress'];
            $_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];
            $_SESSION['Login'] = $_COOKIE['Login'];
            $_SESSION['Rol'] = $_COOKIE['Rol'];
        }

    } 

}

function logOutOldSession() {
    
    if(isset($_SESSION['SKey'])){
        remove("DELETE FROM session WHERE lastactivity + ". IDLE_TIME ." < " . time() . ";"); 
    }

}


function logOut() {
    
    if(isset($_SESSION['SKey'])){
        remove("DELETE FROM `session` WHERE `key` = '".$_SESSION['SKey']."';");
    }

    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);

}

function userIpAddress() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $_SERVER['REMOTE_ADDR'];

}

?>