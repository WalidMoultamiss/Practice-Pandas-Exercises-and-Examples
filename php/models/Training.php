<?php
class Training {
    private $conn;
    private $table = 'training_sessions';

    public $id;
    public $type;
    public $date;
    public $players_involved;

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
        $query = 'INSERT INTO ' . $this->table . ' SET type = :type, date = :date, players_involved = :players_involved';
        $stmt = $this->conn->prepare($query);

        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->players_involved = htmlspecialchars(strip_tags($this->players_involved));

        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':players_involved', $this->players_involved);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET type = :type, date = :date, players_involved = :players_involved WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->players_involved = htmlspecialchars(strip_tags($this->players_involved));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':players_involved', $this->players_involved);
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
