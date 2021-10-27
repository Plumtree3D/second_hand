<?php 

class Database {
    public function connect() {
        try {
            $db = new PDO("mysql:dbname=second_hand; host=localhost","root", "root");
            return $db;
        }
        catch(Exception $e) {
            die('Exception error : '.$e->getMessage());
        }
    }
}