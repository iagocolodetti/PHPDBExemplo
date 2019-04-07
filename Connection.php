<?php

/**
 *
 * @author iagocolodetti
 */
final class Connection {
    
    private static $host = "localhost",
                   $user = "root",
                   $pass = "root",
                   $db = "contatodb",
                   $port = "3306";
    
    public static function getConnection() {
        $conn = new mysqli(self::$host, self::$user, self::$pass, self::$db, self::$port);
        
        if ($conn->connect_errno) {
            //print($conn->error);
            return null;
        } else {
            return $conn;
        }
    }
    
}
