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

if(isset($_POST['save'])){
    foreach ($_POST as $key => $value) {
        modify("UPDATE restaurant SET frontpage = '".$value."' WHERE idrestaurant= ".$key);
    }
}

foreach ($_POST as $key => $value) {

    if(strstr($key, 'up')){
        $array = explode('-', $key);
        $sequence = (int)$array[1];
        $id = (int)$array[2];
        if($sequence > 1){
            $sequence1 = $sequence-1;
            modify("UPDATE restaurant SET sequence = sequence+1 WHERE sequence= ".$sequence1);
            modify("UPDATE restaurant SET sequence = sequence-1 WHERE idrestaurant= ".$id);
        }
    }
    if(strstr($key, 'down')){
        $array = explode('-', $key);
        $sequence = (int)$array[1];
        $id = (int)$array[2];
        $sequence1 = $sequence+1;
        modify("UPDATE restaurant SET sequence = sequence-1 WHERE sequence= ".$sequence1);
        modify("UPDATE restaurant SET sequence = sequence+1 WHERE idrestaurant= ".$id);
    }
}

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
   "restaurant.name AS name, ".
   "restaurant.sequence AS sequence, ".
   "if(restaurant.frontpage = 'N', 'checked', '') AS checkedN, ".
   "if(restaurant.frontpage = 'S', 'checked', '') AS checkedS ".
   "FROM restaurant ".
   "ORDER BY restaurant.sequence ASC;");

$page .= "<form class=\"col-l-12 col-s-12 col-xs-12\" action=\"portada.php\" method=\"post\">\r\n";
$page .= "<div class=\"row\">\r\n";
$page .= "<div class=\"col-l-6 col-s-6 col-xs-4\">\r\n";
$page .= "<p>Restaurante</p>\r\n";
$page .= "</div>\r\n";
$page .= "<div class=\"col-l-3 col-s-3 col-xs-4\">\r\n<p>Orden</p>\r\n</div>\r\n";
$page .= "<div class=\"col-l-3 col-s-3 col-xs-3\">\r\n<p>En portada</p>\r\n</div>\r\n";
$page .= "</div>";

foreach ($result as $key => $value){
    $page .= "<div class=\"row\">\r\n";
    $page .= "<div class=\"col-l-6 col-s-6 col-xs-6\">\r\n";
    $page .= "<p>".$value['name']."</p>\r\n";
    $page .= "</div>\r\n";
    $page .= "<div class=\"col-l-3 col-s-3 col-xs-3 row\">\r\n";
    $page .= " ".$value['sequence']." ";
    $page .= "<div class=\"column col-l-5 col-s-5 col-xs-5\">\r\n";
    $page .= "<input type=\"submit\" name=\"up-".$value['sequence']."-".$value['idrestaurant']."\" value=\"Subir\">\r\n";
    $page .= "<input type=\"submit\" name=\"down-".$value['sequence']."-".$value['idrestaurant']."\" value=\"Bajar\">\r\n";
    $page .= "</div>\r\n";
    $page .= "</div>\r\n";
    $page .= "<div class=\"col-l-3 col-s-3 col-xs-3\">\r\n";
    $page .= " Si <input type=\"radio\" name=\"".$value['idrestaurant']."\" value=\"S\" ".$value['checkedS'].">";
    $page .= " No <input type=\"radio\" name=\"".$value['idrestaurant']."\" value=\"N\" ".$value['checkedN'].">";
    $page .= "</div>\r\n";
    $page .= "</div>\r\n";
}

$page .= "<input type=\"submit\" name=\"save\" value=\"Guardar\">\r\n";
$page .= "</form>\r\n";

echo $page;

?>


    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>