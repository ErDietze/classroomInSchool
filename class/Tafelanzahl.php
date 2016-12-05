<?php

class Tafelanzahl {

    private $id;
    private $name;

    public function __construct($name, $id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
        }
        $this->name = $name;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
   public static function getAll() {
        try {
            $db = DbConnect::getConnection();
            //sql statemant mit prepare statements
            $stmt = $db->prepare("SELECT * FROM tafelanzahl");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tafelanzahl = [];
            foreach ($rows as $row) {
                $tafelanzahl[$row['id']] = new Tafelanzahl($row['name']);
            }
            return $tafelanzahl;
        } catch (Exception $e) {
            throw new Exception('Konnte Tafelanzahl nicht finden.<br>' . $e->getMessage());
        }
}}