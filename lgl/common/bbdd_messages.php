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
$id_user_origen = $_SESSION["idUser"];
$date = date(DATE_W3C);

if (isset ($_POST ["send_msg"])) { 
	$user_destino = addslashes ($_POST["msg_destino"]);
   if ($user_destino!="") {
	$msg = addslashes($_POST["mensaje"]);	 
	if ($msg!="") {
		//comprueba que el usuario exista
		$queryUser = "SELECT id, user FROM users WHERE (user= '".$user_destino."');";
		$resUser = mysql_query($queryUser, $link);
		if (!($rowUser = mysql_fetch_array ($resUser))) {
			$_SESSION["errorReg"] = "El usuario no existe en la base de datos.<br>Vuelva a intentarlo por favor. <a href= 'mod_messages.php'> Enviar Mensajes </a>";
			header('location:../wrong.php');
		}
		
		else {
			$id_user_destino = $rowUser["id"];

			//si el usuario origen y destino es el mismo
			if ($id_user_destino==$id_user_origen) {
				$_SESSION["errorReg"] = "El usuario origen y el destino es el mismo.<br>Vuelva a intentarlo por favor. <a href= 'mod_messages.php'> Enviar Mensajes </a>";
				header('location:../wrong.php');
			}
			
			else {
				$queryComment = "INSERT INTO messages (id_user_origen, id_user_destino, dates, message, leido) VALUES ('".$id_user_origen."', '".$id_user_destino."', '".$date."', '".$msg."', 0);";
				
				if(mysql_query($queryComment, $link)){
					header('location:../mod_messages.php');
				}else{
					$_SESSION["errorReg"] = "Ha ocurrido un error durante el envio del mensaje <a href= 'mod_messages.php'> Enviar Mensaje </a>.";
					header('location:../wrong.php');
				}
			}//else usuario origen y destino distintos
		}
	}
  }
}
else if (isset ($_POST ["send_msg"])&& ($user_destino=="")) {
	$_SESSION["errorReg"] = "No hay destinatario <a href= 'mod_messages.php'> Enviar Mensaje </a>.";
	header('location:../wrong.php');
}

else if (isset ($_POST ["send_msg"])&& ($msg=="")) {
	$_SESSION["errorReg"] = "No hay mensaje <a href= 'mod_messages.php'> Enviar Mensaje </a>.";
	header('location:../wrong.php');
}


/*borrar*/	
else {
	//sacar el id del mensaje
	$id_user = $_SESSION["idUser"];
	$queryMsg = "SELECT * FROM messages WHERE (id_user_origen = '" . $id_user . "' OR id_user_destino = '" . $id_user . "')";;
	$resMsg = mysql_query($queryMsg, $link);
	$numTuplas= mysql_num_rows($resMsg);
	
	for ($i=1; $i<=$numTuplas; $i++){
		$rowMsg = mysql_fetch_array($resMsg);
		
		$id = $rowMsg["id"];
		//saber que numero de formulario ha sido
		$n='borrar_mensaje'.$i.'';
		
		if(isset($_POST[$n])){ 

			$queryDelMsg = "DELETE FROM messages WHERE id=('".$id."'); "; 
			if(mysql_query($queryDelMsg, $link)) {
				header('location:../mod_messages.php');
			}
			else{
				$_SESSION["errorReg"] = "Ha ocurrido un error durante la eliminacion del mensaje.<br>Vuelva a intentarlo por favor. <a href= 'mod_messages.php'> Enviar Mensajes </a>";
				header('location:../wrong.php');
			}
		}
	}
}
?>
