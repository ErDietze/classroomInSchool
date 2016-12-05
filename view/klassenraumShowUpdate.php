<section id='content'>
    <article>
        <header>
            <h1>Raum ändern</h1>            
            <form action='index.php' method='POST'>
                <input type='hidden' name='area' value='klassenraum' />
                <input type='hidden' name='action' value='update' />
                <table border='0' cellpadding='5' cellspacing='10' >
                    <tbody>
                        <div id="textfelder">
                        <tr>
                            <td>Raumnummer</td>
                            <td><input type="text" name="nummer" value="" size="6" required/></td>
                        </tr>
                        <tr>
                        <td>Schulklasse</td>
                        <td>
                            <select name="schulklasse_id" required>
                                <?php echo SchulklasseHTML::buildDropdown($objects['schulklassen']); ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Tafelanzahl</td>
                        <td>
                            <select name="tafel_id" required>
                                <?php echo TafelanzahlHTML::buildDropdown($objects['tafelanzahl']); ?>
                            </select>
                        </td>
                    </tr>
                    
                    </div>
                    <tr>
                        <td></td>
                            <td>
                                <input type='submit' value='Speichern' />
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </header>
    </article>
</section>