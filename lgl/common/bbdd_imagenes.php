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
$id_user = $rowBid["id"];
$user = $rowBid["user"];

if(isset($_POST['add_imagenes'])){ 
	$count = 0;
	foreach ($_FILES["imagen"]["name"] as $key){

		/*mensajes de error*/
		if ($_FILES["imagen"]["error"][$count] > 0){
			if ($_FILES["imagen"]["error"][$count]==1) 
				$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_imagenes.php'> Subir imagenes </a>";
			else if ($_FILES["imagen"]["error"][$count]==2) 
				$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_imagenes.php'> Subir imagenes </a>";
			else if ($_FILES["imagen"]["error"][$count]==3) 
				$_SESSION["errorReg"] = "El archivo subido fue sólo parcialmente cargado <a href= 'mod_imagenes.php'> Subir imagenes </a>";
			else if ($_FILES["imagen"]["error"][$count]==4)
				$_SESSION["errorReg"] = "El campo esta vacío <a href= 'mod_imagenes.php'> Subir imagenes ";
			else if ($_FILES["imagen"]["error"][$count]==6) 
				$_SESSION["errorReg"] = "Falta la carpeta temporal <a href= 'mod_imagenes.php'> Subir imagenes </a>";
			else if ($_FILES["imagen"]["error"][$count]==7) 
				$_SESSION["errorReg"] = "No se pudo escribir el archivo en el disco <a href= 'mod_imagenes.php'> Subir imagenes </a>";
			else if ($_FILES["imagen"]["error"][$count]==8) 
				$_SESSION["errorReg"] = "Se detuvo la carga de archivos, por favor vuelva a iniciar <a href= 'mod_imagenes.php'> Subir imagenes </a>";	
			header('location:../wrong.php');			
		/* si no hay error en el formulario*/
		}else {
			/*comprobar tamaño y formato*/
			if (($_FILES['imagen']['size'][$count]<$maxSize) && 
				(($_FILES['imagen']['type'][$count]==$formatoJPG)||($_FILES['imagen']['type'][$count]==$formatoGIF)
				||($_FILES['imagen']['type'][$count]==$formatoPNG)))
			{	
				$name=limpia_espacios($_FILES['imagen']['name'][$count]);

				/*realiza la insercción en la base de datos*/
				$carp='imagenes/';
				$img="$carp$name";
						
				$queryImg = "INSERT INTO images (id_users, address, title, details) VALUES ('".$id_user."', '".$img."', '".$name."', 'imagenes del usuario ' '".$user."' );";
						
						
				if(mysql_query($queryImg, $link)){
					/*realiza la copia en el fichero destino*/
					$carp='../imagenes/';
					$img_mover="$carp$name";
					if (!move_uploaded_file($_FILES['imagen']['tmp_name'][$count], $img_mover)) {
						$_SESSION["errorReg"] = "El archivo no se ha podido cargar. Intentelo de nuevo <a href= 'mod_imagenes.php'> Subir imagenes </a>";
						header('location:../wrong.php');
					}
					
					//éxito
					header('location:../userOptions.php');
				}else{
					$_SESSION["errorReg"] = "Ha ocurrido un error durante la carga de las imagenes <a href= 'mod_imagenes.php'> Subir imagenes </a>.";
					header('location:../wrong.php');
				}
					
			}
			else {
				$_SESSION["errorReg"] = "Archivo invalido, comprueba que sea un formato válido (JPG, GIF o PNG) y que sea de menos de 5 MB <a href= 'mod_imagenes.php'> Subir imagenes </a>.";
				header('location:../wrong.php');
			}
		}//else
		$count++;
	}//foreach
}


//----------------------------------------------------------------------------

//borrar
else {
	$queryImg = "SELECT * FROM images WHERE (id_users = '" . $id_user . "')";;
	$resImg = mysql_query($queryImg, $link);
	$numTuplas = mysql_num_rows($resImg);
	for ($i=1; $i<=$numTuplas; $i++){
		$rowImg = mysql_fetch_array($resImg);

		$id=$rowImg["id"];
		$img=$rowImg["address"];

		$n='borrar_img'.$i.'';

		if(isset($_POST[$n])){ 
			$queryDelImg = "DELETE FROM images WHERE id=('".$id."'); ";
			if(mysql_query($queryDelImg, $link)){
				/*borra el archivo y retorna*/
				$img = "../$img";
				unlink ($img);
				header('location:../mod_imagenes.php');
			}
			else{
				$_SESSION["errorReg"] = "Ha ocurrido un error durante la eliminacion de la imagen.<br>Vuelva a intentarlo por favor. <a href= 'mod_imagenes.php'> Modificar imagenes </a>";
				header('location:../wrong.php');
			}
		}
	}
}


?>