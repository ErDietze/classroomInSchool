<?php

try {
    include './config.php';
    spl_autoload_register(function($class) { //automatisches einbinden vom Klassen!
        try {
            if (is_file('./class/' . $class . '.php')) {
                include './class/' . $class . '.php';
            } elseif (is_file('./controller/' . $class . '.php')) {
                include './controller/' . $class . '.php';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    });

//erwartet schueler oder schulklasse, mit REQUEST wird GET und POST aufgefangen
    if (isset($_POST['area'])) {
        $areaFiltered = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_MAGIC_QUOTES);
    } else {
        $areaFiltered = filter_input(INPUT_GET, 'area', FILTER_SANITIZE_MAGIC_QUOTES);
    }
    $area = isset($areaFiltered) ? $areaFiltered : 'schueler';

//erwartet: insert , update, show, showInsert, showUpdate
    if (isset($_POST['action'])) {
        $actionFiltered = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_MAGIC_QUOTES);
    } else {
        $actionFiltered = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_MAGIC_QUOTES);
    }
    $action = isset($actionFiltered) ? $actionFiltered : 'show';

    if ($area === 'schueler') {
        // SchuelerController einbinden
        $controller = new SchuelerController($action);
    } elseif ($area === 'schulklasse') {
        // SchulklassenController einbinden
        $controller = new SchulklasseController($action);
    } elseif ($area === 'klassenraum') {
        // SchulklassenController einbinden
        $controller = new KlassenraumController($action);
    } else {
        $view = 'fehler';
        throw new Exception("unbeknnte area gewählt");
    }
    if (isset($controller)) {
        $objects = $controller->doAction();
        $view = $objects['view'];
    }

    include 'view/begin.php';
    include './view/' . $view . '.php';
} catch (Exception $e) {
    include 'view/begin.php';
    $view = 'fehler';
    include './view/' . $view . '.php';
}
include 'view/ende.php';
?>


