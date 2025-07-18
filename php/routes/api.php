<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../controllers/PlayerController.php';

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

$playerController = new PlayerController();

if ($request_uri === '/api/players' && $request_method === 'GET') {
    $playerController->read();
} else {
    http_response_code(404);
    echo json_encode(array('message' => 'Route not found'));
}
?>
