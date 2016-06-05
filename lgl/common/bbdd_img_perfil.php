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
$maxSize = 5000000;
$formatoJPG= "image/jpeg";
$formatoGIF= "image/gif";
$formatoPNG= "image/png";

function limpia_espacios($cadena){
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
}

session_start();
include("conectarse.php");

$link = Conectarse();
$queryBid = "SELECT * from users WHERE (id= '". $_SESSION["idUser"] ."') ";
$resBid = mysql_query($queryBid, $link);
$rowBid = mysql_fetch_array($resBid);
$id = $rowBid["id"];

if(isset($_POST['submit'])){ 
	/*mensajes de error*/
	if (($_FILES["imagen"]["error"] > 0)&& (($_FILES["imagen"]["error"] != 4))){
		if ($_FILES["imagen"]["error"]==1) 
			$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
		else if ($_FILES["imagen"]["error"]==2) 
			$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
		else if ($_FILES["imagen"]["error"]==3) 
			$_SESSION["errorReg"] = "El archivo subido fue sólo parcialmente cargado <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
		else if ($_FILES["imagen"]["error"]==6) 
			$_SESSION["errorReg"] = "Falta la carpeta temporal <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
		else if ($_FILES["imagen"]["error"]==7) 
			$_SESSION["errorReg"] = "No se pudo escribir el archivo en el disco <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
		else if ($_FILES["imagen"]["error"]==8) 
			$_SESSION["errorReg"] = "Se detuvo la carga de archivos, por favor vuelva a iniciar <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
			
		header('location:../wrong.php');			
	/* si no hay error en el formulario*/
	}else {
		/*si el formulario estaba vacío se pone imagen por defecto*/
		if ($_FILES["imagen"]["error"]==4) {
			$name='logoLGL.png';
			
			/*realiza la insercción en la base de datos*/
			$carp='imagenes/';
			$img="$carp$name";
					
			$queryUser = "UPDATE users SET img=('" . $img. "') WHERE id= ('". $id ."'); ";
					
			if(mysql_query($queryUser, $link)){
				header('location:../userOptions.php');
			}else{
				$_SESSION["errorReg"] = "Ha ocurrido un error durante la carga de la imagen <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
				header('location:../wrong.php');
			}
		}	
		else {	
			/*comprobar tamaño y formato*/
			if (($_FILES['imagen']['size']<$maxSize) && 
			(($_FILES['imagen']['type']==$formatoJPG)||($_FILES['imagen']['type']==$formatoGIF)
					||($_FILES['imagen']['type']==$formatoPNG)))
			{	
				$name=limpia_espacios($_FILES['imagen']['name']);

				/*realiza la insercción en la base de datos*/
				$carp='imagenes/';
				$img="$carp$name";
					
				$queryUser = "UPDATE users SET img=('" . $img. "') WHERE id= ('". $id ."'); ";

				$queryNameUser = "SELECT user FROM users WHERE id= ('". $id ."'); ";
				$resNameUser = mysql_query($queryNameUser, $link);
				$rowBuser = mysql_fetch_array($resNameUser);
				$user = $rowBuser["user"];
					
				$queryImg = "INSERT INTO images (id_users, address, title, details) VALUES ('".$id."', '".$img."', '".$name."', 'foto de perfil del usuario ' '".$user."' );";
					
					
				if((mysql_query($queryUser, $link))&&(mysql_query($queryImg, $link))){
					/*realiza la copia en el fichero destino*/
					$carp='../imagenes/';
					$img_mover="$carp$name";
					if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $img_mover)) {
						$_SESSION["errorReg"] = "El archivo no se ha podido cargar. Intentelo de nuevo <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>";
						header('location:../wrong.php');
					}
					header('location:../userOptions.php');
				}else{
					$_SESSION["errorReg"] = "Ha ocurrido un error durante la carga de la imagen <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>.";
					header('location:../wrong.php');
				}
				
			}
			else {
				$_SESSION["errorReg"] = "Archivo invalido, comprueba que sea un formato válido (JPG, GIF o PNG) y que sea de menos de 5 MB <a href= 'mod_img_perfil.php'> Cambiar imagen perfil </a>.";
				header('location:../wrong.php');
			}
		}
	}
	
	
}
?>