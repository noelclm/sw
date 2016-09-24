<?php

/*
	Practica ValoRest: Pagina par la asignatura SW
    Copyright (C) 2016  
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

require_once('lib/global.php');

$message = start(ROL_EDIT);

if(isset($_POST['idrestaurant'])){

  remove("DELETE FROM restaurant WHERE idrestaurant = ".$_POST['idrestaurant']);
  remove("DELETE FROM tagrestaurant WHERE idrestaurant = ".$_POST['idrestaurant']);
  $message = "Restaurante ".$_POST['idrestaurant']." eliminado";
  

}else{
  $message = "No ha selecionado un restaurante para eliminarlo";
}


?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>

    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>