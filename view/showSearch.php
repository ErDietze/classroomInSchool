
<section id="content">
    <article>
        <header>
            <h1>Datenbanksuche</h1>
            <form action="index.php" method="POST">
               <input type="hidden" name="area" value="schueler" />
                <input type="hidden" name="action" value="show" />
                <table border="0" cellpadding="5" cellspacing="10" >
                    <tbody>
                    <div id="textfelder">
                        <tr>
                            <td>Vorname</td>
                            <td><input type="text" name="vorname" value="" size="30" placeholder="suche Vorname:"/></td>
                        </tr>
                        <tr>
                            <td>Nachname</td>
                            <td><input type="text" name="nachname" value="" size="30" placeholder="suche Nachname:"/></td>
                        </tr>
                    </div>
                    <tr>
                        <td>Schulklasse</td>
                        <td>
                            <select name="schulklasse_id">
                            <?php echo SchulklasseHTML::buildDropdown($objects['schulklassen']); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Absenden" />
                            <input type="reset" value="reset" />
                        </td>
                    </tr>

                    </tbody>
                </table>
            </form>
        </header>
    </article>
</section>


