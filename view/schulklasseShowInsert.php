<section id="content">
    <article>
        <header>
            <h1>Neue Klasse anlegen</h1>
            <form action="index.php" method="POST">
                <input type="hidden" name="area" value="schulklasse" />
                <input type="hidden" name="action" value="insert" />
                <table border="0" cellpadding="5" cellspacing="10" >
                    <tbody>
                    <div id="textfelder">
                        <tr>
                            <td>Schulklassennamen</td>
                            <td><input type="text" name="name" value="" size="30" required/></td>
                        </tr>
                    </div>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Absenden" />
                            <input type="reset" value="reset" /></td>
                    </tr>
                    </tbody>                    
                </table>                
            </form>            
        </header>
    </article>
</section>
