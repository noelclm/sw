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
<?php include_once("common/head.php"); ?>
<?php include_once("common/header.php"); ?>

<div class="container">
	<section> 
		<article> 
			<div class="row">
            
            	<div id='containermenu'>						
                    <div class="col-md-4" id="menu-c" >
                        <h2> Menu </h2>
                        <a href="#contacto"> <p> Contacto </p></a>
                        <a href="#integrantes"> <p> Integrantes </p></a>			
                        <a href="#descripcion"> <p> Descripcion del proyecto</p></a>
                        <a href="datos/Casosdeuso.pdf"> <p> Casos de uso</p></a>
                        <a href="#sitemap"> <p> SiteMap</p></a>
                    </div>
			    </div>
		  
				<div class="col-md-8" id="datos">	
                
                		<h2 id='contacto'>Contacto </h2>
                        
						<p>Dentro de poco habra un formulario de contacto en esta sección mientras tanto puede ponerse en contacto con los administradores de la página mediante un mail a: <a href="mailto:localgrouplinked@gmail.com">localgrouplinked@gmail.com</a></p>			
										
						<h2 id='integrantes'> Integrantes del Grupo G5 de Sistemas Web </h2>

						<p>-Noel Clemente Montero <br />-Raquel Gómez Marcos <br />-Pablo Olivera Zaldua </p>
			
						<h2 id='descripcion'> Descripción de proyecto </h2>

						<p>El propósito de la práctica es realizar una página para ofrecer la posibilidad a los grupos de música y a los locales, tanto de ensayo como salas de concierto, de ponerse en contacto y promocionarse. <br /> Los visitantes que no esten logados podrán ver todos los grupos y locales, tanto sus fotos, videos y música que tengan subido, pero no ponerse en contacto. <br /> Los usuarios registrados podrán, a parte de ver a los demás usuarios, ponerse en contacto con ellos, dejar comentarios en sus espacios y puntuar al grupo. Podrán tambien subir noticias para promocionar conciertos, la salida de discos nuevos, nuevos videos o canciones, etc. <br /> Los administradores podrán gestionar los usuarios, los comentarios y las noticias. También podrán modificar ciertos aspectos de la página como el fondo o banners.</p> 
                        
                        <h2 id='sitemap'>Sitemap</h2>

                        <p>Menú
                            <br /><a href="index.php" >-Inicio</a> Aquí encontrarás las últimas noticias, eventos, información sobre la página y más.
                            <br /><a href="noticias.php" >-Noticias</a> En esta sección apareceran todas las noticias mostrando primero las últimas. 
                            <br /><a href="locales.php" >-Locales</a> Mostrará una lista con todos los locales registrados en la página. (Pulsando en el nombre del usuario se poda acceder a su perfil para verlo)
                            <br /><a href="grupos.php" >-Grupos</a> Mostrará una lista con todos los grupos registrados en la página. (Pulsando en el nombre del usuario se poda acceder a su perfil para verlo)
                            <br /><a href="conocenos.php" >-Conocenos</a> Desde esta sección podra ponerse en contacto con los administradores de la página.
                        </p>
            
                        <p>Menú usuario
                            <br /><a href="userOptions.php">-Perfil</a> Una vez logado podrá acceder a esta sección para ver tu perfil y modificarlo.
                            <br /><a href="mod_user.php">-Editar datos</a> Formulario para modificar los datos del usuario logueado.
                            <br /><a href="mod_img_perfil.php">-Cambiar imagen de perfil</a> Para modificar la imagen de perfil.
                            <br /><a href="#">-Modificar imagenes</a> Aquí podra subir imagenes o borrarlas de tu perfil.
                            <br /><a href="mod_audio.php">-Modificar audio</a> Aquí podra subir canciones o borrarlas de tu perfil.
                            <br /><a href="#">-Modificar comentarios</a> En este apartado podras modificar tus comentarios o crear nuevos dentro de tu perfil.
                            <br /><a href="#">-Mensajes privados</a> En esta sección podras revisar si te han enviado mensajes privados, responderlos o mandar uno a otro usuario registrado.
                            <br /><a href="#">-Borrar cuenta </a> Página para borrar la cuenta de usuario.
                        </p>
								
				</div><!--Div Datos-->
					
				
			</div><!--Div Row--> 
		</article>		
	</section>
</div>

    
   
    
<?php include_once("common/footer.php"); ?>