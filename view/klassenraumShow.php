<section id="content">
    <article>
        <header>
            <h1>Räume anzeigen</h1>
            <form action="index.php" method="POST">
                <input type="hidden" name="area" value="klassenraum" />
                <input type="hidden" name="action" value="delete" /> 

                <table id="myTable" cellspacing="7px">
                    <thead>
                        <tr>
                            <th>Raumnummer</th>
                            <th>Klassenname</th>
                            <th>Tafelanzahl</th>
                            <th><input type="submit" value="löschen" name="loeschen" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php 
                    echo KlassenraumHTML::buildTableContent($objects);
                    ?>
                    
                </table>
                <?php //echo $klassenraumInsertFail; ?>
            </form>
        </header>
    </article>
</section>