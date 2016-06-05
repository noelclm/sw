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
							$queryUser = "SELECT * FROM users WHERE (id = '" . $_SESSION["idUser"] . "')";;
							$resUser = mysql_query($queryUser, $link);
							if($rowUser = mysql_fetch_array($resUser)){
								$user = $rowUser["user"];
								$password = $rowUser["password"];
								$email = $rowUser["email"];
								$info = $rowUser["info"];
								$img = $rowUser["img"];
								$web = $rowUser["web"];
								$location = $rowUser["location"];
								$type = $rowUser["type"];
																
								
								echo '<h2> Modificar datos </h2>';
								echo '<form method="post" action="common/bbdd_mod_usuario.php">';
									echo '<input type="text" name="user" value="'.$user. '" >'; 
									echo '<input type="password" name="password" value='.$password.'>';
									echo '<input type="text" name="email" value='. $email .  '>'; 
									echo '<input type="text" name="info" value="'. $info .'" >'; 
									echo '<input type="text" name="web" value=' . $web .' >'; 
									echo '<input type="text" name="location" value="' .$location. '">'; 
									echo '<select name="type" class="selectType">';
										if ($type=="local") {
											echo '<option value="local">local</option>';
											echo '<option value="grupo">grupo</option>';
										}
										else {
											echo '<option value="grupo">grupo</option>';
											echo '<option value="local">local</option>';
										}
										
									echo '</select>';
									echo '<input type="submit" value="Modificar" >';
								echo '</form>';
							}?> 
				<?php } ?>
		</article>		
	</section>
</div>
    
<?php include_once("common/footer.php"); ?>