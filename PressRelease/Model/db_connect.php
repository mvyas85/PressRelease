<?php

class DBConnect {
    private static $dsn = 'mysql:host=localhost;dbname=pressrelease';
    private static $username = 'root';
    private static $password = '*******';
    private static $db ;

    private function __construct() {}

    public static function getDB () {        
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }
}
