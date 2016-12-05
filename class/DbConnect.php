<?php

/**
 * Description of DbConnect
 * design pattern: Singleton
 * @author Teilnehmer
 */
class DbConnect {
    
    private static $conn;
    public static function getConnection() {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO('mysql:host=' . DB_SERVER 
                        . ';dbname=' . DB_NAME . ';charset=utf8',
                        DB_USER, DB_PASSWD);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
                
            } catch (Exception $exc) {
                throw new Exception('Ich konnte mich nicht mit der Datenbank verbinden.');
            }
        
        }
        return self::$conn;
    }
}
