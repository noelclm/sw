<?php

function getPage(){
  $page = "<h2>Restaurantes más votados</h2>";

  $result = consult("SELECT restaurante.idrestaurante AS idrestaurante, ".
         "restaurante.foto AS foto, ".
         "restaurante.nombre AS nombre, ".
         "restaurante.descripcion AS descripcion ".
         "FROM restaurante ".
         "WHERE enportada = 'S' ".
         "ORDER BY idrestaurante DESC;");

  foreach ($result as $key => $value){

      $page .= "<article class=\"row-column\">\r\n";
      $page .= "<div>\r\n";
      $page .= "<img class=\"img-normal\" src=\"img/".$value['foto']."\">\r\n";
      $page .= "</div>\r\n";
      $page .= "<div>\r\n";
      $page .= "<h3><a href=\"restaurante.php?idrestaurante=".$value['idrestaurante']."\">".$value['nombre']."</a></h3>\r\n";
      $page .= "<p>".$value['descripcion']."</p>\r\n";
      $page .= "<p> - ";
      
      $result2 = consult("SELECT tag.idtag AS id, tag.nombre AS nombre FROM tag LEFT JOIN tagrestaurante ON tagrestaurante.idtag = tag.idtag WHERE tagrestaurante.idrestaurante = ".$value['idrestaurante']);
      foreach ($result2 as $key2 => $value2){
        $page .= "<a href=\"lista.php?idtag=".$value2['id']."\">".$value2['nombre']."</a> - ";
      }

      $page .= "</p>\r\n";
      $page .= "</div>\r\n";
      $page .= "</article>\r\n";

  } 

  return $page;
}


?>