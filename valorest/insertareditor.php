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

if(isset($_POST['insert'])){

  $insert = true;

  $resultScore = consult("SELECT user.user AS user, user.email AS email FROM user");

  foreach ($resultScore as $key => $value) {

    if($value['user'] == $_POST['user']){
      $insert = false;
      $message = "El usuario ya existe.";
    }else if($value['email'] == $_POST['email']){
      $insert = false;
      $message = "El correo ya esta en uso.";
    }

  }

  if($_POST['password'] != $_POST['password2']){
      $insert = false;
      $message = "Las contraseña no coinciden.";
  }

  if($insert){
    if(($id = insert("INSERT INTO user (`name`,`user`,`psw`,`email`,`rol`) VALUES ('".$_POST['name']."','".$_POST['user']."','".password_hash($_POST['password'],PASSWORD_DEFAULT)."','".$_POST['email']."',1)"))!== false){
      $message = "Editor ".$id." insertado.";
    }else{
      $message = "Error al insertar.";
    }
  }
  
}

?>

<html lang="es">
<?php require_once('common/head.php'); ?>
<body class="column">

    <?php require_once('common/header.php'); ?>

    <div class="center-800 column container height400">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>

        <form class="column marginH2" enctype="multipart/form-data" action="insertareditor.php" method="post">
          <div class="paddingV2"><label for="user">Usuario:</label><input type="text" name="user" required/></div>
          <div class="paddingV2"><label for="name">Nombre:</label><input type="text" name="name" required/></div>
          <div class="paddingV2"><label for="email">Email:</label><input type="text" name="email" required/></div>
          <div class="paddingV2"><label for="password">Contraseña:</label><input type="password" name="password" required/></div>
          <div class="paddingV2"><label for="password2">Rep. contr.:</label><input type="password" name="password2" required/></div>
          <div class="paddingV2"><input type="submit" class="col-l-2 col-s-2 col-xs-2" name="insert" value="Guardar"></div>
        </form>

    </div>

    <?php require_once('common/footer.php'); ?>

    <script src="js/functionsDown.js"></script>
    
</body>
</html>