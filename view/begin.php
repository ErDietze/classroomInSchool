<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Schulverwaltung</title>
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        <!-- html5 + CSS 3 Template created by miss monorom  http://intensivstation.ch 2013 -->
        <link rel="stylesheet" href="./css/style.css" type="text/css" />
        <!-- by monorom -->

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script src="jquery.min.js" type="text/javascript"></script>
        <script src="mein_menu.js" type="text/javascript"></script>
        <script src="prefixfree.min.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="container">
            <div id="top">
                <header>
                    <p class="headerName">Schülerdatenbank</p>
                    <div class="menubutton"><a href="#"><img src="menu.png" alt=""></a></div>
                </header>


                <nav id="mainnav">

                    <ul>
                        <li><a href="index.php?area=schueler&action=showInsert" <?php
                            if($objects['navigation'] == 0) { echo 'class="selected"'; }
                        ?> >Schüler neu</a></li>
                        <li><a href="index.php?area=schueler&action=show" <?php
                            if($objects['navigation'] == 1) { echo 'class="selected"'; }
                        ?> >Schüler anzeigen</a></li>
                        <li><a href="index.php?area=schueler&action=showSearch" <?php
                            if($objects['navigation'] == 2) { echo 'class="selected"'; }
                        ?> >Suchen</a></li>
                        <li><a href="index.php?area=schulklasse&action=showInsert" <?php
                            if($objects['navigation'] == 3) { echo 'class="selected"'; }
                        ?> >Klasse neu</a></li>
                        <li><a href="index.php?area=schulklasse&action=show" <?php
                            if($objects['navigation'] == 4) { echo 'class="selected"'; }
                        ?> >Klassen anzeigen</a></li>
                        <li><a href="index.php?area=klassenraum&action=show" <?php
                            if($objects['navigation'] == 6) { echo 'class="selected"'; }
                        ?> >Klassenraum anzeigen</a></li>
                        <li><a href="index.php?area=klassenraum&action=showInsert" <?php
                            if($objects['navigation'] == 5) { echo 'class="selected"'; }
                        ?> >neuen Klassenraum erstellen</a></li>
                    </ul>
                </nav>
            </div>

           
            
                

            