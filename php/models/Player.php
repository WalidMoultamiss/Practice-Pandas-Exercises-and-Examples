<?php
class Player {
    private $conn;
    private $table = 'players';

    public $id;
    public $name;
    public $position;
    public $statistics;
    public $health;
    public $injuries;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
