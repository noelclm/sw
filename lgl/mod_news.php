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
							echo '<h2> No tiene permisos </h2>
								<p>Tiene que estar logeado para poder acceder a este apartado</p> ';
							
					} else{ 
							$link = Conectarse();
							echo '<h2> Noticias </h2>';
							echo '<form method="post" action="common/bbdd_news.php" enctype="multipart/form-data">';
								echo '<div class="row">';
									echo '<div class="col-md-3" id="texto">';
										echo '<textarea type="text" name="texto_noticias" placeholder="Texto Noticia" id="coment"></textarea>';
									echo '</div>';
									
									echo '<div class="col-md-4" id="col_img">';
										echo 'Insertar una imagen <input type="file" name="imagen">';
									echo '</div>';
								echo '</div>';
								
								echo '<div class="row">';
									echo '<div class="col-md-4">';
										echo '<input type="submit" name="add_noticia" value="Añadir noticia" >';
									echo '</div>';
								echo '</div>';
							echo '</form>';
			
							/*mostrar comentarios anteriores*/
							echo '<br><br> ';
							
							
							$queryComent = "SELECT * FROM news WHERE (id_user = '" . $_SESSION["idUser"] . "') ORDER BY dates DESC LIMIT 0,20;";
							$resComent = mysql_query($queryComent, $link);
							$numTuplas= mysql_num_rows($resComent);
							for ($i = 1; $i<=$numTuplas; $i++) {
								if($rowComent = mysql_fetch_array($resComent)){
									$message=$rowComent["message"];	
									$id_img=$rowComent["id_img"];
												
									$queryImg = "SELECT address FROM images WHERE id = ('" . $id_img . "');";  
									$resImage = mysql_query ($queryImg, $link);
									$img = NULL;
									if ($rowImage = mysql_fetch_array($resImage)) {
										$img = $rowImage["address"];
									}
									

									
									echo '<form method="post" id="borrar_noticia" action="common/bbdd_news.php" enctype="multipart/form-data">';
									if (($id_img!=0)&&($img!=NULL)) {
										echo '<p> <img src="'. $img . '" id="coment_img"> '. $message . ' 
										<input type="button" class="add_comment_button" id="add_comment_button'.$i.'" value="Escribrir comentario">
										<input type="submit" class="add_comment" name="borrar_noticia'.$i.'" value="eliminar">
										<br> <input type="text" class="add_comment_invisibility" id="add_coment_text'.$i.'" name="agregar_comentario_texto'.$i.'_imagen"> 
										<input type="submit" class="add_comment_invisibility" id="add_coment_submit'.$i.'" name="agregar_comentario'.$i.'_imagen" value="Agregar comentario"></p>';
									} else {
										echo '<p> '. $message . '
										<input type="button" class="add_comment_button" id="add_comment_button'.$i.'" value="Escribrir comentario">
										<input type="submit" class="add_comment" name="borrar_noticia'.$i.'" value="eliminar">
										<br> <input type="text" class="add_comment_invisibility" id="add_coment_text'.$i.'" name="agregar_comentario_texto'.$i.'"> 
										<input type="submit" class="add_comment_invisibility" id="add_coment_submit'.$i.'" name="agregar_comentario'.$i.'" value="Agregar comentario"></p>';
										
									}
									echo '</form>';
								}
							}						
					} 
					?>
		</article>		
	</section>
</div>
    
<?php include_once("common/footer.php"); ?>