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
$queryBid = ( "SELECT * from users WHERE (id= '". $_SESSION["idUser"] ."') ");
$resBid = mysql_query($queryBid, $link);
$rowBid = mysql_fetch_array($resBid);
$id_user = $rowBid["id"];
$user = $rowBid["user"];
$_SESSION["errorReg"] = NULL;

//Si sube una imagen
if(isset($_POST['add_noticia'])){ 	
	$msg = addslashes ($_POST["texto_noticias"]);
	$date = date(DATE_W3C);
	$id_img = 0;
	
	/*mensajes de error*/
	if ((($_FILES["imagen"]["error"] > 0)&& ($_FILES["imagen"]["error"] != 4))||
		(($_FILES["imagen"]["error"] == 4) &&($msg==""))){
		if ($_FILES["imagen"]["error"]==1) 
			$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_news.php'> Modificar Noticias </a>";
		else if ($_FILES["imagen"]["error"]==2) 
			$_SESSION["errorReg"] = "El archivo supera el tamaño máximo <a href= 'mod_news.php'> Modificar Noticias </a>";
		else if ($_FILES["imagen"]["error"]==3) 
			$_SESSION["errorReg"] = "El archivo subido fue sólo parcialmente cargado <a href= 'mod_news.php'> Modificar Noticias </a>";
		else if (($_FILES["imagen"]["error"] == 4)&&($msg==""))
			$_SESSION["errorReg"] = "Los dos campos están vacíos <a href= 'mod_news.php'> Modificar Noticias </a>";
		else if ($_FILES["imagen"]["error"]==6) 
			$_SESSION["errorReg"] = "Falta la carpeta temporal <a href= 'mod_news.php'> Modificar Noticias </a>";
		else if ($_FILES["imagen"]["error"]==7) 
			$_SESSION["errorReg"] = "No se pudo escribir el archivo en el disco <a href= 'mod_news.php'> Modificar Noticias </a>";
		else if ($_FILES["imagen"]["error"]==8) 
			$_SESSION["errorReg"] = "Se detuvo la carga de archivos, por favor vuelva a iniciar <a href= 'mod_news.php'> Modificar Noticias </a>";
				
	}
	else if ($_FILES["imagen"]["error"] == 0){
		/*comprobar tamaño y formato*/
		if (($_FILES['imagen']['size']<$maxSize) && 
			(($_FILES['imagen']['type']==$formatoJPG)||($_FILES['imagen']['type']==$formatoGIF)
			||($_FILES['imagen']['type']==$formatoPNG)))
		{	
			$name=limpia_espacios($_FILES['imagen']['name']);
			
			/*realiza la insercción en la base de datos*/
			$carp='imagenes/';
			$img="$carp$name";
					
			$queryImg = "INSERT INTO images (id_users, address, title, details) VALUES ('".$id_user."', '".$img."', '".$name."', 'imagen de un comentario del usuario ' '".$user."' );";
					
			if($resImage = mysql_query($queryImg, $link)){
				$id_img = mysql_insert_id ($link);
				/*realiza la copia en el fichero destino*/
				$carp='../imagenes/';
				$img_mover="$carp$name";
				if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $img_mover)) {
					$_SESSION["errorReg"] = "El archivo no se ha podido cargar. Intentelo de nuevo <a href= 'mod_news.php'> Modificar Noticias </a>";
				}
				//éxito
				
				
			}else{
				$_SESSION["errorReg"] = "Ha ocurrido un error durante la carga de la imagen <a href= 'mod_news.php'> Modificar Noticias </a>";
			}	

		}
		else {
			$_SESSION["errorReg"] = "Archivo invalido, comprueba que sea un formato válido (JPG, GIF o PNG) y que sea de menos de 5 MB <a href= 'mod_news.php'> Modificar Noticias </a>";
		}	
	}//else no hay errores
	
	
	if ($_SESSION["errorReg"] != NULL) {
		
		header('location:../wrong.php');
	}	
	
	
	//si no ha habido errores carga el comentario	
	else {

		$queryComment = "INSERT INTO news (id_user, dates, message, id_img) VALUES ('".$id_user."', '".$date."', '".$msg."', '".$id_img."');";
		
		if(mysql_query($queryComment, $link)){
			header('location:../mod_news.php');
		}else{
			$_SESSION["errorReg"] = "Ha ocurrido un error durante la carga de la noticia <a href= 'mod_news.php'> Cambiar Noticias </a>.";
			header('location:../wrong.php');
		}
	}	
}	

/*--------------------------------------------------------------------*/
else {

	/*agregar comentario*/
	$queryNews = "SELECT * FROM news WHERE (id_user = '" . $id_user . "') ORDER BY id DESC";
	$resNews = mysql_query($queryNews, $link);
	$numTuplas= mysql_num_rows($resNews);
	for ($i = 1; $i<=$numTuplas; $i++) {					
		$rowNews = mysql_fetch_array($resNews);
		if (isset($_POST['agregar_comentario'.$i.''])) {
				$id_news=$rowNews["id"];
				$date = date(DATE_W3C);
				$msg = $_POST ['agregar_comentario_texto'.$i.''];
				
				$queryComment = "INSERT INTO coments (id_user_property, id_user_writer, dates, message, id_news) VALUES (".$id_user.", ".$id_user.", '".$date."', '".$msg."', ".$id_news.");";
				if (mysql_query($queryComment, $link)){
					header ('location:../mod_news.php');
				}
				else {
					$_SESSION["errorReg"] = "Ha ocurrido un error durante la carga del comentario <a href= 'mod_news.php'> Cambiar Noticias </a>.";
					header('location:../wrong.php');
				}
		}

	
	
/*--------------------------------------------------------------------*/	

		/*borrar*/							
		else if (isset($_POST['borrar_noticia'.$i.''])){
			$id=$rowNews["id"];
			
			$id_img=$rowNews["id_img"];
			
			if ($id_img!=0) {
				//sacar la direccion de la foto
				$queryImg = "SELECT address FROM images WHERE (id = '" . $id_img . "');";
				$resImg = mysql_query($queryImg, $link);
				$rowImg = mysql_fetch_array($resImg);
				$img = $rowImg ["address"];
			}
			
			$queryDelComentario = "DELETE FROM news WHERE id=('".$id."'); "; 
			if(mysql_query($queryDelComentario, $link)) {
				/*Si tiene imagen borra la imagen de la BBDD*/
				if ($id_img != 0) { 
					$queryDelImg = "DELETE FROM images where id = ('".$id_img."');";
					if (mysql_query($queryDelImg, $link)){
						$img = "../$img";
						unlink ($img);
					}
				}
				header('location:../mod_news.php');
			}
			else{
				$_SESSION["errorReg"] = "Ha ocurrido un error durante la eliminacion de la noticia.<br>Vuelva a intentarlo por favor. <a href= 'mod_news.php'> Modificar Noticias </a>";
				header('location:../wrong.php');
			}
		}//else if
	}//for
}//else
?>
