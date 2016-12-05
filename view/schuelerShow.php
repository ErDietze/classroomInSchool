<section id="content">
    <article>
        <header>
            <h1>Schüler anzeigen</h1>
            <form action="index.php" method="POST">
                <input type="hidden" name="area" value="schueler" />
                <input type="hidden" name="action" value="delete" />                
                <table id="myTable" cellspacing="7px">
                    <thead>
                        <tr>
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th>Schulklasse</th>
                            <th>
                                <input type="submit" value="Löschen" name="loeschen" />
                            </th>
                        </tr>
                    </thead>
                    <?php echo SchuleHTML::buildTableContent($objects['schulklassen']); ?>
                </table>
            </form>
        </header>
    </article>
</section>