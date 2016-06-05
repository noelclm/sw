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

                <h2>Gestión de Editores</h2>

                <button type="submit">Insertar</button>

                <!--Lista de eeditores donde puede modificarlos eliminarlos e insertar nuevos-->
                <article class="row">

                    <div class="grow2">
                        <p>Evey<p>
                    </div>
                    <div>
                        <button type="submit">Modificar</button>
                        <button type="submit">Eliminar</button>
                    </div>
                    
                </article>

                <article class="row">

                    <div class="grow2">
                        <p>Jessica<p>
                    </div>
                    <div>
                        <button type="submit">Modificar</button>
                        <button type="submit">Eliminar</button>
                    </div>
                    
                </article>

                <article class="row">

                    <div class="grow2">
                        <p>Luisito<p>
                    </div>
                    <div>
                        <button type="submit">Modificar</button>
                        <button type="submit">Eliminar</button>
                    </div>
                    
                </article>
                
            </div>

            <div id="carcase2">

                <?php 
                    //Incluimos el fichero menu admin solo para admin
                    //Contiene el menú
                    include_once("common/menuadmin.php"); 
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