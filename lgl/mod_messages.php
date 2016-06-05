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
							
					} 
					else{ 
						$id_user = $_SESSION["idUser"];
						$link = Conectarse();
						echo '<h2> Mensajes </h2>';
						echo '<form method="post" action="common/bbdd_messages.php" enctype="multipart/form-data">';
							echo 'Para: <input type=text name="msg_destino" placeholder="Usuario destino">';
							echo '<textarea type="text" name="mensaje" placeholder=Comentarios id="coment"></textarea>';
							echo '<input type="submit" name="send_msg" value="Mandar mensaje" >';
						echo '</form>';
		
		
		
		
						/*mostrar comentarios anteriores*/
						echo '<br><br> ';				
						$queryMsg = "SELECT * FROM messages WHERE (id_user_origen = '" . $id_user . "' OR id_user_destino = '" . $id_user . "') ORDER BY dates DESC LIMIT 0,20;";
						$resMsg = mysql_query($queryMsg, $link);
						$numTuplas = mysql_num_rows($resMsg); 
						if ($numTuplas >0) {
							echo '<form method="post"  id="borrar_mensajes" action="common/bbdd_messages.php" enctype="multipart/form-data">';
							for ($i = 1; $i<=$numTuplas; $i++) {
								if($rowMsg = mysql_fetch_array($resMsg)){
									$id_msg=$rowMsg["id"];
									$message=$rowMsg["message"];
									$date = $rowMsg ["dates"];
									$id_user_origen = $rowMsg ["id_user_origen"];
									$id_user_destino = $rowMsg ["id_user_destino"];
									$leido = $rowMsg ["leido"];
									
									$queryUsers ="SELECT id, user FROM users WHERE (id = '".$id_user_destino."' OR id = '".$id_user_origen."');"; 
									$resUsers = mysql_query($queryUsers, $link);
									$numTuplasA = mysql_num_rows ($resUsers);
									for ($a = 1; $a<=$numTuplasA; $a++) {
										$rowUsers = mysql_fetch_array($resUsers);								
										$id = $rowUsers["id"];

										if ($id_user_destino==$id) {
											$user_destino = $rowUsers["user"];
										}
										
										else if ($id_user_origen==$id) {
											$user_origen = $rowUsers["user"];											
										}
									}//for
									
									
									echo '<p class="p_msg" id="'.$id_msg.'"> mensaje enviado '. $date . '<br> De '. $user_origen . ' para '. $user_destino . ':  
									<br> '. $message . ' 
									<input type="submit" name="borrar_mensaje'.$i.'" value="eliminar"></p>';
									
								}
							}							
							echo '</form>';
						}
					} ?>
					
		</article>		
	</section>
</div>
			

    
<?php include_once("common/footer.php"); ?>