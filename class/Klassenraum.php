<?php

class Klassenraum {

    private $id;
    private $nummer;
    private $schulklassen_id;
    private $tafel_id;
    private $tafeln = [];

    function getId() {
        return $this->id;
    }

    function getNummer() {
        return $this->nummer;
    }

    function getSchulklassen_id() {
        return $this->schulklassen_id;
    }

    function getTafel_id() {
        return $this->tafel_id;
    }

    function __construct($nummer, $schulklassen_id, $tafel_id, $id = NULL) {

        if (!is_null($id)) {
            $this->id = $id;
        }
        $this->nummer = $nummer;
        $this->schulklassen_id = $schulklassen_id;
        $this->tafel_id = $tafel_id;
    }

    public static function getAll() {
        try {
            $db = DbConnect::getConnection();
            //sql statemant mit prepare statements
            $stmt = $db->prepare("SELECT * FROM klassenraum");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $klassenraum = [];
            foreach ($rows as $row) {
                $klassenraum[$row['id']] = new Klassenraum($row['nummer'], $row['schulklassen_id'], $row['tafelanzahl_id']);
            }
            return $klassenraum;
        } catch (Exception $e) {
            throw new Exception('Konnte Klassenraum nicht finden.<br>' . $e->getMessage());
        }
    }

    private static function getKlassenraumById($nummer = NULL, $schulklasse_id = NULL, $tafel_id = NULL) {

        $db = DbConnect::getConnection();
        // gefilterte Suche
        // Lesezugriff auf table schulklasse UND schueler
        // fastload über 2 Tabellen, dient dem speed(nicht zwingend nötig)
//        $sql = "Select klassenraum.id as id , klassenraum.nummer, schulklasse.name as klassenname, tafelanzahl.name as tafelname from klassenraum "
//                . "join schulklasse on schulklassen_id = schulklasse.id "
//                . "join tafelanzahl on tafelanzahl_id = tafelanzahl.id";

        $sql = "Select * from klassenraum";
        $stmt = $db->prepare($sql);

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $klassenraeume = [];
        foreach ($rows as $row) {
            $k = new Klassenraum($row['nummer'], $row['schulklassen_id'], $row['tafel_id'], $row['id']);
            $klassenraeume = $k;
        }

        return $klassenraeume;
    }

    public function getSchulklasseName() {
        return Schulklasse::getById($this->schulklassen_id)->getName();
    }

    public function getTafelName() {
        return Tafelanzahl::getById($this->tafel_id)->getName();
    }

    public static function getById($suchstring) {
        try {
            $db = DbConnect::getConnection();
            // $suchstring etnhält den zu suchenden Teilstring
            // sql statment mit prepare statements
            $stmt = $db->prepare("SELECT * FROM klassenraum WHERE id = ?");
            $stmt->bindValue(1, $suchstring, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $schulklasse = new Klassenraum($row['nummer'], $row['schulklassen_id'], $row['tafelanzahl_id'], $row['id']);

            return $schulklasse;
        } catch (Exception $e) {
            throw new Exception('Konnte Schulklassen nicht ausgeben<br>' . $e->getMessage());
        }
    }

    public static function insert(Klassenraum $k) {
        try {
            $db = DbConnect::getConnection();
            $stmt = $db->prepare("INSERT INTO klassenraum VALUES (Null, ?, ?, ?)");
            $stmt->bindValue(1, $k->getNummer(), PDO::PARAM_INT);
            $stmt->bindValue(2, $k->getSchulklassen_id(), PDO::PARAM_INT);
            $stmt->bindValue(3, $k->getTafel_id(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Konnte Klassenraum nicht speichern<br>' . $e->getMessage());
        }
    }

    public static function update(Klassenraum $k) {
        try {
            $db = DbConnect::getConnection();

            $stmt = $db->prepare("UPDATE klassenraum SET nummer=?, schulklassen_id=?, tafelanzahl_id=? WHERE id=?");
            $stmt->bindValue(1, $k->getNummer(), PDO::PARAM_INT);
            $stmt->bindValue(2, $k->getSchulklassen_id(), PDO::PARAM_INT);
            $stmt->bindValue(3, $k->getTafel_id(), PDO::PARAM_INT);
            $stmt->bindValue(4, $k->getId(), PDO::PARAM_INT);
            
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Konnte Rauminfo nicht in db ändern<br>' . $e->getMessage());
        }
    }

    public static function delete($ids) {
        try {
            $db = DbConnect::getConnection();
            $stmt = $db->prepare("DELETE FROM klassenraum WHERE id = ?");
            foreach ($ids as $id) {
                $stmt->bindValue(1, $id, PDO::PARAM_INT);
                $stmt->execute();
            }
            return;
        } catch (Exception $e) {
            throw new Exception('Konnte Raum nicht löschen<br>' . $e->getMessage());
        }
    }

    public static function getTafelnById($id) {
        try {
            $objects = self::getAll();
//            echo '<pre>';
//            print_r($objects);
//            echo '</pre>';
            foreach ($objects as $sk) {
                foreach ($sk->getTafeln() as $tafeln) {

                    if ($tafeln->getId() == $id) {
                        $tafelnAlt = $tafeln;
                    }
                }
            }
            return $tafelnAlt;
        } catch (Exception $e) {
            throw new Exception('Konnte Tafeln in Klassenraum nicht finden<br>' . $e->getMessage());
        }
    }

}
