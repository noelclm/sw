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

$message = start();

?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>


<?php

$page = '';

$result = consult("SELECT restaurant.idrestaurant AS idrestaurant, ".
       "restaurant.image AS image, ".
       "restaurant.name AS name, ".
       "restaurant.description AS description ".
       "FROM restaurant ".
       "INNER JOIN tagrestaurant ON restaurant.idrestaurant=tagrestaurant.idrestaurant ".
       "WHERE tagrestaurant.idtag = 3 ".
       "ORDER BY restaurant.sequence ASC;");

foreach ($result as $key => $value){

    $page .= "<article class=\"row-column\">\r\n";
    $page .= "<div class=\"col-l-3 col-s-2 col-xs-7 marginH2\">\r\n";
    $page .= "<a href=\"restaurante.php?idrestaurant=".$value['idrestaurant']."\"><img class=\"img100 marginH2 marginV2\" src=\"".$value['image']."\"></a>\r\n";
    $page .= "</div>\r\n";
    $page .= "<div class=\"col-l-9 col-s-10 col-xs-12\">\r\n";
    $page .= "<h3><a href=\"restaurante.php?idrestaurant=".$value['idrestaurant']."\">".$value['name']."</a></h3>\r\n";
    $page .= "<p>".cutText($value['description'],350)."</p>\r\n";
    $page .= "<p> - ";
    
    $result2 = consult("SELECT tag.name AS name, menu.page AS page FROM tag LEFT JOIN menu ON tag.name = menu.name LEFT JOIN tagrestaurant ON tagrestaurant.idtag = tag.idtag WHERE tagrestaurant.idrestaurant = ".$value['idrestaurant']);
    foreach ($result2 as $key2 => $value2){
      $page .= "<a href=\"".$value2['page'].".php\">".$value2['name']."</a> - ";
    }

    $page .= "</p>\r\n";
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