/*
	Practica LGL: Pagina par la asignatura SW
    Copyright (C) 2015  
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
<?php 
session_start();
include("conectarse.php");

$link = Conectarse();

$user = strip_tags($_POST["user"]);
$password = strip_tags($_POST["password"]);

$queryUser = "SELECT * FROM users WHERE user = '" . $user . "'";
$resUser = mysql_query($queryUser, $link);

if($rowUser = mysql_fetch_array($resUser)){
	if($rowUser["confirm"] == "0"){
		session_destroy();
		$_SESSION["errorReg"] = "No se ha confirmado el usuario, revise su correo o vuelva a registrarse";
		header("location:../wrong.php");
	}
	else{
		$keypass = $rowUser["keypass"]; 
		$passwordEncript = sha1($password . $keypass . "machupichu"); //Codifica mediante cifrado SHA1
		if($passwordEncript = $rowUser["password"]){
			$_SESSION["idUser"] = $rowUser["id"];
			$_SESSION["user"] = $rowUser["user"];
			header("location:../index.php");
		}
		else{
			$_SESSION["errorReg"] = "La contrasela es erronea";
			header("location:../wrong.php");
		}
	}
}else{
	$_SESSION["errorReg"] = "El usuario es erroneo";
	header("location:../wrong.php");
}
?>