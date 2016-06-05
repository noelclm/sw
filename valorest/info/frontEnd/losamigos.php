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

                <h2>Bar Los Amigos</h2>
                
                <div id="info" class="row-column">

                    <div><img class="img-normal" src="img/losamigos.jpg"></div>

                    <div>
                        <h3>Dirección</h3>
                        <p>Ezequiel Solana, 114<br>Madrid, 28017<br>Distrito: Ciudad lineal - Barrio: Quintana<br></p>
                        <p></p>
                        <h3>Precio medio</h3>
                        <p>10€ - 20€</p>
                        <p>Tags: Nacional,Tapeo</p>
                    </div>

                </div>

                <div id="descripcion">
                    <p>Situado en Ezequiel Solana, una calle ancha entre La Almudena y Ascao plagada de comercios de barrio de todo tipo de productos y en la que no faltan multitud de bares, si bien ninguno es, ni de lejos, tan famoso como éste.</p>
                </div>

                <div id="opinion">
                    <article>
                            <h3>Evey</h3>
                            <p class="font-size10">Fecha de la comida : 31/01/2016</p>
                            <p>El mayor atractivo de este bar de barrio es que, por una caña te sirven 4 o 5 platos de tapas. Las típicas tapas fritangueras y grasientas, símbolo absoluto de nuestra gastronomía, incluso por encima de la dieta mediterránea, jejeje... El que lo conoce vuelve y vuelve.</p>
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