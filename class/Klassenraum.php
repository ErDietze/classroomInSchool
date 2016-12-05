<?php

class Klassenraum {

    private $id;
    private $nummer;
    private $schulklassen_id;
    private $tafel_id;

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

    public static function insert(Klassenraum $s) {
        try {
            $db = DbConnect::getConnection();
            $stmt = $db->prepare("INSERT INTO klassenraum VALUES (Null, ?, ?, ?)");
            $stmt->bindValue(1, $s->getNummer(), PDO::PARAM_INT);
            $stmt->bindValue(2, $s->getSchulklassen_id(), PDO::PARAM_INT);
            $stmt->bindValue(3, $s->getTafel_id(), PDO::PARAM_INT);
            $stmt->execute();
            $s->id = $db->lastInsertId();
        } catch (Exception $e) {
            throw new Exception('Konnte Klassenraum nicht speichern<br>' . $e->getMessage());
        }
    }

    public static function update(Klassenraum $s) {
        try {
            $db = DbConnect::getConnection();

            $stmt = $db->prepare("UPDATE klassenraum SET nummer=?, schulklasse_id=?, tafel_id WHERE id=?");
            $stmt->bindValue(1, $s->getNummer(), PDO::PARAM_INT);
            $stmt->bindValue(2, $s->getSchulklasse_id(), PDO::PARAM_INT);
            $stmt->bindValue(3, $s->getTafel_id(), PDO::PARAM_INT);
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

}
