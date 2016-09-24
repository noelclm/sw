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

if(isset($_POST['modify'])){

  $update = true;
  $psw = false;

  $resultUsers = consult("SELECT user.iduser AS iduser, user.user AS user, user.email AS email FROM user");

  foreach ($resultUsers as $key => $value) {

    if($value['user'] == $_POST['user'] && $value['iduser'] != $_POST['iduser']){
      $update = false;
      $message = "El usuario ya existe.";
    }else if($value['email'] == $_POST['email'] && $value['iduser'] != $_POST['iduser']){
      $update = false;
      $message = "El correo ya esta en uso.";
    }

  }

  if(isset($_POST['password']) && $_POST['password'] != '' && isset($_POST['password2']) && $_POST['password2'] != ''){
    $psw = true;
    if($_POST['password'] != $_POST['password2']){
        $update = false;
        $message = "Las contraseña no coinciden.";
    }
  }

  if($update){
    if($psw){
      modify("UPDATE user SET `name` = '".$_POST['name']."',`user` = '".$_POST['user']."',`psw` = '".password_hash($_POST['password'],PASSWORD_DEFAULT)."',`email` = '".$_POST['email']."' WHERE iduser = ".$_POST['iduser'].";");
      $message = "Editor ".$_POST['iduser']." modificado.";
    }else{
      modify("UPDATE user SET `name` = '".$_POST['name']."',`user` = '".$_POST['user']."',`email` = '".$_POST['email']."' WHERE iduser = ".$_POST['iduser'].";");
      $message = "Editor ".$_POST['iduser']." modificado.";
    }
    
  }

}

if(isset($_POST['iduser'])){
  
  $result = consult("SELECT user.iduser AS iduser, user.user AS user, user.name AS name,user.email AS email FROM user WHERE user.iduser = ".$_POST['iduser']. ";");

  if(count($result) == 1){

    $iduser = $result[0]['iduser'];
    $user = $result[0]['user'];
    $email = $result[0]['email'];
    $name = $result[0]['name'];

  }else{
    $message = "No ha selecionado un usuario para modificarlo";
  }
  
}

?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container height400">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>

        <form class="column marginH2" enctype="multipart/form-data" action="modificareditor.php" method="post">
          <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
          <div class="paddingV2"><label for="user">Usuario:</label><input type="text" name="user" value="<?php echo $user ?>" required/></div>
          <div class="paddingV2"><label for="name">Nombre:</label><input type="text" name="name" value="<?php echo $name ?>" required/></div>
          <div class="paddingV2"><label for="email">Email:</label><input type="text" name="email" value="<?php echo $email ?>" required/></div>
          <div class="paddingV2"><label for="password">Contraseña:</label><input type="password" name="password" /></div>
          <div class="paddingV2"><label for="password2">Rep. contr.:</label><input type="password" name="password2" /></div>
          <div class="paddingV2"><input type="submit" class="col-l-2 col-s-2 col-xs-2" name="modify" value="Guardar"></div>
        </form>

    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>