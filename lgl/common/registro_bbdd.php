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

$user = strip_tags($_POST["userR"]);
$password = strip_tags($_POST["passwordR"]);
$email = strip_tags($_POST["emailR"]);
$img = strip_tags($_POST["infoR"]);
$info = strip_tags($_POST["infoR"]);
$web = strip_tags($_POST["webR"]);
$location = strip_tags($_POST["locationR"]);
$type = strip_tags($_POST["typeR"]);

$keypass = generarCodigo(); //cadena aleatoria
$passwordEncript = sha1($password . $keypass . "machupichu"); //Codifica mediante cifrado SHA1

	$queryBUser = "SELECT * FROM users WHERE (user = '" . $user . "')";
	$queryBEmail = "SELECT * FROM users WHERE (email = '" . $email . "')";
	$resBUser = mysql_query($queryBUser, $link);
	$resBEmail = mysql_query($queryBEmail, $link);
	
	if($rowBUser = mysql_fetch_array($resBUser)){
		$_SESSION["errorReg"] = "Usuario ya en uso. <a href='registro.php' >Intente otro usuario. </a>";
		header('location:../wrong.php');
	} 
	elseif($rowBEmail = mysql_fetch_array($resBEmail)){
		$_SESSION["errorReg"] = "Email ya en uso. <a href='registro.php' >Intente otro email. </a>";
		header('location:../wrong.php');
	} 
	else{
		$queryUser = "INSERT INTO users (user, password, email,  img, info, web, location, type, activationKey, keypass) values ('" . $user . "','" . $passwordEncript. "','" . $email . "','" . $img . "','" . $info . "','" . $web . "','" . $location . "','" . $type . " ','" .generarCodigo(). "','" .$keypass ."')";
		if(mysql_query($queryUser, $link)){
			$queryBUser = "SELECT * FROM users WHERE (user = '" . $user . "')";
			$resBUser = mysql_query($queryBUser, $link);
			$rowBUser = mysql_fetch_array($resBUser);
			$id = $rowBUser["id"];
			$confirm = $rowBUser["activationKey"];
			$headers = "From: info@localgrouplinked.es"; 
			$mensaje = "pincha en el siguiente enlace, si no te deja copia y pega la dirección en la barra de navegacion de su navegador:
			http://localgrouplinked.es/confirmar.php?id=".$id."&confirm=".$confirm;
			if (!@mail("$email","Confirmacion de registro en localgrouplinked.es","$mensaje","$headers")) {
				$_SESSION["errorReg"] = "No se pudo enviar el email de confirmacion.<br>Pongase en contancto con el administrador de la página.";
				header('location:../wrong.php');
			}
			header('location:../index.php');
		}else{
			$_SESSION["errorReg"] = "Ha ocurrido un error durante el registro.<br><a href='registro.php' >Vuelva a intentarlo por favor.</a>";
			header('location:../wrong.php');
		}
	}

function generarCodigo() {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < 10;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}
?>