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
<?php include_once("common/conectarse.php"); ?>

<div class="container">
    <section>
		<article> 
		<?php 
			$user = $_GET["user"];
            $link = Conectarse();
			$queryUser = "SELECT * FROM users WHERE (user = '" . $user . "')";
			$resUser = mysql_query($queryUser, $link);
			while ($rowUser = mysql_fetch_array($resUser)){
				$id = $rowUser["id"];
				$email = $rowUser["email"];
				$info = $rowUser["info"];
				$img = $rowUser["img"];
				$web = $rowUser["web"];
				$location = $rowUser["location"];
				$type = $rowUser["type"];
			}
			echo '<h2> '.$user.'</h2>' ;
			echo '<p><img src="'. $img .'" width="100" height="70" alt="img"> '. $info . '</p>';
			
			?>
			<h2> Imagenes </h2> 
			<details open>
				<summary> </summary>
				<?php
				$queryImage = "SELECT * FROM images WHERE (id_users = '" . $id . "');";
				$resImage = mysql_query($queryImage, $link);
				$numTuplas= mysql_num_rows($resImage);
				for ($i = 1; $i<=$numTuplas; $i++) {
					if($rowImage = mysql_fetch_array($resImage)){
						$image=$rowImage["address"];				
						echo '<a href="'. $image .'" rel="shadowbox[Mixed]"> <img src="'. $image .'" class="galeriaPeq" alt="img"> </a>';
					}
				}
				?>
			</details>
							
			<?php
			if ($type == "grupo") {
			?>		
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
			<?php } ?>
							
							
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

            	
             
		</article>			
	</section>
</div>
    
 <?php include_once("common/footer.php"); ?>