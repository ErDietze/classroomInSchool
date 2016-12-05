<?php

class Schulklasse {

    private $id;
    private $name;
    private $schueler = [];

    public function __construct($name, $id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
        }
        $this->name = $name;
    }

    function getSchueler() {
        return $this->schueler;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function addSchueler(Schueler $schueler) {
        $this->schueler[$schueler->getId()] = $schueler;
    }

    public static function getAll($vorname = NULL, $nachname = NULL, $schulklasse_id = NULL) {
        try {
            if (is_null($schulklasse_id) || $schulklasse_id === '') {
                $db = DbConnect::getConnection();
                // ungefilterte Suche
                // sql statement mit prepared statements
                $stmt = $db->prepare("SELECT * FROM `schulklasse`");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $schulklassen = [];

                foreach ($rows as $row) {
                    $sk = new Schulklasse($row['name'], $row['id']);
                    $sk->loadSchueler($sk);
                    $schulklassen[$row['id']] = $sk;
                }
            } else {
                $schulklassen = self::getAllFiltered($vorname, $nachname, $schulklasse_id);
            }

            return $schulklassen;
        } catch (Exception $exc) {
            throw new Exception('Abfrage futsch:<br>' . $exc->getMessage());
        }
    }

    private static function getAllFiltered($vorname = NULL, $nachname = NULL, $schulklasse_id = NULL) {

        $db = DbConnect::getConnection();
        // gefilterte Suche
        // Lesezugriff auf table schulklasse UND schueler
        // fastload über 2 Tabellen, dient dem speed(nicht zwingend nötig)
        $sql = "SELECT sk.id AS schulklasse_id, name, s.id AS schueler_id, vorname, nachname "
                . "FROM schulklasse AS sk "
                . "LEFT JOIN schueler AS s ON(schulklasse_id = sk.id) "
                . "WHERE vorname LIKE ? "
                . "AND nachname LIKE ? "
                . "AND schulklasse_id LIKE ? "
                . "ORDER BY schulklasse_id ASC ";
        $stmt = $db->prepare($sql);

        // String für bind muss zuvor erstellt werden
        $vornameLike = "%$vorname%";
        $nachnameLike = "%$nachname%";
        if ($schulklasse_id === '0') {
            $schulklasse_idLike = '%';
        } else {
            $schulklasse_idLike = "%$schulklasse_id%";
        }

        $stmt->bindValue(1, $vornameLike, 2); // beide Varianten möglich, s.u.
        $stmt->bindValue(2, $nachnameLike, PDO::PARAM_STR);
        $stmt->bindValue(3, $schulklasse_idLike, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $schulklassen = [];

        $schulklasse_idOld = 0;
        foreach ($rows as $row) {
            if ($schulklasse_idOld != $row['schulklasse_id']) {
                $sk = new Schulklasse($row['name'], $row['schulklasse_id']);
                $schulklassen[$sk->getId()] = $sk;
                $schulklasse_idOld = $sk->getId();
            }
            if ($row['schueler_id'] !== 'null') {
                $sk->addSchueler(
                        new Schueler($row['schulklasse_id'], $row['vorname'], $row['nachname'], $row['schueler_id']));
            }
        }

        return $schulklassen;
    }

    private function loadSchueler($sk) {
        $this->schueler = Schueler::getAll($sk);
    }

    public static function getById($suchstring) {
        try {
            $db = DbConnect::getConnection();
            // $suchstring etnhält den zu suchenden Teilstring
            // sql statment mit prepare statements
            $stmt = $db->prepare("SELECT * FROM schulklasse WHERE id = ?");
            $stmt->bindValue(1, $suchstring, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $schulklasse = new Schulklasse($row['name'], $row['id']);

            return $schulklasse;
        } catch (Exception $e) {
            throw new Exception('Konnte Schulklassen nicht ausgeben<br>' . $e->getMessage());
        }
    }

    public static function insert(Schulklasse $k) {
        try {
            $db = DbConnect::getConnection();

            // sql statement mit prepared statements
            $stmt = $db->prepare("INSERT INTO schulklasse "
                    . "VALUES(NULL,?)");
            $stmt->bindValue(1, $k->getName(), PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Konnte Schulklasse nicht eingeben, schon vorhanden? <br>' . $e->getMessage());
        }
    }

    public static function update(Schulklasse $k) {
        try {
            $db = DbConnect::getConnection();

            $stmt = $db->prepare("UPDATE schulklasse SET name=? WHERE id=?");
            $stmt->bindValue(1, $k->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $k->getId(), PDO::PARAM_STR);

            $stmt->execute();
        } catch (Exception $exc) {
            throw new Exception('Schulklasse konnte nicht geändert werden, Duplikat?<br>' . $exc->getMessage());
        }
    }

    // delete Function löscht Schüler aus der Klasse und dann die gesamte Klasse 
    public static function delete($klassenIds) { //Bekommt Array mit KlassenIds übergeben
        foreach ($klassenIds as $klassenId) {
            Schulklasse::deleteSchulklasse($klassenId);
        }
    }

    public static function deleteSchulklasse($id) {
        try {
            $db = DbConnect::getConnection();
            // führt DELETE stmt zum löschen der Schulklasse aus
            $stmt = $db->prepare("DELETE FROM schulklasse WHERE id = ?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $exc) {
            throw new Exception('In der Klasse gibt es noch Schüler: ' . $exc->getMessage());
            //echo $exc->getTraceAsString();
        }
    }

    public static function getSchuelerById($id) {
        try {
            $objects = self::getAll();
            foreach ($objects as $sk) {
                foreach ($sk->getSchueler() as $schueler) {
                    if ($schueler->getId() == $id) {
                        $schuelerAlt = $schueler;
                    }
                }
            }
            return $schuelerAlt;
        } catch (Exception $e) {
            throw new Exception('Konnte Schüler in Schulklasse nicht finden<br>' . $e->getMessage());
        }
    }

}
