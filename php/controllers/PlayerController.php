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
}
?>
