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

                <h2>Nacionales</h2>
                
                <article class="row-column">

                    <div>
                        <a href="losamigos.php"><img class="img-small" src="img/losamigos.jpg"></a>
                    </div>
                    <div>
                        <p><a class="bold" href="losamigos.php">Bar Los Amigos</a> Ezequiel Solana, 114</p>
                    </div>
                    
                </article>

                <article class="row-column">

                    <div>
                        <a href="7copas.php"><img class="img-small" src="img/7copas.jpg"></a>
                    </div>
                    <div>
                        <p><a class="bold" href="7copas.php">Siete Copas Bar</a> C/ Sor Ángela de la Cruz, 30</p>
                    </div>
                    
                </article>
                
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