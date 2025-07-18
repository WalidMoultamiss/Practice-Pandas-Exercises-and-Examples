<?php
include_once '../config/database.php';
include_once '../models/Player.php';

class PlayerController {
    public function read() {
        $database = new Database();
        $db = $database->connect();

        $player = new Player($db);
        $result = $player->read();
        $num = $result->rowCount();

        if($num > 0) {
            $players_arr = array();
            $players_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $player_item = array(
                    'id' => $id,
                    'name' => $name,
                    'position' => $position,
                    'statistics' => $statistics,
                    'health' => $health,
                    'injuries' => $injuries
                );
                array_push($players_arr['data'], $player_item);
            }
            echo json_encode($players_arr);
        } else {
            echo json_encode(array('message' => 'No players found'));
        }
    }

    public function create() {
        $database = new Database();
        $db = $database->connect();

        $player = new Player($db);
        $data = json_decode(file_get_contents("php://input"));

        $player->name = $data->name;
        $player->position = $data->position;
        $player->statistics = $data->statistics;
        $player->health = $data->health;
        $player->injuries = $data->injuries;

        if($player->create()) {
            echo json_encode(array('message' => 'Player Created'));
        } else {
            echo json_encode(array('message' => 'Player Not Created'));
        }
    }

    public function update() {
        $database = new Database();
        $db = $database->connect();

        $player = new Player($db);
        $data = json_decode(file_get_contents("php://input"));

        $player->id = $data->id;
        $player->name = $data->name;
        $player->position = $data->position;
        $player->statistics = $data->statistics;
        $player->health = $data->health;
        $player->injuries = $data->injuries;

        if($player->update()) {
            echo json_encode(array('message' => 'Player Updated'));
        } else {
            echo json_encode(array('message' => 'Player Not Updated'));
        }
    }

    public function delete() {
        $database = new Database();
        $db = $database->connect();

        $player = new Player($db);
        $data = json_decode(file_get_contents("php://input"));

        $player->id = $data->id;

        if($player->delete()) {
            echo json_encode(array('message' => 'Player Deleted'));
        } else {
            echo json_encode(array('message' => 'Player Not Deleted'));
        }
    }
}
?>
