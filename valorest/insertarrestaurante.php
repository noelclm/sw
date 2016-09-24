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

if(isset($_POST['insert'])){

  $uploadedfileload = true;

  if ($_FILES['uploadedfile']['size']>200000){
    $message = "El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
    $uploadedfileload = false;
  }

  if (!($_FILES['uploadedfile']['type'] =="image/pjpeg" OR $_FILES['uploadedfile']['type'] == "image/jpeg" OR $_FILES['uploadedfile']['type'] =="image/gif")){
    $message=" Tu archivo tiene que ser JPG o GIF.";
    $uploadedfileload = false;
  }

  $file_name=$_FILES['uploadedfile']['name'];
  $add="restaurants/".generateRandomString().$file_name;
  if($uploadedfileload==true){

    if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add)){

      $sequence = consult("SELECT restaurant.sequence AS sequence FROM restaurant ORDER BY sequence DESC LIMIT 1");
      $pos = $sequence[0]['sequence']+1;
      if(($id = insert("INSERT INTO restaurant (`idcountry`,`idprovince`,`image`,`name`,`address1`,`address2`,`phone`,`web`,`email`,`halfprice`,`description`,`frontpage`,`sequence`) VALUES (".$_POST['country'].",".$_POST['province'].",'".$add."','".$_POST['name']."','".$_POST['address1']."','".$_POST['address2']."','".$_POST['phone']."','".$_POST['web']."','".$_POST['email']."',".$_POST['halfprice'].",'".$_POST['description']."','N',".$pos.")"))!== false){
        $message = "Restaurante ".$id." insertado";
        foreach ($_POST['tags'] as $key => $value) {
          insert("INSERT INTO tagrestaurant (`idtag`,`idrestaurant`) VALUES (".$value.",".$id.")");
        }
      }

    }else{
      $message = "Error al subir el archivo";
    }
  }
}

?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container height700">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>

        <form class="column marginH2" enctype="multipart/form-data" action="insertarrestaurante.php" method="post">
          <div class="paddingV2"><label for="name">Nombre:</label><input type="text" name="name" required/></div>
          <div class="paddingV2"><label for="address1">Dirección 1:</label><input type="text" name="address1" required/></div>
          <div class="paddingV2"><label for="address2">Dirección 2:</label><input type="text" name="address2" required/></div>
          <div class="paddingV2"><label for="country">Pais:</label><select name="country" />
          <?php

          $countrys = consult("SELECT country.idcountry AS idcountry, country.name AS name FROM country ");
          foreach ($countrys as $key => $value) {
            echo "<option value=\"".$value['idcountry']."\">".$value['name']."</option>";
          }

          ?>
          </select></div>
          <div class="paddingV2"><label for="province">Provincia:</label><select name="province" />
          <?php

          $countrys = consult("SELECT province.idprovince AS idprovince, province.name AS name FROM province ");
          foreach ($countrys as $key => $value) {
            echo "<option value=\"".$value['idprovince']."\">".$value['name']."</option>";
          }

          ?>
          </select></div>
          <div class="paddingV2"><label for="tags">Tags:</label><select multiple name="tags[]" required/>
          <?php

          $countrys = consult("SELECT tag.idtag AS idtag, tag.name AS name FROM tag ");
          foreach ($countrys as $key => $value) {
            echo "<option value=\"".$value['idtag']."\">".$value['name']."</option>";
          }

          ?>
          </select></div>
          <div class="paddingV2"><label for="phone">Teléfono:</label><input type="text" name="phone" required/></div>
          <div class="paddingV2"><label for="web">Web:</label><input type="text" name="web" required/></div>
          <div class="paddingV2"><label for="email">email:</label><input type="text" name="email" required/></div>
          <div class="paddingV2"><label for="halfprice">Precio Medio:</label><input type="text" name="halfprice" required/></div>
          <div class="paddingV2"><label for="uploadedfile">Imagen:</label><input type="file" name="uploadedfile" accept="image/pjpeg,image/gif" required/></div>
          <div class="paddingV2"><label for="description">Descripción:</label><textarea name="description" rows="4" cols="50" required></textarea></div>
          <div class="paddingV2"><input type="submit" class="col-l-2 col-s-2 col-xs-2" name="insert" value="Guardar"></div>
        </form>

    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>