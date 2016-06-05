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
$id_msg = $_GET ['id_msg'];
$user = $_SESSION["idUser"];



		$queryDelMsg = "UPDATE messages SET leido=1 WHERE ((id=".$id_msg.") AND (id_user_destino = ".$user.")); "; 
		if (!mysql_query($queryDelMsg, $link)){
			$_SESSION["errorReg"] = "No se ha podido leer el mensaje. <br> Pruebe de nuevo. <a href= 'mod_messages.php'> Enviar Mensajes </a>";
			header('location:../wrong.php');
		}

   
	
?>
