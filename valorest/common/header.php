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

?>
<header>

    <div class="row center-800">

        <div id="logo" class="grow2">

            <h1><a href="index.php">ValoRest</a></h1>

        </div>

        <nav id="menu" class="menu-header">
            <a href="#" class="nav-mobile" id="nav-mobile"></a>
            <ul>

<?php
foreach (getMenu(1) as $key => $value) {
    if(strstr($_SERVER['REQUEST_URI'], $value['page'])){
        echo "<li><a href=\"".$value['page'].".php?".$value['parameter']."\" id=\"menu-active\">".$value['name']."</a></li>\r\n";
    }else{
        echo "<li><a href=\"".$value['page'].".php?".$value['parameter']."\">".$value['name']."</a></li>\r\n";
    }
}
?>

            </ul>
        </nav>
        
    </div>

    <div id="menu2">
        <ul class="row center-800">
   
<?php 
if(isset($_SESSION['Rol']) && $_SESSION['Rol'] > 0){
    foreach (getMenu(2) as $key => $value){
        if(strstr($_SERVER['REQUEST_URI'], $value['page'])){
            echo " <li><a href=\"".$value['page'].".php?".$value['parameter']."\" id=\"menu2-active\">".$value['name']."</a></li> \r\n";
        }else{
            echo " <li><a href=\"".$value['page'].".php?".$value['parameter']."\" >".$value['name']."</a></li> \r\n";
        }
    }
}

// Dependiendo si esta logeado o no muestra un mensaje distinto
if(isset($_SESSION['Login']) && $_SESSION['Login']==true){
    // Si esta en la pagina de login la muestra como selecionada
    if(strstr($_SERVER['REQUEST_URI'], 'login')){
        echo "<li><a href=\"login.php?logOut=true\" id=\"menu2-active\">Logout</a></li>\r\n";
    }else{
        echo "<li><a href=\"login.php?logOut=true\">Logout</a></li>\r\n";
    }
}else{
    if(strstr($_SERVER['REQUEST_URI'], 'login')){
        echo "<li><a href=\"login.php\" id=\"menu2-active\">Login</a></li>\r\n";
    }else{
        echo "<li><a href=\"login.php\">Login</a></li>\r\n";
    }
}
?>

        </ul>
    </div>

</header>
