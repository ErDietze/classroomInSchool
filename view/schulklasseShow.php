<section id="content">
    <article>
        <header>
            <h1>Klassen anzeigen</h1>
            <form action="index.php" method="POST">
                <input type="hidden" name="area" value="schulklasse" />
                <input type="hidden" name="action" value="delete" /> 

                <table id="myTable" cellspacing="7px">
                    <thead>
                        <tr>
                            <th>Schulklasse</th>
                            <th><input type="submit" value="löschen" name="loeschen" /></th>
                        </tr>
                    </thead>
                    <?php 
                    echo SchulklasseHTML::buildTableContent($objects);
                    ?>
                    
                </table>
                <?php //echo $klassenInsertFail; ?>
            </form>
        </header>
    </article>
</section>
