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


if(isset($_POST['modify'])){

  if($_FILES['uploadedfile']['size'] > 0){

    $uploadedfileload = true;

    if ($_FILES['uploadedfile']['size']>200000){
      $message = "El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
      $uploadedfileload = false;
    }

    if (!($_FILES['uploadedfile']['type'] =="image/pjpeg" OR $_FILES['uploadedfile']['type'] == "image/jpeg" OR $_FILES['uploadedfile']['type'] =="image/gif")){
      $message = " Tu archivo tiene que ser JPG o GIF.";
      $uploadedfileload = false;
    }

    $file_name=$_FILES['uploadedfile']['name'];
    $add="restaurants/".generateRandomString().$file_name;
    if($uploadedfileload==true){

      if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add)){

        $result = consult("SELECT restaurant.image AS image FROM restaurant WHERE restaurant.idrestaurant = ".$_POST['idrestaurant'].";");
        if(count($result) == 1){
          unlink($result[0]['image']);
        }
        modify("UPDATE restaurant SET `name` = '".$_POST['name']."',
          `image` = '".$add."',
          `address1` = '".$_POST['address1']."',
          `address2` = '".$_POST['address2']."',
          `phone` = '".$_POST['phone']."',
          `web` = '".$_POST['web']."',
          `email` = '".$_POST['email']."',
          `halfprice` = ".$_POST['halfprice'].",
          `description` = '".$_POST['description']."' 
          WHERE idrestaurant = ".$_POST['idrestaurant']);
        $message = "Restaurante ".$_POST['idrestaurant']." modificado con imagen";

        remove("DELETE FROM tagrestaurant WHERE idrestaurant = ".$_POST['idrestaurant']);
        foreach ($_POST['tags'] as $key => $value) {
          insert("INSERT INTO tagrestaurant (`idtag`,`idrestaurant`) VALUES (".$value.",".$id.")");
        }

      }else{
        $message = "Error al subir el archivo";
      }
    }

  }else{
    modify("UPDATE restaurant SET `name` = '".$_POST['name']."',
      `address1` = '".$_POST['address1']."',
      `address2` = '".$_POST['address2']."',
      `phone` = '".$_POST['phone']."',
      `web` = '".$_POST['web']."',
      `email` = '".$_POST['email']."',
      `halfprice` = ".$_POST['halfprice'].",
      `description` = '".$_POST['description']."' 
      WHERE idrestaurant = ".$_POST['idrestaurant']);
    $message = "Restaurante ".$_POST['idrestaurant']." modificado";

    remove("DELETE FROM tagrestaurant WHERE idrestaurant = ".$_POST['idrestaurant']);
    foreach ($_POST['tags'] as $key => $value) {
      insert("INSERT INTO tagrestaurant (`idtag`,`idrestaurant`) VALUES (".$value.",".$_POST['idrestaurant'].")");
    }
  }

  

}

if(isset($_POST['idrestaurant'])){
  
  $result = consult("SELECT restaurant.idrestaurant AS idrestaurant, ".
       "restaurant.image AS image, ".
       "restaurant.name AS name, ".
       "restaurant.address1 AS address1, ".
       "restaurant.address2 AS address2, ".
       "restaurant.idprovince AS idprovince, ".
       "restaurant.idcountry AS idcountry, ".
       "restaurant.phone AS phone, ".
       "restaurant.web AS web, ".
       "restaurant.email AS email, ".
       "restaurant.halfprice AS halfprice, ".
       "country.name AS country, ".
       "province.name AS province, ".
       "restaurant.description AS description ".
       "FROM restaurant ".
       "INNER JOIN country ON restaurant.idcountry = country.idcountry ".
       "INNER JOIN province ON restaurant.idprovince = province.idprovince ".
       "WHERE restaurant.idrestaurant = ".$_POST['idrestaurant']." ".
       ";");

  if(count($result) == 1){

    $idrestaurant = $result[0]['idrestaurant'];
    $image = $result[0]['image'];
    $name = $result[0]['name'];
    $address1 = $result[0]['address1'];
    $address2 = $result[0]['address2'];
    $idprovince = $result[0]['idprovince'];
    $idcountry = $result[0]['idcountry'];
    $phone = $result[0]['phone'];
    $web = $result[0]['web'];
    $email = $result[0]['email'];
    $halfprice = $result[0]['halfprice'];
    $description = $result[0]['description'];

    $tag = consult("SELECT tagrestaurant.idtag AS idtag FROM tagrestaurant WHERE tagrestaurant.idrestaurant = ".$_POST['idrestaurant']."");
    $tagsrestaurant = array();
    foreach ($tag as $key => $value) {
      $tagsrestaurant[] = $value['idtag'];
    }

  }else{
    $message = "No ha selecionado un restaurante para modificarlo";
  }

}


