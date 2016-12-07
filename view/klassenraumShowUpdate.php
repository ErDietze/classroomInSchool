<section id='content'>
    <article>
        <header>
            <h1>Raum ändern</h1>            
            <form action='index.php' method='POST'>
                <input type='hidden' name='area' value='klassenraum' />
                <input type='hidden' name='action' value='update' />
                <table border='0' cellpadding='5' cellspacing='10' >
                    <tbody>
                        <?php
//                        echo '<pre>';
//                        print_r($objects);
//                        echo '</pre>';
//                        
                        ?>
                    <div id="textfelder">
                        <tr>
                            <td>Raumnummer</td>
                            <td><input type='text' name='nummer' value='<?php echo $objects['klassenraum']->getNummer(); ?>' size='30' /></td>
                        </tr>
                        <tr>
                            <td>Schulklasse</td>
                            <td>

                                <select name="schulklassen_id" required>
                                    <?php echo KlassenraumHTML::buildDropdown($objects['schulklassen']
                                            , $objects['klassenraum']->getSchulklassen_id());
                                                                       ?>
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Tafelanzahl</td>
                            <td>
                               
                                <select name="tafel_id" required>
<?php echo TafelanzahlHTML::buildDropdown2($objects['tafelanzahl'], $objects['klassenraum']->getTafel_id()); ?>
                                                                     
                                </select>
                            </td>
                        </tr>

                    </div>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Speichern' />
                            <input type='reset' value='reset' />
                        </td>
                        <input type='hidden' name='id' value='<?php echo $objects['klassenraum']->getId(); ?>'/>
                    </tr>
                    </tbody>
                </table>
            </form>

        </header>
    </article>
</section>