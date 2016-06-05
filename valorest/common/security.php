<?php

function logIn($name,$psw) {

    $result = consult("SELECT * FROM user WHERE user = '".$name."' ;");

    foreach ($result as $key => $value){

        if(password_verify($psw, $value['psw'])){

            $_SESSION['Name'] = $value['nombre'];
            $_SESSION['UserName'] = $value['usuario'];
            $_SESSION['IdUser'] = $value['iduser'];
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['SKey'] = session_id();
            $_SESSION['IPaddress'] = userIpAddress();
            $_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];
            $_SESSION['Login'] = true;
            $_SESSION['Rol'] = $value['rol']; 

            setcookie("IdUser", $_SESSION['IdUser'] , time()+(IDLE_TIME));
            setcookie("SKey", $_SESSION['SKey'], time()+(IDLE_TIME));
            setcookie("Login", $_SESSION['Login'], time()+(IDLE_TIME));
            setcookie("IPaddress", $_SESSION['IPaddress'], time()+(IDLE_TIME));
            setcookie("Rol", $_SESSION['Rol'], time()+(IDLE_TIME));
            setcookie("UserName", $_SESSION['UserName'], time()+(IDLE_TIME));
            setcookie("Name", $_SESSION['Name'], time()+(IDLE_TIME));

            insert("INSERT INTO `session` (`iduser`,`key`,`activesince`,`lastactivity`,`ip`) VALUES (".$_SESSION['IdUser'].",'".$_SESSION['SKey']."',".$_SESSION['LastActivity'].",".$_SESSION['LastActivity'].",'".$_SESSION['IPaddress']."');");
        
        }

    }
    
}

function checkSession(){

    $result = consult("SELECT * FROM `session` WHERE `key` = '".$_SESSION['SKey']."';");

    if(count($result)){

        if($fila['iduser']==$_SESSION['IdUser'] && $fila['ip']==$_SESSION['IPaddress']){
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