?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container height700">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>

        <form class="column marginH2" enctype="multipart/form-data" action="modificarrestaurante.php" method="post">
          <input type="hidden" name="idrestaurant" value="<?php echo $idrestaurant ?>">
          <div class="paddingV2"><label for="name">Nombre:</label><input type="text" name="name" value="<?php echo $name ?>" required/></div>
          <div class="paddingV2"><label for="address1">Dirección 1:</label><input type="text" name="address1" value="<?php echo $address1 ?>" required/></div>
          <div class="paddingV2"><label for="address2">Dirección 2:</label><input type="text" name="address2" value="<?php echo $address2 ?>" required/></div>
          <div class="paddingV2"><label for="country">Pais:</label><select name="country" />
          <?php

          $countrys = consult("SELECT country.idcountry AS idcountry, country.name AS name FROM country ");
          foreach ($countrys as $key => $value) {
            if($idcountry == $value['idcountry']){
              echo "<option value=\"".$value['idcountry']."\" selected >".$value['name']."</option>";
            }else{  
              echo "<option value=\"".$value['idcountry']."\">".$value['name']."</option>";
            }
          }

          ?>
          </select></div>
          <div class="paddingV2"><label for="province">Provincia:</label><select name="province" />
          <?php

          $provinces = consult("SELECT province.idprovince AS idprovince, province.name AS name FROM province ");
          foreach ($provinces as $key => $value) {
            if($idprovince == $value['idprovince']){
              echo "<option value=\"".$value['idprovince']."\" selected >".$value['name']."</option>";
            }else {
              echo "<option value=\"".$value['idprovince']."\">".$value['name']."</option>";
            }
          }

          ?>
          </select></div>
          <div class="paddingV2"><label for="tags">Tags:</label><select multiple name="tags[]" required/>
          <?php

          $tags = consult("SELECT tag.idtag AS idtag, tag.name AS name FROM tag ");
          foreach ($tags as $key => $value) {
            if(in_array($value['idtag'], $tagsrestaurant)){
              echo "<option value=\"".$value['idtag']."\" selected >".$value['name']."</option>";
            }else{
              echo "<option value=\"".$value['idtag']."\">".$value['name']."</option>";
            }
          }

          ?>
          </select></div>
          <div class="paddingV2"><label for="phone">Teléfono:</label><input type="text" name="phone" value="<?php echo $phone ?>" required/></div>
          <div class="paddingV2"><label for="web">Web:</label><input type="text" name="web" value="<?php echo $web ?>" required/></div>
          <div class="paddingV2"><label for="email">email:</label><input type="text" name="email" value="<?php echo $email ?>" required/></div>
          <div class="paddingV2"><label for="halfprice">Precio Medio:</label><input type="text" name="halfprice" value="<?php echo $halfprice ?>" required/></div>
          <div class="paddingV2"><img class="col-l-1 col-s-1 col-xs-1" src="<?php echo $image ?>"><label for="uploadedfile">Imagen:</label><input type="file" name="uploadedfile" accept="image/pjpeg,image/gif" /></div>
          <div class="paddingV2"><label for="description">Descripción:</label><textarea name="description" rows="4" cols="50" required><?php echo $description ?></textarea></div>
          <div class="paddingV2"><input type="submit" class="col-l-2 col-s-2 col-xs-2" name="modify" value="Guardar"></div>
        </form>

    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>