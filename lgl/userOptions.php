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
<?php include_once("common/head.php"); ?>
<?php include_once("common/header.php"); ?>


<script language="JavaScript"> 
function confirmacion(){ 
    if (confirm('¿Estas seguro de borrar esta cuenta?')){
       document.location="bbdd_borrar_cuenta.php";
    } 
} 
</script> 




<div class="container">
	<section>
		<article>
			<div class="row">
		  
				<?php 
				if(!isset($_SESSION["idUser"])){ 
					echo '<div class="col-lg-10">';
					echo '<h2> No tiene permisos </h2>
							<p>Tiene que estar logeado para poder acceder a este apartado</p> ';
					echo '</div>';
								
				} 
				else{ 
					$id=$_SESSION["idUser"];
					
					?>
					<div  id="menu_user">			
					<div class="col-md-4" id="menu">
						<h2> Menu </h2>
						<a href="mod_user.php"> <p> Editar datos </p></a>			
						<a href="mod_img_perfil.php"> <p> Cambiar imagen de perfil</p></a>
						<a href="mod_imagenes.php"> <p> Modificar imagenes</p></a>
						<a href="mod_audio.php"> <p> Modificar audio</p></a>
						<a href="mod_news.php"> <p> Modificar noticias </p></a>
						<a href="mod_messages.php"> <p> Mensajes privados </p></a>
						<a name="borrar_cuenta" onclick="confirmacion()"> <p> Borrar cuenta </p></a>
					</div>
					</div>
					
					<?php
					echo '<div class="col-md-8" id="datos">';
						$link = Conectarse();
						$queryUser = "SELECT * FROM users WHERE (id = '" . $id . "')";;
						$resUser = mysql_query($queryUser, $link);
						if($rowUser = mysql_fetch_array($resUser)){
							$email = $rowUser["email"];
							$info = $rowUser["info"];
							$img = $rowUser["img"];
							$web = $rowUser["web"];
							$location = $rowUser["location"];
							$type = $rowUser["type"];
										
							if($img==""){
								$img = "imagenes/logoLGL.png";
							}
							echo '<h2> <img src="'. $img .'" width="100" height="70" alt="img"> ' . $rowUser["user"] . '</h2>';
							echo '<p> email: '. $email . '</p>' ;
							echo '<p> Información: '. $info . '</p>' ;
							echo '<p> Web: <a href="http://'. $web .'">'. $web . '</a></p>' ;
							echo '<p> Localización: '. $location . '</p>' ;
						}
						?>         
									
										
						<h2> Imagenes </h2> 
						<details open>
							<summary> </summary>
							<?php
							$queryImage = "SELECT * FROM images WHERE (id_users = '" . $id . "');";
							$resImage = mysql_query($queryImage, $link);
							$numTuplas= mysql_num_rows($resImage);
							echo '<div id="contGaleria">';
								for ($i = 1; $i<=$numTuplas; $i++) {
									if($rowImage = mysql_fetch_array($resImage)){
										$image=$rowImage["address"];			
										echo '<a href="'. $image .'" rel="shadowbox[Mixed]"> <img src="'. $image .'" class="galeriaPeq" alt="img"> </a>';
									}	
								}
							echo '</div>';
							?>
						</details>
										
						<h2> Audio </h2> 
						<details open>		
							<summary> </summary>
							<?php
							$queryAudio = "SELECT * FROM audios WHERE (id_users = '" . $id . "')";;
							$resAudio = mysql_query($queryAudio, $link);
							$numTuplas= mysql_num_rows($resAudio);
							for ($i = 1; $i<=$numTuplas; $i++) {
								if($rowAudio = mysql_fetch_array($resAudio)){
									$song=$rowAudio["address"];
									$title=$rowAudio["title"];
									$format=$rowAudio["format"];
					
									print_r ($title);
									echo '<br>';
									echo '<audio controls loop>';
									echo '<source src='.$song.' type="audio/'.$format.'" />';										
									echo 'Tu navegador no soporta la etiqueta audio de HTML5. Puedes descargar la canción <a href="audio/tender_al_sol.mp3">aquí.</a>';								
									echo '</audio>';
									echo '<br>';
								}
											
								else{
									echo 'Error: Las canciones no se pueden mostrar<br>';
								}
										
							}
							?>
						</details>
										
										
						<h2> Noticias </h2> 
						<details open>
							<summary> </summary>
								<?php
								$queryComent = "SELECT * FROM news WHERE (id_user = '" . $id . "') ORDER BY dates DESC LIMIT 0,20;";
								$resComent = mysql_query($queryComent, $link);
								$numTuplas= mysql_num_rows($resComent);
								for ($i = 1; $i<=$numTuplas; $i++) {
									if($rowComent = mysql_fetch_array($resComent)){
										$message=$rowComent["message"];	
										$id_img_coment=$rowComent["id_img"];
													
										$queryImg = "SELECT address FROM images WHERE id = ('" . $id_img_coment . "');";  
										$resImage = mysql_query ($queryImg, $link);
										$img_coment = NULL;
										if ($rowImage = mysql_fetch_array($resImage)) {
											$img_coment = $rowImage["address"];
										}

										if (($id_img_coment!=0)&&($img_coment!=NULL)){
											echo '<p> <img src="'. $img_coment . '" id="coment_img"> '. $message . ' </p>';
										}else
											echo '<p> '. $message . '</p>';;
									}
								}
								?>			
						</details>

					</div><!--Div Datos-->
					
			   
				<?php
				}/*else*/
				?>
			</div><!--Div Row--> 
		</article>		
	</section>
</div>

<?php include_once("common/footer.php"); ?>