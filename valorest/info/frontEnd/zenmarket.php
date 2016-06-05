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

                <h2>ZenMarket</h2>
                
                <div id="info" class="row-column">

                    <div><img class="img-normal" src="img/zenmarket.jpg"></div>

                    <div>
                        <h3>Dirección</h3>
                        <p>Avda. Concha Espina, 1<br>Estadio Santiago Bernabeu (puerta 20-22)<br>28036 - Madrid<br>Tlf.: +34 91 457 18 73</p>
                        <p><a href="http://www.zenmarket.es/" target="_blank">www.zenmarket.es</a></p>
                        <h3>Precio medio</h3>
                        <p>15€ - 20€</p>
                        <p>Tags: Internacional,Comer</p>
                    </div>

                </div>

                <div id="descripcion">
                    <p>Zen Market, con capacidad para acoger a 290 personas en sus 2.000 metros cuadrados de espacio, cautiva a través de los sentidos, con piezas milenarias que decoran sus paredes y sus salones, mientras que una fusión de su cocina japonesa y china, consigue conquistar lo paladares más exquisitos. Sus especialidades son el pato laqueado y el sushi, regados con más de 350 referencias de vino nacional e internacional.</p>
                    <p>Su atractivo no radica solamente en su cocina, está en sus 11 palcos privados con vistas al campo madridista, en toda su decoración realizada por el reconocido interiorista Nacho García Vinuesa, contando con verdaderas piezas de arte chino, obras de alto valor histórico traídas desde China, entre las que destaca un milenario pórtico chino ubicado en la primera entrada del restaurante, una espectacular estatua de Mao proveniente de un exclusivo anticuario de Pekín o una amplia colección de leones de piedra de alto valor decorativo y artístico.</p>
                </div>

                <div id="opinion">
                    <article>
                            <h3>Jessica</h3>
                            <p class="font-size10">Fecha de la comida : 27/04/2016</p>
                            <p>Comida calidad y buen trato.</p>
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