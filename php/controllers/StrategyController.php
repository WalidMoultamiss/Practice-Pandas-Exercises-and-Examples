<?php
include_once '../config/database.php';
include_once '../models/Strategy.php';

class StrategyController {
    public function read() {
        $database = new Database();
        $db = $database->connect();

        $strategy = new Strategy($db);
        $result = $strategy->read();
        $num = $result->rowCount();

        if($num > 0) {
            $strategies_arr = array();
            $strategies_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $strategy_item = array(
                    'id' => $id,
                    'name' => $name,
                    'description' => $description,
                    'assigned_players' => $assigned_players
                );
                array_push($strategies_arr['data'], $strategy_item);
            }
            echo json_encode($strategies_arr);
        } else {
            echo json_encode(array('message' => 'No strategies found'));
        }
    }

    public function create() {
        $database = new Database();
        $db = $database->connect();

        $strategy = new Strategy($db);
        $data = json_decode(file_get_contents("php://input"));

        $strategy->name = $data->name;
        $strategy->description = $data->description;
        $strategy->assigned_players = $data->assigned_players;

        if($strategy->create()) {
            echo json_encode(array('message' => 'Strategy Created'));
        } else {
            echo json_encode(array('message' => 'Strategy Not Created'));
        }
    }

    public function update() {
        $database = new Database();
        $db = $database->connect();

        $strategy = new Strategy($db);
        $data = json_decode(file_get_contents("php://input"));

        $strategy->id = $data->id;
        $strategy->name = $data->name;
        $strategy->description = $data->description;
        $strategy->assigned_players = $data->assigned_players;

        if($strategy->update()) {
            echo json_encode(array('message' => 'Strategy Updated'));
        } else {
            echo json_encode(array('message' => 'Strategy Not Updated'));
        }
    }

    public function delete() {
        $database = new Database();
        $db = $database->connect();

        $strategy = new Strategy($db);
        $data = json_decode(file_get_contents("php://input"));

        $strategy->id = $data->id;

        if($strategy->delete()) {
            echo json_encode(array('message' => 'Strategy Deleted'));
        } else {
            echo json_encode(array('message' => 'Strategy Not Deleted'));
        }
    }
}
?>
