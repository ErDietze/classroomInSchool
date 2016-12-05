<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchulklasseController
 *
 * @author rolfhackel
 */
class KlassenraumController {

    // muss immer übergeben werden
    private $action;
    // Rückgabearray
    private $objects = [];

    public function __construct($action) {
        $this->action = $action;
    }

    public function doAction() {
        switch ($this->action) {
            case 'insert':
                // Variablenempfang
                $nummerFiltered = filter_input(INPUT_POST, 'nummer', FILTER_SANITIZE_MAGIC_QUOTES);
                $nummer = isset($nummerFiltered) ? $nummerFiltered : '';
                $schulklasseIdFiltered = filter_input(INPUT_POST, 'schulklasse_id', FILTER_SANITIZE_NUMBER_INT);
                $schulklasse_id = isset($schulklasseIdFiltered) ? $schulklasseIdFiltered : '';
                $tafelIdFiltered = filter_input(INPUT_POST, 'tafel_id', FILTER_SANITIZE_NUMBER_INT);
                $tafel_id = isset($tafelIdFiltered) ? $tafelIdFiltered : '';
                
                // eigentliche action
                Klassenraum::insert(new Klassenraum($nummer, $schulklasse_id, $tafel_id));
                
                // Aufbereiten der Anzeigevariablen
                $this->objects['klassenraum'] = Klassenraum::getAll();                          
                $this->objects['view'] = 'klassenraumShow';
                $this->objects['navigation'] = 6;
                break;

            case 'delete':
                // Variablenempfang
                $idsFiltered = array_filter($_POST['ids'], 'ctype_digit');
                $ids = isset($idsFiltered) ? $idsFiltered : '';

                // eigentliche action
                Klassenraum::delete($ids);

                // Aufbereiten der Anzeigevariablen
                $this->objects['klassenraum'] = Klassenraum::getAll();
                $this->objects['view'] = 'klassenraumShow';
                $this->objects['navigation'] = 6;
                break;
            case 'update':
                // Variablenempfang
                $idFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $id = isset($idFiltered) ? $idFiltered : '';
                $nummerFiltered = filter_input(INPUT_POST, 'nummer', FILTER_SANITIZE_MAGIC_QUOTES);
                $nummer = isset($nummerFiltered) ? $nummerFiltered : '';
                $schulklassenIdFiltered = filter_input(INPUT_POST, 'schulklassen_id', FILTER_SANITIZE_NUMBER_INT);
                $schulklassen_id = isset($schulklassenIdFiltered) ? $schulklassenIdFiltered : '';
                $tafelIdFiltered = filter_input(INPUT_POST, 'tafel_id', FILTER_SANITIZE_NUMBER_INT);
                $tafel_id = isset($tafelIdFiltered) ? $tafelIdFiltered : '';

                // eigentliche action
                Klassenraum::update(new Klassenraum($nummer, $schulklassen_id, $tafel_id, $id));

                // Aufbereiten der Anzeigevariablen
                $this->objects['klassenraum'] = Klassenraum::getAll();
                $this->objects['view'] = 'klassenraumShow';
                $this->objects['navigation'] = 6;
                break;
            case 'showInsert':
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['tafelanzahl'] = Tafelanzahl::getAll();
                $this->objects['view'] = 'klassenraumShowInsert';
                $this->objects['navigation'] = 5;
                break;
            case 'showUpdate':
                // Variablenempfang
                $idFiltered = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $id = isset($idFiltered) ? $idFiltered : '';

                Klassenraum::update();
                // Aufbereiten der Anzeigevariablen
                $this->objects['klassenraum'] = Klassenraum::getAll();
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['tafelanzahl'] = Tafelanzahl::getAll();
                $this->objects['view'] = 'klassenraumShowUpdate';
                $this->objects['navigation'] = 6;
                break;
            
            case 'show':
                // Aufbereiten der Anzeigevariablen
                $this->objects['klassenraum'] = Klassenraum::getAll();
                $this->objects['view'] = 'klassenraumShow';
                $this->objects['navigation'] = 6;
                break;
            default:
                $view = 'fehler';
                throw new Exception('Übergabefehler von Variablen, klassenraumController');
        }
        return $this->objects;
    }

}


