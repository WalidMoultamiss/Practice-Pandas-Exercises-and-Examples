<?php
class Budget {
    private $conn;
    private $table = 'budgets';

    public $id;
    public $total_amount;
    public $current_amount;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET total_amount = :total_amount, current_amount = :current_amount WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->total_amount = htmlspecialchars(strip_tags($this->total_amount));
        $this->current_amount = htmlspecialchars(strip_tags($this->current_amount));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':total_amount', $this->total_amount);
        $stmt->bindParam(':current_amount', $this->current_amount);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>
