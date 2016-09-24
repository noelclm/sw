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

$message = start(ROL_ADMIN);

?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container">

      <a href="insertareditor.php"><p>Añadir Editor</p></a>

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>


<?php

$page = '';

$result = consult("SELECT user.iduser AS iduser, ".
       "user.name AS name ".
       "FROM user ".
       "WHERE user.rol = 1 ".
       "ORDER BY user.name DESC;");

foreach ($result as $key => $value){

    $page .= "<article class=\"row\">\r\n";
    $page .= "<div class=\"col-l-10 col-s-9 col-xs-9\">\r\n";
    $page .= "<h3>".$value['name']."</h3>\r\n";
    $page .= "</div>\r\n";
    $page .= "<div class=\"col-l-2 col-s-2 col-xs-1\">\r\n";
    $page .= "<form action=\"modificareditor.php\" method=\"post\" ><input type=\"hidden\" name=\"iduser\" value=\"".$value['iduser']."\"> <input type=\"submit\" value=\"Editar\"></form>\r\n";
    $page .= "<form action=\"eliminareditor.php\" method=\"post\" ><input type=\"hidden\" name=\"iduser\" value=\"".$value['iduser']."\"> <input type=\"submit\" value=\"Eliminar\"></form>\r\n";
    $page .= "</div>\r\n";
    $page .= "</article>\r\n";

} 

echo $page;

?>


    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>