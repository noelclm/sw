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
<!-- <script>
		$(document).ready(function() {
			if(!Modernizr.meter){
				alert('Sorry your brower does not support HTML5 progress bar');
			} else {
				var progressbar = $('#progressbar'),
					max = progressbar.attr('max'),
					time = (1000/max)*5,	
			        value = progressbar.val();

			    var loading = function() {
			        value += 1;
			        addValue = progressbar.val(value);
			        
			        $('.progress-value').html(value + '%');

			        if (value == max) {
			            clearInterval(animate);			           
			        }
			    };

			    var animate = setInterval(function() {
			        loading();
			    }, time);
			};
		});
	</script> -->

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
						$idUser=$_SESSION["idUser"];
						$queryAudio = "SELECT * FROM audios WHERE (id_users = '" . $idUser . "')";;
						$resAudio = mysql_query($queryAudio, $link);
						$numTuplas= mysql_num_rows($resAudio);
													
						echo '<h2> Audio </h2>';
						
						
						echo '<form method="post" id="mod_audio" action="common/bbdd_mod_audio.php" enctype="multipart/form-data">';
						/*agregar audios*/
						echo '<input type="file" name="address">';
						echo '<input type="submit" name="add_cancion" value="agregar audio"> <br>';
						echo '<input type="text" name="details" placeholder="Detalles">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
						echo '<input type="text" name="title" placeholder="Titulo">';
						echo '<br><br> ';
						?>
		<!-- 					<div class="demo-wrapper html5-progress-bar">
		<div class="progress-bar-wrapper">
			<progress id="progressbar" value="0" max="100"></progress>
			<span class="progress-value">0%</span>
		</div>
	</div> -->
						<?php echo '<br><br> ';
			
						if ($numTuplas>0) {	
							/*lista de audios*/
							for ($i = 1; $i<=$numTuplas; $i++) {
								if ($rowAudio = mysql_fetch_array($resAudio)){
									$idsong[$i]=$rowAudio["id"];
									$song=$rowAudio["address"];
									$title=$rowAudio["title"];
									$format=$rowAudio["format"];
								

									print_r ($title);
									echo '<br>';
									echo '<audio controls loop>';
										echo '<source src='.$song.' type="audio/'.$format.'" />';										
										echo 'Tu navegador no soporta la etiqueta audio de HTML5. Puedes descargar la canción <a href="audio/tender_al_sol.mp3">aquí.</a>';								
									echo '</audio>';
									echo '<input type="submit" name="borrar_cancion'.$i.'" value="eliminar"> ';
									echo '<br>';
								}
							}
							
							echo '</form>';
						}

						
						
           	} ?>
 
		</article>		
	</section>
</div>

<?php include_once("common/footer.php"); ?>