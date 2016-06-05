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
/*constantes*/
$maxSize = 20000000;
$formatoMP3= "audio/mp3";
$formatoOGG= "audio/ogg";
$formatoMPEG= "audio/mpeg";

function limpia_espacios($cadena){
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
}

session_start();
include("conectarse.php");

$link = Conectarse();
$idUser=$_SESSION["idUser"];

$queryAudio = "SELECT * FROM audios WHERE (id_users = '" . $idUser . "')";;
$resAudio = mysql_query($queryAudio, $link);
$numTuplas= mysql_num_rows($resAudio);

/*agregar*/
if(isset($_POST['add_cancion'])){ 
	/*Validar y mover audio a su carpeta*/
	$address=limpia_espacios($_FILES['address']['name']);
	
	if (($_FILES['address']['size']<$maxSize) && 
		(($_FILES['address']['type']==$formatoMP3)|| ($_FILES['address']['type']==$formatoOGG) || $_FILES['address']['type']== $formatoMPEG))	
	{
		/*mensajes de error*/
		if ($_FILES["address"]["error"] > 0) {
			if ($_FILES["address"]["error"]==1) 
				$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_audio.php'> Añadir Audio </a>";
			else if ($_FILES["address"]["error"]==2) 
				$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_audio.php'> Añadir Audio </a>";
			else if ($_FILES["address"]["error"]==3) 
				$_SESSION["errorReg"] = "El archivo subido fue sólo parcialmente cargado <a href= 'mod_audio.php'> Añadir Audio </a>";
			else if ($_FILES["address"]["error"]==4) 
				$_SESSION["errorReg"] = "Ningún archivo fue subido <a href= 'mod_audio.php'> Añadir Audio </a>";
			else if ($_FILES["address"]["error"]==6) 
				$_SESSION["errorReg"] = "Falta la carpeta temporal <a href= 'mod_audio.php'> Añadir Audio </a>";
			else if ($_FILES["address"]["error"]==7) 
				$_SESSION["errorReg"] = "No se pudo escribir el archivo en el disco <a href= 'mod_audio.php'> Añadir Audio </a>";
			else if ($_FILES["address"]["error"]==8) 
				$_SESSION["errorReg"] = "Se detuvo la carga de archivos, por favor vuelva a iniciar <a href= 'mod_audio.php'> Añadir Audio </a>";
			header('location:../wrong.php');	
		}
		
		/*si no hay errores valida una vez mas y mueve el archivo a su carpeta*/
		else {
				/*sacar variables*/
				$format=sacarFormato();
				$details=$_POST['details'];
				$title =$_POST['title'];
				$destino = "audio/".$address."";

			if (($title!="")&&($format!="")) {
				$queryAddAudio = "INSERT INTO audios (id_users, address, format, details, title) 
									VALUES ('".$idUser."', '".$destino."', '".$format."', '".$details."', '".$title."');";
				/*mover el fichero a la carpeta de audio*/
				$carp='../audio/';
				$a="$carp$address";
				if (!move_uploaded_file($_FILES['address']['tmp_name'], $a)){
					$_SESSION["errorReg"] = "El archivo no se ha podido cargar <a href= 'mod_audio.php'> Añadir Audio </a>";
					header('location:../wrong.php');
				}	
							
				/*ERRORES*/	
				if(!mysql_query($queryAddAudio, $link)){
					$_SESSION["errorReg"] = "Ha ocurrido un error durante la subida de la cancion <a href= 'mod_audio.php'> Añadir Audio </a>.";
					header('location:../wrong.php');
				}
				
				else {
					header('location:../mod_audio.php');
				}
			}
			else if ($title!="") {	
				$_SESSION["errorReg"] = "No se ha reconocido el formato de la cancion <a href= 'mod_audio.php'> Añadir Audio </a>";
				header('location:../wrong.php');
			}		
					
			else {
				$_SESSION["errorReg"] = "Indique el titulo de la cancion <a href= 'mod_audio.php'> Añadir Audio </a>";
				header('location:../wrong.php');
			}
		}
				
		
	}
	
	else {
		$_SESSION["errorReg"] = "Archivo invalido, comprueba que sea un formato válido (mp3 o ogg) y que sea de menos de 20 MB. <a href= 'mod_audio.php'> Añadir Audio </a>";
		header('location:../wrong.php');
	}
	
}	


/*-----------------------------------------------------------------------------*/

/*borrar*/	
else {

	for ($i=1; $i<=$numTuplas; $i++){
		$rowAudio = mysql_fetch_array($resAudio);

		$id=$rowAudio["id"];
		$song=$rowAudio["address"];

		$n='borrar_cancion'.$i.'';

		if(isset($_POST[$n])){ 
			$queryDelAudio = "DELETE FROM audios WHERE id=('".$id."'); ";
			if(mysql_query($queryDelAudio, $link)){
				/*borra el archivo y retorna*/
				$song = "../$song";
				unlink ($song);
				header('location:../mod_audio.php');
			}
			else{
				$_SESSION["errorReg"] = "Ha ocurrido un error durante la eliminacion de la cancion.<br>Vuelva a intentarlo por favor. <a href= 'mod_audio.php'> Eliminar Audio </a>";
				header('location:../wrong.php');
			}
		}
	}
}
?>


<?php
function sacarFormato() {
 $song = $_FILES['address']['name'];
 $key = ".";
 $formato = "";

 $formato = strrchr ($song, $key);
 $formato = str_replace ($key, '',$formato);
 
return $formato;
}

?>