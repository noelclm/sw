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
include_once("common/head.php");
include_once("common/header.php"); 
include("common/conectarse.php"); ?>

<div class="container">
	<section>
		<article>
		<?php
            $link = Conectarse();
            
            $id = addslashes($_GET["id"]);
            $confirm = addslashes($_GET["confirm"]);
            
            $queryUser = "SELECT * FROM users WHERE id = '" . $id . "' AND activationKey = '" . $confirm . "'";
            $resUser = mysql_query($queryUser, $link);
            if($rowUser = mysql_fetch_array($resUser)){
                $queryUser = "UPDATE users SET confirm = TRUE WHERE id='".$id."' ";
                $resUser = mysql_query($queryUser, $link);
        		echo "<p>La cuenta a sido confirmada correctamente</p>";
            }else{
				$_SESSION["errorReg"] = "La cuenta no se ha podido confirmar, contacto con el administrador de la página";
				header('location:../wrong.php');
            }
            
        ?> 
		</article>		
	</section>
</div>
<?php include_once("common/footer.php"); ?>
