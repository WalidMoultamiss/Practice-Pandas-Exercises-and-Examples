<?php
include_once '../config/database.php';
include_once '../models/Training.php';

class TrainingController {
    public function read() {
        $database = new Database();
        $db = $database->connect();

        $training = new Training($db);
        $result = $training->read();
        $num = $result->rowCount();

        if($num > 0) {
            $training_arr = array();
            $training_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $training_item = array(
                    'id' => $id,
                    'type' => $type,
                    'date' => $date,
                    'players_involved' => $players_involved
                );
                array_push($training_arr['data'], $training_item);
            }
            echo json_encode($training_arr);
        } else {
            echo json_encode(array('message' => 'No training sessions found'));
        }
    }

    public function create() {
        $database = new Database();
        $db = $database->connect();

        $training = new Training($db);
        $data = json_decode(file_get_contents("php://input"));

        $training->type = $data->type;
        $training->date = $data->date;
        $training->players_involved = $data->players_involved;

        if($training->create()) {
            echo json_encode(array('message' => 'Training Session Created'));
        } else {
            echo json_encode(array('message' => 'Training Session Not Created'));
        }
    }

    public function update() {
        $database = new Database();
        $db = $database->connect();

        $training = new Training($db);
        $data = json_decode(file_get_contents("php://input"));

        $training->id = $data->id;
        $training->type = $data->type;
        $training->date = $data->date;
        $training->players_involved = $data->players_involved;

        if($training->update()) {
            echo json_encode(array('message' => 'Training Session Updated'));
        } else {
            echo json_encode(array('message' => 'Training Session Not Updated'));
        }
    }

    public function delete() {
        $database = new Database();
        $db = $database->connect();

        $training = new Training($db);
        $data = json_decode(file_get_contents("php://input"));

        $training->id = $data->id;

        if($training->delete()) {
            echo json_encode(array('message' => 'Training Session Deleted'));
        } else {
            echo json_encode(array('message' => 'Training Session Not Deleted'));
        }
    }
}
?>
