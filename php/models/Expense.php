<?php
class Expense {
    private $conn;
    private $table = 'expenses';

    public $id;
    public $description;
    public $amount;
    public $date;

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
        $query = 'INSERT INTO ' . $this->table . ' SET description = :description, amount = :amount, date = :date';
        $stmt = $this->conn->prepare($query);

        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->date = htmlspecialchars(strip_tags($this->date));

        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':date', $this->date);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
?>
