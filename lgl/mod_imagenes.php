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
						$id_user = $_SESSION["idUser"];
						$queryUser = "SELECT * FROM users WHERE (id = '" . $id_user . "')";;
						$resUser = mysql_query($queryUser, $link);
						if($rowUser = mysql_fetch_array($resUser)){
							$img = $rowUser["img"];
						}
													
						echo '<h2> Subir imagenes </h2>';
						
						echo '<form method="post" action="common/bbdd_imagenes.php" enctype="multipart/form-data">';
							echo '<input type="file" name="imagen[]" multiple>';
							echo '<input type="submit" name="add_imagenes" value="Subir" > ';			
						echo '</form>';
						
						

						//mostrar imagenes del usuario
						$queryImage = "SELECT * FROM images WHERE (id_users = '" . $id_user . "');";
						$resImage = mysql_query($queryImage, $link);
						$numTuplas= mysql_num_rows($resImage);
						echo '<div class="container" id="contGaleria">';
							for ($i = 1; $i<=$numTuplas; $i++) {
								if($rowImage = mysql_fetch_array($resImage)){
									$image=$rowImage["address"];				
									echo '<div id="contImagen">';
										echo '<a href="'. $image .'" rel="shadowbox[Mixed]"> <img src="'. $image .'" class="galeriaGrande" alt="img"> </a>';									
										echo '<form method="post" id="form_del_img" action="common/bbdd_imagenes.php" enctype="multipart/form-data">';
										echo '<input type="submit" id="botton_borrar_img" name="borrar_img'.$i.'" value="Eliminar">';
										echo '</form>';
									echo '</div>';
								}
							}
						echo '</div>';
           	} ?>
 
		</article>		
	</section>
</div>



<?php include_once("common/footer.php"); ?>