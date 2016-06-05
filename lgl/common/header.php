/*
	Practica LGL: Pagina par la asignatura SW
    Copyright (C) 2015  
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
<body>
     <div class="navbar-wrapper"><!--Se puede eliminar--><!--Segun teoría es para envolverlo con la cabecera-->
       <div class="container">
		<div class="navbar navbar-inverse navbar-static-top" role="navigation"><!--Barra de colores invertidos (inverse) y statica arriba. Lo de navigation es para mejor accesibilidad-->
          <div class="container"><!--¿Para que?-->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><!--Boton cuando la pantalla es pequeña-->
                <span class="sr-only">Botón de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><img src="imagenes/logoLGL.png" width="100" height="70" alt="LGL"></a>
            </div><!--navbar-header-->	 

			<div class="navbar-collapse collapse"><!--Barra en el menu-->
			<!--collapse in = cuando ha terminado de abrirse el menu
				collapsing = Cuando se esta abriendo o cerrando-->
              <ul class="nav navbar-nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias.php">Noticias</a></li>
                <li><a href="grupos.php">Grupos</a></li>
                <li><a href="locales.php">Locales</a></li>
                <li><a href="conocenos.php">Conocenos</a></li>
                <li><a href="buscar.php">Buscar</a></li>
              </ul>       
            </div><!--navbar-collapse collapse-->
			
             <?php 
			 include("conectarse.php");
			 if(!isset($_SESSION["idUser"])){ ?> 
                    <div id="user">
                    	<form method="post" action="common/login.php">
                        	<input type="text" name="user" value="usuario" > 
                        	<input type="password" name="password" value="password" >
                        	<input type="submit" value="Login" >
                            <a href="registro.php">Registrarte </a>
                    	</form>
                    </div>
        		<?php } else{ 
		 			echo '<div id="userOpt"><a href="userOptions.php">' . $_SESSION["user"] . ' </a>';
		 			echo '<a href="common/logout.php"> Salir</a></div>';
					
					echo '<div id="leer_msg">';
								//saber cuantos mensajes no se han leido
								$link = Conectarse();
								
								$queryMsg = "SELECT * FROM messages WHERE ((id_user_destino = '" . $_SESSION["idUser"] . "')AND (leido = 0)) ORDER BY dates DESC LIMIT 0,20;";
								$resMsg = mysql_query($queryMsg, $link);
								$c_leidos = mysql_num_rows($resMsg); 
										
								if ($c_leidos==0)
									echo '<a href="mod_messages.php" class="link_msg_nuevos"> <img src="images/email19.png" class="user_reg_msg"> </a>';
								else
									echo '<a href="mod_messages.php" class="link_msg_nuevos">  <img src="images/open57.png" class="user_reg_msg"> '.$c_leidos.' mensajes no leidos </a>';
							echo '</div>';
					mysql_close($link);
		 		} ?>
          </div><!--container-->
        </div><!--navbar navbar-inverse navbar-static-top-->
      </div><!--container-->
    </div><!--navbar-wrapper-->