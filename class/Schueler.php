<?php

// declare(strict_types=1);
class Schueler {

    private $id;
    private $vorname;
    private $nachname;
    private $schulklasse_id;

    function getId() {
        return $this->id;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }

    function getSchulklasse_id() {
        return $this->schulklasse_id;
    }

    function __construct($schulklasse_id, $vorname, $nachname, $id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
        }
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->schulklasse_id = $schulklasse_id;
    }

    public static function getAll(Schulklasse $sk) {
        try {
            $db = DbConnect::getConnection();
            //sql statemant mit prepare statements
            $stmt = $db->prepare("SELECT vorname, nachname, schulklasse_id, id FROM schueler WHERE schulklasse_id = ?");
            $stmt->bindValue(1, $sk->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $schueler = [];
            foreach ($rows as $row) {
                $schueler[$row['id']] = new Schueler($row['schulklasse_id'], $row['vorname'], $row['nachname'], $row['id']);
            }
            return $schueler;
        } catch (Exception $e) {
            throw new Exception('Konnte Schüler zur Schulklasse nicht finden.<br>' . $e->getMessage());
        }
    }

    public static function insert(Schueler $s) {
        try {
            $db = DbConnect::getConnection();
            $stmt = $db->prepare("INSERT INTO schueler VALUES (Null, ?, ?, ?)");
            $stmt->bindValue(1, $s->getVorname(), PDO::PARAM_STR);
            $stmt->bindValue(2, $s->getNachname(), PDO::PARAM_STR);
            $stmt->bindValue(3, $s->getSchulklasse_id(), PDO::PARAM_INT);
            $stmt->execute();
            $s->id = $db->lastInsertId();
        } catch (Exception $e) {
            throw new Exception('Konnte Schüler nicht speichern<br>' . $e->getMessage());
        }
    }

    public static function update(Schueler $s) {
        try {
            $db = DbConnect::getConnection();

            $stmt = $db->prepare("UPDATE schueler SET vorname=?, nachname=?, schulklasse_id=? WHERE id=?");
            $stmt->bindValue(1, $s->getVorname(), PDO::PARAM_STR);
            $stmt->bindValue(2, $s->getNachname(), PDO::PARAM_STR);
            $stmt->bindValue(3, $s->getSchulklasse_id(), PDO::PARAM_INT);
            $stmt->bindValue(4, $s->getId(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Konnte Schülerinfo nicht in db ändern<br>' . $e->getMessage());
        }
    }

    public static function delete($ids) {
        try {
            $db = DbConnect::getConnection();
            $stmt = $db->prepare("DELETE FROM schueler WHERE id = ?");
            foreach ($ids as $id) {
                $stmt->bindValue(1, $id, PDO::PARAM_INT);
                $stmt->execute();
            }
            return;
        } catch (Exception $e) {
            throw new Exception('Konnte Schüler nicht löschen<br>' . $e->getMessage());
        }
    }

}
