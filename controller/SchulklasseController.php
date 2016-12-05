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
class SchulklasseController {

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
                $nameFiltered = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_MAGIC_QUOTES);
                $name = isset($nameFiltered) ? $nameFiltered : '';
                
                // eigentliche action
                Schulklasse::insert(new Schulklasse($name));
                
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schulklasseShow';
                $this->objects['navigation'] = 4;
                break;

            case 'delete':
                // Variablenempfang
                $idsFiltered = array_filter($_POST['ids'], 'ctype_digit');
                $ids = isset($idsFiltered) ? $idsFiltered : '';

                // eigentliche action
                Schulklasse::delete($ids);
                // Aufbereiten der Anzeigevariablen

                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schulklasseShow';
                $this->objects['navigation'] = 4;
                break;
            case 'update':
                // Variablenempfang
                $idFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $id = isset($idFiltered) ? $idFiltered : '';
                $nameFiltered = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_MAGIC_QUOTES);
                $name = isset($nameFiltered) ? $nameFiltered : '';

                // eigentliche action
                Schulklasse::update(new Schulklasse($name, $id));

                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schulklasseShow';
                $this->objects['navigation'] = 4;
                break;
            case 'showInsert':
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schulklasseShowInsert';
                $this->objects['navigation'] = 3;
                break;
            case 'showUpdate':
                // Variablenempfang
                $idFiltered = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $id = isset($idFiltered) ? $idFiltered : '';

                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getById($id);
                $this->objects['view'] = 'schulklasseShowUpdate';
                $this->objects['navigation'] = 4;
                break;
            case 'show':
                // Aufbereiten der Anzeigevariablen
                $this->objects['schulklassen'] = Schulklasse::getAll();
                $this->objects['view'] = 'schulklasseShow';
                $this->objects['navigation'] = 4;
                break;
            default:
                $view = 'fehler';
                throw new Exception('Übergabefehler von Variablen, schulklassenController');
        }
        return $this->objects;
    }

}
