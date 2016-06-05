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
			<h2> Registro </h2>
			<form method="post" action="common/registro_bbdd.php">
					<input type="text" name="userR" placeholder="usuario" >
					<input type="password" name="passwordR" placeholder="password">
					<input type="text" name="emailR" placeholder="email">
					<input type="text" name="webR" placeholder="pagina web" >
					<input type="text" name="locationR" placeholder="localizacion">
					<select name="typeR" class="selectType">
						<option disabled selected value ="Tipo de cuenta">Tipo de cuenta</option>
						<option value="local">local</option>
						<option value="grupo">grupo</option>
					</select>
					<textarea input type="text" name="infoR" placeholder="Información"></textarea> <br />
					<input type="submit" value="Registrarse" >
					</form>
				<p>Se le enviará un email a su dirección de correo para confirmarla. </p>
		</article>		
	</section>
</div>
    
<?php include_once("common/footer.php"); ?>