<section id='content'>
    <article>
        <header>
            <h1>Schüler ändern</h1>
            <form action='index.php' method='POST'>
                <input type='hidden' name='area' value='schueler' />
                <input type='hidden' name='action' value='update' />
                <table border='0' cellpadding='5' cellspacing='10' >
                    <tbody>
                        <div id='textfelder'>
                            <tr>
                                <td>Vorname</td>
                                <td><input type='text' name='vorname' value='<?php echo $objects['schuelerAlt']->getVorname(); ?>' size='30' placeholder='Vorname' /></td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td><input type='text' name='nachname' value='<?php echo $objects['schuelerAlt']->getNachname();?>' size='30' placeholder='Nachname' /></td>
                            </tr>
                        </div>
                        <tr>
                            <td>Schulklasse</td>
                            <td><select name='schulklasse_id'>
                                    <?php echo SchulklasseHTML::buildDropdown($objects['schulklassen'], $objects['schuelerAlt']); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type='submit' value='Speichern' />
                                <input type='reset' value='reset' />
                            </td>
                            
                            <input type='hidden' name='id' value='<?php echo $objects['schuelerAlt']->getId(); ?>'/>
                        
                        </tr>
                    </tbody>
                </table>
            </form>

        </header>
    </article>
</section>
