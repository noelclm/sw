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

<div class="container">
	<section>
		<article>
		 
			 <?php if(!isset($_SESSION["idUser"])){ 
					    echo '<div class="col-lg-10">';
							echo '<h2> No tiene permisos </h2>
								<p>Tiene que estar logeado para poder acceder a este apartado</p> ';
						echo '</div>';
							
					} else{ 
						$link = Conectarse();
						$queryUser = "SELECT * FROM users WHERE (id = '" . $_SESSION["idUser"] . "')";;
						$resUser = mysql_query($queryUser, $link);
						if($rowUser = mysql_fetch_array($resUser)){
							$img = $rowUser["img"];
						}
													
						echo '<h2> Cambiar imagen de perfil </h2>';
						
						echo '<form method="post" action="common/bbdd_img_perfil.php" enctype="multipart/form-data">';
							echo '<input type="file" name="imagen">';
							echo '<input type="submit" name="submit" value="Subir" > ';			
						echo '</form>';
						
						echo '<p>Si no se escoge imagen se pondra la imagen por defecto</p>';
						

						
						
           	} ?>
 
		</article>		
	</section>
</div>



<?php include_once("common/footer.php"); ?>