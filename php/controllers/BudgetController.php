<?php
include_once '../config/database.php';
include_once '../models/Budget.php';

class BudgetController {
    public function read() {
        $database = new Database();
        $db = $database->connect();

        $budget = new Budget($db);
        $result = $budget->read();
        $num = $result->rowCount();

        if($num > 0) {
            $budget_arr = array();
            $budget_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $budget_item = array(
                    'id' => $id,
                    'total_amount' => $total_amount,
                    'current_amount' => $current_amount
                );
                array_push($budget_arr['data'], $budget_item);
            }
            echo json_encode($budget_arr);
        } else {
            echo json_encode(array('message' => 'No budget found'));
        }
    }

    public function update() {
        $database = new Database();
        $db = $database->connect();

        $budget = new Budget($db);
        $data = json_decode(file_get_contents("php://input"));

        $budget->id = $data->id;
        $budget->total_amount = $data->total_amount;
        $budget->current_amount = $data->current_amount;

        if($budget->update()) {
            echo json_encode(array('message' => 'Budget Updated'));
        } else {
            echo json_encode(array('message' => 'Budget Not Updated'));
        }
    }
}
?>
