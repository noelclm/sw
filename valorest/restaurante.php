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

if(isset($_SESSION['Rol']) && $_SESSION['Rol'] >= ROL_EDIT){

  if(isset($_POST['save'])){
    $resultInsert = insert("INSERT INTO comment (`idrestaurant`,`iduser`,`score`,`date`,`comment`) VALUES (".$_GET['idrestaurant'].",".$_SESSION['IdUser'].",".$_POST['score'].",'".date("Y-m-d")."','".$_POST['comment']."')");
    if($resultInsert !== null){
      $resultScore = consult("SELECT SUM(comment.score) AS score, count(comment.idrestaurant) AS total FROM comment WHERE comment.idrestaurant = ".$_GET['idrestaurant']);
      $media = $resultScore[0]['score']/$resultScore[0]['total'];
      modify("UPDATE restaurant SET score = '".$media."' WHERE idrestaurant= ".$_GET['idrestaurant']);
    }
  }

}

?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container">

        <?php if($message != '') echo "<h2>".$message."</h2>"; 


$page = '';

if(isset($_GET['idrestaurant'])){
    
    $result = consult("SELECT restaurant.idrestaurant AS idrestaurant, ".
       "restaurant.image AS image, ".
       "restaurant.name AS name, ".
       "restaurant.address1 AS address1, ".
       "restaurant.address2 AS address2, ".
       "restaurant.phone AS phone, ".
       "restaurant.web AS web, ".
       "restaurant.email AS email, ".
       "CONCAT(REPLACE(ROUND(restaurant.halfprice,2),'.',','),'€') AS halfprice, ".
       "REPLACE(ROUND(restaurant.score,2),'.',',') AS score, ".
       "country.name AS country, ".
       "province.name AS province, ".
       "restaurant.description AS description ".
       "FROM restaurant ".
       "INNER JOIN country ON restaurant.idcountry = country.idcountry ".
       "INNER JOIN province ON restaurant.idprovince = province.idprovince ".
       "WHERE restaurant.idrestaurant = ".$_GET['idrestaurant']." ".
       ";");

}

if(!isset($result) || !count($result)){
    $page .= "<h2>No se ha encontrado el restaurante</h2>";
}else{

  foreach ($result as $key => $value){

    $page .= "<article class=\"column\">\r\n";

    $page .=  "<h2>".$value['name']."</h2>\r\n";
                
    $page .=  "<div class=\"row-column col-l-12 col-s-12 col-xs-12 marginH2\">\r\n";

    $page .=    "<div class=\"col-l-6 col-s-5 col-xs-4\"><img class=\"img100\" src=\"".$value['image']."\"></div>\r\n";

    $page .=    "<div class=\"col-l-6 col-s-7 col-xs-8\">\r\n";
    $page .=        "<h3>Dirección</h3>\r\n";
    $page .=        "<p>".$value['address1']."<br>".$value['address2']."<br>".$value['province']."-".$value['country']."<br>Tlf.: ".$value['phone']."</p>\r\n";
    $page .=        "<p><a href=\"".$value['web']."\" target=\"_blank\">".$value['web']."</a></p>\r\n";
    $page .=        "<h3>Precio medio</h3>\r\n";
    $page .=        "<p>".$value['halfprice']."</p>\r\n";
    $page .=        "<h3>Puntuación</h3>\r\n";
    $page .=        "<p>".$value['score']."</p>\r\n";
    $page .=    "</div>\r\n";

    $page .=  "</div>\r\n";

    $page .=  "<div class=\"col-l-12 col-s-12 col-xs-12\">\r\n";
    $page .=    "<p>".$value['description']."</p>\r\n";
    $page .=  "</div>\r\n";

    $page .= "<p> - ";
    
    $result2 = consult("SELECT tag.name AS name, menu.page AS page FROM tag LEFT JOIN menu ON tag.name = menu.name LEFT JOIN tagrestaurant ON tagrestaurant.idtag = tag.idtag WHERE tagrestaurant.idrestaurant = ".$value['idrestaurant']);
    foreach ($result2 as $key2 => $value2){
      $page .= "<a href=\"".$value2['page'].".php\">".$value2['name']."</a> - ";
    }
    $page .= "</p>\r\n";
    $page .= "</article>\r\n";

    $result3 = consult("SELECT user.name AS user, ROUND(comment.score,0) AS score, comment.date AS commentDate, comment.comment AS comment FROM comment INNER JOIN user ON comment.iduser = user.iduser WHERE comment.idrestaurant = ".$value['idrestaurant']);
    foreach ($result3 as $key3 => $value3){
      $page .= "<article>\r\n";
      $page .= "<h3>".$value3['user']."</h3>\r\n";
      $page .= "<p class=\"font-size10\">Fecha : ".$value3['commentDate']."</p>\r\n";
      $page .= "<p>".$value3['comment']."</p>\r\n";
      $page .= "<p>Nota: ".$value3['score']."/10</p>\r\n";
      $page .= "</article>\r\n";
    }

    // Si esta logueado puede meter comentarios
    if(isset($_SESSION['Rol']) && $_SESSION['Rol'] >= ROL_EDIT){

      $page .= "<article>\r\n";

      $page .= "<h3>Insertar comentario</h3>\r\n";

      $page .= "<form class=\"column marginH2\" action=\"restaurante.php?idrestaurant=".$_GET['idrestaurant']."\" method=\"post\">\r\n";

      $page .= "<p>Puntuación</p> <select class=\"col-l-1 col-s-1 col-xs-1\" name=\"score\">
                  <option value=\"10\">10</option>
                  <option value=\"9\">9</option>
                  <option value=\"8\">8</option>
                  <option value=\"7\">7</option>
                  <option value=\"6\">6</option>
                  <option value=\"5\">5</option>
                  <option value=\"4\">4</option>
                  <option value=\"3\">3</option>
                  <option value=\"2\">2</option>
                  <option value=\"1\">1</option>
                  <option value=\"0\">0</option>
                </select>\r\n";
      $page .= "<p>Comentario</p><textarea name=\"comment\" rows=\"4\" cols=\"50\"></textarea>\r\n";
      $page .= "<input type=\"submit\" class=\"col-l-1 col-s-1 col-xs-2\" name=\"save\" value=\"Guardar\">\r\n";
      $page .= "</form>\r\n";
      $page .= "</article>\r\n";

    }

  }

} 

echo $page;

?>


    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>