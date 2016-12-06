<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchuelerController
 *
 * @author rolfhackel
 */
class SchuelerController {

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
                $vornameFiltered = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_MAGIC_QUOTES);
                $vorname = isset($vornameFiltered) ? $vornameFiltered : '';
                $nachnameFiltered = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_MAGIC_QUOTES);
                $nachname = isset($nachnameFiltered) ? $nachnameFiltered : '';
                $schulklasseIdFiltered = filter_input(INPUT_POST, 'schulklasse_id', FILTER_SANITIZE_NUMBER_INT);
                $schulklasse_id = isset($schulklasseIdFiltered) ? $schulklasseIdFiltered : '';

                // eigentliche action
                Schueler::insert(new Schueler($schulklasse_id, $vorname, $nachname, NULL));

                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schuelerShow';
                $this->objects['navigation'] = 1;
                break;

            case 'delete':
                // variablenempfang
                $idsFiltered = array_filter($_POST['ids'], 'ctype_digit');
                $ids = isset($idsFiltered) ? $idsFiltered : '';
                
                // eigentliche action
                Schueler::delete($ids);
                
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schuelerShow';
                $this->objects['navigation'] = 1;
                break;
                
            case 'update':
                // Variablenempfang
                $idFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $id = isset($idFiltered) ? $idFiltered : '';
                $vornameFiltered = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_MAGIC_QUOTES);
                $vorname = isset($vornameFiltered) ? $vornameFiltered : '';
                $nachnameFiltered = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_MAGIC_QUOTES);
                $nachname = isset($nachnameFiltered) ? $nachnameFiltered : '';
                $schulklasseIdFiltered = filter_input(INPUT_POST, 'schulklasse_id', FILTER_SANITIZE_NUMBER_INT);
                $schulklasse_id = isset($schulklasseIdFiltered) ? $schulklasseIdFiltered : '';
                
                // eigentliche action
                Schueler::update(new Schueler($schulklasse_id, $vorname, $nachname, $id));
                
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schuelerShow';
                $this->objects['navigation'] = 1;
                break;
            case 'show':
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schuelerShow';
                $this->objects['navigation'] = 1;
                break;
            case 'showInsert':
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schuelerShowInsert';
                $this->objects['navigation'] = 0;
                break;
            case 'showUpdate':
                // Variablenempfang
                $idFiltered = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $id = isset($idFiltered) ? $idFiltered : '';
                
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schuelershowUpdate';
                $this->objects['navigation'] = 1;
                $this->objects['schuelerAlt'] = Schulklasse::getSchuelerById($id);
                break;
            case 'showSearch':
                                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'showSearch';
                $this->objects['navigation'] = 2;
                break;
            default:
                $view = 'fehler';
                throw new Exception('Übergabefehler von Variablen, schuelerController');
        }
        
        return $this->objects;
    }

}
