<section id='content'>
    <article>
        <header>
            <h1>Klassen ändern</h1>
            
            <form action='index.php' method='POST'>
                <input type='hidden' name='area' value='schulklasse' />
                <input type='hidden' name='action' value='update' />
                <table border='0' cellpadding='5' cellspacing='10' >
                    <tbody>
                        <div id='textfelder'>
                            <tr>
                                <td>Klassenname</td>
                                <td><input type='text' name='name' value='<?php echo $objects['schulklassen']->getName(); ?>' size='30' /></td>
                            </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type='submit' value='Speichern' />
                                <input type='hidden' name='id' value='<?php echo $objects['schulklassen']->getId(); ?>' />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </header>
    </article>
</section>