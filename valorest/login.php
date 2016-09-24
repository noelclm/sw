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

    

    <div class="center-800 column">

        <?php if($message != '') echo "<h2>".$message."</h2>"; ?>

        <fieldset>
            <form action="index.php" method="post">
                <label for="username">Nombre:</label><input type="text" name="username" required ><br><br>
                <label for="password">Contraseña:</label><input type="password" name="password" required ><br><br>
                <label for="saveSession">Guardar</label><input type="checkbox" value="true" name="saveSession" id="saveSession" checked/><br><br>
                <input type="hidden" name="login" value=true>
                <button type="submit">Entrar</button>
            </form>
       </fieldset>

    </div>

    <?php require_once('common/footer.php'); ?>
    
    <script src="js/functionsDown.js"></script>
    
</body>
</html>