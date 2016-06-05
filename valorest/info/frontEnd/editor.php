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
        <div class="center-margin row-column ">

            <!--Con grow2 ocupa todo el espacio posible, dejando lo justo para los demas elemntos-->
            <div id="carcase" class="grow2">

                <h2>Restaurantes más votados</h2>
                
                <article class="row-column">

                    <div>
                        <img class="img-normal" src="img/zenmarket.jpg">
                    </div>
                    <div>
                        <h3><a href="zenmarket.php">ZenMarket</a></h3>
                        <p>Con capacidad para acoger a 290 personas en sus 2.000 metros cuadrados de espacio, cautiva a través de los sentidos, con piezas milenarias que decoran sus paredes y sus salones, mientras que una fusión de su cocina japonesa y china, consigue conquistar lo paladares más exquisitos.</p>
                        <p>Tags: Internacional, Comer</p>
                    </div>
                    
                </article>

                <article class="row-column">

                    <div>
                        <img class="img-normal" src="img/losamigos.jpg">
                    </div>
                    <div>
                        <h3><a href="losamigos.php">Bar Los Amigos</a></h3>
                        <p>Situado en Ezequiel Solana, una calle ancha entre La Almudena y Ascao plagada de comercios de barrio de todo tipo de productos y en la que no faltan multitud de bares, si bien ninguno es, ni de lejos, tan famoso como éste.</p>
                        <p>Tags: Nacional, Tapeo</p>
                    </div>
                    
                </article>

                <article class="row-column">

                    <div>
                        <img class="img-normal" src="img/7copas.jpg">
                    </div>
                    <div>
                        <h3><a href="7copas.php">Siete Copas Bar</a></h3>
                        <p>El 01 de Junio de 1997 SieteCopasCafé, inicialmente llamado Café 7, abrió sus puertas en el madrileño barrio de Castillejos, recién inagurado el último tramo en obras que completaba la calle Sor Ángela de la Cruz, en el número 30, muy cerca de la Pza. Cuzco/Castellana. En aquel entonces, el local estaba dedicado principalmente a la venta de exquisitos y variados tipos de café, de varias zonas del mundo, cervezas, combinados, así como raciones y picoteo en general y su decoración recordaba a la de una terraza de playa.</p>
                        <p>Tags: Nacional,Internacional,Copas</p>
                    </div>
                    
                </article>
                
            </div>

            <div id="carcase2">

                <?php 
                    //Incluimos el fichero menu admin solo para admin
                    //Contiene el menú
                    include_once("common/menuedit.php"); 
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