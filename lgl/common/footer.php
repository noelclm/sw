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
<footer>
		<span>Local-Group Linked <a href="http://validator.w3.org/check?uri=http%3A%2F%2Flocalgrouplinked.es%2F"> Validador HTLM5 </a> - <a href="http://jigsaw.w3.org/css-validator/check/referer"> 
    Validador CSS3</a></span>
</footer>
    
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script> 
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='js/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='js/camera.min.js'></script> 
	<script type="text/javascript" src="js/shadowbox.js"></script>
 
<!-- galería página principal  -->
    <script>
		jQuery(function(){
			
			jQuery('#camera_wrap_1').camera({
				thumbnails: true
			});
		});
	</script>    

<!-- Script para poner como leido los mensajes privados -->
	<script>
$(document).ready(function(){

  var elem = document.getElementsByClassName("p_msg");
  var length = elem.length;
  	$(".p_msg").click(function(e){
	var id = e.target.id;
	var id2 = "mod_messages.php #leer_msg";
	
	 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	$("#leer_msg").load(id2);
    }
  }
  
  xmlhttp.open("GET","common/bbdd_leer_msg.php?id_msg="+id,true);
  xmlhttp.send();
	
  });
});
</script>

<!-- galería de usuario -->	
    <script type="text/javascript">
		Shadowbox.init();
	</script>

</body>
</html>