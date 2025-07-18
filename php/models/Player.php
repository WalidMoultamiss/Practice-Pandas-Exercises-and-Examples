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

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, position = :position, statistics = :statistics, health = :health, injuries = :injuries';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->position = htmlspecialchars(strip_tags($this->position));
        $this->statistics = htmlspecialchars(strip_tags($this->statistics));
        $this->health = htmlspecialchars(strip_tags($this->health));
        $this->injuries = htmlspecialchars(strip_tags($this->injuries));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':statistics', $this->statistics);
        $stmt->bindParam(':health', $this->health);
        $stmt->bindParam(':injuries', $this->injuries);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, position = :position, statistics = :statistics, health = :health, injuries = :injuries WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->position = htmlspecialchars(strip_tags($this->position));
        $this->statistics = htmlspecialchars(strip_tags($this->statistics));
        $this->health = htmlspecialchars(strip_tags($this->health));
        $this->injuries = htmlspecialchars(strip_tags($this->injuries));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':statistics', $this->statistics);
        $stmt->bindParam(':health', $this->health);
        $stmt->bindParam(':injuries', $this->injuries);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>
