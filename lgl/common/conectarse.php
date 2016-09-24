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
<?php

function Conectarse() {
    if (!($link = mysql_connect("server", "user", "password"))) {
		$_SESSION["errorReg"] = "Error conectando a la base de datos. Intentelo de nuevo más tarde. Si el error persiste pongase en contacto con el administrador de la página en la sección de contacto.";
		header('location:../wrong.php');
    }
    if (!mysql_select_db("localgrouplinke", $link)) {
		$_SESSION["errorReg"] = "Error seleccionando la base de datos. Contacte con el administrador en la sección de contacto.";
		header('location:../wrong.php');
    }
    return $link;
}

?>
