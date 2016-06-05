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
    <div class="container-fluid">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
            <div data-thumb="imagenes/presentacion_thumb.jpg" data-src="imagenes/presentacion.jpg">
                <div class="camera_caption fadeFromBottom">
                    Bienvenido. <em>Regístrate para poder ponerte en contacto con los demás grupos y locales.</em>
                </div>
            </div>
            <div data-thumb="imagenes/concierto_thumb.jpg" data-src="imagenes/concierto.jpg">
                <div class="camera_caption fadeFromBottom">
                    Concierto. <em></em>
                </div>
            </div>
    
        </div><!-- #camera_wrap_1 -->
    </div><!--FluidConteiner-->

	<section>
		<article>
        	
            
			<h2>Ultimas noticias</h2>
            <?php include_once("common/ultimas_noticias.php"); ?>

		</article>		
	</section>
</div>
    
<?php include_once("common/footer.php"); ?>