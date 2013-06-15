<?php

defined('HOST') ? null : define('HOST', 'localhost');
defined('USER') ? null : define('USER', 'root');
defined('PASS') ? null : define('PASS', '');
defined('DB_NAME') ? null : define('DB_NAME', 'obuka');

class Database {

    private $db;

    public function __construct() {
        $this->open_connection();
    }

    private function open_connection() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=obuka", USER, PASS);
            $this->db->exec('set names utf8');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql) {
        $result = $this->db->query($sql);
        return $result;
    }

    public function fetch($result_set) {
        $result = $result_set->fetch();
        return $result;
    }

    public function num_rows($result_set) {
        $result = $result_set->rowCount();
        return $result;
    }

}

$database = new Database();
?>
