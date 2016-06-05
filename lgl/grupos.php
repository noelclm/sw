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
			<h2>Grupos </h2>
			<?php $link = Conectarse();
				$queryUser = "SELECT * FROM users WHERE (type = 'grupo')";;
				$resUser = mysql_query($queryUser, $link);
				while ($rowUser = mysql_fetch_array($resUser)){
					$info = $rowUser["info"];
					$img = $rowUser["img"];
					$user = $rowUser["user"];
					echo '<p><img src="'. $img .'" width="100" height="70" alt="img"> <span><a href="perfil.php?user='.$user.'"> '.$user.' </a></span> '. $info . ' <br/></p>';
				}
			?>  
		</article>			
	</section>
</div>

<?php include_once("common/footer.php"); ?>