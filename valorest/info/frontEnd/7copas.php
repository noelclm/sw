<html>

    <?php 
        //Incluimos el fichero head comun para todas las páginas
        //Contiene las metaetiquetas de la web
        include_once("common/head.php"); 
    ?>

    <!--Con column los elemntos que va encontrando los coloca en una columna-->
    <body class="column">

        <?php 
            //Incluimos el fichero header comun para todas las páginas
            //Contiene la barra superior con el logo
            include_once("common/header.php"); 
        ?>

        <!--Con row-column los elemntos que va encontrando los coloca en una fila-->
        <!--dependiendo de la resolucion cambia a columna-->
        <div class="center-margin row-column">

            <!--Con grow2 ocupa todo el espacio posible, dejando lo justo para los demas elemntos-->
            <div id="carcase" class="grow2">

                <h2>Siete Copas Bar</h2>
                
                <div id="info" class="row-column">

                    <div><img class="img-normal" src="img/7copas.jpg"></div>

                    <div>
                        <h3>Dirección</h3>
                        <p>C/ Sor Ángela de la Cruz, 30<br>Madrid, 28020<br>Distrito: Tetuán<br></p>
                        <p><a href="http://www.sietecopascafe.es/" target="_blank">www.sietecopascafe.es</a></p>
                        <h3>Precio medio</h3>
                        <p>10€ - 20€</p>
                        <p>Tags: Nacional,Internacional,Copas</p>
                    </div>

                </div>

                <div id="descripcion">
                    <p>El 01 de Junio de 1997 SieteCopasCafé, inicialmente llamado Café 7, abrió sus puertas en el madrileño barrio de Castillejos, recién inagurado el último tramo en obras que completaba la calle Sor Ángela de la Cruz, en el número 30, muy cerca de la Pza. Cuzco/Castellana. En aquel entonces, el local estaba dedicado principalmente a la venta de exquisitos y variados tipos de café, de varias zonas del mundo, cervezas, combinados, así como raciones y picoteo en general y su decoración recordaba a la de una terraza de playa. Ya a finales del 2001, antes del cambio de moneda, el local sufrió un cambio radical y se transformó en lo que es hoy en dia, una Taberna de estilo Irlandés, pero con todos sus elementos de caracter Español: carteles publicitarios antiguos, fotos reales de época, barriles rotulados procedentes de bodegas vinícolas, figuras, retroiluminaciones, etc... todo ello en un entorno de verdes paredes y suelos  y techos de madera. En 2010 volvimos a mejorar y se amplió enormemente la oferta en cervezas. Actualmente disponemos de 2 tipos de cerveza en barril y de más de 80 en botella. Se adecuó la decoración para todo ello, se adquirió la vajilla original de la mayoria de esas cervezas y se amplió también la oferta en alcoholes de primeras marcas, disponiendo hasta la fecha de más de 70 marcas diferentes de estos, incluyendo una veintena de Ginebras Premium (GinClub), más de 30 Rones de todos los tipos y más de 20 marcas de Whisky, nuevamente de todos los gustos y calidades. Completamos todo ello, con una exiquisita carta de Molletes recien hechos, tamaño mediano, perfecto! raciones de calidad y buen queso y nuestras afamadas aceitunas "de la abuela". Si todavía no nos conoces, en estos más de 18 años de andadura, esperamos que no tardes en hacerlo, porque estamos seguros de que te encantará y por supuesto, volverás.</p>
                </div>

                <div id="opinion">
                    <article>
                            <h3>Luisito</h3>
                            <p class="font-size10">Fecha de la comida : 11/06/2014</p>
                            <p>Sitio perfecto para venir solo o con buena compañía. Entre semana tranquilto, los findes con ambiente. Se valora que siempre veas las mismas caras del personal. Muuuuchas cervezas y muy buenas. La comida muy recomendable.</p>
                            <p>Nota: 10 /10</p>
                    </article>
                </div>

            </div>
            
            <div id="carcase2">

                <?php 
                    //Incluimos el fichero menu comun para todas las páginas
                    //Contiene el menú
                    include_once("common/menu.php"); 
                ?>

            </div>

        </div>

        <?php 
            //Incluimos el fichero footer comun para todas las páginas
            //Contiene el pie de página
            include_once("common/footer.php"); 
        ?>
        
    </body>
</html>