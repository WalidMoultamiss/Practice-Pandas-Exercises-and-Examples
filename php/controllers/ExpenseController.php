<?php
include_once '../config/database.php';
include_once '../models/Expense.php';
include_once '../models/Budget.php';

class ExpenseController {
    public function read() {
        $database = new Database();
        $db = $database->connect();

        $expense = new Expense($db);
        $result = $expense->read();
        $num = $result->rowCount();

        if($num > 0) {
            $expenses_arr = array();
            $expenses_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $expense_item = array(
                    'id' => $id,
                    'description' => $description,
                    'amount' => $amount,
                    'date' => $date
                );
                array_push($expenses_arr['data'], $expense_item);
            }
            echo json_encode($expenses_arr);
        } else {
            echo json_encode(array('message' => 'No expenses found'));
        }
    }

    public function create() {
        $database = new Database();
        $db = $database->connect();

        $expense = new Expense($db);
        $data = json_decode(file_get_contents("php://input"));

        $expense->description = $data->description;
        $expense->amount = $data->amount;
        $expense->date = $data->date;

        if($expense->create()) {
            $budget = new Budget($db);
            $result = $budget->read();
            $budget_data = $result->fetch(PDO::FETCH_ASSOC);
            $budget->id = $budget_data['id'];
            $budget->total_amount = $budget_data['total_amount'];
            $budget->current_amount = $budget_data['current_amount'] - $expense->amount;
            $budget->update();

            echo json_encode(array('message' => 'Expense Created'));
        } else {
            echo json_encode(array('message' => 'Expense Not Created'));
        }
    }
}
?>
